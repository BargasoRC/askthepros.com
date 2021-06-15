<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Increment\Account\Models\Account;
use Socialite;
class SocialController extends APIController
{
    public function redirect($provider)
    {
      $scopes = [];
      if(strtolower($provider) == 'facebook') {
        $scopes = ["publish_actions, manage_pages", "publish_pages"];
      }else if(strtolower($provider) == 'linkedin') {
        $scopes = ["r_emailaddress", "r_liteprofile", "w_member_social"];
      }

      $result = Socialite::with($provider)->scopes($scopes)->redirect()->getTargetUrl();
      $this->response['data'] = array('url' => $result);
      return $this->response();
    }

    public function Callback($provider)
    {
      $user = Socialite::driver($provider)->stateless()->user();
      $acc = Account::firstOrNew(['username' => $user->getId()]);
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
