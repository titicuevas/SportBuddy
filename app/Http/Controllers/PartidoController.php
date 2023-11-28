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
            'hora' => 'required', //preguntar a ricardo
            'ubicacion_id' => 'required',
            'deporte' => 'required',
        ]);

        $user = auth()->user()->id;
        $equipo1 = Equipo::find(1);
        $equipo2 = Equipo::find(2);

        Partido::create([
            'fecha' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'equipo1' => $equipo1->id, //Le asignamos el id del equipo1
            'equipo2' => $equipo2->id, //Le asignamos el id del equipo2
            'user_id' => $user,
            'superficie_id' => $superficie->id,
            'pista_id' => $request->input('pista_id'),
            'ubicacion_id' => $request->input('ubicacion_id'),
            'deporte_id' => $deporte->id,
        ]);


        //TODO: hay que meter en la tabla asignamiento el usuario que crea el partido al azar en un equipo
        $ultimoPartido = Partido::orderBy('id', 'desc')->first();


        //TODO: hay que coger uno de los dos equipos aleatoriamente para asignarselo a la tabla asignamiento
        Asignamiento::create([
            'partido_id' => $ultimoPartido->id,
            'equipo_id' => $equipo1->id,
            'user_id' => $user,
        ]);


        //Con este metodo el usuario que crea el partido se le asignaria al partido

        return redirect()->route('partidos.index')->with('success', 'Partido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */

    /* public function show(user $id)

    Fallaria y no mostraria los partidos

    */


    public function show(Partido $partido)
    {
        return view('partidos.show', ['partido' => $partido]);
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
        $partido = Partido::find($partido->id);
        $asignaciones = $partido->asignamientos;
        /*     foreach ($asignaciones as $asignacion) {
        $asignacion->delete();
    } */

        // Ahora puedes eliminar el partido
        //$partido->delete();

        // Mensaje de confirmación

        return $asignaciones;
    }


    public function inscribirPartido(Partido $partido)
    {
        $user = auth()->user()->id;

        // Verificar si el usuario ya está inscrito en el partido
        $inscrito = Asignamiento::where('user_id', $user)->where('partido_id', $partido->id)->first();
        if ($inscrito) {
            return redirect()->route('partidos.show', $partido)->with('success', 'Ya estás inscrito en el partido.');
        }

        // Verificar si el partido ya está completo
        $totalJugadores = Asignamiento::where('partido_id', $partido->id)->count();
        $limite = $this->obtenerLimitePorDeporte($partido->deporte->nombre);

        if ($totalJugadores >= $limite) {
            return redirect()->route('partidos.show', $partido)->with('error', 'El partido está completo. No es posible inscribirse.');
        }

        // Resto de la lógica para asignar al usuario a un equipo
        $equipos = [
            Equipo::find(1),
            Equipo::find(2),
        ];

        $num_equipo1 = 0;
        $num_equipo2 = 0;

        foreach ($equipos[0]->asignamientos as $asignamiento) {
            if ($asignamiento['partido_id'] == $partido->id) {
                if ($num_equipo1 < $limite) {
                    $asignamiento['equipo_id'] = 1;
                    $num_equipo1++;
                }
            }
        }

        foreach ($equipos[1]->asignamientos as $asignamiento) {
            if ($asignamiento['partido_id'] == $partido->id) {
                if ($num_equipo2 < $limite) {
                    $asignamiento['equipo_id'] = 2;
                    $num_equipo2++;
                }
            }
        }

        // Seleccionar aleatoriamente uno de los equipos (en caso de que no se haya llenado por completo)
        $equipoAleatorio = $equipos[array_rand($equipos)];

        // Crear un nuevo registro en la tabla de asignamientos
        Asignamiento::create([
            'partido_id' => $partido->id,
            'equipo_id' => $equipoAleatorio->id,
            'user_id' => $user,
        ]);

        return redirect()->route('partidos.show', $partido)->with('success', 'Te has inscrito al partido correctamente');
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
}
