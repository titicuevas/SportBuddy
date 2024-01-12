<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeporteRequest;
use App\Http\Requests\StoreAdminDeporteRequest;

use App\Http\Requests\UpdateDeporteRequest;
use App\Models\Deporte;

class AdminDeporteController extends Controller
{
    public function index()
    {
        $deportes = Deporte::all();
        return view('admin.deportes.index')->with('deportes', $deportes);
    }



    public function create()
    {
        return view('admin.deportes.create');
    }

    public function store(StoreAdminDeporteRequest $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);



        Deporte::create([
            'nombre' => $request->input('nombre'),
        ]);

        return redirect()->route('admin.deportes.index')->with('success', 'Deporte agregado exitosamente.');
    }


    public function destroy(Deporte $deporte)
    {
        $deporte->delete();
        return redirect()->route('admin.deportes.index')->with('success', 'Deporte eliminado exitosamente.');
    }
}
