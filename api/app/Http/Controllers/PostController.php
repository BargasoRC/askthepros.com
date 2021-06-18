<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostTarget;
use App\PostHistory;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Increment\Common\Image\Models\Image;

class PostController extends APIController
{
    //

    public function create(Request $request) {
        $data = $request->all();
        \DB::beginTransaction();
        try{

            $post = new Post();
            $post->code = $this->generateCode($post);
            $post->parent = $data['parent'];
            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->channels = $data['channels'];
            $post->url = $data['url'];
            $post->account_id = $data['account_id'];
            $post->status = $data['status'];
            $post->save();

            $post_target = new PostTarget();
            $post_target->code = $this->generateCode($post_target);
            $post_target->post_id = $post->id;
            $post_target->payload = 'INDUSTRY';
            $post_target->payload_value = $data['category'];
            $post_target->save();

            $post_history = new PostHistory();
            $post_history->code = $this->generateCode($post_history);
            $post_history->post_id = $post->id;
            $post_history->link = null;
            $post_history->page_id = null;
            $post_history->page_id = $data['account_id'];
            $post_history->status = 'PUBLISHED';
            $post_history->save();

            \DB::commit();

            $this->response['data'] = 'posted_successfully';
            $this->response['error'] = null;
        }catch(\Exception $e){
            \DB::rollback();
            $this->response['data'] = null;
            $this->response['error'] = $e->getMessage();
            $this->response['error_status'] = $e->getCode();
        }
        return $this->response();
    }

    public function generateCode($db){
        $code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);
        $codeExist = $db::where('code', '=', $code)->get();
        if(sizeof($codeExist) > 0){
          $this->generateCode();
        }else{
          return $code;
        }
      }
}
