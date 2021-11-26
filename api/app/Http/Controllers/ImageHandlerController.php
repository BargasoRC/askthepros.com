<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    $postId = $data['id'];

    $width       = 400;
    $height      = 400;
    $center_x    = $width / 2;
    $center_y    = $height / 2;
    $max_len     = 36;
    $font_size   = 42;
    $font_height = 30;
    $backgroundColor = '#01009A';

    $image = Image::canvas($width, $height);
    $image->fill($backgroundColor);


    $y = $center_y - (1 * $font_height);
    $image->text($category, $center_x, 100, function($font) use ($font_size) {
      $font->file(public_path('font/OpenSans-Regular.ttf'));
      $font->size($font_size);
      $font->color('#ffffff');
      $font->align('center');
      $font->valign('top');
    });

    $image->text($question, $center_x, $y, function($font) use ($font_size) {
      $font->file(public_path('font/OpenSans-Regular.ttf'));
      $font->size($font_size - 10);
      $font->color('#ffffff');
      $font->align('center');
      $font->valign('top');
    });

    $date = Carbon::now()->toDateString();
    $time = str_replace(':', '_',Carbon::now()->toTimeString());
    $filename = $postId.'_'.$date.'_'.$time.'.png';
    $image->save(storage_path('/app/images/'.$filename));

    $this->response['data'] = '/storage/image/'.$filename;
    return $this->response();
  }
}
