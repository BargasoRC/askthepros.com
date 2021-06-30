<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branding;
use Carbon\Carbon;

class BrandingController extends Controller
{
  function __construct(){
    $this->model = new Branding();
  }

  public function create(Request $request){
    $data = $request->all();
    $data['code'] = $this->generateCode();
    if($this->checkIfExist($data) == false){
      $this->model = new Branding();
      $this->insertDB($data);
      return $this->response();       
    }else{
      $this->response['data'] = null;
      $this->response['error'] = 'Branding already existed';
      return $this->response();
    }
  }

  public function checkIfExist($data){
    $result = Branding::where('account_id', '=', $data['account_id'])->get();
    return sizeof($result) > 0 ? true : false;
  }

  public function generateCode(){
    $code = 'brn_'.substr(str_shuffle($this->codeSource), 0, 60);
    $codeExist = Branding::where('code', '=', $code)->get();
    if(sizeof($codeExist) > 0){
      $this->generateCode();
    }else{
      return $code;
    }
  }
}
