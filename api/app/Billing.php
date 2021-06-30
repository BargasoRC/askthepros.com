<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends APIModel
{
 	protected $table = 'billings';
  protected $fillable = ['merchant_id', 'currency', 'details', 'amount', 'start_date', 'end_date', 'status'];
}
