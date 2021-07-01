<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends APIModel
{
    //
    protected $table = 'pages';
    protected $fillable = ['code', 'account_id', 'type', 'page', 'details'];
}
