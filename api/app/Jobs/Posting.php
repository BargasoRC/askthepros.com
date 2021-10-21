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

    $currentPlan = Plan::where($conditions)->limit(1)->orderBy('created_at', 'desc')->get();

    if($currentPlan && sizeof($currentPlan) > 0){
      // get the status on payloads
      $plan = $currentPlan[0];
      $competition = Payload::where(array(
        array('payload', '=', 'competitor'),
        array('account_id', '=', $plan['account_id'])
      ))->get();
      if($competition && sizeof($competition) > 0){
        // get competition size
        $payloadValue = json_decode($competition[0]['payload_value'], true);
        $size = Payload::where(array(
          array('payload', '=', 'competitor'),
          array('category', '=', $this->industry),
          array('payload_value', 'like', '%"locality":"'.$payloadValue['locality'].'"')
        ))->get();
        if(sizeof($size) > 1){
          // with competition, proceed to posting
          // the rank
          $rank = intval($payloadValue['rank']);
          $this->managePosting($plan, $rank, $size);
        }else{
          // no competition, proceed to posting
          $this->managePosting($plan, null, null);
        }
      }else{
        // no competition, proceed to posting
        $this->managePosting($plan, null, null);
      }
    }else{
      // no available plan then proceed to next
      echo "\n\t\t No available plan on selected industry ==> ".$industry;
    }
  }

  public function managePosting($plan, $rank, $size){
    // get all post
    $posts = DB::table('post_targets as T1')
    ->leftJoin('posts as T2', 'T2.id', '=', 'T1.post_id')
    ->where('T1.payload_value', 'like', '%'.$plan['plan'].'%')
    ->get(['T2.*']);

    $postSize = sizeof($posts);

    // get last post

    $lastPost = PostHistory::where('industry', '=', $this->industry)->where('account_id', '=', $plan['account_id'])->orderBy('created_at', 'desc')->limit(1)->get();

    $nextPost = null;

    if($lastPost){
      $lastIndex = array_search($lastPost[0]['post_id'], array_column($posts, 'id'));
      if($rank && $size){
        // get the last post of the other user which rank before the current user.
        $lastCompetitor = Payload::where(array(
          array('payload', '=', 'competitor'),
          array('category', '=', $this->industry),
          array('payload_value', 'like', '%"rank":"'.(intval($rank) - 1).'"')
        ))->get();

        if($lastCompetitor){
          $lastCompetitorPost = PostHistory::where('industry', '=', $this->industry)->where('account_id', '=', $lastCompetitor[0]['account_id'])->orderBy('created_at', 'desc')->limit(1)->get();
          $lastCompetitorPostIndex = array_search($lastCompetitorPost[0]['post_id'], array_column($posts, 'id'));
          $nextPost = $lastCompetitorPostIndex && sizeof($posts) > 0 && $lastCompetitorPostIndex < sizeof($posts) ? $posts[$lastCompetitorPostIndex + 1] : null;
        }else{
          $nextPost = $lastIndex && sizeof($posts) > 0 && $lastIndex < sizeof($posts) ? $posts[$lastIndex + 1] : null;
        }
      }else{
        // get the next post
        $nextPost = $lastIndex && sizeof($posts) > 0 && $lastIndex < sizeof($posts) ? $posts[$lastIndex + 1] : null;
      }
    }else{
      $nextPost = sizeof($posts) > 0 ? $posts[0] : null;
    }

    if($nextPost && $plan){
      $this->manageChannels($nextPost, $plan);
    }else{
      echo "\n\t\t No available post on selected industry ==> ".$industry;
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
