<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    /**
     * This is just a test connection to social media platform.
    */
 
    public function post(Request $request) {
        // $client = new \GuzzleHttp\Client();
        // $client->setDefaultOption('headers', array(
        //     'Authorization' => 'Bearer ',
        //     'X-Restli-Protocol-Version' => '2.0.0',
        //     'Content-Type' => 'application/json'
        // ));
        // $client->post(
        //     'https://api.linkedin.com/v2/ugcPosts',
        //     array(
        //         'form_params' => array(
        //             "author" => "urn:li:person",
        //             "lifecycleState" => "PUBLISHED",
        //             "specificContent" => array(
        //                 "com.linkedin.ugc.ShareContent" => array(
        //                     "media" => [
        //                         array( 
        //                             "landingPage" => array(
        //                                 "landingPageTitle" => "LEARN_MORE",
        //                                 "landingPageUrl" => "https:linkedin.com"
        //                             ),
        //                             "media" => "urn:li:digitalmediaAsset:C5500AQG7r2u00ByWjw",
        //                             "status" => "READY",
        //                             "title" => array(
        //                                 "attributes" => [],
        //                                 "text" => "Sample Video Create"
        //                             )
        //                         )
        //                     ],
        //                     "shareCommentary" => array(
        //                         "attributes" => [],
        //                         "text" => "Some share text"
        //                     ),
        //                     "shareMediaCategory" => "VIDEO"
        //                 )
        //             ),
        //         )
        //     )
        // );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.linkedin.com/v2/audienceCountsV2?q=targetingCriteria&target.includedTargetingFacets.industries[0]=urn:li:industry:4&target.includedTargetingFacets.seniorities[0]=urn:li:seniority:3&target.includedTargetingFacets.locations[0]=urn:li:country:us&target.includedTargetingFacets.locations[1]=urn:li:country:gb&target.includedTargetingFacets.followedCompanies[0]=urn:li:person');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Restli-Protocol-Version: 2.0.0',
            'Authorization: Bearer '
        ));
        curl_setopt($ch, CURLOPT_HEADER, 0);

        //$body = '{}';
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
        //curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $test = curl_exec($ch);

        return response()->json($test);
    }
}
