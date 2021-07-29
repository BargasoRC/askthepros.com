<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkedinService extends Controller
{
    //
    protected $url = '';
    protected $headers = [];

    function __construct($url) {
        $this->url = $url;
    }
    public function textOnly($token, $message, $author) {
        $body = '{
            "author": "urn:li:person:'.$author.'",
            "lifecycleState": "PUBLISHED",
            "specificContent": {
                "com.linkedin.ugc.ShareContent": {
                    "shareCommentary": {
                        "attributes": [],
                        "text": "'.$message.'"
                    },
                    "shareMediaCategory": "NONE"
                }
            },
            "visibility": {
                "com.linkedin.ugc.MemberNetworkVisibility": "PUBLIC"
            }
        }';
        $this->headers[] = 'X-Restli-Protocol-Version: 2.0.0';
        $this->headers[] = 'Authorization: Bearer ' . $token;
        $this->headers[] = 'Content-Type: application/json';
        $curl = new CurlController($this->headers);

        $result = $curl->postRequest($this->url, $body);

        return $result;
    }
    public function shareMedia($token, $owner) {
        $body = '{
            "registerUploadRequest":{
               "owner":"urn:li:person:'.$owner.'",
               "recipes":[
                  "urn:li:digitalmediaRecipe:feedshare-image"
               ],
               "serviceRelationships":[
                  {
                     "identifier":"urn:li:userGeneratedContent",
                     "relationshipType":"OWNER"
                  }
               ],
               "supportedUploadMechanism":[
                  "SYNCHRONOUS_UPLOAD"
               ]
            }
        }';
        $this->headers[] = 'X-Restli-Protocol-Version: 2.0.0';
        $this->headers[] = 'Authorization: Bearer ' . $token;
        $this->headers[] = 'Content-Type: application/json';
        $curl = new CurlController($this->headers);

        $result = $curl->postRequest($this->url, $body);

        return $result;
    }

    public function postWithMedia($token, $author, $message, $media, $media_type) {
        $body = '{
            "author": "urn:li:person:'.$author.'",
            "lifecycleState": "PUBLISHED",
            "specificContent": {
                "com.linkedin.ugc.ShareContent": {
                    "media": [
                        {
                            "media": "'.$media.'",
                            "status": "READY",
                            "title": {
                                "attributes": [],
                                "text": "Sample Video Create"
                            }
                        }
                    ],
                    "shareCommentary": {
                        "attributes": [],
                        "text": "'.$message.'"
                    },
                    "shareMediaCategory": "'.$media_type.'"
                }
            },
            "visibility": {
                "com.linkedin.ugc.MemberNetworkVisibility": "PUBLIC"
            }
        }';
        $this->headers[] = 'X-Restli-Protocol-Version: 2.0.0';
        $this->headers[] = 'Authorization: Bearer ' . $token;
        $this->headers[] = 'Content-Type: application/json';
        $curl = new CurlController($this->headers);

        $result = $curl->postRequest($this->url, $body);

        return $result;
    }

    public function uploadImage($token, $image) {
        $this->headers[] = 'X-Restli-Protocol-Version: 2.0.0';
        $this->headers[] = 'Authorization: Bearer ' . $token;
        $this->headers[] = 'Content-Type: application/json';
        $this->headers[]= 'Connection: Keep-Alive';
        $curl = new CurlController($this->headers);
        $result = $curl->imageUpload($this->url, $image);
        return $result;
    }

    public function checkUploadStatus($token) {
        $this->headers[] = 'X-Restli-Protocol-Version: 2.0.0';
        $this->headers[] = 'Authorization: Bearer ' . $token;
        $this->headers[] = 'Content-Type: application/json';
        $result = $curl->getRequest($this->url);
        return $result;
    }
}
