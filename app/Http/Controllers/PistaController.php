<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePistaRequest;
use App\Http\Requests\UpdatePistaRequest;
use App\Models\Pista;

class PistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePistaRequest $request)
    {
        $request->validate([
            'ubicacion_id' => 'required|integer',
            'superficie_id' => 'required|integer',
            'numero' => 'required|integer',
            'tipo' => 'required|string',
        ]);

        $pista = new Pista();
        $pista->ubicacion_id = $request->input('ubicacion_id');
        $pista->superficie_id = $request->input('superficie_id');
        $pista->numero = $request->input('numero');
        $pista->tipo = $request->input('tipo');

        $pista->save();

        return redirect()->route('pistas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pista $pista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pista $pista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePistaRequest $request, Pista $pista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pista $pista)
    {
        //
    }
}
