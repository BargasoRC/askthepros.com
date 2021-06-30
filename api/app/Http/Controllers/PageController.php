<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Carbon\Carbon;
class PageController extends Controller
{
  function __construct(){
    $this->model = new Page();
  }

  public function create(Request $request){
    $data = $request->all();
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
}
