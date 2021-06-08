<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Increment\Account\Models\Account;

class SocialController extends APIController
{
    //
    public function redirect($provider)
    {
        $result = Socialite::with($provider)->redirect()->getTargetUrl();
        $this->response['data'] = array('url' => $result);
        return $this->response();
    }

    public function Callback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $acc = Account::firstOrNew(['email' => $user->getEmail()]);
        if($acc->new){
          $acc->token = $user->token;
        }else {
            $acc->code = $this->generateCode();
            $acc->username = $user->getEmail();
            $acc->email = $user->getEmail();
            $acc->account_type = 'USER';
            $acc->status = 'NOT_VERIFIED';
            $acc->token = $user->token;
        }
        $acc->save();
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
