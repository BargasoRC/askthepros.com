<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use App\UserAuth;
use Increment\Account\Models\Account;
use App\LoginLogger;
use App\Jobs\Email;
use Carbon\Carbon;

class AuthenticateController extends Controller
{
  public function __construct()
   {
     // Apply the jwt.auth middleware to all methods in this controller
     // except for the authenticate method. We don't want to prevent
     // the user from retrieving their token if they don't already have it
     $this->middleware('jwt.auth', ['except' => ['authenticate']]);
   }
  public function index()
  {
    $users = UserAuth::all();
    return $users;
  }

  public function broadcastAuth(Request $request){
    $data = $request->all();
    $user = UserAuth::where('id', '=', $data['account_id'])->get();
    if(sizeof($user) > 0){
      return response()->json(true);
    }
    return response()->json(['error' => 'invalid_credentials'], 401); 
  }

  public function refreshToken(){
    // config/jwt.php ttl to change token life
    // if ($token = JWTAuth::parseToken()->refresh()){
    //   return response()->json(['error' => 'failed_parse', 'token' => JWTAuth::getToken()], 401);
    // }
    $current_token  = JWTAuth::getToken();
    $token          = JWTAuth::refresh($current_token);
    return response()->json(compact('token'));
  }
  public function authenticate(Request $request)
  {
    $data = $request->all();
    $text = array('email' => $data['username']);
    
    $credentials = null;
    $result = null;
    if($this->customValidate($text) == true){    
      $credentials = array("email" => $data['username'], 'password' => $data['password']);
      // $result = Account::where('email', '=', $data['username'])->get();
      $result = Account::whereRaw("BINARY email='".$data["username"]."'")->get();
    }else{
      $credentials = array("username" => $data['username'], 'password' => $data['password']);
      // $result = Account::where('username', '=', $data['username'])->get();
      $result = Account::whereRaw("BINARY username='".$data["username"]."'")->get();
    }
    
    try {
      // verify the credentials and create a token for the user
      if (! $token = JWTAuth::attempt($credentials)) {
          return response()->json(['error' => 'invalid_credentials'], 401);
      }
    } catch (JWTException $e) {
      // something went wrong
      return response()->json(['error' => 'could_not_create_token'], 500);
    }

    $token = compact('token');
    if(sizeof($result) > 0){
      // app('App\Http\Controllers\NotificationSettingController')->manageNotification($result[0]['id']);
      $lastLogin = Carbon::createFromFormat('Y-m-d H:i:s', $result[0]['updated_at']);
      $currentDate = Carbon::now();
      $diff = $currentDate->diffInMinutes($lastLogin);

      if($token && isset($token['token']) && $diff > 60 && $result[0]['token']){
        $accountToken = [];
        $accountToken = json_decode($result[0]['token'], true);
        if($accountToken){
          $accountToken['token'] = $token['token'];
          Account::where('id', '=', $result[0]['id'])->update(array(
            'token' => json_encode($accountToken),
            'updated_at' => Carbon::now()
          ));
        }else{
          Account::where('id', '=', $result[0]['id'])->update(array(
            'token' => json_encode(array(
              'token' => $token['token'],
            'updated_at' => Carbon::now()
            ))
          ));
        }
      }else{
        $accountToken = $token['token'];
        $token['token'] = $accountToken;
        Account::where('id', '=', $result[0]['id'])->update(array(
          'token' => json_encode(array(
            'token' => $accountToken,
          )),
          'updated_at' => Carbon::now()
        ));
      }
    }
    
    return response()->json(array(
      'token' => $token['token']
    ));
  }
  public function deauthenticate(){
    JWTAuth::invalidate(JWTAuth::getToken());
    return response()->json(['token' => NULL]);
  }
  public function getAuthenticatedUser()
  {
    try {
      if (! $user = JWTAuth::parseToken()->authenticate()) {
        return response()->json(['user_not_found'], 404);
      }
    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
      return response()->json(['token_expired'], $e->getStatusCode());
    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
      return response()->json(['token_invalid'], $e->getStatusCode());
    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
      return response()->json(['token_absent'], $e->getStatusCode());
    }

    // the token is valid and we have found the user via the sub claim
    if($user){
      // add merchant
      // profile = url {url => }
      $user['profile'] = app('Increment\Account\Http\AccountProfileController')->getProfileUrlByAccountId($user['id']);
      $user['merchant'] = app('Increment\Imarket\Merchant\Http\MerchantController')->getByParams('account_id', $user['id']);
      $user['plan'] = app('App\Http\Controllers\PlanController')->getByParams('account_id', $user['id']);
    }
    $user['login_type'] = 'local';
    return response()->json($user);
  }
  
  public function customValidate($text){
    $validation = array('email' => 'required|email'); 
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


  public function test(){
    return "Here";
  }

  public function googleLogin(){
    $CLIENT_ID = "110121744042-m2q8b6gjnor8q8njmu1dkgtsieek9as2.apps.googleusercontent.com";
    $client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
    $payload = $client->verifyIdToken($id_token);
    return $payload;
    if ($payload) {
      $userid = $payload['sub'];
      // If request specified a G Suite domain:
      //$domain = $payload['hd'];
    } else {
      // Invalid ID token
    }
  }
}
