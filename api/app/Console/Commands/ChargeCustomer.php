<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ChargeCustomer as ChargeCustomerJob;

class ChargeCustomer extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'charge_customer:run';

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
    echo '[ChargeCustomer Command] Start running ...';
    ChargeCustomerJob::dispatch();
    echo "\n[ChargeCustomer Command] Completed";
  }
}
