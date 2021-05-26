<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\TwilioController;
use Increment\Imarket\Merchant\Models\Merchant;
use Carbon\Carbon;
use App\Billing as BillingModel;

class Billing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $twilioController = 'App\Http\Controllers\TwilioController';
    public $shopifyCredentialsController = 'App\Http\Controllers\ShopifyCredentialController';
    public $accountClass = 'Increment\Account\Http\AccountController';
    public $shopifyAuthController = 'App\Http\Controllers\ShopifyAuthenticateController';
    public $merchantController = 'Increment\Imarket\Merchant\Http\MerchantController';
    public $smsController = 'App\Http\Controllers\SMSController';
    public $billingController = 'App\Http\Controllers\BillingController';
    public $shopifyController = 'App\Http\Controllers\ShopifyDirectController';
    public $planController = 'App\Http\Controllers\PlanController';

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
      //
      echo "\n\t[Billing Job] dispatched ...";

      echo "\n\t[Billing Job] Retrieving merchants ... ";
      $merchants = Merchant::get();

      if(sizeof($merchants) > 0){
        foreach ($merchants as $key => $merchant) {
          // check if merchant recently billed and paid
          echo "\n\t[Billing Job] Start billing of merchant => " .$merchant['name'];
          // get recent billing
          $recentBilling = app($this->billingController)->getRecentBilling('merchant_id', $merchant['id']);
          $totalSpent = 0;
          if($recentBilling){
            // get the current spent of the merchant
            echo "\n\t\t[Billing Job] Calculate new total for billing starting ".$recentBilling['end_date'];
            $totalSpent = app($this->smsController)->getTotalSpentByStartDate($merchant['id'], $recentBilling['end_date']);
          }else{
            // get the new billing
            // get the current spent of the merchant
            echo "\n\t\t[Billing Job] Calculate new total for billing";
            $totalSpent = app($this->smsController)->getTotalSpentWithoutDate($merchant['id']);
          }

          // get the plan of the merchant
          echo "\n\t\t[Billing Job] Retrieving currrent plan";
          $currentPlan = app($this->planController)->getByParams('merchant_id', $merchant['id']);

          echo "\n\t\t[Billing Job] Retrieving account details";
          $account = $merchant ? app($this->accountClass)->retrieveById($merchant['account_id']) : null;
          
          echo "\n\t\t[Billing Job] Retrieving shopify credentials";
          $credentials = app($this->shopifyCredentialsController)->getCredentialsByParams('merchant_id', $merchant['id']);


          // check if recently not greater than 15 days from the previous end, ignore, otherwise billed customer
          if(sizeof($account) > 0 && $currentPlan){
            $this->manageResult($currentPlan, $merchant, $account[0], $credentials, $totalSpent, Carbon::now(), Carbon::now());
          }else{
            echo "\n\t\t[Billing Job] No accounts found... ";   
          }
        }
      }else{
          echo "\n\t[Billing Job] No merchants found... ";
      }
      echo "\n\t[Billing Job] finished ...";
  }

  public function manageResult($currentPlan, $merchant, $account, $credentials, $totalSpent, $endDate, $billingDate){
    $title = 'PIVOTSMS '.$currentPlan['plan'].' Plan Subscription: '.$currentPlan['currency'].' '.$currentPlan['amount'].' plus addition charges per sms sent';
    $total = doubleval($currentPlan['amount'] + $totalSpent);
    echo "\n\t\t\t[Billing Job] Billing description: ".$title; 
    echo "\n\t\t\t[Billing Job] Billing total: ".$total; 
    $params = array(
      'recurring_application_charge' => array(
        'name' => $title,
        'price' => $total,
        'return_url' => 'https://'.$credentials['shop'],
        'capped_amount' =>  8000,
        'terms' => $title,
        'activated_on' => $endDate,
        'billing_on' => $billingDate,
        'test' => true,
        "status" => "active",
      )
    );
    echo "\n\t\t\t[Billing Job] Requesting to shopify recurring billing... "; 
    $racResult = app($this->shopifyController)->createRecurringApplicationCharge($credentials, json_encode($params));
    // dd($racResult);
    if($racResult['error'] == null){
      echo "\n\t\t\t[Billing Job] Recurring application charge is successfully created";
      $usageChargeParams = array(
        'usage_charge' => array(
          'description' => $title,
          'price' => $total
        )
      );
      echo "\n\t\t\t[Billing Job] Create usage charge on shopify";
      $usageCharge = app($this->shopifyController)->createUsageCharge($credentials, json_encode($usageChargeParams), $racResult['data']['id']);
      if($usageCharge['error'] == null){
        echo "\n\t\t\t[Billing Job] Usage charge is successfully created";
      }else{
        echo "\n\t\t\t[Billing Job] Usage charge error: ".$usageCharge['error']['recurring_application_charge'][0];
      }

    }else{
      echo "\n\t\t\t[Billing Job] Recurring application charge error: ".$racResult['error'];
    }
  }
}
