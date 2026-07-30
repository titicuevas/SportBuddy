<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminUbicacionRequest;
use App\Http\Requests\UpdateAdminUbicacionRequest;
use App\Models\Ubicacion;
use App\Services\StatsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminUbicacionController extends Controller
{
    public function index(): View
    {
        $ubicaciones = Ubicacion::query()->orderBy('nombre')->paginate(10);

        return view('admin.ubicacion.index', compact('ubicaciones'));
    }

    public function create(): View
    {
        return view('admin.ubicacion.create');
    }

    public function store(StoreAdminUbicacionRequest $request): RedirectResponse
    {
        $datos = $request->safe()->except('imagen');

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $this->guardarImagen($request->file('imagen'));
        }

        Ubicacion::create($datos);

        StatsService::bump();

        return redirect()->route('admin.ubicacion.index')->with('success', 'Ubicación creada correctamente.');
    }

    public function edit(Ubicacion $ubicacion): View
    {
        return view('admin.ubicacion.edit', compact('ubicacion'));
    }

    public function update(UpdateAdminUbicacionRequest $request, Ubicacion $ubicacion): RedirectResponse
    {
        $datos = $request->safe()->except('imagen');

        if ($request->hasFile('imagen')) {
            $this->borrarImagenLocal($ubicacion->imagen);
            $datos['imagen'] = $this->guardarImagen($request->file('imagen'));
        }

        $ubicacion->update($datos);

        StatsService::bump();

        return redirect()->route('admin.ubicacion.index')->with('success', 'Ubicación actualizada correctamente.');
    }

    public function destroy(Ubicacion $ubicacion): RedirectResponse
    {
        if ($ubicacion->pistas()->exists() || $ubicacion->partidos()->exists()) {
            return redirect()->route('admin.ubicacion.index')
                ->with('error', 'No puedes eliminar la ubicación porque tiene pistas o partidos asociados.');
        }

        $this->borrarImagenLocal($ubicacion->imagen);
        $ubicacion->delete();

        StatsService::bump();

        return redirect()->route('admin.ubicacion.index')->with('success', 'Ubicación eliminada correctamente.');
    }

    private function guardarImagen(UploadedFile $imagen): string
    {
        $nombre = $imagen->hashName();
        $imagen->storeAs('public/imagen', $nombre);

        return $nombre;
    }

    private function borrarImagenLocal(?string $imagen): void
    {
        if ($imagen && ! filter_var($imagen, FILTER_VALIDATE_URL)) {
            Storage::delete('public/imagen/'.$imagen);
        }
    }
}
