<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Increment\Common\Image\Models\Image;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FileUploadController extends APIController
{
    //

    public function upload(Request $request){
        /**
         * Method for uploading multiple files 
        */
        $data = $request->all();
        $data['file_url'] = explode(",", $data['file_url']);
        if(isset($data['file_url'])){
          $values = [];
          for($i = 0; $i < sizeof($data['file_url']); $i++){
            $date = Carbon::now()->toDateString();
            $time = str_replace(':', '_',Carbon::now()->toTimeString());
            $ext =$request->file('file' . $i)->extension();
            $filename = $data['account_id'].'_'.$date.'_'.$time.'_'.$data['file_url'][$i];
            $result = $request->file('file' . $i)->storeAs('images', $filename);
            $url = '/storage/image/'.$filename;
            array_push($values, array(
              'account_id'    => $data['account_id'],
              'url'           => $url,
              'category'      => isset($data['category']) ? $data['category'] : null
            ));
          }


          $_response = array_map(function($val) {
            return $val['url'];
          }, $values);
          // $response = []
          // foreach ($values as $key => $value) {
          //   $response[] = $value['url'];
          // }



          // Image::insert($values);
          $this->response['data'] = $_response;
          return $this->response();
        }
        return response()->json(array(
          'data'  => null,
          'error' => null,
          'timestamps' => Carbon::now()
        ));
      }
}
