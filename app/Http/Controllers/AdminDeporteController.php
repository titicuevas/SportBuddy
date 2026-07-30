<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminDeporteRequest;
use App\Http\Requests\UpdateDeporteRequest;
use App\Models\Deporte;
use App\Services\StatsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminDeporteController extends Controller
{
    public function index(): View
    {
        $deportes = Deporte::query()->orderBy('nombre')->paginate(10);

        return view('admin.deportes.index', compact('deportes'));
    }

    public function create(): View
    {
        return view('admin.deportes.create');
    }

    public function store(StoreAdminDeporteRequest $request): RedirectResponse
    {
        Deporte::create($request->validated());

        StatsService::bump();

        return redirect()->route('admin.deportes.index')->with('success', 'Deporte creado correctamente.');
    }

    public function edit(Deporte $deporte): View
    {
        return view('admin.deportes.edit', compact('deporte'));
    }

    public function update(UpdateDeporteRequest $request, Deporte $deporte): RedirectResponse
    {
        $deporte->update($request->validated());

        StatsService::bump();

        return redirect()->route('admin.deportes.index')->with('success', 'Deporte actualizado correctamente.');
    }

    public function destroy(Deporte $deporte): RedirectResponse
    {
        if ($deporte->partidos()->exists() || $deporte->pistas()->exists()) {
            return redirect()->route('admin.deportes.index')
                ->with('error', 'No puedes eliminar el deporte porque tiene pistas o partidos asociados.');
        }

        $deporte->delete();

        StatsService::bump();

        return redirect()->route('admin.deportes.index')->with('success', 'Deporte eliminado correctamente.');
    }
}
