<?php

namespace App\Listeners;

use App\Events\LinkChangeTrap;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class LinkChangeTrapListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param LinkChangeTrap $event
     * @internal param LinkChangeTrap $trap
     */
    public function handle(LinkChangeTrap $event)
    {
        try {
            $point = \App\Point::where('ip', $event->trap->ip)
                ->where('port', $event->trap->port)
                ->firstOrFail();

            $point->changeStatus($event->trap->status);

        } catch (ModelNotFoundException $e) {
            Log::info("Point not found.");
        }

        Log::info("trap catched: ip: {$event->trap->ip} port: {$event->trap->port} link: {$event->trap->status}");
    }
}
