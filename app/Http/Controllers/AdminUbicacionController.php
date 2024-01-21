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
        $ubicaciones = Ubicacion::paginate(10); // Cambia el número según tus necesidades

        return view('admin.ubicacion.index', compact('ubicaciones'));
    }

    public function create()
    {
        return view('admin.ubicacion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'enlace_maps' => 'nullable|string',
            'iframe' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg|max:2048', // Ajusta las extensiones y el tamaño según tus necesidades
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo JPEG.',
            'imagen.max' => 'La imagen no debe superar los 2 MB.',
            // Puedes personalizar los mensajes de error según tus necesidades
        ]);

        // Lógica para guardar la ubicación y la imagen
        $ubicacion = new Ubicacion();
        $ubicacion->nombre = $request->nombre;
        $ubicacion->direccion = $request->direccion;
        $ubicacion->enlace_maps = $request->enlace_maps;
        $ubicacion->iframe = $request->iframe;

        if ($request->hasFile('imagen')) {
            // Obtén el nombre original del archivo
            $nombreOriginal = $request->file('imagen')->getClientOriginalName();

            // Almacena la imagen con el nombre original
            $request->file('imagen')->storeAs('public/imagen', $nombreOriginal);
            $ubicacion->imagen = $nombreOriginal;
        }

        $ubicacion->save();

        return redirect()->route('admin.ubicacion.index')->with('success', 'Ubicación creada exitosamente.');
    }






    public function edit(Ubicacion $ubicacion)
    {
        return view('admin.ubicacion.edit', compact('ubicacion'));
    }




    public function update(Request $request, Ubicacion $ubicacion)
    {
        $request->validate([
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'enlace_maps' => 'nullable|string',
            'iframe' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg|max:2048', // Ajusta las extensiones y el tamaño según tus necesidades
        ]);

        // Actualizar los atributos de la ubicación
        $ubicacion->nombre = $request->nombre;
        $ubicacion->direccion = $request->direccion;
        $ubicacion->enlace_maps = $request->enlace_maps;
        $ubicacion->iframe = $request->iframe;

        if ($request->hasFile('imagen')) {
            // Obtener el nombre original del archivo
            $nombreOriginal = $request->file('imagen')->getClientOriginalName();

            // Almacenar la imagen con el nombre original
            $imagenPath = $request->file('imagen')->storeAs('imagen', $nombreOriginal, 'public');
            $ubicacion->imagen = 'imagen/' . $nombreOriginal;
        }

        $ubicacion->save();


        return redirect()->route('admin.ubicacion.index')->with('success', 'Ubicación actualizada exitosamente.');
    }

    public function destroy(Ubicacion $ubicacion)
    {
        $ubicacion->delete();

        return redirect()->route('admin.ubicacion.index')->with('success', 'Ubicación eliminada exitosamente.');
    }
}
