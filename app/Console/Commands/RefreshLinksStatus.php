<?php

namespace App\Console\Commands;

use App\Point;
use Illuminate\Console\Command;
use Illuminate\Log\Writer as Log;

class RefreshLinksStatus extends Command
{
    /**
     * @var Log
     */
    protected $log;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'links:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Point::where('status', '!=', 'up')->each(function (Point $point) {
            $this->log->debug('try check point status!! '.$point->ip);
            $point->changeStatus($point->requestStatus());
        });
    }
}
