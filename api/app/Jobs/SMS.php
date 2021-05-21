<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Carbon\Carbon;
class SMS implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  public $twilioController = 'App\Http\Controllers\TwilioController';
  public $smsController = 'App\Http\Controllers\SMSHandlerController';
  public $merchantController = 'Increment\Imarket\Merchant\Http\MerchantController';
  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct()
  {
  
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    echo "\n\t[SMS Job] running..";
    // get messages in asc order where status = 0;
    $result = app($this->smsController)->getByParams('status', 0);
    if($result){
      $result = $result->groupBy('merchant_id');
      foreach ($result as $key => $value) {
        $merchant = app($this->merchantController)->getByParams('id', $key);
        if($merchant && $merchant['addition_informations']){
          if($value && sizeof($value) > 0){
            // app($this->twilioController)->transferPhoneNumber($merchant['addition_informations']);
            foreach ($value as $jKey => $jValue) {
              $array = array(
                'receiver'  => $jValue->receiver,
                'message'   => $jValue->messages,
                'sender'   => $jValue->sender,
                'code'      => $jValue->code
              );
              app($this->twilioController)->sendDirect($array, $merchant['addition_informations']);
              app($this->smsController)->updateDirect($jValue);
              echo "\n\t\t[SMS Job] Update status on id = ".$jValue['id'];
            }
          }
          
        }else if($merchant && $merchant['addition_informations'] == null){
          // create subaccount
          echo "\n\t\t[SMS Job] Creating subaccount";
          $exist = app($this->twilioController)->findSubAccount($merchant['email']);
          if($exist == false){
            $subAcccount = app($this->twilioController)->createSubAccount($merchant['email']);
            if($subAcccount){
              app($this->merchantController)->updateByParams('id', $value['merchant_id'], array(
                'addition_informations' => $subAcccount->sid,
                'updated_at' => Carbon::now()
              ));
              echo "\n\t\t[SMS Job] Updated merchant addition_informations";
            }else{
              echo "\n\t\t[SMS Job] Unable to create subAcccount";
            }
          }else{
            // update here
            app($this->merchantController)->updateByParams('id', $key, array(
              'addition_informations' => $exist,
              'updated_at' => Carbon::now()
            ));
            echo "\n\t\t[SMS Job] Updated merchant addition_informations";
          }
        }
      }
    }else{
      echo "\n\t[SMS Job] no data..";
    }
    echo "\n\t[SMS Job] finish..";
  }
}
