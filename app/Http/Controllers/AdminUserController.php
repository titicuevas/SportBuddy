<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        // Obtener la lista de usuarios ordenados por nombre
        $users = User::orderBy('name')->paginate(10); // Puedes ajustar el número de usuarios por página

        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {

        // Encuentra el usuario por su ID
        $user = User::findOrFail($id);

        // Elimina el usuario de la base de datos
        $user->delete();

        // Redirige a la vista de usuarios después de la eliminación
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
