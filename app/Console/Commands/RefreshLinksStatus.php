<?php

namespace App\Console\Commands;

use App\Point;
use Illuminate\Console\Command;

class RefreshLinksStatus extends Command
{
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
        Point::where('status', '!=', 'up')->each(function (Point $point) {
            $this->log->debug("try check point status!! " . $point->ip);
            $point->changeStatus($point->requestStatus());
        });
    }
}
