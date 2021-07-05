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
        $scopes = ["r_emailaddress", "r_liteprofile", "w_member_social", "r_fullprofile"];
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
        $acc->username = $user->getId();
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

    public function linkedinConnect(Request $request, $provider) {
      /**
       * first api call retrieves USER TOKEN
       * second api call retrieves USER INFO 
       * third api call retrieves USER EMAIL ADDRESS
       */
      $data = $request->all();
      $redirect_id = env('LINKEDIN_CLIENT_ID');
      $redirect_client_secret = env('LINKEDIN_CLIENT_SECRET');
      $url = 'https://www.linkedin.com/oauth/v2/accessToken?grant_type=authorization_code&client_id='.$redirect_id.'&client_secret='.$redirect_client_secret.'&code='.$request->query('code').'&redirect_uri='. env('CONNECT_CALLBACK_URL');
      $token = $this->getCurl($url);
      $url = 'https://api.linkedin.com/v2/me';
      $headers =  array(
        'Authorization: Bearer '.$token->access_token,
        'cache-control: no-cache',
        'X-Restli-Protocol-Version: 2.0.0'
      );
      $user = $this->getCurl($url, $headers);
      $url = 'https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))';
      $emailAddress = $this->getCurl($url, $headers);
      $handle = (array)$emailAddress->elements[0];
      
      $this->saveSocialAuths($data['id'], $token->access_token, $handle['handle~']->emailAddress, $user, $provider);

      $this->response['data'] = $user;
      return $this->response();
    }

    public function saveSocialAuths($user, $token, $email, $social_user, $provider) {
      $social_auth = SocialAuths::firstOrNew(['account_id' => $user, 'type' => $provider]);
      $token = $token;
      if($social_auth->new){
        $social_auth->token = $token;
        $social_auth->save();
      } else {
        $social_auth->account_id = $user;
        $social_auth->type = $provider;
        $social_auth->token = $token;
        $social_auth->email = $email ? $email : "";
        $social_auth->details = json_encode($social_user);
        $social_auth->save();
      }
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

    public function getCurl($url, $headers = []) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      $response = curl_exec($ch);
      $result = json_decode($response);
      curl_close($ch);
      return $result;
    }
}
