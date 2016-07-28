<?php

namespace App\Console\Commands;

use App\Events\LinkChangeTrap;
use App\Trap;
use Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TrapHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'snmp:trap {event?} {trap?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle snmp traps';

    /**
     * Create a new command instance.
     *
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

        $trap = Trap::createFromInput($input);

        // @todo need implement factory pattern
        switch ($trap->oid) {
            case 'IF-MIB::linkUp':
            case 'IF-MIB::linkDown':
                Event::fire(new LinkChangeTrap($trap));
                break;
            case 'SNMPv2-MIB::authenticationFailure':
            case 'SNMPv2-SMI::enterprises.171.10.94.89.89.0.176':
                break;
            default:
                Log::debug("Unknown trap {$trap->oid} from {$trap->ip}");
        }

        //Log::debug($input);
    }
}
