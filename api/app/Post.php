<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';
    protected $fillable = ['code', 'parent', 'title', 'description', 'channels', 'url', 'account_id', 'status'];
}
