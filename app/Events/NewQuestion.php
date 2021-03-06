<?php

namespace App\Events;

use App\Models\Pregunta;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewQuestion implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pregunta;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Pregunta $pregunta)
    {
        //
        $this->pregunta = $pregunta->load('opciones');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('Question');
    }

    public function broadcastAs() {
        return 'new_question';
    }
}
