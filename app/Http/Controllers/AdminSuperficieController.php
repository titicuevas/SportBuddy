<?php

// AdminSuperficieController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Superficie;

class AdminSuperficieController extends Controller
{
    public function index()
    {
        $superficies = Superficie::all();
        return view('admin.superficie.index', compact('superficies'));
    }

    public function create()
    {
        return view('admin.superficie.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
        ]);

        $tipo = strtolower($request->input('tipo'));

        // Verifica si ya existe una superficie con el mismo nombre (en minúsculas)
        if (Superficie::where('tipo', $tipo)->exists()) {
            return redirect()->route('admin.superficie.create')->with('error', 'Ya existe una superficie con ese nombre.');
        }

        $superficie = new Superficie();
        $superficie->tipo = $tipo;
        $superficie->save();

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie agregada exitosamente.');
    }

    public function update(Request $request, Superficie $superficie)
    {
        $request->validate([
            'tipo' => 'required|string',
        ]);

        $tipo = strtolower($request->input('tipo'));

        // Verifica si ya existe otra superficie con el mismo nombre (en minúsculas)
        if (Superficie::where('tipo', $tipo)->where('id', '!=', $superficie->id)->exists()) {
            return redirect()->route('admin.superficie.edit', $superficie->id)->with('error', 'Ya existe una superficie con ese nombre.');
        }

        $superficie->update([
            'tipo' => $tipo,
            // Agrega aquí otros campos según sea necesario
        ]);

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie actualizada exitosamente.');
    }

    public function destroy(Superficie $superficie)
    {
        $superficie->delete();

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie eliminada exitosamente.');
    }
}
