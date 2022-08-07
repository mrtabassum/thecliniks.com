<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteAppointmentFromGoogleCalendar
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $user;
    public $events;

    /**
     * Create a new event instance.
     *
     * @param $events
     * @param $user
     */
    public function __construct($events, $user)
    {
        $this->events = $events;
        $this->user = $user;
    }
}
