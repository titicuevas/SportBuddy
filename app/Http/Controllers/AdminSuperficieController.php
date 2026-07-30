<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminSuperficieRequest;
use App\Http\Requests\UpdateSuperficieRequest;
use App\Models\Superficie;
use App\Services\StatsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminSuperficieController extends Controller
{
    public function index(): View
    {
        $superficies = Superficie::query()->orderBy('tipo')->paginate(15);

        return view('admin.superficie.index', compact('superficies'));
    }

    public function create(): View
    {
        return view('admin.superficie.create');
    }

    public function store(StoreAdminSuperficieRequest $request): RedirectResponse
    {
        Superficie::create($request->validated());

        StatsService::bump();

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie creada correctamente.');
    }

    public function edit(Superficie $superficie): View
    {
        return view('admin.superficie.edit', compact('superficie'));
    }

    public function update(UpdateSuperficieRequest $request, Superficie $superficie): RedirectResponse
    {
        $superficie->update($request->validated());

        StatsService::bump();

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie actualizada correctamente.');
    }

    public function destroy(Superficie $superficie): RedirectResponse
    {
        if ($superficie->pistas()->exists() || $superficie->partidos()->exists()) {
            return redirect()->route('admin.superficie.index')
                ->with('error', 'No puedes eliminar la superficie porque tiene pistas o partidos asociados.');
        }

        $superficie->delete();

        StatsService::bump();

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie eliminada correctamente.');
    }
}
