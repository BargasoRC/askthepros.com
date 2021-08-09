<?php

namespace App;
use FacebookAds\Object\Page;
use FacebookAds\Object\Photo;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
class Facebook
{
  public $api;

  function __construct($token){
    // require '../../vendor/autoload.php';
    $this->api = Api::init(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'), $token);
    $this->api->setLogger(new CurlLogger());
  }

  public function publishContentWithPhoto($pageId, $params){
    $fields = array();
    return (new Page($pageId))->createPhoto(
      $fields,
      $params
    )->exportAllData();
  }

  public function publishContentTextOnly($pageId, $params){
    $fields = array();
    return (new Page($pageId))->createFeed(
      $fields,
      $params
    )->exportAllData();
  }
}
