<?php

namespace App\Console\Commands;

use App\Events\LinkChangeTrap;
use App\Trap;
use Event;
use Illuminate\Console\Command;
use Illuminate\Log\Writer as Log;

class TrapHandler extends Command
{
    /**
     * @property Log log
     */
    protected $log;
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
     * @param Log $log
     */
    public function __construct(Log $log)
    {
        parent::__construct();
        $this->log = $log;
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
            //               .1.3.6.1.4.1.259.8.1.11.2.1.0.1   swPowerStatusChangeTrap  ES3510MA-MIB
            case 'SNMPv2-SMI::enterprises.259.8.1.11.2.1.0.200':
            case 'SNMPv2-SMI::enterprises.259.8.1.11.2.1.0.208':
            case 'SNMPv2-SMI::enterprises.259.8.1.11.2.1.0.107':
            case 'SNMPv2-SMI::enterprises.259.8.1.11.2.1.0.108':
            //               .1.3.6.1.4.1.259.6.10.94.2.1.0.1  swPowerStatusChangeTrap  ES3528MO-MIB
            case 'SNMPv2-SMI::enterprises.259.6.10.94.2.1.0.67':
            case 'SNMPv2-SMI::enterprises.259.6.10.94.2.1.0.36':
            case 'SNMPv2-SMI::enterprises.171.10.94.89.89.0.176':
            case 'SNMPv2-MIB::authenticationFailure':
            case 'SNMPv2-MIB::coldStart':
            case 'SNMPv2-MIB::warmStart':
            case 'SNMPv2-SMI::mib-2.17.0.2':
            case 'iso.0.8802.1.1.2.0.0.1.0.1':
            case 'iso.0.8802.1.1.2.0.0.1':                          //lldpRemTablesChange
                break;
            default:
                $this->log->debug("Unknown trap {$trap->oid} from {$trap->ip}");
        }
    }
}
