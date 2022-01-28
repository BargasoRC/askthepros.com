<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

class ImageHandlerController extends APIController
{
  function __construct(){
  }

  public function generate(Request $request){
    $data = $request->all();

    $question = $data['question'];
    $answer = $data['answer'];
    $category = $data['category'];

    $width       = 250;
    $height      = 250;
    $center_x    = $width / 2;
    $center_y    = $height / 2;
    $max_len     = 36;
    $font_size   = 42;
    $font_height = 30;
    $backgroundColor = '#01009A';

    $image = Image::canvas($width, $height);
    $image->fill($backgroundColor);


    $y = $center_y - (1 * $font_height);
    $image->text($category. ' Q&A', $center_x, 50, function($font) use ($font_size) {
      $font->file(public_path('font/OpenSans-Bold.ttf'));
      $font->size($font_size);
      $font->color('#ffffff');
      $font->align('center');
      $font->valign('top');
    });

    $image->text($question, $center_x, $y, function($font) use ($font_size) {
      $font->file(public_path('font/OpenSans-Bold.ttf'));
      $font->size($font_size - 10);
      $font->color('#ffffff');
      $font->align('center');
      $font->valign('top');
    });

    $date = Carbon::now()->toDateString();
    $time = str_replace(':', '_',Carbon::now()->toTimeString());
    $filename = $date.'_'.$time.'.png';
    $image->save(storage_path('/app/images/'.$filename));

    $this->response['data'] = '/storage/image/'.$filename;
    return $this->response();
  }

  public function generateText(Request $request){
    $data = $request->all();
    $headers[] = 'X-Api-Key: bM8sWJwKCyPegpgY3GJGY9Wd7aaV7RsCxnPWQeprrc3Pb9NnuAFAuhBseUJH52Fd';
    $endpoint = 'https://openai.askthepros.com/api/v1/generate';
    $res = HTTP::withHeaders([
      'X-Api-Key' => 'bM8sWJwKCyPegpgY3GJGY9Wd7aaV7RsCxnPWQeprrc3Pb9NnuAFAuhBseUJH52Fd'
    ])->post($endpoint, [
      "company_industry" => $data['company_industry'],
      "company_location" => $data['company_location'],
      "company_name" => $data['company_name'],
      "employee_name" => $data['employee_name'],
      "entity" => $data['entity']
    ]);    
    return $res;
  }

  public function generateAnswer(Request $request){
    $data = $request->all();
    $headers[] = 'X-Api-Key: bM8sWJwKCyPegpgY3GJGY9Wd7aaV7RsCxnPWQeprrc3Pb9NnuAFAuhBseUJH52Fd';
    $endpoint = 'https://openai.askthepros.com/api/v1/qa';
    $res = HTTP::withHeaders([
      'X-Api-Key' => 'bM8sWJwKCyPegpgY3GJGY9Wd7aaV7RsCxnPWQeprrc3Pb9NnuAFAuhBseUJH52Fd'
    ])->post($endpoint, ['question' => $data['question']]);    
    return $res;
  }
}
