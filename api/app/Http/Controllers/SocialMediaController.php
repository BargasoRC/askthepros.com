<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CurlController;
use App\Http\Controllers\LinkedinService;
use Increment\Account\Models\Account;

class SocialMediaController extends APIController
{
    /**
     * A controller to post on LINKEDIN
    */
 
    public function post(Request $request) {
        /**
         * POSTING, for TESTING PURPOSES ONLY
         */
        $body = '{
            "author": "urn:li:organization:75023337",
            "lifecycleState": "PUBLISHED",
            "specificContent": {
                "com.linkedin.ugc.ShareContent": {
                    "shareCommentary": {
                        "attributes": [],
                        "text": "Hello World! This is my THIRD POST using LINKEDIN API."
                    },
                    "shareMediaCategory": "NONE"
                }
            },
            "targetAudience": {
                "targetedEntities": [
                    {
                        "geoLocations": [
                            "urn:li:geo:103644278"
                        ],
                        "seniorities": [
                            "urn:li:seniority:3"
                        ]
                    }
                ]
            },
            "visibility": {
                "com.linkedin.ugc.MemberNetworkVisibility": "PUBLIC"
            }
        }';
        $token = "AQV94Qvo5At9SE34VKd6AIRqbYOi-XfmiCYb8LqEvoyJxqtiU3Ngnp4TqG6pzfWi1CGWl4h0mPJRR2fqiMJ4mSHSATCC8wJbrCNlNMi1Rw-M78TW7U4jPqIaUkDh_HNoupJ8MYENOhsKUUzj_-GHQaCbq6fb5z7-YYq92ItSgzVN9s4hsIIsot2d1-XVU-xDHoOYC19z_qfawL-gmqDpA_2OaJ4tGGeb4n3TcGRc81lesKFm8a8p92WjyyGqJ4qVZadIEWR8eSA2gGGxEXsTH5kdvXsBy_q4JeDsu3d24YCJvW_XRw7_ws_cF1CrhOCndZuzWTngv-WrFBaHP4dz3P7w5xw3HA";
        $headers = [
            'Authorization: Bearer '.$token
        ];
        $curl = new CurlController($headers);

        $result = $curl->postRequest($this->linkedInHostApi."/ugcPosts", $body);

        return response()->json($result);
    
        /**
         * End of TEST METHOD
         */
    }

    public function retrieveLinkedinPages(Request $request) {
        $data = $request->all();
        $account = Account::leftJoin('social_auths', 'accounts.id', '=', 'social_auths.account_id')
                ->select('accounts.token', 'social_auths.details')
                ->where([
                    ['accounts.id', '=', $data['account_id']],
                    ['social_auths.type', '=', 'linkedin']
                ])
                ->get();
        $details = json_decode($account[0]['details'], true);
        $url = $this->linkedInHostApi.'organizationAcls?q=roleAssignee&role=ADMINISTRATOR&projection=(elements*(*,organization~(localizedName)))';
        $service = new LinkedinService($url);
        $result = $service->getPages($details['token']);
        return response()->json($result);
    }

    public function linkedinPost(Request $request) {
        /**
         * This method post to linkedin with only PURE TEXT
         * It shoud accept ID and Text
         */
        $data = $request->all();
        $account = Account::leftJoin('social_auths', 'accounts.id', '=', 'social_auths.account_id')
                ->select('accounts.token', 'social_auths.details')
                ->where([
                    ['accounts.id', '=', $data['id']],
                    ['social_auths.type', '=', 'linkedin']
                ])
                ->get();
        $details = json_decode($account[0]['details'], true);
        $service = new LinkedinService($this->linkedInHostApi.'ugcPosts');
        $result = $service->textOnly($details['token'], 'Hello World! Sample LINKEDIN Posting using UGC Post API, with text only!', $details['id']); // Text to post on linkedin is static for now.
        return response()->json($result);
    }

    public function linkedinPostWithMedia($token, $owner, $message, $media, $media_type) {
        $service = new LinkedinService($this->linkedInHostApi.'ugcPosts');
        $result = $service->postWithMedia($token, $owner, $message, $media, $media_type);
        return $result;
    }

    public function linkedinRegisterUpload(Request $request) {
        /**
         * Register an upload to get upload URL for image,
         * It should Accept ID and FILE as Parameters
         */
        $data = $request->all();
        $account = Account::leftJoin('social_auths', 'accounts.id', '=', 'social_auths.account_id')
                ->select('accounts.token', 'social_auths.details')
                ->where([
                    ['accounts.id', '=', $data['id']],
                    ['social_auths.type', '=', 'linkedin'],
                    ['social_auths.deleted_at', '=', null]
                ])
                ->get();
        $path = storage_path('/app/images/' . '1_2021-06-23_01_58_13_robot.png'); // file here is static for now
        
        if (!\File::exists($path)) {
            abort(404);
        }
        
        $file = \File::get($path);
        $type = \File::mimeType($path);

        $details = json_decode($account[0]['details'], true);
        $service = new LinkedinService($this->linkedInHostApi.'assets?action=registerUpload');
        $result = $service->shareMedia($details['token'], $details['id']);
        $registration = [];
        $registration['registration'] = $result;

        if(!isset($result)){
            return response('Cannot register Image', 500);
        }

        $registerResult = (array)json_decode(json_encode($result))->value->uploadMechanism;

        $upload = new LinkedinService(((object)$registerResult['com.linkedin.digitalmedia.uploading.MediaUploadHttpRequest'])->uploadUrl);
        $uploaded = $upload->uploadImage($details['token'], $path);
        $_upload = [];
        $_upload['upload'] = $uploaded;

        $media_uri = ((object)(((object)$result)->value))->asset;
        $asset = explode(':', $media_uri);

        $status_service = new LinkedinService($this->linkedInHostApi."assets/" . $asset[sizeof($asset) - 1]);
        $status = $status_service->checkUploadStatus($details['token']);
        $_status = [];
        $_status['status'] = $status;

        $post = $this->linkedinPostWithMedia($details['token'], $details['id'], 'Sample LINKEDIN Posting using UGC Post API, with Text and Image!\n#VueJs\n#PHP-Laravel\n#UGC_POSTS_API', $media_uri, 'IMAGE');
         // Text to post on linkedin is static for now.

        return response()->json((object) array_merge($registration, $_upload, $_status, $post));
    }

  public function retrieveFacebookPages(Request $request) {
    /**
     * This method retrieves all the facebook pages of the user
     */
    $data = $request->all();
    $account = Account::leftJoin('social_auths', 'accounts.id', '=', 'social_auths.account_id')
            ->select('accounts.token', 'social_auths.details')
            ->where([
                ['accounts.id', '=', $data['account_id']],
                ['social_auths.type', '=', 'facebook'],
                ['social_auths.deleted_at', '=', null]
            ])
            ->get();
    $details = json_decode($account[0]['details'], true);
    $url = $this->facebookHostApi.$details['id'].'/accounts'.(env('CHANNEL_PRODUCTION_MODE') ? '' : '?limit=3');
    $headers = [];
    $headers[] = 'Authorization: Bearer ' . $details['token'];
    $service = new FacebookService($url, $headers);
    $pages = $service->getPages();
    $pages = $pages && $pages['data'] ? $pages['data'] : [];
    if($pages && sizeof($pages) > 0){
      $i = 0;
      foreach ($pages as $key => $page) {
        $url = $this->facebookHostApi.$page['id'].'/picture';
        // $image = $service->requestHandler($url);
        $pages[$i]['image'] = $url;
        $i++;
      }
    }
    $this->response['data'] =  $pages;
    return $this->response();
  }

}
