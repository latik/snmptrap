<?php

namespace App\Events;

use App\Trap;
use Illuminate\Queue\SerializesModels;

class LinkChangeTrap extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Trap $trap)
    {
        $this->ip = $trap->ip;
        $this->port = $trap->port;
        $this->status = $trap->status;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
