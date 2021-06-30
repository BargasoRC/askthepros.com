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

  public function getByParams($column, $value){
    $billing = Billing::where($column, '=', $value['id'])->where('deleted_at', '=', null)->get(['amount', 'start_date', 'end_date', 'details', 'status as billing_status']);
    $account_information = app('Increment\Account\Http\AccountInformationController')->getByParamsWithColumns($value['account_id'], ['first_name', 'last_name', 'cellular_number']);
    $result = array();
    if(sizeof($billing) > 0){
      $i=0;
      foreach ($billing as $key) {
        $sms = SMS::where($column, '=', $value['id'])->where('price', '!=', null)->whereDate('created_at', '>=', $billing[$i]['end_date'])->groupBy('merchant_id')->select(DB::raw('SUM(price) as total_price'), 'currency', 'merchant_id', 'created_at')->orderBy('created_at', 'asc')->get();
        if(sizeof($sms) > 0){
          $j = 0;
          foreach ($sms as $key) {
           array_push($result, array(
             'total_price' => $sms[$j]['total_price'],
             'currency' => $sms[$j]['currency'],
             'start_date' => Carbon::createFromFormat('Y-m-d H:i:s',  $sms[$j]['created_at'])->format('Y-m-d'),
             'end_date' => Carbon::createFromFormat('Y-m-d H:i:s',  $sms[$j]['created_at'])->format('Y-m-d'),
             'merchant_id' => $sms[$j]['merchant_id']
           ));
           $j++;
          }
        }
        $i++;
      }
    }else{
      $sms = SMS::where($column, '=', $value['id'])->where('price', '!=', null)->groupBy('merchant_id')->select(DB::raw('SUM(price) as total_price'), 'currency', 'merchant_id', 'created_at')->orderBy('created_at', 'asc')->get();
      if(sizeof($sms) > 0){
        $j = 0;
        foreach ($sms as $key) {
         array_push($result, array(
           'total_price' => $sms[$j]['total_price'],
           'currency' => $sms[$j]['currency'],
           'start_date' => Carbon::createFromFormat('Y-m-d H:i:s',  $sms[$j]['created_at'])->format('Y-m-d'),
           'merchant_id' => $sms[$j]['merchant_id']
         ));
         $j++;
        }
      }
    }
    return $result;
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
