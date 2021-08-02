<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\ResetPassword;
use App\Mail\Verification;
use App\Mail\ChangedPassword;
use App\Mail\Referral;
use App\Mail\LoginEmail;
use App\Mail\OtpEmail;
use App\Mail\NotifyReferrer;
use App\Mail\Receipt;
use App\Mail\NewMessage;
use App\Mail\Ledger;
use App\Mail\Deposit;
use Illuminate\Http\Request;

class EmailController extends APIController
{

    public $timezone = 'Asia/Manila';

    function __construct(){
        $this->localization();
        $this->timezone = $this->response['timezone'];
    }

    public function resetPassword($id){
    	$user = $this->retrieveAccountDetails($id);
    	if($user != null){
    		Mail::to($user['email'])->send(new ResetPassword($user, $this->response['timezone']));
    		return true;
    	}
    	return false;
    }

    public function verification($id){
        $user = $this->retrieveAccountDetails($id);
        if($user != null){
            Mail::to($user['email'])->send(new Verification($user, $this->response['timezone']));
            return true;
        }
        return false;
    }

    public function loginInvitation($id, $password){
    }

    public function changedPassword($id){
        $user = $this->retrieveAccountDetails($id);
        if($user != null){
            Mail::to($user['email'])->send(new ChangedPassword($user, $this->response['timezone']));
            return true;
        }
        return false;
    }

    public function loginEmail($id){
        $user = $this->retrieveAccountDetails($id);
        if($user != null){
            Mail::to($user['email'])->send(new LoginEmail($user, $this->response['timezone']));
            return true;
        }
        return false;
    }

    public function notifyReferrer($id){
        $user = $this->retrieveAccountDetails($id);
        if($user != null){
            Mail::to($user['email'])->send(new NotifyReferrer($user, $this->response['timezone']));
            return true;
        }
        return false;
    }


    public function invitation($user, $data){
        return Mail::to($data['to_email'])->send(new Referral($user, $data['content'], $data['to_email'], $this->response['timezone']));
    }

    public function receipt($accountId, $data){
        $user = $this->retrieveAccountDetails($accountId);
        if($user != null && sizeof($data) > 0){
            Mail::to($user['email'])->send(new Receipt($user, $data[0], $this->response['timezone']));
            return true;
        }
        return false;
    }


    public function trial(Request $request){
        $data = $request->all();
        $user = $this->retrieveAccountDetails($data['account_id']);
        if($user != null){
            Mail::to($user['email'])->send(new LoginEmail($user, $this->response['timezone']));
            $this->response['data'] = true;
        }
        return $this->response();
    }

}