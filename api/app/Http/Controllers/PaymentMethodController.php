<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentMethod;
class PaymentMethodController extends APIController
{
  function __construct(){
    $this->model = new PaymentMethod();
  }

  public function createByParams($data){
    $data['code'] = $this->generateCode();
    $this->insertDB($data);
    return $this->response['data'];
  }

  public function generateCode(){
    $code = 'pay_'.substr(str_shuffle($this->codeSource), 0, 60);
    $codeExist = PaymentMethod::where('code', '=', $code)->get();
    if(sizeof($codeExist) > 0){
      $this->generateCode();
    }else{
      return $code;
    }
  }
}
