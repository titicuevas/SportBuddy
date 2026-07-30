<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminPistaRequest;
use App\Http\Requests\UpdateAdminPistaRequest;
use App\Models\Deporte;
use App\Models\Pista;
use App\Models\Superficie;
use App\Models\Ubicacion;
use App\Services\StatsService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;

class AdminPistaController extends Controller
{
    public function index()
    {
        $pistas = Pista::query()
            ->with(['ubicacion:id,nombre', 'deporte:id,nombre', 'superficie:id,tipo'])
            ->orderBy('ubicacion_id')
            ->orderBy('numero')
            ->paginate(15);

        return view('admin.pista.index', compact('pistas'));
    }

    public function create()
    {
        $ubicaciones = Ubicacion::query()->orderBy('nombre')->get();
        $superficies = Superficie::query()->orderBy('tipo')->get();
        $deportes = Deporte::query()->orderBy('nombre')->get();

        return view('admin.pista.create', compact('ubicaciones', 'superficies', 'deportes'));
    }

    public function store(StoreAdminPistaRequest $request)
    {
        try {
            $pista = Pista::create($request->validated());
            $this->invalidarCachePistas($pista);
            StatsService::bump();

            return redirect()->route('admin.pista.index')->with('success', 'Pista creada exitosamente.');
        } catch (QueryException) {
            return redirect()->route('admin.pista.create')->with('error', 'Error al crear la pista.');
        }
    }

    public function edit(Pista $pista)
    {
        $ubicaciones = Ubicacion::query()->orderBy('nombre')->get();
        $superficies = Superficie::query()->orderBy('tipo')->get();
        $deportes = Deporte::query()->orderBy('nombre')->get();

        return view('admin.pista.edit', compact('pista', 'ubicaciones', 'superficies', 'deportes'));
    }

    public function update(UpdateAdminPistaRequest $request, Pista $pista)
    {
        $ubicacionAnterior = $pista->ubicacion_id;
        $pista->update($request->validated());
        $this->invalidarCachePistas($pista, $ubicacionAnterior);
        StatsService::bump();

        return redirect()->route('admin.pista.index')->with('success', 'Pista actualizada exitosamente.');
    }

    public function destroy(Pista $pista)
    {
        try {
            if ($pista->partidos()->exists()) {
                return redirect()->route('admin.pista.index')->with('error', 'No puedes eliminar la pista porque hay partidos asociados.');
            }

            $this->invalidarCachePistas($pista);
            $pista->delete();
            StatsService::bump();

            return redirect()->route('admin.pista.index')->with('success', 'Pista eliminada exitosamente.');
        } catch (QueryException) {
            return redirect()->route('admin.pista.index')->with('error', 'Error al eliminar la pista.');
        }
    }

    private function invalidarCachePistas(Pista $pista, ?int $ubicacionAnterior = null): void
    {
        Cache::forget("pistas.ubicacion.{$pista->ubicacion_id}");

        if ($ubicacionAnterior && $ubicacionAnterior !== $pista->ubicacion_id) {
            Cache::forget("pistas.ubicacion.{$ubicacionAnterior}");
        }
    }
}
