<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
       'App\Console\Commands\Campaigns',
       'App\Console\Commands\Upsells',
       'App\Console\Commands\CartRecoveries',
       'App\Console\Commands\SMS',
       'App\Console\Commands\Billing',
       'App\Console\Commands\SMSUsageChecker'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // syncing data to app
        $schedule->command('campaigns:run')->everyMinute();
        $schedule->command('upsells:run')->everyMinute();
        $schedule->command('cart_recoveries:run')->everyMinute();
        $schedule->command('billings:run')->everyMinute();
        $schedule->command('sms:usage')->everyMinute();
        // manage synq data
        $schedule->command('sms:run')->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
