<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SMSUsageChecker implements ShouldQueue
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
        //
    }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    echo "\n\t[SMSUsageCheckerJob Job] running..";
    // get messages in asc order where status = 0;
    $result = app($this->smsController)->getByParams('status', 2);
    if($result){
      foreach ($result as $key => $value) {
        $message = app($this->twilioController)->fetch($value['callback_message']);
        print_r($message);
        if($message && $message->price != null){
            app($this->smsController)->updateCharge($value['id'], $message->price, $message->priceUnit);
            echo "\n\t[SMSUsageCheckerJob Job] Priced updated on id = > ".$value['id'];
            // updated message here
        }else{
            echo "\n\t[SMSUsageCheckerJob Job] Message price not available.";
        }
      }
    }else{
      echo "\n\t[SMSUsageCheckerJob Job] no data..";
    }
    echo "\n\t[SMSUsageCheckerJob Job] finish..";
  }
}
