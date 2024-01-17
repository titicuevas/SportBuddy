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
        $user = User::find($user);

        if (!$user) {
            abort(404);
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

    // Función para actualizar el perfil del usuario (otros datos)
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->update($request->only(['name', 'apellidos', 'telefono', 'email']));

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    // Función para actualizar la foto de perfil del usuario
    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        $user = $request->user();

        if ($request->hasFile('foto')) {
            $allowedTypes = ['jpeg'];
            $fileType = $request->file('foto')->getClientOriginalExtension();

            // Verificar si es un tipo de imagen permitido
            if (!in_array($fileType, $allowedTypes) || !@getimagesize($request->file('foto'))) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'El formato de archivo no es compatible. Por favor, utiliza formatos JPEG.',
                ]);
            }


            if ($user->foto) {
                // Eliminar la foto anterior si existe
                Storage::delete($user->foto);
            }

            // Almacenar la nueva foto en storage/public/profile-photos
            $path = $request->file('foto')->store('public/profile-photos');

            // Actualizar la ruta en la base de datos
            $user->update(['foto' => $path]);

            $fotoPerfilURL = Storage::url($path);

            return response()->json(['status' => 'foto-updated', 'fotoPerfilURL' => $fotoPerfilURL]);
        }
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
