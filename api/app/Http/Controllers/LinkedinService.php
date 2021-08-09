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

    public function getPages($token) {
        /**
         * url should be like this;
         * $this->url = https://api.linkedin.com/v2/organizations?ids=List({organization-id})
         * 
         * This method is a service to retrieve user's Linkedin Organizations or pages
         * This is called in the SocialMediaController
         */
        $this->headers[] = 'Authorization: Bearer '.$token;
        $this->headers[] = 'X-Restli-Protocol-Version: 2.0.0';
        $curl = new CurlController($this->headers);
        $result = $curl->getRequest($this->url);
        return $result;
    }

    public function textOnly($token, $message, $author) {
        $body = '{
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
               "owner":"'.$owner.'",
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

    public function contentWithMedia($token, $author, $message, $media, $media_type) {
        // $body = '{
        //         "content": {
        //             "contentEntities": [
        //                 {
        //                     "entity": "'.$media.'"
        //                 }
        //             ],
        //             "description": "Uploaded image",
        //             "title": "AskThePros Image",
        //             "shareMediaCategory": "IMAGE"
        //         },
        //         "distribution": {
        //             "linkedInDistributionTarget": {}
        //         },
        //         "subject": "test",
        //         "text": {
        //             "text": "'.$message.'"
        //         },
        //         "owner": "'.$author.'"
        //     }';
        $body = '{
            "author": "'.$author.'",
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
                    "shareMediaCategory": "IMAGE"
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

    public function postWithMedia($token, $author, $message, $media, $media_type) {
        $body = '{
            "author": "'.$author.'",
            "lifecycleState": "PUBLISHED",
            "specificContent": {
                "com.linkedin.ugc.ShareContent": {
                    "media": [
                        {
                            "media": "'.$media.'",
                            "status": "READY",
                            "title": {
                                "attributes": [],
                                "text": "'.$message.'"
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
        // echo "\nbody".$body;
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
        $curl = new CurlController($this->headers);
        $result = $curl->getRequest($this->url);
        return $result;
    }
}
