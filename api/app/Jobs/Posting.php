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
    // Get channels credentials
    // Send to curl of the channel
    $schedule = 'MondayTuesdayWednesdayThursdayFriday';
    $currentDate = Carbon::now()->format('l');
    echo "currentDate = ".$currentDate;
    if(str_contains($schedule, $currentDate)){
      echo "\n\t [POSTING] Running on day => ".$currentDate;
      // Get current merchant
      $plans = Plan::where('end_date', '=', null)->orWhere('end_date', '>=', Carbon::now())->get();
      if(sizeof($plans) > 0){
        foreach ($plans as $key => $plan) {
          // Get published posting using the same category as plan
          
          // user 1 => finance
          // user 2 => real estate
          // user 3 => finance
          // user 4 => Technology
          // user 5 => finance
          $users = Account::leftJoin('account_informations as T1', 'T1.account_id', '=', 'accounts.id')
              ->where('account_type', '=', 'USER')
              ->leftJoin('plans as P1', 'P1.account_id', '=', 'accounts.id')
              ->where('account_type', '=', 'USER')
              ->where('plan', '=', $plan['plan'])
              ->get(['T1.*']);
              
          if(sizeof($users) > 0){
            foreach($users as $key => $user) {
              if(json_decode($user['address'])->locality){

                $userLocation = $size = Account::leftJoin('account_informations as T1', 'T1.account_id', '=', 'accounts.id')
                ->where('account_type', '=', 'USER')
                ->leftJoin('plans as P1', 'P1.account_id', '=', 'accounts.id')
                ->where('account_type', '=', 'USER')
                ->where('plan', '=', $plan['plan'])
                ->groupBy('T1.address')
                ->having('T1.address', 'like', '%'.json_decode($user['address'])->locality.'%')
                ->orderBy('accounts.created_at')->get();
                dd($userLocation);
                // if(sizeof($userLocation) > 0){
                //   return $post;
                // }else{
                //   return [];
                // }

              }else{
                echo "\n\t\t [LOCALITY PROBLEM] Invalid Location";
              }
            }
          }else{
            echo "\n\t [INFORMATION PROBLEM] Please setup your personal information.";
          }
          // user 1 => 
            // count the size of the plans with the same industry of the selected plan of the same location
            // 3 array(user 1, user 3, user 5) or you can use filter
            // get the order or get the index of the user
                // for example, user 1 => 0
                // for exsample, user 3 => 1
                // for example, user 5 => 2
          // get the all all post of the selected industry
          // get and count previous posted post of the selected user
                //  for eq., 10 post, so that can select the next id of the post
              // If previous existed, get the last post id
                  // else, post directly using the index position of the user
          // post to the post histories
            // check if the post already existed
          
        $i = 0;
        $posts = array();
          $onePost = $size = DB::table('post_targets as T1')
          ->leftJoin('posts as T2', 'T2.id', '=', 'T1.post_id')
          ->where('T1.payload_value', 'like', '%'.$plan['plan'].'%')
          ->groupBy('T1.payload_value')
          ->having('T1.payload_value', 'like', '%'.$plan['plan'].'%')
          ->get(['T2.*', 'T1.payload_value']);
          array_push($posts, $onePost);
          $i++;
        }
        dd($posts);
          // groupBy plan and location
          
          // $postsa = array();
          // if(sizeof(array_unique($posts)) > 0){
          if(sizeof($posts) > 0){
            foreach ($posts as $pKey => $post) {
              // dd($post);
              $location = $this->postByLocation($post, $plan);
              if($location && sizeof($location) > 0){
                $this->manageChannels($post, $plan);
              }
            }
          }else{
            echo "\n\t [POSTING] No post(s) related to the category.";
          }
      }else{
        echo "\n\t [POSTING] No active customer with active plans.";
      }
    }else{
      echo "\n\t [POSTING] Not on schedule..";
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
