<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Increment\Imarket\Merchant\Models\Merchant;
use Increment\Account\Models\Account;
use Increment\Account\Models\AccountInformation;

class AccountsController extends APIController
{
    //
    public function retrieve(Request $request){
        $data = $request->all();
        $this->model = new Account();
        $result = $this->retrieveDB($data);
        if(sizeof($result) > 0){
          $i = 0;
          // dd($result);
          foreach ($result as $key) {
            $result[$i] = Account::leftJoin('account_informations', 'accounts.id', '=', 'account_informations.account_id')
                      ->leftJoin('merchants', 'accounts.id', '=', 'merchants.account_id')
                      ->select('accounts.id', 'accounts.created_at', 'accounts.username', 'accounts.email', 'account_informations.first_name', 'account_informations.last_name', 'merchants.name as business_name', 'account_informations.cellular_number', 'accounts.account_type', 'accounts.status')
                      ->where('accounts.id', $result[$i]['id'])
                      ->first();
            $i++;
          }
          return response()->json(array('data' => $result));
        }else{
          return $this->response();
        }
      }
}
