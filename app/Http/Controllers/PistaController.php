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
        // Asegúrate de cargar la relación 'superficie'
        $pista->load('superficie');

        return response()->json([
            'numero' => $pista->numero,
            'tipo_superficie' => $pista->superficie ? $pista->superficie->tipo : 'Tipo Desconocido',
        ]);
    }



    /*
        Para encontrar la ubicacion de la pista y sacar el numero
    */

    public function pistasPorUbicacion($ubicacionId)
    {
        try {
            $pistas = Pista::where('ubicacion_id', $ubicacionId)->get(['id', 'numero']);
            return response()->json($pistas);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Hubo un error al obtener pistas'], 500);
        }
    }

    /* Para encontrar la superficie de la pista */

    public function superficiePorUbicacion($ubicacionId)
    {
        try {
            $pistas = Pista::with('superficie')->where('ubicacion_id', $ubicacionId)->get(['id', 'numero', 'superficie.tipo']);
            return response()->json($pistas);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function deportePorPista($pistaId)
    {
        $pista = Pista::findOrFail($pistaId);
        $deporte = $pista->deporte;

        return response()->json(['nombre' => $deporte ? $deporte->nombre : 'Desconocido']);
    }




    public function cargarTipoSuperficie($pistaId)
{
    try {
        if ($pistaId !== null) {
            $pista = Pista::findOrFail($pistaId);
            $tipoSuperficie = $pista->superficie ? $pista->superficie->tipo : 'Tipo Desconocido';

            return response()->json(['tipo_superficie' => $tipoSuperficie]);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
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
