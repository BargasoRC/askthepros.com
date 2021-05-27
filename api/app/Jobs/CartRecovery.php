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
class CartRecovery implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public $upsellController = 'App\Http\Controllers\UpsellController';
  public $shopifyController = 'App\Http\Controllers\ShopifyDirectController';
  public $shopifyCredentialsController = 'App\Http\Controllers\ShopifyCredentialController';
  public $accountClass = 'Increment\Account\Http\AccountController';
  public $shopifyAuthController = 'App\Http\Controllers\ShopifyAuthenticateController';
  public $merchantController = 'Increment\Imarket\Merchant\Http\MerchantController';
  public $smsHandlerController = 'App\Http\Controllers\SMSHandlerController';
  public $smsController = 'App\Http\Controllers\SMSController';
  public $smsGroupController = 'App\Http\Controllers\SMSGroupController';
  public $smsTemplateController = 'App\Http\Controllers\SMSTemplateController';
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
    // get all paid merchants
    // get merchant credentials
    // get abandoned checkouts per merchant
    echo "\n\t[CartRecovery Job] dispatched ...";

    echo "\n\t[CartRecovery Job] Retrieving merchants ... ";
    $merchants = Merchant::get();

    if(sizeof($merchants) > 0){
      foreach ($merchants as $key => $value) {
        echo "\n\t[CartRecovery Job] Get Authentication Credentials of merchant = ".$value['name'];
        $account = $value ? app($this->accountClass)->retrieveById($value['account_id']) : null;
        $credentials = app($this->shopifyCredentialsController)->getCredentialsByParams('merchant_id', $value['id']);
        echo "\n\t[CartRecovery Job] Credentials".print_r($credentials);
        $results = app($this->shopifyController)->getAbandonedCheckouts($credentials, null);
        if(sizeof($account) > 0){
          $this->manageResult($results, $value, $account[0]);
        }else{
          echo "\n\t\t[CartRecovery Job] No accounts found... ";   
        }
      }
    }else{
      echo "\n\t[CartRecovery Job] No merchants found... ";
    }
    echo "\n\t[CartRecovery Job] finished ...";
  }

  public function manageResult($data, $merchant, $account){
    if($data['data']){
      foreach ($data['data'] as $key => $value) {
        $cartProducts = '';
        $i = 0;
        foreach ($value['line_items'] as $lKey => $lValue) {
          $cartProducts .= ($i > 0 ? ',' : '').$lValue['title'];
          $i++;
        }

        echo "\n\t\t[CartRecovery Job] Sending sms to ".$value['customer']['phone'];
        $customerData = array(
          "default_address"  => isset($value['customer']['default_address']) ? $value['customer']['default_address'] : $value['shipping_address'],
          "cart"      => array(
            "presentment_currency"  => $value["presentment_currency"],
            "total_price" => $value["total_price"],
            "order_id" => $value['id']
          ),
          "products" => $cartProducts,
          "merchant"=> $merchant['name']
        );
        $array = array(
          'merchant_id' => $merchant['id'],
          'payload'   => 'cart_recoveries',
          'payload_value' => $value['id'],
          'full_name'  => $value['customer']['first_name'].' '.$value['customer']['last_name'],
          'receiver'  => $value['customer']['phone'],
          'status'    => 'on going',
          'customer_data' => json_encode($customerData),
          'created_at'  => Carbon::now()
        );
        $smsGroup = app($this->smsGroupController)->createByParams($array);
        if($smsGroup){
          $message = app($this->smsController)->timeSender($value, $merchant, $account, $cartProducts, 'cart_recoveries');
          unset($array['customer_data']);
          $array['sms_group_id'] = $smsGroup['id'];
          $array['sender'] = env("TWILIO_NUMBER");
          $array['messages'] = $message;
          $array['status'] = 0;
          $result = app($this->smsHandlerController)->createByParams($array);
          if($result == true){
            echo "\n\t\t\t[SMS Controller] Adding ".$value['customer']['first_name'].' using number '.$value['customer']['phone']. ' to SMS';
          }else{
            echo "\n\t\t\t[SMS Controller] ".$value['customer']['first_name'].' using number '.$value['customer']['phone']. ' already exist';
          }
        }
      }
    }else{
      echo "\n\t\t[CartRecovery Job] No carts found... ";
    }
  }
}
