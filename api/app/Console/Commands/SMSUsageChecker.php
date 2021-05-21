<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SMSUsageChecker as SMSUsageCheckerJob;
class SMSUsageChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:usage';

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
        echo '[SMSUsageCheckerJob Command] Start running ...';
        SMSUsageCheckerJob::dispatch();
        echo "\n[SMSUsageCheckerJob Command] Finished";
    }
}
