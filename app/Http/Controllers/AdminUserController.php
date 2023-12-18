<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        // Obtener la lista de usuarios
        $users = User::all();

        // Devolver la vista con la variable $users
        return view('admin.users.index', compact('users'));

    }
}
