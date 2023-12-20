<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUbicacionRequest;
use App\Models\Ubicacion;

class AdminUbicacionController extends Controller
{
    public function index()
    {
        $ubicaciones = Ubicacion::all();

        return view('admin.ubicacion.index', compact('ubicaciones'));
    }

    public function create()
    {
        return view('admin.ubicacion.create');
    }

    public function store(StoreUbicacionRequest $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ajusta según tus necesidades
            'enlace_maps' => 'nullable|url',
            'iframe' => 'nullable|string',
        ]);

        // Procesar la imagen si se proporciona
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('imagenes/ubicaciones', 'public');
        }

        Ubicacion::create([
            'nombre' => $request->input('nombre'),
            'direccion' => $request->input('direccion'),
            'imagen' => $imagenPath,
            'enlace_maps' => $request->input('enlace_maps'),
            'iframe' => $request->input('iframe'),
        ]);

        return redirect()->route('admin.ubicacion.index')->with('success', 'Ubicación agregada exitosamente.');
    }
}
