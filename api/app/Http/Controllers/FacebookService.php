<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacebookService
{
    protected $url = '';
    protected $headers = [];

    public function __construct($url = ''){
        $this->url = $url;
    }

    public function textOnly($page_id, $access_token, $message) {
        $this->url = 'https://graph.facebook.com/'.$page_id.'/feed?message='.$message.
        '&publish=true&access_token='.$access_token;

        $curl = new CurlController($token, $this->headers);
        $result = $curl->postRequest($this->url, '{}');
        return $result;
    }

    public function postWithSingleMedia($caption, $access_token, $image) {
        $body = '{
            "caption": "'.$caption.'",
            "access_token": "'.$access_token.'",
            "published": true,
            "url": "'.$image.'"
        }';
        $result = $curl->postRequest($this->url, $body);
        return $result;
    }
    
}
