<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Plan;
use App\PaymentMethod;
use App\Billing;
use Carbon\Carbon;
class PlanController extends APIController
{
  function __construct(){
    $this->model = new Plan();
    $this->notRequired = array(
      'code', 'end_date'
    );
  }

  public function retrieve(Request $request) {
    $data = $request->all();
    $result = Plan::where('account_id', '=', $data['condition'][0]['value'])
    ->where(function($e) {
      $e->whereDate('end_date', '>', Carbon::now())
      ->orWhere('end_date', '=', null);
    })
    ->get();
    $this->response['data'] = $result;
    return $this->response();
  }

  public function cancelPlan(Request $request){
    $data = $request->all();
    $billing = Billing::where('details', 'like', '%"plan_id":'.$data['id'].'}%')->orderBy('created_at', 'desc')->limit(1)->get();
    if(sizeof($billing) > 0){
      $endDate = $billing[0]['end_date'];

      Plan::where('id', '=', $data['id'])->update(array(
        'updated_at' => Carbon::now(),
        'end_date'   => $endDate
      ));

      $this->response['data'] = $data['id'];
    }
    return $this->response();
  }



  public function retrieveWithPaymentsAndHistory(Request $request) {
    $data = $request->all();
    $this->model = new Plan();
    $this->retrieveDB($data);
    $plan = $this->response['data'] ? $this->response['data'][0] : null;


    $this->model = new PaymentMethod();
    $this->retrieveDB($data);
    $paymentMethod = $this->response['data'] ? $this->response['data'][0] : null;

    $this->response['data'] = array(
      'plan' => $plan,
      'payment_method' => $paymentMethod
    );

    return $this->response();
  }

  public function create(Request $request){
    $data = $request->all();
    $data['code'] = $this->generateCode();
    if($this->checkIfExist($data) == false){
			$this->model = new Plan();
      $data['start_date'] = Carbon::now();
      $data['end_date'] = null;
	    $this->insertDB($data);
	    return $this->response();    	
    }else{
    	$this->response['data'] = null;
    	$this->response['error'] = 'Plan already existed';
    	return $this->response();
    }
  }

  public function createByParams($data){
    $data['code'] = $this->generateCode();
    if($this->checkIfExist($data) == false){
      $this->model = new Plan();
      $data['start_date'] = Carbon::now();
      $data['end_date'] = null;
      $this->insertDB($data);
      return $this->response['data'];     
    }else{
      return null;
    }
  }

  public function update(Request $request){
    $data = $request->all();
    $result = Plan::where('merchant_id', '=', $data['merchant_id'])
    ->where(function($e) {
      $e->whereDate('end_date', '>', Carbon::now())
      ->orWhere('end_date', '=', null);
    })
    ->orderBy('start_date', 'ASC')
    ->get();

    $end_date = Carbon::now()->subDays(Carbon::now()->day - Carbon::parse($result[0]->created_at)->day)->addMonths(1);
    if($result !== null){
      unset($data['id']);
      $data['code'] = $this->generateCode();
      $data['start_date'] = $end_date;
      $data['end_date'] = null;
      $this->model = new Plan();
      $update = $this->insertDB($data);
      
      Plan::where('id', '=', $result[0]['id'])
      ->update(array('end_date' => $end_date));

      Plan::where([
        ['id', '>', $result[0]['id']],
        ['id', '<=', $result[sizeof($result) - 1]['id']]
      ])
      ->update(array('deleted_at' => Carbon::now()));

      if($update !== null){
        $this->response['data'] = 1;
      }else{
        $this->response['data'] = null;
      }
    }
    return $this->response();
  }

  public function checkIfExist($data){
  	$result = Plan::where('account_id', '=', $data['account_id'])->get();
  	return sizeof($result) > 0 ? true : false;
  }

  public function generateCode(){
    $code = 'pla_'.substr(str_shuffle($this->codeSource), 0, 60);
    $codeExist = Plan::where('code', '=', $code)->get();
    if(sizeof($codeExist) > 0){
      $this->generateCode();
    }else{
      return $code;
    }
  }
  public function getByParams($column, $value){
    $result = Plan::where($column, '=', $value)->orderBy('created_at', 'desc')->get();
    return sizeof($result) > 0 ? $result[0] : null;
  }
}
