<?php

namespace App\Models;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notifiable;

class Mensaje extends Model implements ShouldBroadcast
{
    use HasFactory, Notifiable;

    protected $fillable = ['partido_id', 'user_id', 'contenido'];

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('partido.'.$this->partido_id);
    }
}
