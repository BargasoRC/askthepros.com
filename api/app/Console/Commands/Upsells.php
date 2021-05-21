<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\Upsells as UpsellsJob;
class Upsells extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upsells:run';

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
        echo '[Upsells Command] Start running ...';
        UpsellsJob::dispatch();
        echo "\n[Upsells Command] Completed";
    }
}
