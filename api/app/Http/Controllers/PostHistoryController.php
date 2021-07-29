<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostHistory;
use App\Post;

class PostHistoryController extends APIController
{
  
  
  function __construct(){
    $this->model = new PostHistory();
    
    $this->notRequired = array(
      'link', 'channel'
    );
  }
  public $postClass = 'App\Http\Controllers\PostController';
  
  public function createByParams($data){
    $data['code'] = $this->generateCode();
    $this->model = new PostHistory();
    $this->insertDB($data);
    return $this->response['data'];     
  }

  public function generateCode(){
    $code = 'phi_'.substr(str_shuffle($this->codeSource), 0, 60);
    $codeExist = PostHistory::where('code', '=', $code)->get();
    if(sizeof($codeExist) > 0){
      $this->generateCode();
    }else{
      return $code;
    }
  }

  public function retrieveByCodes(Request $request){
    $data = $request->all();
    $result = PostHistory::where('code', '=', $data['code'])->get();
    $i = 0;
    foreach ($result as $key) {
      $result[$i]['post'] = app($this->postClass)->retrieveByCodeParams($result[$i]['post_id']);
      $i++;
    }

    $this->response['data'] = $result;
    return $this->response();
  }

}
