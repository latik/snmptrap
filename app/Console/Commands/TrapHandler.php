<?php

namespace App\Console\Commands;

use App\Console\Requests\Trap;
use App\Point;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class TrapHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'snmp:trap {event} {trap?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle snmp traps';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $input = trim(stream_get_contents(STDIN));
        $event = $this->argument('event');
        $trap = Trap::createFromInput($input);

        try {
            $point = Point::where('ip', $trap->ip)
            ->where('port',$trap->port)
            ->firstOrFail();
            
            $point->changeStatus($event);

        } catch (ModelNotFoundException $e) {
            //$this->error('snmp trap catched. Poind not found.');
        }

        Log::info('trap catched: ip:'. $trap->ip.' port:'. $trap->port. ' event: link ' . $this->argument('event'));
        Log::debug($input);
    }
}
