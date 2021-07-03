<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Plan extends APIModel
{
    protected $table = 'plans';
    protected $fillable = [
     'account_id' ,'plan', 'amount', 'currency', 'code'
    ];
}
