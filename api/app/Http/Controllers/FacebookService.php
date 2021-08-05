<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacebookService extends APIController
{
  protected $url = '';
  protected $headers = [];

  public function __construct($url = '', $headers = []){
    $this->url = $url;
    $this->headers = $headers;
  }

  public function getPages() {
    /**
     * url should be like this;
     * $this->url = https://graph.facebook.com/v11.0/{id}/accounts
     * 
     * This method is a service to retrieve user's Facebook Pages
     * This is called in the SocialMediaController
     */
    $curl = new CurlController($this->headers);
    $result = $curl->getRequest($this->url);
    return $result;
  }

  public function requestHandler($url){
    $curl = new CurlController($this->headers);
    $result = $curl->getRequest($url);
    return $result;
  }

  public function textOnly($page_id, $access_token, $message) {
    $this->url = 'https://graph.facebook.com/'.$page_id.'/feed?message='.$message.
    '&publish=true&access_token='.$access_token;

    $curl = new CurlController($this->headers);
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
    $curl = new CurlController($this->headers);
    $result = $curl->postRequest($this->url, $body);
    return $result;
  }
    
}
