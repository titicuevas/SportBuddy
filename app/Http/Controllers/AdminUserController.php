<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\StatsService;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'No puedes eliminar tu propia cuenta desde el panel.');
        abort_if($user->esAdmin(), 403, 'No se pueden eliminar cuentas de administrador.');

        if ($user->partidosCreados()->exists() || $user->comentarios()->exists() || $user->mensajes()->exists()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'No puedes eliminar el usuario porque tiene partidos, comentarios o mensajes asociados.');
        }

        $user->asignamientos()->delete();
        $user->delete();

        StatsService::bump();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
