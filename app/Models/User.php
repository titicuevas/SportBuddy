<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellidos',
        'telefono',
        'email',
        'password',
        'foto',
        'roles_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function asignamientos()
    {
        return $this->hasMany(Partido::class, 'user_id');
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class, 'partido_id');
    }

    public function partidosCreados()
    {
        return $this->hasMany(Partido::class, 'user_id');
    }



    public function esAdmin(): bool
    {
        // Reemplaza 1 con el valor real del rol de administrador
        return $this->rol_id === 1;
    }
}
