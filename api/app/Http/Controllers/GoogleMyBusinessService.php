<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleMyBusinessService extends APIController
{
    protected $url = '';
    protected $headers = [];

    public function __construct($url = '', $headers = []){
        $this->url = $url;
        $this->headers = $headers;
    }

    public function retrieveLocations($account_id) {
        $url = $this->googleMyBusinessHostApi.'accounts/"'.$account_id.'"/locations';
        $curl = new CurlController($this->headers);
        $result = $curl->getRequest($this->url);
        return $result;
    } 

    public function postWithMedia($message, $images) {
        $body = '{
            "languageCode": "en-US",
            "summary": "'.$message.'",
            "media": [
              {
                "mediaFormat": "PHOTO",
                "sourceUrl": "https://api.staging.askthepros.com/increment/v1/storage/image/2_2021-08-03_02_00_17_robot.png",
              }
            ],
        }';
        $curl = new CurlController($this->headers);
        $result = $curl->postRequest($this->url, $body);
        return $result;
    }
}
