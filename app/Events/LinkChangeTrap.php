<?php

namespace App\Events;

use App\Trap;
use Illuminate\Queue\SerializesModels;

class LinkChangeTrap extends Event
{
    use SerializesModels;

    /**
     * @var Trap
     */
    public $trap;

    /**
     * Create a new event instance.
     *
     * @param Trap $trap
     */
    public function __construct(Trap $trap)
    {
        $this->trap = $trap;
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
