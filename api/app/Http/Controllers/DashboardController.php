<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Page;
use App\Branding;
class DashboardController extends APIController
{
  function __construct(){

  }

  public function retrieveByUser(Request $request){
    // get setup
    // get setup bran
    // get latest post
    $data = $request->all();
    $pages = Page::where('account_id', '=', $data['account_id'])->get();
    $facebook = false;
    $google = false;
    $linkedin = false;
    
    if($pages && sizeof($pages) > 0){
      foreach ($pages as $key => $page) {
        switch(strtolower($page['type'])){
          case 'facebook':
            $facebook = true;
            break;
          case 'google':
            $google = true;
            break;
          case 'linkedin':
            $linkedin = true;
            break;
        }
      }
    }

    $branding = Branding::where('account_id', '=', $data['account_id'])->get();

    $cards = array(
      "facebook" => $facebook,
      "google"   => $google,
      "linkedin" => $linkedin,
      "brand"    => $branding && sizeof($branding) > 0 ? true : false
    );

    $this->response['data'] = array(
      'cards' => $cards
    );

    return $this->response();
  }
}
