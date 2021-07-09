<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountInformationContoller extends APIController
{
  public function retrieveAccountInformation(Request $request) {
    $data = $request->all();
    $user = [];
    $user['profile'] = app('Increment\Account\Http\AccountInformationController')->getAccountInformation($data['id']);
    $user['profile'] = app('Increment\Account\Http\AccountProfileController')->getProfileUrlByAccountId($data['id']);
    $user['merchant'] = app('Increment\Imarket\Merchant\Http\MerchantController')->getByParams('account_id', $data['id']);
    $this->response['data'] = $user;

    return $this->response();
  }
}
