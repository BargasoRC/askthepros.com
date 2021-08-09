<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurlController extends Controller
{
  protected $basicRoot = 'https://';

  protected $ch = null;
  protected $headers = array();

  public function __construct($headers) {
    $this->headers = $headers;
    $this->ch = curl_init();

    curl_setopt($this->ch, CURLOPT_VERBOSE, 0);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
  }
  

  public function manageResult($data){
    $result = array();
    $data = json_decode($data, true);
    if(!isset($data['errors']) && $data){
      foreach ($data as $key => $value) {
        return array(
          'error' => null,
          'data'  => $value
        );
      }
    }else{
      return array(
        'error' => $data['errors'],
        'data'  => null
      );
    }

    return array(
      'data' => $data,
      'error' => null
    );
  }

  public function postRequest($url, $body) {
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_POST, 1);
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body);

    $result = curl_exec($this->ch);
    curl_close($this->ch);

    return json_decode($result, true);
  }

  public function postRequestDirect($url, $body) {
    $this->ch = curl_init();

    curl_setopt($this->ch, CURLOPT_VERBOSE, 0);
    // curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_POST, 1);
    if($body){
      curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($body));
    }

    $result = curl_exec($this->ch);
    
    curl_close($this->ch);
    // print_r(curl_getinfo($this->ch));
    return $result;
  }

  public function getRequest($url) {
    curl_setopt($this->ch, CURLOPT_URL, $url);

    $result = curl_exec($this->ch);
    curl_close($this->ch);

    return json_decode($result, true);
  }

  public function getRequestWithoutData($url) {
    curl_setopt($this->ch, CURLOPT_URL, $url);

    $result = curl_exec($this->ch);
    curl_close($this->ch);

    return $result;
  }

  public function putRequest($url, $body) {
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($this->ch);
    curl_close($this->ch);

    return  json_decode($result, true);
  }

  public function imageUpload($url, $file) {
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_PUT, 1);
    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "PUT");
    $fh_res = fopen($file, 'r');
    curl_setopt($this->ch, CURLOPT_INFILE, $fh_res);
    curl_setopt($this->ch, CURLOPT_INFILESIZE, filesize($file));
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($this->ch);
    curl_close($this->ch);
    return  json_decode($result, true);
  }

  public function deleteRequest($url, $body) {
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_DELETE, true);
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body);

    $result = curl_exec($this->ch);
    curl_close($this->ch);

    return $result;
  }

  public function getInit() {
    return $this->$ch;
  }
}
