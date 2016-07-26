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
                //Log::debug('LinkChangeTrap');
                Event::fire(new LinkChangeTrap($trap));
                break;
            default:
                Log::debug('UnknowTrap');
                Log::debug($trap->oid);
        }

        //Log::debug($input);
    }
}
