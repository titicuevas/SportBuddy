<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePartidoRequest;
use App\Models\Asignamiento;
use App\Models\Comentario;
use App\Models\Deporte;
use App\Models\Mensaje;
use App\Models\Partido;
use App\Models\Pista;
use App\Models\Superficie;
use App\Models\Ubicacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Rules\UniquePistaHoraRule;
use App\Services\StatsService;
use App\Services\WeatherService;




class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarioId = auth()->id();
        $cacheVersion = Cache::get('partidos.cache.version', 1);

        $partidos = Cache::remember("partidos.v{$cacheVersion}.disponibles.{$usuarioId}", 60, function () use ($usuarioId) {
            return Partido::query()
                ->future()
                ->whereDoesntHave('asignamientos', fn ($q) => $q->where('user_id', $usuarioId))
                ->withCardData()
                ->orderBy('fecha_hora')
                ->get();
        });

        $partidosInscritos = Cache::remember("partidos.v{$cacheVersion}.inscritos.{$usuarioId}", 60, function () use ($usuarioId) {
            return Partido::query()
                ->future()
                ->forUser($usuarioId)
                ->withCardData()
                ->orderBy('fecha_hora')
                ->get();
        });

        return view('partidos.index', compact('partidos', 'partidosInscritos'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $ubicaciones = Ubicacion::query()->orderBy('nombre')->get();

        return view('partidos.create', compact('ubicaciones'));
    }







    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartidoRequest $request)
    {
        $validated = $request->validate([
            'fecha' => ['required', 'date', 'after_or_equal:today', new UniquePistaHoraRule($request->input('hora'), $request->input('pista_id'))],
            'hora' => 'required',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'deporte' => 'required|exists:deportes,nombre',
            'pista_id' => 'required|exists:pistas,id',
            'precio' => 'required|numeric|min:0',
            'tipo_superficie' => 'required|exists:superficies,tipo',
        ]);

        $fechaHora = Carbon::parse($validated['fecha'].' '.$validated['hora']);

        if ($fechaHora <= now()) {
            return back()->with('error', 'La hora seleccionada debe ser posterior a la hora actual.');
        }

        $superficie = Superficie::where('tipo', $validated['tipo_superficie'])->firstOrFail();
        $deporte = Deporte::where('nombre', $validated['deporte'])->firstOrFail();
        $userId = auth()->id();

        try {
            DB::transaction(function () use ($fechaHora, $superficie, $deporte, $validated, $userId) {
                $partido = Partido::create([
                    'fecha_hora' => $fechaHora,
                    'equipo1' => 1,
                    'equipo2' => 2,
                    'user_id' => $userId,
                    'superficie_id' => $superficie->id,
                    'pista_id' => $validated['pista_id'],
                    'ubicacion_id' => $validated['ubicacion_id'],
                    'deporte_id' => $deporte->id,
                    'precio' => $validated['precio'],
                ]);

                Asignamiento::create([
                    'partido_id' => $partido->id,
                    'equipo_id' => 1,
                    'user_id' => $userId,
                ]);
            });
        } catch (\Illuminate\Database\QueryException $e) {
            if (str_contains($e->getMessage(), 'partidos_pista_fecha_hora_unique')) {
                return back()->with('error', 'Ya hay un partido en esa pista a esa hora.');
            }

            throw $e;
        }

        $this->bumpPartidosCache();
        $this->clearHorasOcupadasCache((int) $validated['pista_id'], $validated['fecha']);

        return redirect()->route('partidos.index')->with('success', 'Partido creado exitosamente.');
    }

    private function bumpPartidosCache(): void
    {
        $version = (int) Cache::get('partidos.cache.version', 1);
        Cache::put('partidos.cache.version', $version + 1);
        StatsService::bump();
    }

    private function clearHorasOcupadasCache(int $pistaId, string $fecha): void
    {
        Cache::forget("horas_ocupadas.{$pistaId}.{$fecha}");
    }



    public function show(Partido $partido)
    {
        $partido->load([
            'user:id,name',
            'ubicacion:id,nombre,direccion,enlace_maps,iframe',
            'pista:id,numero',
            'deporte:id,nombre',
            'asignamientos.user:id,name',
            'comentarios' => fn ($q) => $q->with('user:id,name')->orderBy('created_at'),
        ]);

        $usuarioActual = auth()->user();
        $inscrito = $partido->usuarioInscrito($usuarioActual->id);
        $limite = Partido::limitePorDeporte($partido->deporte->nombre);
        $partidoCompleto = $partido->asignamientos->count() >= $limite * 2;

        return view('partidos.show', compact('partido', 'usuarioActual', 'inscrito', 'partidoCompleto'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partido $partido)
    {
        abort_unless(auth()->id() === $partido->user_id, 403);

        Mensaje::where('partido_id', $partido->id)->delete();
        Asignamiento::where('partido_id', $partido->id)->delete();
        $partido->comentarios()->delete();
        $partido->delete();

        $this->bumpPartidosCache();

        return redirect()->route('partidos.index')->with('success', 'Partido eliminado exitosamente.');
    }








    public function inscribirPartido(Partido $partido)
    {
        $user = auth()->user();
        $partido->load('deporte:id,nombre');
        $limite = Partido::limitePorDeporte($partido->deporte->nombre);

        if (Asignamiento::where('partido_id', $partido->id)->where('user_id', $user->id)->exists()) {
            return back()->with('success', 'Ya estás inscrito en el partido.');
        }

        $conteos = Asignamiento::query()
            ->where('partido_id', $partido->id)
            ->selectRaw('equipo_id, COUNT(*) as total')
            ->groupBy('equipo_id')
            ->pluck('total', 'equipo_id');

        $totalJugadores = $conteos->sum();

        if ($totalJugadores >= $limite * 2) {
            return back()->with('error', 'El partido está completo.');
        }

        $equiposDisponibles = collect();

        if (($conteos[1] ?? 0) < $limite) {
            $equiposDisponibles->push(1);
        }

        if (($conteos[2] ?? 0) < $limite) {
            $equiposDisponibles->push(2);
        }

        if ($equiposDisponibles->isEmpty()) {
            return back()->with('error', 'No se pudo asignar a un equipo.');
        }

        try {
            Asignamiento::create([
                'partido_id' => $partido->id,
                'equipo_id' => $equiposDisponibles->random(),
                'user_id' => $user->id,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            if (str_contains($e->getMessage(), 'asignamientos_partido_user_unique')) {
                return back()->with('success', 'Ya estás inscrito en el partido.');
            }

            throw $e;
        }

        $this->bumpPartidosCache();

        return back()->with('success', 'Te has inscrito al partido correctamente.');
    }



    /* Desapuntarse */

    public function desapuntarse(Partido $partido)
    {
        $userId = auth()->id();

        Comentario::where('partido_id', $partido->id)
            ->where('user_id', $userId)
            ->delete();

        Asignamiento::where('partido_id', $partido->id)
            ->where('user_id', $userId)
            ->delete();

        $this->bumpPartidosCache();

        return back()->with('success', 'Te has desapuntado del partido correctamente.');
    }





    public function obtenerHorasOcupadas(int $pistaId, string $fecha)
    {
        $horas = Cache::remember("horas_ocupadas.{$pistaId}.{$fecha}", 30, function () use ($pistaId, $fecha) {
            return Partido::query()
                ->where('pista_id', $pistaId)
                ->whereDate('fecha_hora', $fecha)
                ->pluck('fecha_hora')
                ->map(fn ($fechaHora) => Carbon::parse($fechaHora)->format('H:i'))
                ->values()
                ->all();
        });

        return response()->json($horas);
    }

    public function clima(Partido $partido, WeatherService $weather)
    {
        $partido->load('ubicacion:id,nombre,direccion');

        return response()->json(
            $weather->getForUbicacion($partido->ubicacion, Carbon::parse($partido->fecha_hora))
        );
    }

    public function climaUbicacion(Request $request, Ubicacion $ubicacion, WeatherService $weather)
    {
        $request->validate([
            'fecha' => ['nullable', 'date'],
            'hora' => ['nullable', 'date_format:H:i'],
        ]);

        $fechaHora = $request->filled('fecha')
            ? Carbon::parse($request->fecha)
            : now();

        if ($request->filled('hora')) {
            [$hora, $minuto] = explode(':', $request->hora);
            $fechaHora->setTime((int) $hora, (int) $minuto);
        }

        return response()->json($weather->getForUbicacion($ubicacion, $fechaHora));
    }
}
