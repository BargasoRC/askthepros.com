<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branding extends APIModel
{
    //
    protected $table = 'brandings';
    protected $fillable = ['code', 'details', 'account_id'];
}
