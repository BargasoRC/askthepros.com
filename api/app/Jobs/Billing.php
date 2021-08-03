<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Billing as BillingModel;
use App\Plan;
use Carbon\Carbon;
class Billing implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   *
   * @return void
   */

  public $billingController = 'App\Http\Controllers\BillingController';
  public $emailController = 'App\Http\Controllers\BillingController';

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
    // get plans with end_date is null
    $plans = Plan::where('end_date', '=', null)->get();

    if($plans && sizeof($plans) > 0){
      foreach ($plans as $key => $plan) {
        // get last billing
        $billing = BillingModel::where('account_id', '=', $plan['account_id'])->orderBy('end_date', 'desc')->limit(1)->get();
        if($billing && sizeof($billing) > 0){
          $lastDate = $billing[0]['end_date'] ? Carbon::createFromFormat('Y-m-d H:i:s', $billing[0]['end_date']) : null;
          if($lastDate){
            $currentDate = Carbon::now();
            $diffInDays = $currentDate->diffInDays($lastDate, true);
            $startDate = null;
            $endDate = null;
            if($diffInDays > 1 && $diffInDays <= 7){
              // create billing
              $startDate = $lastDate->copy();
              $endDate = $lastDate->copy()->addMonths(1);
            }else if($diffInDays < 0){
              $startDate = Carbon::now();
              $endDate = Carbon::now()->addMonths(1);
            }

            if($startDate && $endDate){
              $billing = app($this->billingController)->addToBilling(array(
                'account_id' => $plan['account_id'],
                'currency'   => 'USD',
                'details'    => $billing[0]['details'],
                'amount'     => intval($plan['amount']),
                'start_date' => $startDate,
                'end_date'   => $endDate,
                'status'     => 'not paid'
              ));
              echo "\n\t [Billing] New billing created";
              // send an email
            }else{
              echo "\n\t [Billing] Invalid start and end date..";
            }
          }else{
            echo "\n\t [Billing] No end date from last billing..";
          }
        }else{
          echo "\n\t [Billing] No existing billing..";
        }
      }
    }else{
      echo "\n\t [Billing] No available plans..";
    }
  }
}
