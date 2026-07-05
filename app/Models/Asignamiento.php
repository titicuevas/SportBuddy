<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignamiento extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'partido_id',
        'user_id',
        'equipo_id',
    ];

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
