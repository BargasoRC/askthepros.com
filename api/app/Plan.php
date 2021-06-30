<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Plan extends APIModel
{
    protected $table = 'plans';
    protected $fillable = [
        'merchant_id', 'account_id' ,'plan', 'amount', 'currency', 'code'
    ];
}
