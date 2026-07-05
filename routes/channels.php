<?php

use App\Models\Asignamiento;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('partido.{partidoId}', function ($user, $partidoId) {
    return Asignamiento::where('user_id', $user->id)
        ->where('partido_id', $partidoId)
        ->exists();
});
