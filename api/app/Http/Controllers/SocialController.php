<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Increment\Account\Models\Account;
use App\SocialAuths;
use Socialite;
class SocialController extends APIController
{
    public function redirect($provider)
    {
      $scopes = [];
      $_provider = '';
      $redirect_uri = '';
      if(strtolower($provider) == 'facebook' || strtolower($provider) == 'facebook_connect') {
        $scopes = ["publish_video", "pages_manage_posts", "pages_read_engagement", "pages_show_list"];
        $_provider = 'facebook';
        $redirect_uri = $provider == 'facebook' ? env('FACEBOOK_URL') : env('CONNECT_CALLBACK_URL');
      }else if(strtolower($provider) == 'linkedin' || strtolower($provider) == 'linkedin_connect') {
        $scopes = ["r_emailaddress", "r_liteprofile", "w_member_social"];
        $_provider = 'linkedin';
        $redirect_uri = $provider == 'linkedin' ? env('LINKEDIN_URL') : env('CONNECT_CALLBACK_URL');
      }else if(strtolower($provider) == 'google' || strtolower($provider) == 'google_connect') {
        $_provider = 'google';
        $redirect_uri = $provider == 'google' ? env('GOOGLE_URL') : env('CONNECT_CALLBACK_URL');
      }

      $result = Socialite::driver($_provider)->with(['redirect_uri' => $redirect_uri])->scopes($scopes)->redirect()->getTargetUrl();
      $this->response['data'] = array('url' => $result);
      return $this->response();
    }

    public function Callback($provider)
    {
      $user = Socialite::driver($provider)->stateless()->user();
      $acc = Account::firstOrNew(['email' => $user->getEmail(), 'username' => $user->getId()]);
      $token = $user->token;
      if ($acc->new) {
        $acc->token = $token;
        $acc->save();
      } else {
        $acc->code = $this->generateCode();
        $acc->username = $user->getEmail() ? $user->getEmail() : "";
        $acc->email = $user->getEmail() ? $user->getEmail() : "";
        $acc->account_type = 'USER';
        $acc->status = 'NOT_VERIFIED';
        $acc->token = $token;
        $acc->save();
      }

      $user_account = Account::where('id', $acc->id)->get();

      return response()->json([
        'token' => $user_account[0]->token,
        'user' => $user_account,
        'expires' => $user->expiresIn,
        'avatar' => $user->getAvatar(),
        'login_type' => 'social_lite',
      ]);
    }

    public function connectRedirect($provider)
    {
      $scopes = [];
      $redirect_uri = '';
      if(strtolower($provider) == 'facebook') {
        $scopes = ["publish_video", "pages_manage_posts", "pages_read_engagement", "pages_show_list"];
        $redirect_uri = env('CONNECT_CALLBACK_URL');
      }else if(strtolower($provider) == 'linkedin') {
        $scopes = ["r_emailaddress", "r_liteprofile", "w_member_social"];
        $redirect_uri = env('CONNECT_CALLBACK_URL');
      }else if(strtolower($provider) == 'google') {
        $redirect_uri = env('CONNECT_CALLBACK_URL');
      }

      $result = Socialite::driver($provider)->with(['redirect_uri' => $redirect_uri])->scopes($scopes)->redirect()->getTargetUrl();
      $this->response['data'] = array('url' => $result);
      return $this->response();
    }

    public function connectCallBack(Request $request, $provider) {
      $data = $request->all();
      $user = Socialite::driver($provider)->stateless()->user();
      $social_auth = SocialAuths::firstOrNew(['account_id' => $data['id'], 'type' => $provider]);
      $token = $user->token;
      if($social_auth->new){
        $social_auth->token = $token;
        $social_auth->save();
      } else {
        $social_auth->account_id = $data['id'];
        $social_auth->type = $provider;
        $social_auth->token = $token;
        $social_auth->email =$user->getEmail() ? $user->getEmail() : "";
        $social_auth->details = json_encode($user);
        $social_auth->save();
      }

      $this->response['data'] = $user;
      return $this->response();
    }

    public function checkToken(Request $request)
    {
        $data = $request->all();
        if ($request->has('token')) {
            // $user->invitee = $request->input('invitee');
            $result = Account::where([
                ['id', '=', $data['id']],
                ['token', '=', $data['token']],
            ])->get();

            $response = null;
            if (sizeof($result) > 0) {
                $response = [];
                $response['id'] = $result[0]['id'];
                $response['email'] = $result[0]['email'];
                $response['code'] = $result[0]['code'];
                $response['account_type'] = $result[0]['account_type'];
                $response['status'] = $result[0]['status'];
                $response['username'] = $result[0]['username'];
                $response['created_at'] = $result[0]['created_at'];
                $response['updated_at'] = $result[0]['updated_at'];
                $response['deleted_at'] = $result[0]['deleted_at'];
                $response['token'] = $result[0]['token'];
                $response['login_type'] = 'social_lite';
            } else {
                return response()->json(['user_not_found'], 404);
            }
            // $token = $request->input('token');
            // $verified_user = Socialite::driver($data['provider'])->userFromToken($request->token);
            return response()->json($response);
        }
    }

    public function generateCode()
    {
        $code = 'acc_' . substr(str_shuffle($this->codeSource), 0, 60);
        $codeExist = Account::where('code', '=', $code)->get();
        if (sizeof($codeExist) > 0) {
            $this->generateCode();
        } else {
            return $code;
        }
    }
}
