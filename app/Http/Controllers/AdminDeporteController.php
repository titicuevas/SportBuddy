<?php

namespace App\Http\Controllers;




use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminDeporteRequest;
use App\Http\Requests\UpdateDeporteRequest;
use App\Models\Deporte;
use App\Services\StatsService;

class AdminDeporteController extends Controller
{
    public function index()
    {
        $deportes = Deporte::query()->orderBy('nombre')->paginate(10);

        return view('admin.deportes.index')->with('deportes', $deportes);
    }

    public function create()
    {
        return view('admin.deportes.create');
    }

    public function store(StoreAdminDeporteRequest $request)
    {
        Deporte::create([
            'nombre' => $request->input('nombre'),
        ]);

        StatsService::bump();

        return redirect()->route('admin.deportes.index')->with('success', 'Deporte agregado exitosamente.');
    }

    public function edit(Deporte $deporte)
    {
        return view('admin.deportes.edit', compact('deporte'));
    }

    public function update(UpdateDeporteRequest $request, Deporte $deporte)
    {
        $deporte->update([
            'nombre' => $request->input('nombre'),
        ]);

        return redirect()->route('admin.deportes.index')->with('success', 'Deporte actualizado exitosamente.');
    }

    public function destroy(Deporte $deporte)
    {
        $deporte->delete();

        StatsService::bump();

        return redirect()->route('admin.deportes.index')->with('success', 'Deporte eliminado exitosamente.');
    }
}
