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
        switch(strtolower($postHistory['channel'])){
          case 'facebook':
            $this->manageFacebook($postHistory);
            break;
          case 'linkedin':
            $this->manageLinkedIn($postHistory);
            break;
          case 'google_my_business':
            $this->manageGoogle($postHistory);
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

    if($page == null){
        return false;
    }

    $token = $page['details']['access_token'];
    if(isset($postHistory['url'])) {
      if(json_decode($postHistory['url'])) {
        $url = $postHistory['url'];
        $media = json_decode($url);
        $media = env('BACKEND_URL', ''). $media[0];
      }
    }

    $url = $page['page'].'/feed';
    $params = array(
      "message" => $postHistory['description'],
      "access_token" => $token
    );

    // if($postHistory['url']){
    //   $urls = json_decode($postHistory['url'], true);
    //   echo print_r($urls);
    // }else{

    // }

    app($this->facebookController)->publishContent($url, $params, $token);

    // if($postHistory['url']) {
    //   $result = app('App\Http\Controllers\SocialMediaController')->facebookPostTextOnly($postHistory['description'], $postHistory['account_id']);
    //   $result = app('App\Http\Controllers\SocialMediaController')->facebookPostWithMedia($postHistory['description'], $media, $postHistory['account_id']);
    //   print_r($result);
    //   $this->updatePostHistories($postHistory);
    // }else {
    //   $result = app('App\Http\Controllers\SocialMediaController')->facebookPostTextOnly($postHistory['description'], $postHistory['account_id']);
    //   $this->updatePostHistories($postHistory);
    // }
    echo "\n\t\t\t Manage facebook => ".json_encode($result);
  }

  public function manageLinkedIn($postHistory){
    $media = '';
    $result = null;
    if($postHistory['url']) {
      $url = $postHistory['url'];
      $media = json_decode($url)[0];
    }
    if($postHistory['url']) {
      $result = app('App\Http\Controllers\SocialMediaController')->linkedinRegisterUpload($postHistory['account_id'], $postHistory['description'], substr($media, 15));
    }else {
      $result = app('App\Http\Controllers\SocialMediaController')->linkedinPost($postHistory['account_id'], $postHistory['description']);
    }
    // echo "\n\t\t\t Manage Linkedin => ".json_encode($result);
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

  public function updatePostHistories($postHistory){
    PostHistory::where('id', '=', $postHistory['id'])->update(array(
      'status' => 'posted',
      'updated_at' => Carbon::now()
    ));
  }
}
