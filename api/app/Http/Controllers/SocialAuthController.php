<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocialAuths;

class SocialAuthController extends APIController
{
    //
    function __construct(){
        $this->model = new SocialAuths();
    }
}
