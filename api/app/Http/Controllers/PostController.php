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
    public $brandingClass = 'App\Http\Controllers\BrandingController'; 

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

            \DB::commit();

            $this->response['data'] = $post->id;
            $this->response['error'] = null;
        }catch(\Exception $e){
            \DB::rollback();
            $this->response['data'] = null;
            $this->response['error'] = $e->getMessage();
            $this->response['error_status'] = $e->getCode();
        }
        return $this->response();
    }

    public function retrieve(Request $request) {
        $data = $request->all();
        if($data['edit'] === true){
          $result = Post::leftJoin('post_targets', 'posts.id', '=', 'post_targets.post_id')
            ->leftJoin('accounts', 'accounts.id', '=', 'posts.account_id')
            ->select('posts.*', 'post_targets.payload_value as category', 'accounts.username as author')
            ->where('posts.id', '=', $data['id'])
            ->get();
        }else{
          $result = Post::leftJoin('post_targets', 'posts.id', '=', 'post_targets.post_id')
            ->leftJoin('accounts', 'accounts.id', '=', 'posts.account_id')
            ->select('posts.*', 'post_targets.payload_value as category', 'accounts.username as author')
            ->get();
        }
        $this->response['data'] = $result;
        $this->response['error'] = null;
        return $this->response();
    }

    public function delete(Request $request) {
      $data = $request->all();
      $result = Post::where('posts.id', '=', $data['id'])
        ->update(array('deleted_at' => Carbon::now()));
      return $result;
    }

    public function retrieveByUser(Request $request) {
      $data = $request->all();
      $result = Post::leftJoin('post_targets', 'posts.id', '=', 'post_targets.post_id')
              ->leftJoin('accounts', 'accounts.id', '=', 'posts.account_id')
              ->select('posts.*', 'post_targets.payload_value as category', 'accounts.username as author')
              ->where('posts.account_id', '=', $data['account_id'])
              ->get();
      $this->response['data'] = $result;
      $this->response['error'] = null;
      return $this->response();
    }

    public function retrieveById(Request $request) {
      $data = $request->all();
      $result = Post::leftJoin('post_targets', 'posts.id', '=', 'post_targets.post_id')
              ->leftJoin('accounts', 'accounts.id', '=', 'posts.account_id')
              ->select('posts.*', 'post_targets.payload_value as category', 'accounts.username as author')
              ->where('posts.id', '=', $data['id'])
              ->get();
      $i = 0;
      foreach ($result as $key) {
        $result[$i]['branding'] = app($this->brandingClass)->retrieveByAccountId($data['account_id']);
        $i++;
      }
      $this->response['data'] = $result;
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
