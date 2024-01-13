<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminSuperficieRequest;
use App\Http\Requests\UpdateSuperficieRequest;
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

    public function store(StoreAdminSuperficieRequest $request)
    {
        $request->validate([
            'tipo' => 'required|string',
        ]);

        Superficie::create([
            'tipo' => $request->input('tipo'),
        ]);

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie agregada exitosamente.');
    }

    public function edit(Superficie $superficie)
    {
        return view('admin.superficie.edit', compact('superficie'));
    }

    public function update(UpdateSuperficieRequest $request, Superficie $superficie)
    {
        $request->validate([
            'tipo' => 'required|string',
        ]);

        $superficie->update([
            'tipo' => $request->input('tipo'),
        ]);

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie actualizada exitosamente.');
    }

    public function destroy(Superficie $superficie)
    {
        $superficie->delete();

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie eliminada exitosamente.');
    }
}
