<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminSuperficieRequest;
use App\Http\Requests\UpdateSuperficieRequest;
use App\Models\Superficie;
use App\Services\StatsService;

class AdminSuperficieController extends Controller
{
    public function index()
    {
        $superficies = Superficie::query()->orderBy('tipo')->paginate(15);

        return view('admin.superficie.index', compact('superficies'));
    }

    public function create()
    {
        return view('admin.superficie.create');
    }

    public function store(StoreAdminSuperficieRequest $request)
    {
        Superficie::create($request->validated());

        StatsService::bump();

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie agregada exitosamente.');
    }

    public function edit(Superficie $superficie)
    {
        return view('admin.superficie.edit', compact('superficie'));
    }

    public function update(UpdateSuperficieRequest $request, Superficie $superficie)
    {
        $superficie->update($request->validated());

        StatsService::bump();

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie actualizada exitosamente.');
    }

    public function destroy(Superficie $superficie)
    {
        if ($superficie->pistas()->exists() || $superficie->partidos()->exists()) {
            return redirect()->route('admin.superficie.index')
                ->with('error', 'No puedes eliminar la superficie porque tiene pistas o partidos asociados.');
        }

        $superficie->delete();

        StatsService::bump();

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie eliminada exitosamente.');
    }
}
