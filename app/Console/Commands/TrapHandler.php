<?php

namespace App\Console\Commands;

use App\Trap;
use App\Events\LinkChangeTrap;
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
        
        $trap = Trap::createFromInput($input);

        Event::fire(new LinkChangeTrap($trap));

        //Log::debug($input);
    }
}
