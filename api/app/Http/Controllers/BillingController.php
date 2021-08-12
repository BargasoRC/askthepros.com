<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Billing;
use App\PaymentMethod;
use App\Plan;
use Carbon\Carbon;
class BillingController extends APIController
{
  function __construct(){
    $this->model = new Billing();
  }

  public function retrieve(Request $request){
    $data = $request->all();
    $this->model = new Billing();
    $this->retrieveDB($data);
    $con = $data['condition'];
    $result = Billing::where($con[0]['column'], $con[0]['clause'], $con[0]['value'])->limit($data['limit'])
      ->offset($data['offset'])->orderBy(array_keys($data['sort'])[0], array_values($data['sort'])[0])->get();

    if(sizeof($result) > 0){
      $i = 0;
      foreach ($result as $key => $value) {
        $result[$i]['account'] = $this->retrieveAccountOnly($value['account_id']);
        $result[$i]['plan'] =  app('App\Http\Controllers\PlanController')->getByParams('account_id', $value['account_id']);
        $result[$i]['method'] = 'STRIPE';
        $result[$i]['invoice'] = '00-11';
        $i++;
      }
    }
    $this->response['data'] = $result;
    $this->response['size'] = Billing::where('deleted_at', '=', null)->count();
    return $this->response();
  }

  public function retrieveOnHistory(Request $request){
    $data = $request->all();
    $this->model = new Billing();
    $this->retrieveDB($data);
    $con = $data['condition'];
    $billing = Billing::where($con[0]['column'], $con[0]['clause'], $con[0]['value'])->limit(isset($data['limit']) ? $data['limit'] : 1)
      ->offset((isset($data['offset']) ? $data['offset'] : 1))->orderBy(array_keys($data['sort'])[0], array_values($data['sort'])[0])->get();

    $i = 0;
    foreach ($billing as $key => $value) {
      $details = json_decode($value['details'], true);
      $paymentMethodTemp = PaymentMethod::where('id', '=', $details['payment_method_id'])->get();
      $plan = Plan::where('id', '=', $details['plan_id'])->get();
      $method = sizeof($paymentMethodTemp) > 0 ? $paymentMethodTemp[0] : null;
      $method['details'] = json_decode($method['details'], true);
      $billing[$i]['payment_method'] = $method;
      $billing[$i]['account'] = $this->retrieveAccountOnly($value['account_id']);
      $billing[$i]['plan'] = sizeof($plan) > 0 ? $plan[0] : null;
      $result[$i]['invoice'] = '00-11';
      $i++;
    }

    $this->response['data'] = $billing;
    $this->response['size'] = Billing::where('deleted_at', '=', null)->count();
    return $this->response();
  }

  public function getRecentBilling($column, $value){
    $result = Billing::where($column, '=', $value)->orderBy('end_date', 'desc')->get();
    return sizeof($result) > 0 ? $result[0] : null;
  }

  public function addToBilling($data){
    $this->model = new Billing();
    $data['code'] = $this->generateCode();
    $res = $this->insertDB($data);
    return $res;
  }

  public function generateCode(){
    $code = 'bil_'.substr(str_shuffle($this->codeSource), 0, 60);
    $codeExist = Billing::where('code', '=', $code)->get();
    if(sizeof($codeExist) > 0){
      $this->generateCode();
    }else{
      return $code;
    }
  }

  public function updateStatus($status, $id){
    $res = Billing::where('id', '=', $id)->update(array(
      'status' => $status
    ));
    return $res;
  }
}
