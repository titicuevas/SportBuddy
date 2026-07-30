<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminPistaRequest;
use App\Http\Requests\UpdateAdminPistaRequest;
use App\Models\Deporte;
use App\Models\Pista;
use App\Models\Superficie;
use App\Models\Ubicacion;
use App\Services\StatsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AdminPistaController extends Controller
{
    public function index(): View
    {
        $pistas = Pista::query()
            ->with(['ubicacion:id,nombre', 'deporte:id,nombre', 'superficie:id,tipo'])
            ->orderBy('ubicacion_id')
            ->orderBy('numero')
            ->paginate(15);

        return view('admin.pista.index', compact('pistas'));
    }

    public function create(): View
    {
        return view('admin.pista.create', $this->formOptions());
    }

    public function store(StoreAdminPistaRequest $request): RedirectResponse
    {
        $pista = Pista::create($request->validated());
        $this->invalidarCachePistas($pista);
        StatsService::bump();

        return redirect()->route('admin.pista.index')->with('success', 'Pista creada correctamente.');
    }

    public function edit(Pista $pista): View
    {
        return view('admin.pista.edit', array_merge(
            ['pista' => $pista],
            $this->formOptions()
        ));
    }

    public function update(UpdateAdminPistaRequest $request, Pista $pista): RedirectResponse
    {
        $ubicacionAnterior = $pista->ubicacion_id;
        $pista->update($request->validated());
        $this->invalidarCachePistas($pista, $ubicacionAnterior);
        StatsService::bump();

        return redirect()->route('admin.pista.index')->with('success', 'Pista actualizada correctamente.');
    }

    public function destroy(Pista $pista): RedirectResponse
    {
        if ($pista->partidos()->exists()) {
            return redirect()->route('admin.pista.index')
                ->with('error', 'No puedes eliminar la pista porque hay partidos asociados.');
        }

        $this->invalidarCachePistas($pista);
        $pista->delete();
        StatsService::bump();

        return redirect()->route('admin.pista.index')->with('success', 'Pista eliminada correctamente.');
    }

    private function formOptions(): array
    {
        return [
            'ubicaciones' => Ubicacion::query()->orderBy('nombre')->get(),
            'superficies' => Superficie::query()->orderBy('tipo')->get(),
            'deportes' => Deporte::query()->orderBy('nombre')->get(),
        ];
    }

    private function invalidarCachePistas(Pista $pista, ?int $ubicacionAnterior = null): void
    {
        Cache::forget("pistas.ubicacion.{$pista->ubicacion_id}");

        if ($ubicacionAnterior && $ubicacionAnterior !== $pista->ubicacion_id) {
            Cache::forget("pistas.ubicacion.{$ubicacionAnterior}");
        }
    }
}
