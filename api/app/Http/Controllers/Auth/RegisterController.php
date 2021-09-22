<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\APIController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Increment\Account\Models\Account;
use Increment\Account\Models\AccountInformation;
use Increment\Account\Models\BillingInformation;
use Increment\Imarket\Merchant\Models\Merchant;
use Increment\Common\Payload\Models\Payload;

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
            $referralCode = $request['referral_code'];
            $invitationPassword = $request['password'];

            $account = new Account();
            $account->code = $this->generateCode($account);
            $account->password = Hash::make($request['password']);
            $account->status = 'NOT_VERIFIED';
            $account->email = $request['email'];
            $account->username = $request['username'];
            $account->account_type = $request['account_type'];
            $account->created_at = Carbon::now();
            $account->save();

            $merchant = new Merchant();
            $merchant->account_id = $account->id;
            $merchant->code = $this->generateCode($merchant);
            $merchant->email = $account->email;
            $merchant->addition_informations = $request['industry'];
            $merchant->save();

            if($account && $account->id){
                Payload::insert(array(
                    'account_id' => $account->id,
                    'payload'   => 'automation_settings',
                    'payload_value' => 'OFF',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ));
                app('App\Http\Controllers\EmailController')->verification($account->id);
            }


            \DB::commit();
            $this->response['data'] = array('message' => 'account_successfully_created', 'data' => $account->id);
            $this->response['error'] = null;
        } catch (\Exception $e) {
            \DB::rollback();
            $this->response['data'] = null;
            $this->response['error'] = $e->getMessage();
            $this->response['error_status'] = $e->getCode();
        }
        return $this->response();
    }

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
}
