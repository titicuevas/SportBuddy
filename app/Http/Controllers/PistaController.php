<?php

namespace App\Http\Controllers;

use App\Models\Pista;
use App\Models\Ubicacion;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class PistaController extends Controller
{
    public function show(Pista $pista): JsonResponse
    {
        $pista->load(['superficie:id,tipo', 'deporte:id,nombre']);

        return response()->json([
            'numero' => $pista->numero,
            'tipo_superficie' => $pista->superficie?->tipo ?? 'Tipo Desconocido',
            'deporte' => $pista->deporte?->nombre ?? 'Desconocido',
            'tiene_luz' => (bool) $pista->tiene_luz,
            'precio_sin_luz' => $pista->precio_sin_luz,
            'precio_con_luz' => $pista->precio_con_luz,
        ]);
    }

    public function pistasPorUbicacion(Ubicacion $ubicacion): JsonResponse
    {
        $pistas = Cache::remember("pistas.ubicacion.{$ubicacion->id}", 300, fn () =>
            Pista::query()->where('ubicacion_id', $ubicacion->id)->get(['id', 'numero'])
        );

        return response()->json($pistas);
    }
}
