<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostHistory extends APIModel
{
    //
    protected $table = 'post_histories';
    protected $fillable = ['code', 'post_id', 'channel', 'link', 'page_id', 'account_id', 'status'];
}
