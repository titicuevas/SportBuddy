<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartidoRequest;
use App\Models\Asignamiento;
use App\Models\Comentario;
use App\Models\Mensaje;
use App\Models\Partido;
use App\Models\Pista;
use App\Models\Ubicacion;
use App\Services\StatsService;
use App\Services\WeatherService;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PartidoController extends Controller
{
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

    public function create()
    {
        $ubicaciones = Ubicacion::query()->orderBy('nombre')->get();

        return view('partidos.create', compact('ubicaciones'));
    }

    public function store(StorePartidoRequest $request)
    {
        $validated = $request->validated();

        $fechaHora = Carbon::parse($validated['fecha'].' '.$validated['hora']);

        if ($fechaHora <= now()) {
            return back()->with('error', 'La hora seleccionada debe ser posterior a la hora actual.');
        }

        $pista = Pista::findOrFail($validated['pista_id']);
        $userId = auth()->id();

        try {
            DB::transaction(function () use ($fechaHora, $pista, $validated, $userId) {
                $partido = Partido::create([
                    'fecha_hora' => $fechaHora,
                    'equipo_local_nombre' => 'Equipo Azul',
                    'equipo_visitante_nombre' => 'Equipo Naranja',
                    'user_id' => $userId,
                    'superficie_id' => $pista->superficie_id,
                    'pista_id' => $pista->id,
                    'ubicacion_id' => $pista->ubicacion_id,
                    'deporte_id' => $pista->deporte_id,
                    'precio' => $validated['precio'],
                ]);

                Asignamiento::create([
                    'partido_id' => $partido->id,
                    'lado' => $partido->ladoLocal(),
                    'user_id' => $userId,
                ]);
            });
        } catch (QueryException $e) {
            if (str_contains($e->getMessage(), 'partidos_pista_fecha_hora_unique')) {
                return back()->with('error', 'Ya hay un partido en esa pista a esa hora.');
            }

            throw $e;
        }

        $this->bumpPartidosCache();
        $this->clearHorasOcupadasCache((int) $validated['pista_id'], $validated['fecha']);

        return redirect()->route('partidos.index')->with('success', 'Partido creado exitosamente.');
    }

    public function show(Partido $partido)
    {
        $partido->load([
            'user:id,name',
            'ubicacion:id,nombre,direccion,enlace_maps,iframe',
            'pista:id,numero',
            'deporte:id,nombre,jugadores_por_equipo',
            'asignamientos.user:id,name',
            'comentarios' => fn ($q) => $q->with('user:id,name')->orderBy('created_at'),
        ]);

        $usuarioActual = auth()->user();
        $inscrito = $partido->usuarioInscrito($usuarioActual->id);
        $partidoCompleto = $partido->estaCompleto();
        $mapIframe = $partido->ubicacion->iframe
            ? str_replace('<iframe', '<iframe loading="lazy" referrerpolicy="no-referrer-when-downgrade"', $partido->ubicacion->iframe)
            : '';

        return view('partidos.show', compact('partido', 'usuarioActual', 'inscrito', 'partidoCompleto', 'mapIframe'));
    }

    public function destroy(Partido $partido)
    {
        abort_unless(auth()->id() === $partido->user_id, 403);

        $pistaId = (int) $partido->pista_id;
        $fecha = $partido->fecha_hora->toDateString();

        DB::transaction(function () use ($partido) {
            Mensaje::where('partido_id', $partido->id)->delete();
            Asignamiento::where('partido_id', $partido->id)->delete();
            $partido->comentarios()->delete();
            $partido->delete();
        });

        $this->bumpPartidosCache();
        $this->clearHorasOcupadasCache($pistaId, $fecha);

        return redirect()->route('partidos.index')->with('success', 'Partido eliminado exitosamente.');
    }

    public function inscribirPartido(Partido $partido)
    {
        abort_if($partido->fecha_hora->isPast(), 403, 'Este partido ya ha finalizado.');

        $user = auth()->user();
        $partido->load('deporte:id,nombre,jugadores_por_equipo');
        $limite = $partido->deporte->limitePorEquipo();

        try {
            $resultado = DB::transaction(function () use ($partido, $user, $limite) {
                $partidoBloqueado = Partido::query()
                    ->whereKey($partido->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if (Asignamiento::where('partido_id', $partidoBloqueado->id)->where('user_id', $user->id)->exists()) {
                    return ['type' => 'success', 'message' => 'Ya estás inscrito en el partido.'];
                }

                $conteos = Asignamiento::query()
                    ->where('partido_id', $partidoBloqueado->id)
                    ->selectRaw('lado, COUNT(*) as total')
                    ->groupBy('lado')
                    ->lockForUpdate()
                    ->pluck('total', 'lado');

                if ($conteos->sum() >= $limite * 2) {
                    return ['type' => 'error', 'message' => 'El partido está completo.'];
                }

                $ladoAsignado = collect([$partidoBloqueado->ladoLocal(), $partidoBloqueado->ladoVisitante()])
                    ->filter(fn (int $lado) => ($conteos[$lado] ?? 0) < $limite)
                    ->sortBy(fn (int $lado) => $conteos[$lado] ?? 0)
                    ->first();

                if (! $ladoAsignado) {
                    return ['type' => 'error', 'message' => 'No se pudo asignar a un equipo.'];
                }

                Asignamiento::create([
                    'partido_id' => $partidoBloqueado->id,
                    'lado' => $ladoAsignado,
                    'user_id' => $user->id,
                ]);

                return ['type' => 'success', 'message' => 'Te has inscrito al partido correctamente.'];
            }, 3);
        } catch (QueryException $e) {
            if (str_contains($e->getMessage(), 'asignamientos_partido_user_unique')) {
                return back()->with('success', 'Ya estás inscrito en el partido.');
            }

            throw $e;
        }

        $this->bumpPartidosCache();

        return back()->with($resultado['type'], $resultado['message']);
    }

    public function desapuntarse(Partido $partido)
    {
        abort_if($partido->fecha_hora->isPast(), 403, 'Este partido ya ha finalizado.');

        $userId = auth()->id();

        abort_if($partido->user_id === $userId, 403, 'El creador no puede desapuntarse. Elimina el partido si ya no quieres organizarlo.');

        $borrado = DB::transaction(function () use ($partido, $userId) {
            Comentario::where('partido_id', $partido->id)
                ->where('user_id', $userId)
                ->delete();

            return Asignamiento::where('partido_id', $partido->id)
                ->where('user_id', $userId)
                ->delete();
        });

        abort_unless($borrado, 403, 'No estás inscrito en este partido.');

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
            $weather->getForUbicacion($partido->ubicacion, $partido->fecha_hora)
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
}
