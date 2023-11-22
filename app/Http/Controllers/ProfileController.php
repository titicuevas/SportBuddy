<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{


    //Show Profile

    public function show($user)
    {

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


    //Mostrar la imagen Profile




    //Editar foto Profile




    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());


        //Foto user
        $request->validateWithBag('profileUpdate', [
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        $user = $request->user();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = $foto->storeAs('public/profile-photos', $user->id . '.' . $foto->getClientOriginalExtension());

            $user->foto = Storage::url($path);
        }

        $user->fill($request->validated());


        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
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
