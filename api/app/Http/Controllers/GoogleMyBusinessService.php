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
        $curl = new CurlController($this->headers);
        $result = $curl->getRequest($this->url);
        return $result;
    } 

    public function postWithMedia($message, $images) {
        /**
         * The media in the body below should look like this...
         * 
         * "media": [
         *  {
         *      "mediaFormat": "PHOTO",
         *      "sourceURL": "link of image"
         *  }
         * ]
         */
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
            "media": $media
        }';
        $curl = new CurlController($this->headers);
        $result = $curl->postRequest($this->url, $body);
        return $result;
    }
}
