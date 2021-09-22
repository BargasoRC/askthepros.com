<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\ResetPassword;
use App\Mail\Verification;
use App\Mail\ChangedPassword;
use App\Mail\LoginEmail;
use App\Mail\ContactUs;
use App\Mail\OtpEmail;
use App\Mail\Receipt;
use App\Mail\Billing;
use App\Mail\SetupSNS;
use App\Mail\NewMessage;
use App\Mail\VerificationStatus;
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
    	if($user != null && $user['status'] !== 'INVALID_EMAIL'){
    		Mail::to($user['email'])->send(new ResetPassword($user, $this->response['timezone']));
    		return true;
    	}
    	return false;
    }

    public function verification($id){
        $user = $this->retrieveAccountDetails($id);
        if($user != null){
            Mail::to('herreracherrymae@gmail.com')->send(new Verification($user, $this->response['timezone']));
            return true;
        }
        return false;
    }

    public function loginInvitation($id, $password){
    }

    public function changedPassword($id){
        $user = $this->retrieveAccountDetails($id);
        if($user != null && $user['status'] !== 'INVALID_EMAIL'){
            Mail::to($user['email'])->send(new ChangedPassword($user, $this->response['timezone']));
            return true;
        }
        return false;
    }

    public function loginEmail($id){
        $user = $this->retrieveAccountDetails($id);
        if($user != null && $user['status'] !== 'INVALID_EMAIL'){
            Mail::to($user['email'])->send(new LoginEmail($user, $this->response['timezone']));
            return true;
        }
        return false;
    }

    public function invitation($user, $data){
        return Mail::to($data['to_email'])->send(new Referral($user, $data['content'], $data['to_email'], $this->response['timezone']));
    }

    public function receipt($accountId, $data){
        $user = $this->retrieveAccountDetails($accountId);
        if($user != null && $data !== null && $user['status'] !== 'INVALID_EMAIL'){
            Mail::to($user['email'])->send(new Receipt($user, $data, $this->response['timezone']));
            return true;
        }
        return false;
    }

    public function setupSNS($data){
        $this->localization();
        Mail::to("kennettecanales@gmail.com")->send(new SetupSNS($data, $this->response['timezone']));
        return true;
    }

    public function billing($accountId, $data){
        $user = $this->retrieveAccountDetails($accountId);
        if($user != null && $data != null && $user['status'] !== 'INVALID_EMAIL'){
            Mail::to($user['email'])->send(new Billing($user, $data, $this->response['timezone']));
            return true;
        }
        return false;
    }


    public function trial(Request $request){
        $data = $request->all();
        $user = $this->retrieveAccountDetails($data['account_id']);
        if($user != null && $user['status'] !== 'INVALID_EMAIL'){
            Mail::to($user['email'])->send(new LoginEmail($user, $this->response['timezone']));
            $this->response['data'] = true;
        }
        return $this->response();
    }


    public function sendMessage(Request $request){
        $data = $request->all();
        $subject = $data['subject'];
        $content = $data['content'];
        Mail::to(env('COMPANY_EMAIL'))->send(new ContactUs($data, $this->response['timezone'], $subject, $content));
        $this->response['data'] = true;
        return $this->response();
    }

    public function verification_status($accountId, $details){
        $user = $this->retrieveAccountDetails($accountId);
        if($user != null && $user['status'] != 'NOT_VERIFIED'){
            Mail::to($user['email'])->send(new VerificationStatus($user, $details, $this->response['timezone']));
            return true;
        }
        return false;
    }

}