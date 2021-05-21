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

class Campaigns implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

  public $shopifyController = 'App\Http\Controllers\ShopifyDirectController';
  public $shopifyCredentialsController = 'App\Http\Controllers\ShopifyCredentialController';
  public $accountClass = 'Increment\Account\Http\AccountController';
  public $shopifyAuthController = 'App\Http\Controllers\ShopifyAuthenticateController';
  public $merchantController = 'Increment\Imarket\Merchant\Http\MerchantController';
  public $smsController = 'App\Http\Controllers\SMSController';
  public $smsGroupController = 'App\Http\Controllers\SMSGroupController';
  public $smsHandlerController = 'App\Http\Controllers\SMSHandlerController';
  public $smsTemplateController = 'App\Http\Controllers\SMSTemplateController';
  public $campaignController = 'App\Http\Controllers\CampaignController';
  public $shortUrlController = 'App\Http\Controllers\ShortUrlController';
    
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

    echo "\n\t[Campaigns Job] dispatched ...";

    echo "\n\t[Campaigns Job] Retrieving merchants ... ";
    $merchants = Merchant::get();

    if(sizeof($merchants) > 0){
      foreach ($merchants as $key => $value) {
        echo "\n\t[Campaigns Job] Get Authentication Credentials of merchant = ".$value['name'];
        $account = $value ? app($this->accountClass)->retrieveById($value['account_id']) : null;
        $credentials = app($this->shopifyCredentialsController)->getCredentialsByParams('merchant_id', $value['id']);
        echo "\n\t[Campaigns Job] Credentials ".print_r($credentials);
        $results = app($this->campaignController)->retrieveCampaigns();
        if(sizeof($account) > 0){
          $this->manageCampaigns($results, $value, $account[0], $credentials);
        }else{
          echo "\n\t\t[Campaigns Job] No accounts found... ";   
        }
      }
    }else{
      echo "\n\t[Campaigns Job] No merchants found... ";
    }
    echo "\n\t[Campaigns Job] finished ...";
  }

  public function manageCampaigns($data, $merchant, $account, $credentials){
    if(sizeof($data) > 0){
      foreach ($data as $value) {
        $campaigns = '';
        $i = 0;
        $c = 0;
        foreach ($value as $vValue) {
          $campaigns .= ($i > 0 ? ',' : '').$vValue[$i]['name'];
          $customers = app($this->campaignController)->getCustomerByParams(
            array(
              array('campaign_id', '=', $vValue[$i]['id']),
              array('deleted_at', '=', null),
            ));
          $customerShopify = app($this->shopifyController)->getCustomers($credentials);
          foreach ($customers as $customer) {
            $cd = 0;
            foreach ($customer['customer'] as $each) {
              $conditions = json_decode($each['attributes']);
              $result = $this->manageCustomerFilter($conditions->condition, $conditions->attributes, $credentials);
              if(sizeof($result) > 0){
                $r = 0;
                foreach ($result as $rValue) {
                  $array = array(
                    'merchant_id' => $merchant['id'],
                    'payload'   => 'campaigns',
                    'payload_value' => $vValue[$i]['id'],
                    'full_name'  => $rValue['first_name'].' '.$rValue['last_name'],
                    'receiver'  => $rValue['phone'],
                    'status'    => 'on going',
                    'created_at'  => Carbon::now()
                  );
                  $smsGroup = app($this->smsGroupController)->createByParams($array);
                  if($smsGroup){
                    $message = $vValue[$i]['message'];
                    $array['sms_group_id'] = $smsGroup['id'];
                    $array['sender'] = env("TWILIO_NUMBER");
                    $array['messages'] = $message;
                    $array['status'] = 0;
                    $result = app($this->smsHandlerController)->createByParams($array);
                    if($result == true){
                      echo "\n\t\t\t[SMS Controller] Adding ".$rValue['first_name'].' using number '.$rValue['phone']. ' to SMS';
                    }else{
                      echo "\n\t\t\t[SMS Controller] ".$rValue['first_name'].' using number '.$rValue['phone']. ' already exist';
                    }
                }
              }
            $r++;
            }
            $cd++;
          }
          $c++;
          }
        $i++;
        }
      }
    }else{
      echo "\n\t\t[Campaigns Job] No campaigns found... ";
    }
  }

  public function manageCustomerFilter($condition, $filter, $credentials){
    $query = 'query=';
    $isOrder=false;
    $temp = [];
    $searhResult = [];
    $i=0;
    foreach ($filter as $value) {
      if(sizeof($filter) > 0){
        if($value->title == 'Lifetime money spent by customer'){
          $query .= 'total_spent:'.$value->value.' ';
        }else if($value->title == 'Number of orders placed by customer'){
          $query .= 'order_count ';
        }else if($value->title ==  'Customer ordered specific product(s)'){
          $query .= 'order_count ';
        }else if($value->title == "Customer tagged with 'x'"){
          $query .= 'customer_tag:'.$value->value;
        }else if($value->title == 'Customer not tagged with "x"'){
          $query .= '&customer_tag!='.$value->value;
        }else if($value->title == 'Customer located in "x" countries'){
          $query .= 'country:'.$value->value;
        }else if($value->title == 'Customer not located in "x" countries'){
          $query .= 'country!='.$value->value;
        }else if($value->title == 'Customer(s) with fulfilled orders'){
          $queryParameter = 'fulfill_status:fulfilled';
          $temp = app($this->shopifyController)->getOrdersByParams($credentials, $queryParameter);
        }else if($value->title == 'Customer(s) with unfulfilled orders'){
          $queryParameter = 'fulfill_status:null';
          $temp = app($this->shopifyController)->getOrdersByParams($credentials, $queryParameter);
        }else if($value->title == 'Customer(s) with paid orders'){
          $queryParameter = 'financial_status:paid';
          $temp = app($this->shopifyController)->getOrdersByParams($credentials, $queryParameter);
        }else if($value->title == 'Customer(s) with pending orders'){
          $queryParameter = 'financial_status:pending';
          $temp = app($this->shopifyController)->getOrdersByParams($credentials, $queryParameter);
        }else if($value->title == 'Customer(s) with refunded orders'){
          $queryParameter = 'financial_status:refunded';
          $temp = app($this->shopifyController)->getOrdersByParams($credentials, $queryParameter);
        }
        $searhResult = app($this->shopifyController)->searchCustomers($credentials, $query);
      }
      $i++;
    }
    return $searhResult['data'];
  }
}
