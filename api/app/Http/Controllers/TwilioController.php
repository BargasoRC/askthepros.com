<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioController extends APIController
{

	public $authToken = null;
	public $accountID = null;
  public $callBackUrl = null;
  public $client = null;
  public $sender = null;

  public $smsController = 'App\Http\Controllers\SMSHandlerController';

  function __construct(){
    $this->localization();
    $this->timezone = $this->response['timezone'];
    $this->init();
  }

  public function init(){
    $this->accountID = env("TWILIO_SID");
    $this->authToken = env("TWILIO_AUTH_TOKEN");
    $this->sender = env("TWILIO_NUMBER");
    $this->callBackUrl = env('TWILIO_CALLBACK_URL');
    if($this->accountID == null || $this->authToken == null || $this->callBackUrl == null){
      echo 'connected';
      $this->client = new Client($this->accountID, $this->authToken);  
    }
  }


  public function createSubAccount($email){
    $sid = env("TWILIO_SID");
    $token = env("TWILIO_AUTH_TOKEN");
    $twilio = new Client($sid, $token);
    return $twilio->api->v2010->accounts->create(["friendlyName" => $email]);
  }

  public function findSubAccount($email){
    $sid = env("TWILIO_SID");
    $token = env("TWILIO_AUTH_TOKEN");
    $twilio = new Client($sid, $token);
    $accounts =  $twilio->api->v2010->accounts->read(["friendlyName" => $email], 20);
    foreach ($accounts as $key => $value) {
      return $value->sid;
    }
    return false;
  }

  public function getBillingSubAccount($sId, $startDate){
    $sid = env("TWILIO_SID");
    $token = env("TWILIO_AUTH_TOKEN");
    $twilio = new Client($sid, $token, $sId);
    $calls = $twilio->calls->read(["startTime" => $startDate], 20);

    $price = 0;

    foreach ($calls as $key => $value) {
      $price += $value->price;
    }
    
    return array(
      'total' => $price,
      'sms'   => sizeof($calls),
      'date'  => $startDate
    );
  }

  public function transferPhoneNumber($newSId){
    $sid = env("TWILIO_SID");
    $token = env("TWILIO_AUTH_TOKEN");
    $sender = env("TWILIO_NUMBER");
    $twilio = new Client($sid, $token);

    $data = array(
      'AccountSid' => $newSId
    );
    $headers[] = 'ACCOUNT_SID:' . $token;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    curl_close($ch);

    return print_r($result);
  }

  public function fetch($mId){
    $sid = env("TWILIO_SID");
    $token = env("TWILIO_AUTH_TOKEN");
    $twilio = new Client($sid, $token);
    $message = $twilio->messages($mId)->fetch();
    return $message;
  }

  public function send(Request $request){
    $data = $request->all();
    $exist = app('App\Http\Controllers\SmsController')->getByParams($data);
    if($exist){
      $this->response['error'] = 'Already Existed';
      $this->response['data'] = null;
      return $this->response();
    }
    if($this->client){
      $this->response['data'] = $this->client->messages->create($data['receiver'], ['from' => $this->sender, 'body' => $data['message'], 'statusCallback' => $this->callBackUrl]);  
    }
  	return $this->response();
  }

  public function sendFromRequest($data){
    $accountID = env("TWILIO_SID");
    $authToken = env("TWILIO_AUTH_TOKEN");
    $sender = env("TWILIO_NUMBER");
    $callBackUrl = env('TWILIO_CALLBACK_URL');
    $client = new Client($accountID, $this->authToken);
    return $client->messages->create($data['receiver'], [
      'from' => $sender,
      'body' => $data['messages'],
      'statusCallback' => $callBackUrl.$data['code']
    ]);
  }

  public function sendDirect($data, $sId = null){
    $accountID = env("TWILIO_SID");
    $authToken = env("TWILIO_AUTH_TOKEN");
    $sender = env("TWILIO_NUMBER");
    $callBackUrl = env('TWILIO_CALLBACK_URL');
    $client = new Client($accountID, $this->authToken);
    print('[RECEIVER]'.': '.$data['receiver']);
    return $client->messages->create($data['receiver'], [
      'from' => $sender,
      'body' => $data['message'],
      'statusCallback' => $callBackUrl.$data['code']
    ]);
  }

  public function callback(Request $request, $code){
  	$data = $request->all();
    if($data && $code){
      app($this->smsController)->updateByParams('code', $code, 2, $data);
    }else{
      app($this->smsController)->updateByParams('code', $code, 3, $data);
    }
  }
}
