<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\APIController;
use App\Branding;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Increment\Account\Models\Account;
use Increment\Account\Models\AccountInformation;
use Increment\Account\Models\BillingInformation;
use Increment\Imarket\Merchant\Models\Merchant;
use Increment\Common\Payload\Models\Payload;
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
            "username" => "unique:accounts",
        );
        $this->notRequired = array(
            'token',
        );
    }

    public function create(Request $request)
    {
        /**
         * Initially removed the email verification, to successfully register and create INDUSTRY
         */
        \DB::beginTransaction();
        try {
            $request = $request->all();
            // $referralCode = $request['referral_code'];
            // $invitationPassword = $request['password'];
            if($request['id'] > 0){
                // $account = new Account();
                // $account->code = $this->generateCode($account);
                // $account->password = Hash::make($request['password']);
                // $account->status = 'NOT_VERIFIED';
                // $account->email = $request['email'];
                // $account->username = $request['username'];
                // $account->account_type = $request['account_type'];
                // $account->created_at = Carbon::now();
                // $account->save();

                $info = new AccountInformation();
                $info->account_id = $request['id'];
                $info->first_name = $request['first_name'];
                $info->last_name = $request['last_name'];
                $info->address = $request['address'];
                $info->save();
                
                $branding = new Branding();
                $branding->account_id = $request['id'];
                $branding->code = $this->generateBrandingCode();
                $branding->details = $request['details'];
                $branding->save();

                $merchant = new Merchant();
                $merchant->account_id = $request['id'];
                $merchant->code = $this->generateCode($merchant);
                $merchant->name = $request['business_name'];
                $merchant->addition_informations = $request['industry'];
                $merchant->save();
                if($request['id'] > 0){
                    Payload::insert(array(
                        'account_id' => $request['id'],
                        'payload'   => 'automation_settings',
                        'payload_value' => 'OFF',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ));
                    app('App\Http\Controllers\EmailController')->verification($request['id']);
                }
    
    
                \DB::commit();
                $this->response['data'] = array('message' => 'account_successfully_created', 'data' => $request['id']);
                $this->response['error'] = null;
            }else{
                $this->response['data'] = null;
                $this->response['error'] = array('message' => 'Email or Username already exist. Please Try Again.');
            }

        } catch (\Exception $e) {
            \DB::rollback();
            $this->response['data'] = null;
            $this->response['error'] = $e->getMessage();
            $this->response['error_status'] = $e->getCode();
        }
        return $this->response();
    }

    public function validateEmail($email){
        $text = array('email' => $email);
        if($this->customValidate($text) == true){
            return true;
        }else{
            return false;
        }
    }

    public function customValidate($text){
        $validation = array('email' => 'required|email|unique:accounts');
        return $this->validateReply($text, $validation);
    }
    
    public function validateReply($text, $validation){
        $validator = Validator::make($text, $validation);
        if($validator->fails()){
          return false;
        }
        else
          return true;
    }
    // public function validateUsername($username){
    //     $text = array('username' => $username);
    //     if($this->customValidateUsername($text) == true){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }

    // public function customValidateUsername($text){
    //     $validation = array('username' => 'required|username|unique:accounts');
    //     return $this->validateReplyUsername($text, $validation);
    // }
    
    // public function validateReplyUsername($text, $validation){
    //     $validator = Validator::make($text, $validation);
    //     if($validator->fails()){
    //       return false;
    //     }
    //     else
    //       return true;
    // }

    public function createDetails($accountId, $type)
    {
        $info = new AccountInformation();
        $info->account_id = $accountId;
        $info->created_at = Carbon::now();
        $info->save();

        $billing = new BillingInformation();
        $billing->account_id = $accountId;
        $billing->created_at = Carbon::now();
        $billing->save();
        if (env('NOTIFICATION_SETTING_FLAG') == true) {
            app('App\Http\Controllers\NotificationSettingController')->insert($accountId);
        }
    }

    public function generateCode($db){
      $code = 'acc_' . substr(str_shuffle($this->codeSource), 0, 60);
      $codeExist = $db::where('code', '=', $code)->get();
      if(sizeof($codeExist) > 0){
        $this->generateCode();
      }else{
        return $code;
      }
    }

    public function generateBrandingCode(){
        $code = 'brn_'.substr(str_shuffle($this->codeSource), 0, 60);
        $codeExist = Branding::where('code', '=', $code)->get();
        if(sizeof($codeExist) > 0){
          $this->generateBrandingCode();
        }else{
          return $code;
        }
      }
}
