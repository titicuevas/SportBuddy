<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipoRequest;
use App\Http\Requests\UpdateEquipoRequest;
use App\Models\Equipo;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipo::all();

        return view('equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipoRequest $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $equipo = new Equipo();
        $equipo->nombre = $request->input('nombre');

        $equipo->save();

        return redirect()->route('equipos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        $equipo = Equipo::findOrFail($equipo);

        return view('equipos.edit', compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipoRequest $request, Equipo $equipo)
    {
        
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $equipo = Equipo::findOrFail($equipo);
        $equipo->nombre = $request->input('nombre');

        $equipo->save();

        return redirect()->route('equipos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        //
    }
}
