<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeporteRequest;
use App\Http\Requests\UpdateDeporteRequest;
use App\Models\Deporte;

class AdminDeporteController extends Controller
{
    public function index()
    {
        $deportes = Deporte::all();

        return view('admin.deportes.index', compact('deportes'));
    }

    public function create()
    {
        return view('admin.deporte.create');
    }

    public function store(StoreDeporteRequest $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        Deporte::create([
            'nombre' => $request->input('nombre'),
        ]);

        return redirect()->route('admin.deportes.index')->with('success', 'Deporte agregado exitosamente.');
    }
}
