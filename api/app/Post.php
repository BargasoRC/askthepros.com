<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends APIModel
{
    //
    protected $table = 'posts';
    protected $fillable = ['code', 'parent', 'title', 'description', 'channels', 'url', 'account_id', 'status'];
}
