<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\PostHistory;
use App\Post;

class Channel implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
          case 'google':
            $this->manageGoogle($postHistory);
        }
      }
    }else{
      echo "\n\t\t[CHANNEL] No post available for posting.";
    }
  }

  public function manageFacebook($postHistory){
    echo "\n\t\t\t Manage Facebook => ".$postHistory;
    $media = '';
    $result = null;
    if($postHistory['url']) {
      $url = $postHistory['url'];
      // $media = json_decode($url)[0];
      $media = 'http://127.0.0.1:8000/increment/v1'. json_decode($url)[0];
    }
    echo "\n\t\t\t media... ".$postHistory['post_id'];
    if($postHistory['url']) {
      echo "\n\t\t\t with media... ";
      $result = app('App\Http\Controllers\SocialMediaController')->facebookPostWithMedia($postHistory['description'], $media, $postHistory['account_id']);
    }else {
      echo "\n\t\t\t without media... ";
      $result = app('App\Http\Controllers\SocialMediaController')->facebookPostTextOnly($postHistory['description'], $postHistory['account_id']);
    }
    echo "\n\t\t\t Manage facebook => ".json_encode($result);
  }

  public function manageLinkedIn($postHistory){
    // echo "\n\t\t\t Manage Linkedin => ".$postHistory;
    $media = '';
    $result = null;
    if($postHistory['url']) {
      $url = $postHistory['url'];
      $media = json_decode($url)[0];
    }
    echo "\n\t\t\t media... ".$postHistory['post_id'];
    if($postHistory['url']) {
      echo "\n\t\t\t with media... ";
      $result = app('App\Http\Controllers\SocialMediaController')->linkedinRegisterUpload($postHistory['account_id'], $postHistory['description'], substr($media, 15));
    }else {      
      echo "\n\t\t\t without media... ";
      $result = app('App\Http\Controllers\SocialMediaController')->linkedinPost($postHistory['account_id'], $postHistory['description']);
    }
    echo "\n\t\t\t Manage Linkedin => ".json_encode($result);
  }

  public function manageGoogle(){

  }
}
