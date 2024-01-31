<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\Channel;



class Mensaje extends Model implements ShouldBroadcast
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

    public function broadcastOn()
    {
        return new Channel('Chat');
    }
}
