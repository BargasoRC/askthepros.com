<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostHistory extends Model
{
    //
    protected $table = 'post_histories';
    protected $fillable = ['code', 'post_id', 'link', 'page_id', 'account_id', 'status'];
}
