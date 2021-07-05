<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTarget extends APIModel
{
    //
    protected $table = 'post_targets';
    protected $fillable = ['code', 'post_id', 'payload', 'payload_value'];
}
