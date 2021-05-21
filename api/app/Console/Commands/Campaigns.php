<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\Campaigns as CampaignsJob;

class Campaigns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaigns:run';

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
        echo '[Campaigns Command] Start running ...';
        CampaignsJob::dispatch();
        echo "\n[Campaigns Command] Completed";
    }
}
