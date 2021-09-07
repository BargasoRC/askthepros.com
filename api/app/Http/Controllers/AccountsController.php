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
        
        $con = $data['condition'];
        $result = Account::where($con[0]['column'], $con[0]['clause'], $con[0]['value'])->limit($data['limit'])
          ->offset($data['offset'])->orderBy(array_keys($data['sort'])[0], array_values($data['sort'])[0])->get();

        if(sizeof($result) > 0){

          $i = 0;
          foreach ($result as $key) {
            $result[$i] = Account::leftJoin('account_informations', 'accounts.id', '=', 'account_informations.account_id')
                      ->leftJoin('merchants', 'accounts.id', '=', 'merchants.account_id')
                      ->select('accounts.id', 'accounts.created_at', 'accounts.username', 'accounts.email', 'account_informations.first_name', 'account_informations.last_name', 'merchants.name as business_name', 'merchants.addition_informations as industry', 'account_informations.cellular_number', 'accounts.account_type', 'accounts.status')
                      ->where('accounts.id', $result[$i]['id'])
                      ->first();
            $i++;
          }
          return response()->json(array(
            'data' => $result,
            'size' => Account::where('deleted_at', '=', null)->count()
          ));
        }else{
          return $this->response();
        }
      }
}
