<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeporteRequest;
use App\Http\Requests\UpdateDeporteRequest;
use App\Models\Deporte;

class DeporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deportes = Deporte::all();

        return view('deportes.index', compact('deportes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeporteRequest $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $deporte = new Deporte();
        $deporte->nombre = $request->input('nombre');

        $deporte->save();

        return redirect()->route('deportes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deporte $deporte , $id)
    {
        $deporte = Deporte::findOrFail($id);

        return view('deportes.show', compact('deporte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deporte $deporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeporteRequest $request, Deporte $deporte ,$id)
    {
        $deporte = Deporte::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string',
        ]);

        $deporte->nombre = $request->input('nombre');

        $deporte->save();

        return redirect()->route('deportes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deporte $deporte ,$id)
    {
        $deporte = Deporte::findOrFail($id);

        $deporte->delete();
    }
}
