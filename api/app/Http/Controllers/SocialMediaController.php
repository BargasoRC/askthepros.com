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
        //     'Authorization' => 'Bearer AQVIDSN0G_9xH_gUFhoiHwIFXFFneYuVeVlP-9nsDzChRen5DuUzDxq5y3l7Dks1S7oKRrjLqEQdbQm3tfLOXpPmQQW9UUVha2h_SirQblt8-M-54jBlFok1QhGWGgENTJe9cvFiOSQikE2pFAbmnj6Sanh9Dgfry2CBpJ_ZVvE1d96K4GlFKvQhKoHUQir1_YhYC5nNiAT5qHneSu7igaZKp4fko86aGcJ6U9cklMqQ0qbico6Dab605e6J8t3r',
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
            'Authorization: Bearer AQUcxSsL5EJg6uc1N9NyHkQlNGOTNvam-cprp2cBLDyXyEwSEGK26b1FMW2Nq1x9BTModBudB9RxW3LbPqGlL466HtjC3rCopruahAwbwJlZhJfrPpNjOK74rzt-1NymgLZlmERJSwvUlEzksVpBORHf7mgjXmfZE_KvCGOmCfsDRwei7KWJPS_oNTZ0ux3zIGLV6CIPWUheiGAE4vhQ-idUZwWOWKNpN3Nd9l2S3Rgb7Jbst3jAgaAvXy7o8rJB'
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
