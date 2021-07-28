<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\PostHistory;

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

    $posts = PostHistory::where('status', '=', 'for posting')->get();

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
    echo "\n\t\t\t Manage Facebook => ".$postHistory['post_id'];
  }

  public function manageLinkedIn(){

  }

  public function manageGoogle(){

  }
}
