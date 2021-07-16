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
            "author": "urn:li:person:JHTK8LWD7X",
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
        $token = "AQXLmE7WTnNGdiYqpVzHWnQKLX7TmgNaBmsMnJSA7VuCz6iPjy6JoT1PH5P-FWsDMyQrBqb69CyvbKdrEvQXjq0ue4h2hEU6X5DqtCeKLzXhA1e_SysnZWsmMGsJN8E0AruVOYd380Hj2lajFre45OkFHUbhuK0tQvs56Ao-B6qGT-tCFGmbGTwCwypFvKdHFkbVjZb3WWo0GC1vrEjK-CkEyqKZl9_dIyD5WJaTSEOPxu1UXcjqftQACtdZqaNNS8QnfeWLVNGXVMLmvprtuLAGqE2dmqvZIPatFbnphOomprBosF8kgPy42FRq6MFUZONemZsA_AiK7Np_fU6F7eetO9whEQ";
        $curl = new CurlController($token);

        $result = $curl->postRequest("https://api.linkedin.com/v2/ugcPosts", $body);

        return response()->json($result);
        /**
         * End of TEST METHOD
         */
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
        $service = new LinkedinService('https://api.linkedin.com/v2/ugcPosts');
        $result = $service->textOnly($details['token'], 'Hello World! Sample LINKEDIN Posting using UGC Post API, with text only!', $details['id']); // Text to post on linkedin is static for now.
        return response()->json($result);
    }

    public function linkedinPostWithMedia($token, $owner, $message, $media, $media_type) {
        $service = new LinkedinService('https://api.linkedin.com/v2/ugcPosts');
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
        $path = storage_path('/app/images/' . '1_2021-06-18_07_18_56_Group_1623.png'); // file here is statis for now
        
        if (!\File::exists($path)) {
            abort(404);
        }
        
        $file = \File::get($path);
        $type = \File::mimeType($path);

        $details = json_decode($account[0]['details'], true);
        $service = new LinkedinService('https://api.linkedin.com/v2/assets?action=registerUpload');
        $result = $service->shareMedia($details['token'], $details['id']);
        $registration = [];
        $registration['registration'] = $result;

        $registerResult = (array)json_decode(json_encode($result))->value->uploadMechanism;

        $upload = new LinkedinService(((object)$registerResult['com.linkedin.digitalmedia.uploading.MediaUploadHttpRequest'])->uploadUrl);
        $uploaded = $upload->uploadImage($details['token'], $path);
        $_upload = [];
        $_upload['upload'] = $uploaded;

        $media_uri = ((object)(((object)$result)->value))->asset;
        $asset = explode(':', $media_uri);

        $status_service = new LinkedinService("https://api.linkedin.com/v2/assets/" . $asset[sizeof($asset) - 1]);
        $status = $status_service->checkUploadStatus($details['token']);
        $_status = [];
        $_status['status'] = $status;

        $post = $this->linkedinPostWithMedia($details['token'], $details['id'], 'Hello World! Sample LINKEDIN Posting using UGC Post API, with TEXT and IMAGE!', ((object) $status)->id, 'IMAGE');
         // Text to post on linkedin is static for now.

        return response()->json((object) array_merge($registration, $_upload, $_status, $post));
    }

}
