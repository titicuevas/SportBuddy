<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\ProfileUpdateFotoRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Asignamiento;
use App\Models\Comentario;
use App\Models\Mensaje;
use App\Services\StatsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->only(['name', 'apellidos', 'telefono', 'email']));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($user->wasChanged('email') && is_null($user->email_verified_at)) {
            $user->sendEmailVerificationNotification();

            return redirect()->route('verification.notice')
                ->with('status', 'verification-link-sent');
        }

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateFoto(ProfileUpdateFotoRequest $request): JsonResponse|RedirectResponse
    {
        $user = $request->user();

        if ($request->input('foto_eliminada') === '1') {
            if ($user->foto) {
                Storage::delete($user->foto);
                $user->update(['foto' => null]);
            }

            return redirect()->route('profile.edit')->with('success', 'Foto eliminada.');
        }

        if (! $request->hasFile('foto')) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se recibió ninguna imagen.',
            ], 422);
        }

        if ($user->foto) {
            Storage::delete($user->foto);
        }

        $path = $request->file('foto')->store('public/profile-photos');
        $user->update(['foto' => $path]);

        return response()->json([
            'status' => 'foto-updated',
            'fotoPerfilURL' => Storage::url($path),
        ]);
    }

    public function destroy(DeleteUserRequest $request): RedirectResponse
    {
        $user = $request->user();

        Auth::logout();

        DB::transaction(function () use ($user) {
            if ($user->foto) {
                Storage::delete($user->foto);
            }

            $partidoIds = $user->partidosCreados()->pluck('id');

            if ($partidoIds->isNotEmpty()) {
                Mensaje::whereIn('partido_id', $partidoIds)->delete();
                Comentario::whereIn('partido_id', $partidoIds)->delete();
                Asignamiento::whereIn('partido_id', $partidoIds)->delete();
                $user->partidosCreados()->delete();
            }

            $user->comentarios()->delete();
            $user->mensajes()->delete();
            $user->asignamientos()->delete();
            $user->delete();
        });

        StatsService::bump();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
