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

    public function setUrl($url) {
        $this->url = $url;
    }

    public function retrieveLocations($account_id) {
        $url = $this->googleMyBusinessHostApi.'accounts/'.$account_id.'/locations';
        $curl = new CurlController($this->headers);
        $result = $curl->getRequest($this->url);
        return $result;
    } 

    public function postWithMedia($message, $images) {
        $media = [];
        foreach ($images as $image) {
            $temp = array(
                "mediaFormat" => "PHOTO",
                "sourceURL" => $image
            );
            array_push($media, (object)$temp);
        }
        $body = '{
            "languageCode": "en-US",
            "summary": "'.$message.'",
            "media": '.json_encode($media).',
        }';
        $curl = new CurlController($this->headers);
        $result = $curl->postRequest($this->url, $body);
        return $result;
    }
}
