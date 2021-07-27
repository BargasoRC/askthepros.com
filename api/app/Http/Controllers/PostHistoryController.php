<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostHistory;

class PostHistoryController extends APIController
{
  function __construct(){
    $this->model = new PostHistory();

    $this->notRequired = array(
      'link', 'channel'
    );
  }

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

}
