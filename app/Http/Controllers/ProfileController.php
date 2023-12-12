<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Función para mostrar el perfil del usuario
    public function show($user)
    {
        $user = User::find($user); // Asegurarse de obtener un usuario válido

        if (!$user) {
            abort(404); // Manejar el caso en que no se encuentre el usuario
        }

        $fotoPerfil = $user->foto;

        if ($fotoPerfil) {
            $fotoPerfilURL = Storage::url($fotoPerfil);
        } else {
            $fotoPerfilURL = asset('img/default-profile-image.png');
        }

        return view('profile.show', [
            'user' => $user,
            'fotoPerfilURL' => $fotoPerfilURL,
        ]);
    }


    // Función para mostrar el formulario de editar perfil
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // Función para actualizar el perfil del usuario
    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        $user = $request->user();

        // Verificar si se proporcionó una nueva foto
        if ($request->hasFile('foto')) {
            // Eliminar la foto actual si existe
            if ($user->foto) {
                Storage::delete($user->foto);
            }

            // Almacenar la nueva foto
            $foto = $request->file('foto');
            $path = $foto->storeAs('public/profile-photos', $user->id . '.' . $foto->getClientOriginalExtension());
            $user->foto = $path;
            $user->save(); // Guardar cambios en la base de datos
        }

        // Redirigir a la página de perfil con el ID del usuario
        return response()->json(['status' => 'foto-updated', 'fotoPerfilURL' => Storage::url($user->foto)]);
    }


    // Función para eliminar la cuenta del usuario
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
