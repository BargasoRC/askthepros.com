<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends APIModel
{
    protected $table = 'payment_methods';
    protected $fillable = ['account_id', 'code', 'method', 'details', 'status'];
}
