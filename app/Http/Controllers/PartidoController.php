<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePartidoRequest;
use App\Http\Requests\UpdatePartidoRequest;
use App\Models\Partido;
use App\Models\Equipo;
use App\Models\Deporte;
use App\Models\Ubicacion;
use App\Models\Asignamiento;
use App\Models\Superficie;
use App\Models\Pista;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Events\MensajeEnviado;
use App\Models\Mensaje;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Rules\UniquePistaHoraRule;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;




class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtén el usuario actualmente autenticado
        $usuario = auth()->user();

        // Obtén todos los partidos
        $partidos = Partido::with('user')->get();

        // Obtén los partidos en los que el usuario está inscrito
        $misPartidos = Asignamiento::where('user_id', $usuario->id)->pluck('partido_id');

        // Filtra los partidos para mostrar solo los que el usuario está inscrito
        $partidosInscritos = $partidos->whereIn('id', $misPartidos);

        // Pasa los partidos y "Mis Partidos" a la vista
        return view('partidos.index', compact('partidos', 'partidosInscritos'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $ubicaciones = Ubicacion::all();
        $deportes = Deporte::all();

        // Obtén la fecha y hora actual
        $now = Carbon::now();

        // Filtra las horas que ya han pasado
        $horasDisponibles = $this->obtenerHorasDisponibles($now);

        return view('partidos.create', [

            'ubicaciones' => $ubicaciones,
            'deportes' => $deportes,
            'horasDisponibles' => $horasDisponibles,
        ]);
    }

    // Función para obtener las horas disponibles a partir de la fecha y hora actuales
    private function obtenerHorasDisponibles($now)
    {
        $horasDisponibles = [];

        // Lógica para obtener las horas disponibles, teniendo en cuenta partidos/reservas existentes
        $horasPosibles = collect(range($now->hour, 22));

        // Filtra las horas que ya han pasado
        $horasFiltradas = $horasPosibles->filter(function ($hora) use ($now) {
            return ($hora > $now->hour) || ($hora == $now->hour && $hora > $now->minute);
        });

        foreach ($horasFiltradas as $hora) {
            // Verifica si hay un partido o reserva en esa pista a esa hora y fecha
            $horaCompleta = $hora . ':00';
            $partidoEnHora = Partido::where('fecha_hora', $now->format('Y-m-d') . ' ' . $horaCompleta)->exists();
            $pistaOcupada = Partido::where('fecha_hora', $now->format('Y-m-d') . ' ' . $horaCompleta)
                ->whereNotNull('pista_id')->exists();

            if (!$partidoEnHora && !$pistaOcupada) {
                $horasDisponibles[] = $horaCompleta;
            }
        }

        return $horasDisponibles;
    }







    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartidoRequest $request)
    {
        //dd($request->all()); // Muestra los datos recibidos antes de la validación
        $superficie = Superficie::where('tipo', $request->input('tipo_superficie'))->first();
        $deporte = Deporte::where('nombre', $request->input('deporte'))->first();

        // Obtén la fecha y hora seleccionadas por el usuario
        $fechaHoraSeleccionada = Carbon::parse($request->input('fecha') . ' ' . $request->input('hora'));

        // Verifica si hay algún partido existente en la misma hora, mismo día y misma pista
        if (Partido::where('pista_id', $request->input('pista_id'))
            ->where('fecha_hora', $fechaHoraSeleccionada)
            ->exists()
        ) {
            return redirect()->route('partidos.create')->with('error', 'Ya hay un partido programado en la misma hora, mismo día y misma pista.');
        }

        // Verifica si la pista está ocupada en la misma hora y día
        if (Partido::where('pista_id', $request->input('pista_id'))
            ->where('fecha_hora', $fechaHoraSeleccionada)
            ->exists()
        ) {
            return redirect()->back()->with('error', 'La pista ya está ocupada en la misma hora y día.');
        }



        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'ubicacion_id' => 'required',
            'deporte' => 'required',
            'precio' => 'required',
            new UniquePistaHoraRule('partidos', $request->input('hora'), $request->input('pista_id')),
        ]);

        $user = auth()->user()->id;
        $equipo1 = Equipo::find(1);
        $equipo2 = Equipo::find(2);

        // Obtén la pista seleccionada por el usuario
        $pista = Pista::find($request->pista_id);

        // Calcula el precio según la elección del usuario
        $precioSeleccionado = $request->precio;

        // Obtén la fecha y hora seleccionadas por el usuario
        $fechaHoraSeleccionada = Carbon::parse($request->input('fecha') . ' ' . $request->input('hora'));

        // Verifica si la hora seleccionada es igual o posterior a la hora actual
        $now = Carbon::now();
        if ($fechaHoraSeleccionada <= $now) {
            return redirect()->back()->with('error', 'La hora seleccionada debe ser posterior a la hora actual.');
        }

        Log::info('Fecha y Hora Seleccionadas:', ['fechaHoraSeleccionada' => $fechaHoraSeleccionada]);

        // Intenta insertar directamente usando el constructor de consultas
        DB::table('partidos')->insert([
            'fecha_hora' => $fechaHoraSeleccionada,
            'equipo1' => $equipo1->id,
            'equipo2' => $equipo2->id,
            'user_id' => $user,
            'superficie_id' => $superficie->id,
            'pista_id' => $request->input('pista_id'),
            'ubicacion_id' => $request->input('ubicacion_id'),
            'deporte_id' => $deporte->id,
            'precio' => $precioSeleccionado,
        ]);

        // TODO: hay que meter en la tabla asignamiento el usuario que crea el partido al azar en un equipo
        $ultimoPartido = Partido::orderBy('id', 'desc')->first();

        // TODO: hay que coger uno de los dos equipos aleatoriamente para asignárselo a la tabla asignamiento
        Asignamiento::create([
            'partido_id' => $ultimoPartido->id,
            'equipo_id' => $equipo1->id,
            'user_id' => $user,
        ]);

        return redirect()->route('partidos.index')->with('success', 'Partido creado exitosamente.');
    }



    public function show(Partido $partido)
    {
        // Obtener el usuario actual
        $usuarioActual = auth()->user();

        // Verificar si el usuario actual está inscrito en el partido
        $inscrito = Asignamiento::where('user_id', $usuarioActual->id)->where('partido_id', $partido->id)->first();

        // Verificar si el partido está completo
        $totalJugadores = Asignamiento::where('partido_id', $partido->id)->count();
        $limite = $this->obtenerLimitePorDeporte($partido->deporte->nombre);
        $partidoCompleto = $totalJugadores >= $limite * 2;

        return view('partidos.show', [
            'partido' => $partido,
            'usuarioActual' => $usuarioActual,
            'inscrito' => $inscrito,
            'partidoCompleto' => $partidoCompleto,
        ]);
    }



    // Intento ver el perfil del usuario


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partido $partido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartidoRequest $request, Partido $partido, $id)
    {
        $partido = Partido::findOrFail($id);

        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|time',
            'equipo1' => 'required|integer',
            'equipo2' => 'required|integer',
            'user_id' => 'required|integer',
            'resultado' => 'required|string',
            'ubicacion_id' => 'required|integer',
            'deporte_id' => 'required|integer',
        ]);

        $partido->fecha = $request->input('fecha');
        $partido->hora = $request->input('hora');
        $partido->equipo1 = $request->input('equipo1');
        $partido->equipo2 = $request->input('equipo2');
        $partido->user_id = $request->input('user_id');
        $partido->superficie_id = $request->input('superficie_id');
        $partido->pista_id = $request->input('pista_id');
        $partido->resultado = $request->input('resultado');
        $partido->ubicacion_id = $request->input('ubicacion_id');
        $partido->deporte_id = $request->input('deporte_id');

        $partido->save();

        return redirect()->route('partidos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partido $partido)
    {
        // Elimina todas las asignaciones asociadas al partido
        Asignamiento::where('partido_id', $partido->id)->delete();

        // Elimina el partido
        $partido->delete();

        // Mensaje de confirmación
        return redirect()->route('partidos.index')->with('success', 'Partido eliminado exitosamente.');
    }








    public function inscribirPartido(Partido $partido)
    {
        $user = auth()->user();

        // Verificar si el usuario ya está inscrito en el partido
        $inscrito = Asignamiento::where('user_id', $user->id)->where('partido_id', $partido->id)->first();
        if ($inscrito) {
            return redirect()->route('partidos.show', $partido)->with('success', 'Ya estás inscrito en el partido.');
        }

        // Verificar si el partido ya está completo
        $totalJugadores = Asignamiento::where('partido_id', $partido->id)->count();
        $limite = $this->obtenerLimitePorDeporte($partido->deporte->nombre);

        if ($totalJugadores >= $limite * 2) {
            return redirect()->route('partidos.show', $partido)->with('error', 'El partido está completo. No es posible inscribirse.');
        }

        // Después de inscribir al usuario, puedes enviar un mensaje
        $contenidoMensaje = '¡Nuevo jugador inscrito! ' . $user->name . ' se ha unido al partido.';


        // Obtener los equipos del partido
        $equipo1 = Equipo::find(1);
        $equipo2 = Equipo::find(2);

        // Contadores de jugadores en cada equipo
        $num_equipo1 = $equipo1->asignamientos->where('partido_id', $partido->id)->count();
        $num_equipo2 = $equipo2->asignamientos->where('partido_id', $partido->id)->count();

        // Seleccionar aleatoriamente uno de los equipos disponibles
        if ($num_equipo1 < $limite && $num_equipo2 < $limite) {
            $equiposDisponibles = [$equipo1, $equipo2];
        } elseif ($num_equipo1 < $limite) {
            $equiposDisponibles = [$equipo1];
        } elseif ($num_equipo2 < $limite) {
            $equiposDisponibles = [$equipo2];
        } else {
            return redirect()->route('partidos.show', $partido)->with('error', 'No se pudo asignar a un equipo. El partido puede estar completo.');
        }

        // Seleccionar aleatoriamente uno de los equipos disponibles
        $equipoAleatorio = $equiposDisponibles[array_rand($equiposDisponibles)];

        // Crear un nuevo registro en la tabla de asignamientos
        Asignamiento::create([
            'partido_id' => $partido->id,
            'equipo_id' => $equipoAleatorio->id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('partidos.show', $partido)->with('success', 'Te has inscrito al partido correctamente');
    }



    /* Desapuntarse */

    public function desapuntarse(Partido $partido)
    {
        $user = auth()->user()->id;
        $asignamiento =  Asignamiento::where('partido_id', $partido->id)
            ->where('user_id', $user)->first();

        // Eliminar la asignación
        if ($asignamiento) {
            Asignamiento::where('partido_id', $partido->id)
                ->where('user_id', $asignamiento->user_id)->where('equipo_id', $asignamiento->equipo_id)->delete();
        }

        return redirect()->route('partidos.show', $partido)->with('success', 'Te has desapuntado del partido correctamente.');
    }





    public function actualizarEstadoPago(Request $request, $partidoId)
    {
        $partido = Partido::findOrFail($partidoId);

        // Actualiza el estado del pago en la base de datos
        $partido->update(['pago_aprobado' => $request->pago_aprobado]);

        // Almacena el estado del pago en la sesión
        session(['pago_aprobado_' . $partidoId => $request->pago_aprobado]);

        return response()->json(['success' => true]);
    }





    // Función para obtener el límite según el deporte
    private function obtenerLimitePorDeporte($deporte)
    {
        switch ($deporte) {
            case 'Futbol 7':
                return 7;
            case 'Futbol Sala':
                return 5;
            case 'Padel':
                return 2; // Cambiado a 2 jugadores por equipo para pádel
            case 'Baloncesto':
                return 5;
            case 'Tenis':
                return 1;
            case 'Judo':
                return 1;
            default:
                return 0; // Valor predeterminado
        }
    }



    private function usuarioApuntado($partido)
    {
        $usuario = auth()->user();

        return $partido->asignamientos()->where('user_id', $usuario->id)->exists();
    }
}
