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
class Upsells implements ShouldQueue
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
  public $merchantController = 'Increment\Imarket\Merchant\Http\MerchantController';
  public $twilioController = 'App\Http\Controllers\TwilioController';
  public $smsController = 'App\Http\Controllers\SMSController';
  public $smsHandlerController = 'App\Http\Controllers\SMSHandlerController';
  public $accountClass = 'Increment\Account\Http\AccountController';
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
    echo "\n\t[Upsells Job] dispatched ...";

    echo "\n\t[Upsells Job] Retrieving Store Upsells ... ";
    $upsells = app($this->upsellController)->getByParams('status', 1);
    if($upsells == null){
      echo "\n\t[Upsells Job] Empty Upsells...\n[Upsells Job] Complete...";
      return false;
    }
    $merchants = $upsells->groupBy('merchant_id');
    $merchants = json_decode($merchants, true);

    

    foreach ($merchants as $key => $value) {
      $merchant = app($this->merchantController)->getByParams('id', $key);;
      echo "\n\t[Upsells Job] Get Authentication Credentials of merchant = ".$merchant['name'];
      // print(json_encode($value));
      $account = $value ? app($this->accountClass)->retrieveById($value[0]['account_id']) : null;
      $credentials = app($this->shopifyCredentialsController)->getCredentialsByParams('merchant_id', $key);
      $this->manageUpsells($value, $credentials, $upsells, $account[0]);
    }

    echo "\n\t[Upsells Job] Completed Upsells ... ";

  }

  public function manageUpsells($data, $credentials, $upsells, $account){
    if(sizeof($data) > 0){
      foreach ($data as $key => $value) {
        $collections = app($this->shopifyController)->getRestProducts($credentials, null);
        $orders = app($this->shopifyController)->getOrders($credentials);
        $customers = app($this->shopifyController)->getCustomers($credentials);
        $o = 0;
        $url = null;
        $tempOrder = [];
        foreach ($orders['data'] as $oValue) {
          // $oValue['discount_codes'] = $oValue['discount_codes'];
          // $oValue['discount'] = $oValue['total_discounts'];
          $oValue['line_items'][0]['discount_codes'] = $oValue['discount_codes'];
          $oValue['line_items'][0]['discount'] = $oValue['total_discounts'];
          array_push($tempOrder, $oValue['line_items']);
          $o++;
        }

        if(sizeof($customers) > 0){
          $j = 0;
          $c = 0;
          $i= 0;
          $upsells = null;
          // print(json_encode($collections['data']));
          // dd();
          foreach ($customers as $key => $cValue) {
            // echo print_r($cValue);
            // echo "\n\t[Upsells Job] Sending Upsells to ".$cValue['firstName'].'...';
            if($collections['data']){
              foreach ($collections['data'] as $uValue) {
                if(sizeof($tempOrder) > 0){
                  foreach ($tempOrder as $tValue) {
                    if($uValue['id'] === $tValue[$c]['product_id']){
                      
                      //get upsells products in table
                      $upsellsData = app($this->upsellController)->getUpsellProductByParams(array(array('product' , '=', $uValue['admin_graphql_api_id'])), ['upsell_id', 'payload']);
                      
                      if($upsellsData !== null){
                        $productData = app($this->upsellController)->getByParams('id', $upsellsData['upsell_id']);
                        $uValue['discount'] = $productData[0]['discount'];
                        $uValue['order_product'] =  $upsellsData['payload'] == $uValue['admin_graphql_api_id'] ? $uValue['title'] : $productData[0]['name'];
                      }else{
                        $uValue['discount'] = 0;
                      }
                      $uValue['product_url'] = 'https://pivotsmsdevelopmentstore.myshopify.com/products/'.$uValue['handle'];
                      $uValue['discount_codes'] = $uValue['admin_graphql_api_id'];
                      $uValue['upsells_id'] = $upsellsData !== null ? $upsellsData['upsell_id'] : null;
                      

                      $array = array(
                        'merchant_id' => $credentials['id'],
                        'payload'   => 'upsells',
                        'payload_value' => $upsellsData !== null ? $upsellsData['upsell_id'] : null,
                        'receiver'  => $cValue[$j]['phone'],
                        'status'    => 'on going',
                        'created_at'  => Carbon::now()
                      );

                      $smsGroup = app($this->smsGroupController)->createByParams($array);

                      if($smsGroup){
                        $message = app($this->smsController)->timeSender($cValue[$j], $value, $account, $uValue, 'upsells');
                        $array['sms_group_id'] = $smsGroup['id'];
                        $array['sender'] = env("TWILIO_NUMBER");
                        $array['messages'] = $message;
                        $array['status'] = 0;
                        $result = app($this->smsHandlerController)->createByParams($array);
                        echo "\n\t\t\t[Sending SMS] send to ".$cValue[$j]['email'].' using number '.$cValue[$j]['phone'];
                        if($result !== null){
                          echo "\n\t\t\t[Send SMS] sms is successfull send to ".$cValue[$j]['email'].' using number '.$cValue[$j]['phone'];
                        }else{
                          echo "\n\t\t\t[Send SMS] connection time out";
                        }
                      }
                    }
                  }
                }else{
                  echo "\n\t\t[Upsells Job] No orders found... ";
                }
                $i++;
              }
            }else{
              echo "\n\t\t[Upsells Job] No collection found... ";
            }
            $j++;
          }
        }else{
          echo "\n\t\t[Upsells Job] No customer found... ";
        }
        
      }
    }
  }
}
