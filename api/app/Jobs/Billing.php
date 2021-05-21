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
    public $smsController = 'App\Http\Controllers\SMSHandlerController';
    public $billingController = 'App\Http\Controllers\BillingController';
    public $shopifyController = 'App\Http\Controllers\ShopifyDirectController';

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
            foreach ($merchants as $key => $value) {
                echo "\n\t[Billing Job] Get Authentication Credentials of merchant = ".$value['name'];
                $account = $value ? app($this->accountClass)->retrieveById($value['account_id']) : null;
                $credentials = app($this->shopifyCredentialsController)->getCredentialsByParams('merchant_id', $value['id']);
                echo "\n\t[Billing Job] Credentials".print_r($credentials);
                $results = app($this->billingController)->getByParams('merchant_id', $value);
                // $results = app($this->shopifyController)->getAbandonedCheckouts($credentials, null); // should be replace by sms data where status is = 2
                if(sizeof($account) > 0){
                $this->manageResult($results, $value, $account[0], $credentials);
                }else{
                echo "\n\t\t[Billing Job] No accounts found... ";   
                }
            }
        }else{
            echo "\n\t[Billing Job] No merchants found... ";
        }
        echo "\n\t[Billing Job] finished ...";
    }

    public function manageResult($data, $merchant, $account, $credentials){
        if(sizeof($data) > 0){
          $i=0;
          foreach ($data as $key) {
            $data[$i]['details'] = 'sample';
            $data[$i]['status'] = 1;
            $data[$i]['amount'] = ((float)$data[$i]['total_price']) * 4.67;
            BillingModel::create($data[$i]);
            $abandonedCheckouts = app($this->shopifyController)->getAbandonedCheckouts($credentials, null);
            if($abandonedCheckouts['data']){
              if(sizeof($abandonedCheckouts['data']) > 0){
                $j = 0;
                foreach ($abandonedCheckouts['data'] as $key) {
                  $params = array(
                    'recurring_application_charge' => array(
                      'name' => $abandonedCheckouts['data'][$j]['line_items'][0]['title'],
                      'price' => $abandonedCheckouts['data'][$j]['line_items'][0]['price'],
                      'return_url' => $abandonedCheckouts['data'][$j]['abandoned_checkout_url'],
                      'capped_amount' =>  100,
                      'terms' => "$1 for 1000 emails",
                      'activated_on' => null,
                      'billing_on' => null,
                      'test' => true,
                      "status" => "active",
                    ),

                  );
                  
                  $racResult = app($this->shopifyController)->createRecurringApplicationCharge($credentials, json_encode($params));
                  // dd($racResult);
                  if($racResult['error'] == null){
                    echo 'recurring application charge is successfully created'."\n";
                    // $updateParams = array(
                    //   'recurring_application_charge' => array(
                    //     'status' => 'accepted'
                    //   )
                    //   );
                    // $updateCharge = app($this->shopifyController)->updateRecurringApplicationCharge($credentials, json_encode($updateParams), $racResult['data']['id']);
                    $usageChargeParams = array(
                      'usage_charge' => array(
                        'description' => $abandonedCheckouts['data'][$j]['line_items'][0]['title'],
                        'price' => (int)$abandonedCheckouts['data'][$j]['line_items'][0]['price']
                      )
                    );
                    $usageCharge = app($this->shopifyController)->createUsageCharge($credentials, json_encode($usageChargeParams), $racResult['data']['id']);
                    // print(json_encode($usageCharge['error']['recurring_application_charge'][0]));
                    // dd();
                    if($usageCharge['error'] == null){
                      echo 'usage charge charge is successfully created';
                    }else{
                      echo 'error occured in creating usage charge: '.$usageCharge['error']['recurring_application_charge'][0]."\n\t";
                    }
                  }else{
                    echo 'error occured in creating recurring application charge: '.$racResult['error']."\n\t";
                  }
                  $j++;
                }
              }
            }
            // $i++;
          }
        }else{
          echo "\n\t\t[Billing Job] No billing found... ";
        }
      }
}
