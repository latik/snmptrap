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
     * @param  LinkChangeTrap $trap
     * @return void
     */
    public function handle(LinkChangeTrap $trap)
    {
        try {
            $point = \App\Point::where('ip', $trap->ip)
                ->where('port', $trap->port)
                ->firstOrFail();

            $point->changeStatus($trap->status);
            Log::info("point status changed");
        } catch (ModelNotFoundException $e) {
            Log::info("snmp trap catched, but Point not found.");
            //$this->error('snmp trap catched. Point not found.');
        }

        Log::info("trap catched: ip: {$trap->ip} port: {$trap->port} link: {$trap->status}");
    }
}
