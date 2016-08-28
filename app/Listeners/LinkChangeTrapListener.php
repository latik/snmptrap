<?php

namespace App\Listeners;

use App\Events\LinkChangeTrap;
use App\Point;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Log\Writer as Log;


class LinkChangeTrapListener
{
    /**
     * @property Log log
     */
    protected $log;

    /**
     * Create the event listener.
     *
     * @param Log $log
     */
    public function __construct(Log $log)
    {
        $this->log = $log;
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
            $this->log->info("Point not found.");
        }

        $this->log->info("trap catched: ip: {$event->trap->ip} port: {$event->trap->port} link: {$event->trap->status}");
    }
}
