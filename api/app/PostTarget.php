<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTarget extends Model
{
    //
    protected $table = 'popost_targetst';
    protected $fillable = ['code', 'post_id', 'payload', 'payload_value'];
}
