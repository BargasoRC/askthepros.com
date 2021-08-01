<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Carbon\Carbon;
class PageController extends APIController
{
  function __construct(){
    $this->model = new Page();
  }

  public function create(Request $request){
    $data = $request->all();
    
    // delete all previous
    Page::where('account_id', '=', $data['account_id'])->where('type', '=', $data['type'])->update(array(
      'deleted_at' => Carbon::now()
    ));

    $data['code'] = $this->generateCode();
    $this->model = new Page();
    $this->insertDB($data);
    return $this->response();
  }

  public function generateCode(){
    $code = 'pge_'.substr(str_shuffle($this->codeSource), 0, 60);
    $codeExist = Page::where('code', '=', $code)->get();
    if(sizeof($codeExist) > 0){
      $this->generateCode();
    }else{
      return $code;
    }
  }

  public function getActiveByParams($accountId, $type){
    $result = Page::where('account_id', '=', $accountId)->where('type', '=', $type)->get();
    if($result && sizeof($result) > 0){
      $result[0]['details'] = json_decode($result[0]['details'], true);
    }
    return sizeof($result) > 0 ? $result[0] : null;
  }

}
