<?php

namespace App\Http\Controllers;

use App\Models\Pista;
use App\Models\Ubicacion;
use App\Models\Superficie;
use App\Models\Deporte;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class AdminPistaController extends Controller
{
    /**
     * Muestra un listado de las pistas.
     */
    public function index()
    {
        $pistas = Pista::paginate(6); // Cambia 10 por el número de pistas que deseas mostrar por página
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
        try {
            $request->validate([
                'ubicacion_id' => 'required|exists:ubicaciones,id',
                'superficie_id' => 'required|exists:superficies,id',
                'deporte_id' => 'required|exists:deportes,id',
                'numero' => [
                    'required',
                    'integer',
                    'min:0',
                    Rule::unique('pistas')
                        ->where('ubicacion_id', $request->ubicacion_id)
                        ->where('superficie_id', $request->superficie_id)
                        ->where('deporte_id', $request->deporte_id),
                ],
                'precio_sin_luz' => 'required|numeric|min:0',
                'precio_con_luz' => 'nullable|numeric|min:0',
            ], [
                'numero.unique' => 'El número de pista ya está en uso para esta ubicación, superficie y deporte.',
            ]);

            // Crear una nueva instancia de Pista
            $pista = new Pista();

            // Asignar valores a los atributos de la pista
            $pista->ubicacion_id = $request->ubicacion_id;
            $pista->superficie_id = $request->superficie_id;
            $pista->deporte_id = $request->deporte_id;
            $pista->numero = $request->numero;
            $pista->precio_sin_luz = $request->precio_sin_luz;
            $pista->precio_con_luz = $request->precio_con_luz;

            // Guardar la pista en la base de datos
            $pista->save();

            // Redirigir a la vista index con un mensaje de éxito
            return redirect()->route('admin.pista.index')->with('success', 'Pista creada exitosamente.');
        } catch (QueryException $e) {
            // Redirigir a la vista create con un mensaje de error
            return redirect()->route('admin.pista.create')->with('error', 'Error al crear la pista.');
        }
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
            'precio_sin_luz' => 'required|numeric|min:0',
            'precio_con_luz' => 'nullable|numeric|min:0',
        ]);

        // Agregar la lógica para actualizar la pista en la base de datos.
        $pista->update([
            'ubicacion_id' => $request->ubicacion_id,
            'superficie_id' => $request->superficie_id,
            'deporte_id' => $request->deporte_id,
            'numero' => $request->numero,
            'precio_sin_luz' => $request->precio_sin_luz,
            'precio_con_luz' => $request->precio_con_luz,
        ]);

        return redirect()->route('admin.pista.index')->with('success', 'Pista actualizada exitosamente.');
    }

    /**
     * Elimina una pista de la base de datos.
     */
    public function destroy(Pista $pista)
    {
        try {
            // Verificar si hay partidos asociados a la pista
            if ($pista->partidos()->exists()) {
                return redirect()->route('admin.pista.index')->with('error', 'No puedes eliminar la pista porque hay partidos asociados.');
            }

            // Eliminar la pista
            $pista->delete();

            return redirect()->route('admin.pista.index')->with('success', 'Pista eliminada exitosamente.');
        } catch (QueryException $e) {
            // Manejar cualquier error de base de datos
            return redirect()->route('admin.pista.index')->with('error', 'Error al eliminar la pista.');
        }
    }
}
