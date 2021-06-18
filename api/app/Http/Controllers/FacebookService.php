<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacebookService
{
    protected $api;

    public function __construct()
    {
        // $fb->setDefaultAccessToken(Auth::user()->token);
        $this->api = new Facebook([
            'app_id' => env('FACEBOOK_CLIENT_ID'),
            'app_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'default_graph_version' => 'v2.6',
        ]);
    }

    protected function getPageAccessToken($page_id, $id){
        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $token = Account::where('id', '=', $id)->get();
            $response = $this->api->get('/me/accounts', $token);
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        try {
            $pages = $response->getGraphEdge()->asArray();
            foreach ($pages as $key) {
                if ($key['id'] == $page_id) {
                    return $key['access_token'];
                }
            }
        } catch (FacebookSDKException $e) {
            dd($e); // handle exception
        }
    }

    public function publishToPage($page, $title, $id){
        try {
            $post = $this->api->post('/' . $page . '/feed', array('message' => $title), $this->getPageAccessToken($page, $id));
    
            $post = $post->getGraphNode()->asArray();
            } catch (FacebookSDKException $e) {
                dd($e); // handle exception
            }
    }
}
