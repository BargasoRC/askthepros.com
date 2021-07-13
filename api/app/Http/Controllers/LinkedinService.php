<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkedinService extends Controller
{
    //
    protected $url = '';

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
        $curl = new CurlController($token);

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
        $curl = new CurlController($token);

        $result = $curl->postRequest($this->url, $body);

        return $result;
    }
}
