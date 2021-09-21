<?php

namespace Increment\Account\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\APIModel;
class AccountInformation extends APIModel
{

  protected $table = "account_informations";
  protected $fillable = ['account_id', 'first_name', 'last_name', 'middle_name', 'birth_date', 'sex', 'cellular_number', 'address'];

  public function getAccountIdAttribute($value){
    return intval($value);
  }
}
