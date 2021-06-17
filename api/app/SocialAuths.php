<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAuths extends Model
{
    //
    protected $table = 'social_auths';
    protected $fillable = ['code', 'account_id', 'type', 'token', 'email', 'details'];
}
