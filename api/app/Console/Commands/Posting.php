<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\Posting;
class Posting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posting:run';

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
     * @return int
     */
    public function handle()
    {
        echo '[Posting Command] Start running ...';
        CampaignsJob::dispatch();
        echo "\n[Posting Command] Completed";
    }
}
