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
class PostingOld implements ShouldQueue
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
          $posts = $size = DB::table('post_targets as T1')
          ->leftJoin('posts as T2', 'T2.id', '=', 'T1.post_id')
          ->where('T1.payload_value', 'like', '%'.$plan['plan'].'%')
          ->get(['T2.*']);
          $posts = json_decode($posts, true);

          

          // echo  "\n\t" . $posts;
          if($posts && sizeof($posts) > 0){
            $lastPost = PostHistory::where('industry', '=', $plan['plan'])->where('account_id', '=', $plan['account_id'])->orderBy('created_at', 'desc')->limit(1)->get();
            if($lastPost && sizeof($lastPost)){
              

              $currentDate = Carbon::now();
              $lastPostDate = Carbon::createFromFormat('Y-m-d H:i:s', $lastPost[0]['created_at']);

              $diff = abs($currentDate->diffInDays($lastPostDate));
              if($diff > 1){
                $lastIndex = array_search($lastPost[0]['post_id'], array_column($posts, 'id'));
                $nextPost = sizeof($posts) > 0 && $lastIndex < sizeof($posts) ? $posts[$lastIndex + 1] : null;
                $this->manageChannels($nextPost, $plan);
              }else{
                echo "\n\t [POSTING] Already have post for today";
              }
              
            }else{
              $nextPost = sizeof($posts) > 0 ? $posts[0] : null;
              $this->manageChannels($nextPost, $plan);
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
    echo "\n\npost => id".$post['id'].json_encode($channels);
    if($channels){
      foreach ($channels as $key => $channel) {
        $postHistory = PostHistory::where(array(
          array('post_id', '=', $post['id']),
          array('account_id', '=', $plan['account_id']),
          array('channel', '=', $channel),
          array('industry', '=', $plan['plan']),
          array('created_at', '>=', Carbon::now()->subDays(7))
        ))->get();

        if($postHistory && sizeof($postHistory) > 0){
          echo "\n\t\t Post id => ".$post['id']." for ".$channel." already existed";
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
      ->limit(1)
      ->get();

      if($page && sizeof($page) > 0){
        $result = app($this->postHistoryController)->createByParams(array(
          'post_id' => $post['id'],
          'page_id' => $page[0]['id'],
          'link'    => null,
          'channel' => $channel,
          'account_id'  => $plan['account_id'],
          'industry' => $plan['plan'],
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