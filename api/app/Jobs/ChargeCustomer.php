<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Billing;
use Carbon\Carbon;
class ChargeCustomer implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   *
   * @return void
   */

  public $stripeController = 'App\Http\Controllers\StripeController';
  public function __construct()
  {
      //
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    // get billing with status not paid
    $billings = Billing::where('status', '=', 'not paid')->orderBy('end_date', 'asc')->get();

    if($billings && sizeof($billings) > 0){
      foreach ($billings as $key => $billing) {
        $startDate = $billing['start_date'];
        $currentDate = Carbon::now();
        $diffInDays = $currentDate->diffInDays($startDate);

        if($diffInDays === 0 || $diffInDays < 0){
          // charge customer here
          $charge = app($this->stripeController)->chargeCustomerByBilling($billing);
          if($charge == true){
            Billing::where('id', '=', $billing['id'])->update(array(
              'status' => 'paid',
              'updated_at' => Carbon::now()
            ));
            // send email
          }else{
            // record error here
            echo "\n\t [ChargeCustomer] Error on auto charging customer";
          }
        }else{
          echo "\n\t [ChargeCustomer] Different days is invalid";
        }
      }
    }else{
      echo "\n\t [ChargeCustomer] No available billing with status not paid..";
    }
  }
}
