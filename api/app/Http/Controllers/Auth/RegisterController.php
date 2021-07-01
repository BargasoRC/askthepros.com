<?php

namespace App\Http\Controllers\Auth;

use Increment\Account\Models\Account;
use Increment\Account\Models\AccountInformation;
use Increment\Account\Models\BillingInformation;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends APIController
{
  /**
   * Created this controller so that the type INDUSTRY of the user will be created
   */
  public function __construct()
  {
    $this->model = new Account();
    $this->validation = array(  
      "email" => "unique:accounts",
      "username"  => "unique:accounts"
    );
    $this->notRequired = array(
      'token'
    );
  }

  public function create(Request $request){
    /**
     * Initially removed the email verification, to successfully register and create INDUSTRY
     */
    $request = $request->all();
    $referralCode = $request['referral_code'];
    $invitationPassword = $request['password'];
    $dataAccount = array(
      'code'  => $this->generateCode(),
      'password'        => Hash::make($request['password']),
      'status'          => 'NOT_VERIFIED',
      'email'           => $request['email'],
      'username'        => $request['username'],
      'account_type'    => $request['account_type'],
      'created_at'      => Carbon::now()
    );
    $this->model = new Account();
    $this->insertDB($dataAccount, true);
    
    return $this->response();
  }

  public function createDetails($accountId, $type){
    $info = new AccountInformation();
    $info->account_id = $accountId;
    $info->created_at = Carbon::now();
    $info->save();

    $billing = new BillingInformation();
    $billing->account_id = $accountId;
    $billing->created_at = Carbon::now();
    $billing->save();
    if(env('NOTIFICATION_SETTING_FLAG') == true){
      app('App\Http\Controllers\NotificationSettingController')->insert($accountId);
    }
  }

  public function generateCode(){
    $code = 'acc_'.substr(str_shuffle($this->codeSource), 0, 60);
    $codeExist = Account::where('code', '=', $code)->get();
    if(sizeof($codeExist) > 0){
      $this->generateCode();
    }else{
      return $code;
    }
  }
}
