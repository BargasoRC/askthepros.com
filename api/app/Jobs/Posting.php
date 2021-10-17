<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


use Increment\Imarket\Merchant\Models\Merchant;
use App\Plan;
use App\Post;
use App\PostHistory;
use App\Page;
use Increment\Common\Payload\Models\Payload;
use Increment\Account\Models\AccountInformation;
use Increment\Account\Models\Account;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Posting implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   *
   * @return void
   */



  public $postHistoryController = 'App\Http\Controllers\PostHistoryController';
  public $industries = null;
  public $industry = null;
  public function __construct()
  {
      //
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle(){
    $schedule = 'MondayTuesdayWednesdayThursdayFriday';
    $currentDate = Carbon::now()->format('l');
    echo "currentDate = ".$currentDate;
    if(str_contains($schedule, $currentDate)){
      // Get all list of industries
      $industries = Payload::where(array(
        array('payload', '=', 'subscriptions')
      ))->orderBy('category', 'asc')->get();

      if($industries && sizeof($industries) > 0){
        $this->industries = $industries;
        // get the current industry for posting
        $currentPayload = Payload::where(array(
          array('payload', '=', 'current_industry')
        ))->get();

        if($currentPayload && sizeof($currentPayload) > 0){
          // continue to the current industry
          $this->manageIndustry($currentPayload[0]['category']);
        }else{
          // continue to first industry
          $this->manageIndustry($industries[0]['category']);
        }
      }else{
        echo "\n\t [POSTING] No available industries..";
      }
    }else{
      echo "\n\t [POSTING] Not on schedule..";
    }
  }

  public function manageIndustry($industry){
    // get current save plan of the industry
    $currentPlan = Payload::where(array(
      array('payload', '=', 'current_plan')
    ))->get();

    $this->industry = $industry;
    if($currentPlan && sizeof($currentPlan) > 0){
      // proceed to next state
      $currentPlanDetails = json_decode($currentPlan[0]['payload_value'], true);
      $this->manageNextPlan($currentPlanDetails['id']);
    }else{
      // empty plan state
      $this->manageNextPlan(false);
    }
  }

  public function manageNextPlan($planId = null){
    $conditions = array(
      array('plan', '=', $this->industry),
      array('end_date', '>', Carbon::now())
    );
    if($planId){
      $conditions[] = array('id', '>', $planId);
    }
    $nextPlan = Plan::where($conditions)->limit(1)->orderBy('created_at', 'desc')->get();

    if($nextPlan && sizeof($nextPlan) > 0){

    }else{
      // no available plan then proceed to next
    }
  }

  public function postByLocation($post, $plan){
    $users = Account::leftJoin('account_informations as T1', 'T1.account_id', '=', 'accounts.id')->where('account_type', '=', 'USER')->leftJoin('plans as P1', 'P1.account_id', '=', 'accounts.id')->where('account_type', '=', 'USER')->where('plan', '=', $plan['plan'])->get(['T1.*']);
    // dd($users);
    if(sizeof($users) > 0){
      foreach($users as $key => $user) {
        // if(json_decode($user[0]->address)->locality != null){
        // dd(json_decode($user['address'])->locality);
        if(json_decode($user['address'])->locality){
          $userLocation = Account::leftJoin('account_informations as T1', 'T1.account_id', '=', 'accounts.id')->where('account_type', '=', 'USER')->leftJoin('plans as P1', 'P1.account_id', '=', 'accounts.id')->where('account_type', '=', 'USER')->where('plan', '=', $plan['plan'])->groupBy('T1.address')->having('T1.address', 'like', '%'.json_decode($user['address'])->locality.'%')->orderBy('accounts.created_at')->get();
          if(sizeof($userLocation) > 0){
            return $post;
          }else{
            return [];
          }
        }else{
          echo "\n\t\t [LOCALITY PROBLEM] Invalid Location";
        }
      }
    }else{
      echo "\n\t [INFORMATION PROBLEM] Please setup your personal information.";
    }
  }

  public function manageChannels($post, $plan){
    echo "\n\t\t Manage channels";
    $channels = $post && $post[0]->channels ? json_decode($post[0]->channels) : null;
    if(sizeOf($channels) > 0){
      foreach ($channels as $key => $channel) {
        // dd($post[0]);
        $postHistory = PostHistory::where(array(
          array('post_id', '=', $post[0]->id),
          array('account_id', '=', $plan['account_id']),
          array('channel', '=', $channel),
          array('created_at', '>=', Carbon::now()->subDays(7))
          ))->get();
          // ))->whereBetween('created_at', array(Carbon::now()->startOfDay(), Carbon::now()->endOfDay()))->get();
          // dd($postHistory);
        if($postHistory && sizeof($postHistory) > 0){
          echo "\n\t\t Post id => ".$post[0]->id." for ".$channel." already existed";
        }else{
          $this->managePostHistory($post, $plan, $channel);
        }
      }
    }else{
      echo "\n\t\t No channel was added";
    }
  }

  public function managePostHistory($post, $plan, $channel){
    // get automation setting
    // get page of the merchant
    $postSetting = Payload::where(array(
      array('payload', '=', 'automation_settings'),
      array('account_id', '=', $plan['account_id'])
    ))->get();
    
    if($postSetting && sizeof($postSetting) > 0){
      $page = Page::where(array(
        array('account_id', '=', $plan['account_id']),
        array('type', '=', $channel === 'GOOGLE_MY_BUSINESS' ? 'google' : strtolower($channel))
        ))->orderBy('created_at', 'desc')
        // ->limit(1)
        ->get();
      // dd($page);
      if($page && sizeof($page) > 0){
        $result = app($this->postHistoryController)->createByParams(array(
          'post_id' => $post[0]->id,
          'page_id' => $page[0]['id'],
          'link'    => null,
          'channel' => $channel,
          'account_id'  => $plan['account_id'],
          'status'  => $postSetting[0]['payload_value'] == 'ON' ? 'for posting' : 'for review'
        ));
        // dd($result);

        echo "\n\t\t Post id => ".$post[0]->id." for ".$channel." successfully created";        
      }else{
        echo "\n\t\t Account don't have existing page for channel ".$channel;
      }
    }else{
      echo "\n\t\t No post automation settings";
    }
  }
}
