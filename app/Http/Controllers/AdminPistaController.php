<?php

namespace App\Http\Controllers;

use App\Models\Pista;
use App\Models\Ubicacion;
use App\Models\Superficie;
use App\Models\Deporte;
use Illuminate\Http\Request;

class AdminPistaController extends Controller
{
    /**
     * Muestra un listado de las pistas.
     */
    public function index()
    {
        $pistas = Pista::all();
        return view('admin.pista.index', compact('pistas'));
    }

    /**
     * Muestra el formulario para crear una nueva pista.
     */
    public function create()
    {
        $ubicaciones = Ubicacion::all();
        $superficies = Superficie::all();
        $deportes = Deporte::all();

        return view('admin.pista.create', compact('ubicaciones', 'superficies', 'deportes'));
    }

    /**
     * Almacena una nueva pista en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'superficie_id' => 'required|exists:superficies,id',
            'deporte_id' => 'required|exists:deportes,id',
            'numero' => 'required|integer|min:0',
            'tiene_luz' => 'required|boolean',
            'precio_sin_luz' => 'required|numeric|min:0',
            'precio_con_luz' => 'nullable|numeric|min:0',
        ]);

        return redirect()->route('admin.pista.index')->with('success', 'Pista creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una pista.
     */
    public function edit(Pista $pista)
    {
        $ubicaciones = Ubicacion::all();
        $superficies = Superficie::all();
        $deportes = Deporte::all();

        return view('admin.pista.edit', compact('pista', 'ubicaciones', 'superficies', 'deportes'));
    }

    /**
     * Actualiza la información de una pista en la base de datos.
     */
    public function update(Request $request, Pista $pista)
    {
        $request->validate([
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'superficie_id' => 'required|exists:superficies,id',
            'deporte_id' => 'required|exists:deportes,id',
            'numero' => 'required|integer|min:0',
            'tiene_luz' => 'required|boolean',
            'precio_sin_luz' => 'required|numeric|min:0',
            'precio_con_luz' => 'nullable|numeric|min:0',
        ]);
        return redirect()->route('admin.pista.index')->with('success', 'Pista actualizada exitosamente.');
    }

    /**
     * Elimina una pista de la base de datos.
     */
    public function destroy(Pista $pista)
    {
        $pista->delete();

        return redirect()->route('admin.pista.index')->with('success', 'Pista eliminada exitosamente.');
    }
}
