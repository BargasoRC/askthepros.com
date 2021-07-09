<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountInformationsContoller extends APIController
{
  public function retrieveAccountInformation(Request $request) {
    $data = $request->all();
    $user = [];
    $user[] = app('Increment\Account\Http\AccountInformationController')->getAccountInformation($data['account_id']);
    $this->response['data'] = $user;

    return $this->response();
  }
}
