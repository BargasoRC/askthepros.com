<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocialAuths;

class SocialAuthController extends APIController
{
  

  public $pageController = 'App\Http\Controllers\PageController';

  function __construct(){
    $this->model = new SocialAuths();
  }

  public function retrieve(Request $request){
    $data = $request->all();

    $this->model = new SocialAuths();
    $this->retrieveDB($data);

    $auths = $this->response['data'];
    if($auths && sizeof($auths) > 0){
      $i = 0;
      foreach ($auths as $key => $auth) {
        $auths[$i]['page'] = app($this->pageController)->getActiveByParams($auth['account_id'], $auth['type']);
      }
    }

    $this->response['data'] = $auths;
    return $this->response();
  }
}
