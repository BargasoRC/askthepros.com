<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Increment\Account\Models\Account;

class AccountInformationsContoller extends APIController
{
  public function retrieveAccountInformation(Request $request) {
    $data = $request->all();
    $user = [];
    $user[] = app('Increment\Account\Http\AccountInformationController')->getAccountInformation($data['account_id']);
    $this->response['data'] = $user;

    return $this->response();
  }

  public function updateAccountAndInformations(Request $request) {
    $data = $request->all();
    $result = Account::leftJoin('account_informations', 'accounts.id', '=', 'account_informations.account_id')
            ->where('accounts.id','=', $data['account_id'])
            ->update($data);
    $this->response['data'] = $result;
    return $this->response();
  }

  public function checkPassword(Request $request) {
    $data = $request->all();
    $result = \DB::table('accounts')
              ->where('id', '=', $data['id'])
              ->first();
    if($result && \Hash::check($data['password'], $result->password)) {
      $this->response['data'] = true;
    }else{
      $this->response['data'] = false;
    }
    return $this->response();
  }
}
