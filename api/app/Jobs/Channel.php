<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\PostHistory;
use App\Post;
use Carbon\Carbon;
use App\Facebook;
class Channel implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   *
   * @return void
   */

  public $facebookController = 'App\Http\Controllers\FacebookService';
  public $pageController = 'App\Http\Controllers\PageController';
  public $brandingController = 'App\Http\Controllers\BrandingController';
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
    // get all post histories with for posting status

    $posts = PostHistory::leftJoin('posts', 'post_histories.post_id', '=', 'posts.id')
            ->where('post_histories.status', '=', 'for posting')
            ->select('post_histories.*', 'posts.url', 'posts.description')
            ->get();

    if($posts && sizeof($posts) > 0){
      foreach ($posts as $key => $postHistory) {
        $branding = app($this->brandingController)->getActiveByParams($postHistory['account_id']);

        

        switch(strtolower($postHistory['channel'])){
          case 'facebook':
            if($branding && $branding['details'] !== null){
              $message = "\n\n".$branding['details']['brand1']."\n\n".$branding['details']['brand2']."\n\n".$branding['details']['brand3'];
              $postHistory['description'] .= $message;
            }
            $this->manageFacebook($postHistory);
            break;
          case 'linkedin':
            if($branding && $branding['details'] !== null){
              $message = "//n//n".$branding['details']['brand1']."//n//n".$branding['details']['brand2']."//n//n".$branding['details']['brand3'];
              $postHistory['description'] .= $message;
            }
            $this->manageLinkedIn($postHistory);
            break;
          case 'google_my_business':
            // $this->manageGoogle($postHistory);
            break;
        }
      }
    }else{
      echo "\n\t\t[CHANNEL] No post available for posting.";
    }
  }

  public function manageFacebook($postHistory){
    $media = '';
    $result = null;
    $page = app($this->pageController)->getActiveByParams($postHistory['account_id'], 'facebook');
    echo "\n\t\t\t pageController => ".$postHistory['account_id'];

    if($page == null){
        return false;
    }

    $token = $page['details']['access_token'];
    $media = env('BACKEND_URL').'/storage/image/2_2021-08-03_02_00_17_robot.png';
    // if(isset($postHistory['url'])) {
    //   if(json_decode($postHistory['url'])) {
    //     $url = $postHistory['url'];
    //     $media = json_decode($url);
    //     $media = env('BACKEND_URL', ''). $media[0];
    //   }
    // }


    $params = null;
    $facebook = new Facebook($token);
    $postHistory['url'] = null;
    if($postHistory['url']){
      // post with image
      $params = array(
        "message" => $postHistory['description'],
        "access_token" => $token,
        "url" => $media
      );

      $result = $facebook->publishContentWithPhoto($page['page'], $params);
    }else{
      // post without image
      $params = array(
        "message" => $postHistory['description'],
        "access_token" => $token
      );
      $result = $facebook->publishContentTextOnly($page['page'], $params);
    }

    if($result && isset($result['id'])){
      $this->updatePostHistories($postHistory, 'https://www.facebook.com/'.$result['id']);
      echo "\n\t\t Posted on facebook => ".$result['id'];
    }else{
      echo "\n\t\t Unable to post on facebook";
    }
  }

  public function manageLinkedIn($postHistory){
    $media = '';
    $result = null;
    // $media = env('BACKEND_URL').'/storage/image/2_2021-08-03_02_00_17_robot.png';
    if($postHistory['url']) {
      $url = $postHistory['url'];
      $media = json_decode($url)[0];
    }
    $postHistory['url'] = null;
    if($postHistory['url']) {
      $result = app('App\Http\Controllers\SocialMediaController')->linkedinRegisterUpload($postHistory['account_id'], $postHistory['description'], substr($media, 15));
    }else {
      $result = app('App\Http\Controllers\SocialMediaController')->linkedinPost($postHistory['account_id'], $postHistory['description']);
    }
   
    print_r($result); 
    if($result && isset($result['id'])){
      $this->updatePostHistories($postHistory, 'https://www.linkedin.com/embed/feed/update/'.$result['id']);
      echo "\n\t\t Posted on linkedin => ".$result['id'];
    }else{
      echo "\n\t\t Unable to post on linkedin";
    }
  }

  public function manageGoogle($postHistory){
    $media = [];
    $result = null;
    if(isset($postHistory['url'])) {
      if(json_decode($postHistory['url'])) {
        $url = $postHistory['url'];
        $media = json_decode($url);
        $media = env('BACKEND_URL', ''). $media[0];
      }
    }
    if($postHistory['url']) {
      $result = app('App\Http\Controllers\SocialMediaController')->googleBusinessPostWithMedia($postHistory['account_id'], $postHistory['description'], $media);
    }
    echo "\n\t\t\t Manage GOOGLE => ".json_encode($result);
  }

  public function updatePostHistories($postHistory, $link){
    PostHistory::where('id', '=', $postHistory['id'])->update(array(
      'status' => 'posted',
      'link'   => $link,
      'updated_at' => Carbon::now()
    ));
  }
}
