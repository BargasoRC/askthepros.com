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
        $data = $request->all();
        $account = Account::leftJoin('social_auths', 'accounts.id', '=', 'social_auths.account_id')
                ->select('accounts.token', 'social_auths.details')
                ->where('accounts.id', '=', $data['id'])
                ->get();
        $details = json_decode($account[0]['details'], true);
        $service = new LinkedinService('https://api.linkedin.com/v2/ugcPosts');
        $result = $service->textOnly($details['token'], 'Hello World! Sample LINKEDIN Posting using UGC Post API, with text only!', $details['id']);
        return response()->json($result);
    }

}
