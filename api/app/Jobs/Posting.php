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
    $schedule = 'MondayTuesdayWednesdayFriday';
    $currentDate = Carbon::now()->format('l');
    echo "currentDate = ".$currentDate;
    if(str_contains($schedule, $currentDate)){
      echo "\n\t [POSTING] Running on day => ".$currentDate;
      // Get current merchant
      $plans = Plan::where('end_date', '=', null)->orWhere('end_date', '>=', Carbon::now())->get();

      if(sizeof($plans) > 0){
        foreach ($plans as $key => $plan) {
          // Get published posting using the same category as plan
          $posts = $size = DB::table('post_targets as T1')
          ->leftJoin('posts as T2', 'T2.id', '=', 'T1.post_id')
          ->where('T1.payload_value', 'like', '%'.$plan['plan'].'%')
          ->get(['T2.*']);
          $posts = json_decode($posts, true);

          if($posts && sizeof($posts) > 0){
            foreach ($posts as $pKey => $post) {
              $this->manageChannels($post, $plan);
            }
          }else{
            echo "\n\t [POSTING] No post(s) related to the category.";
          }
        }
      }else{
        echo "\n\t [POSTING] No active customer with active plans.";
      }
    }else{
      echo "\n\t [POSTING] Not on schedule..";
    }
  }

  public function manageChannels($post, $plan){
    echo "\n\t\t Manage channels";
    $channels = $post && $post['channels'] ? json_decode($post['channels']) : null;
    if($channels){
      foreach ($channels as $key => $channel) {
        $postHistory = PostHistory::where(array(
          array('post_id', '=', $post['id']),
          array('account_id', '=', $plan['account_id']),
          array('channel', '=', $channel),
          array('created_at', '>=', Carbon::now()->subDays(7))
        ))->get();

        if($postHistory && sizeof($postHistory) > 0){
          echo "\n\t\t Post id => ".$post['id']." for ".$channel." already existed";
        }else{
          $this->managePostHistory($post, $plan, $channel);
        }
      }
    }else{
      echo "\n\t\t No added was added";
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
        array('type', '=', $channel)
      ))->orderBy('created_at', 'desc')
      ->limit(1)
      ->get();

      if($page && sizeof($page) > 0){
        $result = app($this->postHistoryController)->createByParams(array(
          'post_id' => $post['id'],
          'page_id' => $page[0]['id'],
          'link'    => null,
          'channel' => $channel,
          'account_id'  => $plan['account_id'],
          'status'  => $postSetting[0]['payload_value'] == 'ON' ? 'for posting' : 'for review'
        ));

        echo "\n\t\t Post id => ".$post['id']." for ".$channel." successfully created";        
      }else{
        echo "\n\t\t Account don't have existing page for channel ".$channel;
      }
    }else{
      echo "\n\t\t No post automation settings";
    }
  }
}
