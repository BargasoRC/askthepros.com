<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAuths extends APIModel
{
    //
    protected $table = 'social_auths';
    protected $fillable = ['code', 'account_id', 'type', 'token', 'email', 'details'];
}
