<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable = ['contenido', 'user_id', 'partido_id'];

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
