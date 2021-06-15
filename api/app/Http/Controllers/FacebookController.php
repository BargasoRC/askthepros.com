<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacebookController extends Controller
{
    //
    public function publishToPage(Request $request, FacebookPoster $facebookPoster)
    {
        $page_id = 'XXXXXXXXXXXXX';
        $title = 'XXXXXXXXXXXXX';

        $facebookPoster->publishToPage($page_id, $title);
    }

    // public function store(Request $request, FacebookPoster $facebookPoster)
    // {
    //     $data = $this->handleRequest($request);

    //     $newPost = $request->user()->posts()->create($data);
    //     $newPost->createTags($data["post_tags"]);
        
    //     //...
            
    //     $facebookPoster->publishToPage($page, $newPost->title);
    // }
}
