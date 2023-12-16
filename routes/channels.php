<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('partido.{partidoId}', function ($user, $partidoId) {
    // Lógica de autorización, por ejemplo, verificar si el usuario pertenece al partido
    return true; // O devuelve true si todos los usuarios autenticados pueden acceder
});
