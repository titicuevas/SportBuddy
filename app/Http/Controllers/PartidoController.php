<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartidoRequest;
use App\Http\Requests\UpdatePartidoRequest;
use App\Models\Partido;
use App\Models\Equipo;
use App\Models\Deporte;
use App\Models\Ubicacion;


class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partidos = Partido::all();

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
       $request->validate([

            'fecha' => 'required|date',
            'time' => 'required|date_format:H:i',
            'equipo1' => 'required|integer',
            'equipo2' => 'required|integer',
            'user_id' => 'required|integer',
            'resultado' => 'string',
            'ubicacion_id' => 'required|integer',
            'deporte_id' => 'required|integer',
        ]);

        $partido = new Partido();
        $partido->fecha = $request->input('fecha');
        $partido->hora = $request->input('hora');
        $partido->equipo1 = Equipo::find(1);
        $partido->equipo2 = Equipo::find(2);
        $partido->user_id = auth()->user()->name;
        $partido->ubicacion_id = $request->input('ubicacion_id');
        $partido->deporte_id = $request->input('deporte_id');

        $partido->save();
        return redirect()->route('partidos.index')->with('success', 'Partido creado exitosamente.');    }

    /**
     * Display the specified resource.
     */
    public function show(Partido $partido ,$id)
    {
        $partido = Partido::findOrFail($id);

        return view('partidos.show', compact('partido'));
    }

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
    public function update(UpdatePartidoRequest $request, Partido $partido,$id)
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
        $partido->delete();

    return redirect()->route('partidos.index');
    }
}
