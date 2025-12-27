<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RoyaOptimize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:roya-optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run optimiziation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Run the optimize:clear command
        $this->call('optimize:clear');

        sleep(5);
        // Run the optimize command
        $this->call('optimize');
    }
}
