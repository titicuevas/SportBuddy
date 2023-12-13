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


class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partidos = Partido::with('user')->get();

        // $partidos = Partido::with('ubicacion')->get();

        return view('partidos.index', compact('partidos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $ubicaciones = ubicacion::all();
        $deportes = Deporte::all();

        return view('partidos.create', ['ubicaciones' => $ubicaciones, 'deportes' => $deportes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartidoRequest $request)
    {
        $superficie = Superficie::where('tipo', $request->input('tipo_superficie'))->first();
        $deporte = Deporte::where('nombre', $request->input('deporte'))->first();

        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'ubicacion_id' => 'required',
            'deporte' => 'required',
            'precio' => 'required',
        ]);

        $user = auth()->user()->id;
        $equipo1 = Equipo::find(1);
        $equipo2 = Equipo::find(2);

        // Obtén la pista seleccionada por el usuario
        $pista = Pista::find($request->pista_id);

        // Calcula el precio según la elección del usuario
        $precioSeleccionado = $request->precio;

        // Opcional: Puedes validar que el precio seleccionado sea uno de los valores permitidos
        // Puedes agregar lógica adicional según tus necesidades

        Partido::create([
            'fecha_hora' => $request->input('fecha') . ' ' . $request->input('hora'), // Combina fecha y hora
            'equipo1' => $equipo1->id,
            'equipo2' => $equipo2->id,
            'user_id' => $user,
            'superficie_id' => $superficie->id,
            'pista_id' => $request->input('pista_id'),
            'ubicacion_id' => $request->input('ubicacion_id'),
            'deporte_id' => $deporte->id,
            'precio' => $precioSeleccionado, // Usar el precio seleccionado por el usuario
        ]);

        // TODO: hay que meter en la tabla asignamiento el usuario que crea el partido al azar en un equipo
        $ultimoPartido = Partido::orderBy('id', 'desc')->first();

        // TODO: hay que coger uno de los dos equipos aleatoriamente para asignarselo a la tabla asignamiento
        Asignamiento::create([
            'partido_id' => $ultimoPartido->id,
            'equipo_id' => $equipo1->id,
            'user_id' => $user,
        ]);

        // Con este método, el usuario que crea el partido se le asignaría al partido
        return redirect()->route('partidos.index')->with('success', 'Partido creado exitosamente.');
        return response()->json(['message' => 'Partido creado exitosamente.'], 200);
    }


    /**
     * Display the specified resource.
     */

    /* public function show(user $id)

    Fallaria y no mostraria los partidos

    */


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
