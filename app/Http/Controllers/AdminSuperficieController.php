<?php

// AdminSuperficieController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Superficie;

class AdminSuperficieController extends Controller
{
    public function index()
    {
        return view('admin.superficie.index');
    }


    public function create()
    {
        return view('admin.superficie.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
        ]);

        $superficie = new Superficie();
        $superficie->tipo = $request->input('tipo');
        $superficie->save();

        return redirect()->route('admin.superficie.index')->with('success', 'Superficie agregada exitosamente.');
    }
}
