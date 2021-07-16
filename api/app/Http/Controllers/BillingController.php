<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Billing;
use App\SMS;
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

    $result = $this->response['data'];

    if(sizeof($result) > 0){
      $i = 0;
      foreach ($result as $key => $value) {
        $result[$i]['account'] = $this->retrieveAccountOnly($value['account_id']);
        $result[$i]['plan'] =  app('App\Http\Controllers\PlanController')->getByParams('account_id', $value['account_id']);
        $i++;
      }
    }
    $this->response['data'] = $result;
    return $this->response();
  }

  public function getRecentBilling($column, $value){
    $result = Billing::where($column, '=', $value)->orderBy('end_date', 'desc')->get();
    return sizeof($result) > 0 ? $result[0] : null;
  }

  public function addToBilling($data){
    $this->model = new Billing();
    $res = $this->insertDB($data);
    return $res;
  }

  public function updateStatus($status, $id){
    $res = Billing::where('id', '=', $id)->update(array(
      'status' => $status
    ));
    return $res;
  }
}
