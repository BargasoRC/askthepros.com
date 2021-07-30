<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostTarget;
use App\PostHistory;
use App\Page;
use App\Http\Controllers\Account;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Increment\Common\Image\Models\Image;

class PostController extends APIController
{
    //
    public $brandingClass = 'App\Http\Controllers\BrandingController';
    public $historyClass = 'App\Http\Controllers\PostHistoryController';
    public $pageClass = 'App\Http\Controllers\PageController';
    public $accountClass = 'App\Http\Controllers\AccountsController';

    public function create(Request $request) {
        $data = $request->all();
        \DB::beginTransaction();
        try{
          // app($this->accountClass)->retrieveWithUpdate($data);

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
        $con = $data['condition'];

        $result = Post::leftJoin('post_targets', 'posts.id', '=', 'post_targets.post_id')
        ->leftJoin('accounts', 'accounts.id', '=', 'posts.account_id')
        ->select('posts.*', 'post_targets.payload_value as category', 'accounts.username as author')
        ->where('posts.'.$con[0]['column'], $con[0]['clause'], $con[0]['value'])
        ->limit($data['limit'])
        ->offset($data['offset'])->orderBy(array_keys($data['sort'])[0], array_values($data['sort'])[0])->get();

        $size = Post::leftJoin('post_targets', 'posts.id', '=', 'post_targets.post_id')
        ->leftJoin('accounts', 'accounts.id', '=', 'posts.account_id')
        ->select('posts.*', 'post_targets.payload_value as category', 'accounts.username as author')
        ->where('posts.'.$con[0]['column'], $con[0]['clause'], $con[0]['value'])
        ->orderBy(array_keys($data['sort'])[0], array_values($data['sort'])[0])->get();

        $i = 0;
        foreach ($result as $key) {
          $result[$i]['branding'] = app($this->brandingClass)->retrieveByAccountId($data['account_id']);
          $result[$i]['created_at_human'] = Carbon::createFromFormat('Y-m-d H:i:s', $result[$i]['created_at'])->copy()->tz($this->response['timezone'])->format('F j, Y h:i A');
          $i++;
        }
        $this->response['data'] = $result;
        $this->response['size'] = count($size);
        $this->response['error'] = null;
        return $this->response();
    }


    public function retrieveByCode(Request $request) {
        $data = $request->all();
        $result = Post::leftJoin('post_targets', 'posts.id', '=', 'post_targets.post_id')
        ->leftJoin('accounts', 'accounts.id', '=', 'posts.account_id')
        ->select('posts.*', 'post_targets.payload_value as category', 'accounts.username as author')
        ->where('posts.code', '=', $data['code'])
        ->get();

        $i = 0;
        foreach ($result as $key) {
          $result[$i]['branding'] = app($this->brandingClass)->retrieveByAccountId($data['account_id']);
          $i++;
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

    public function update(Request $request){
      $data = $request->all();
      $id = Post::where('code', '=', $data['code'])->get('id');
      Post::where('code', '=', $data['code'])->update(array(
        'title' => $data['title'],
        'parent' => null,
        'description' => $data['description'],
        'channels' => $data['channels'],
        // 'url' => $data['url'],
        'account_id' => $data['account_id'],
        'status' => $data['status'],
        'updated_at' => Carbon::now()
      ));
      if($data['category'] != null){
        PostTarget::where('post_id', '=', $id[0]['id'])->update(array(
          'payload_value' => $data['category'],
          'updated_at' => Carbon::now()
        ));
      }
      $this->response['data'] = true;
      return $this->response();
    }

    public function updateExpert(Request $request){
      $data = $request->all();
      $id = Post::where('code', '=', $data['code'])->get('id');
      Post::where('code', '=', $data['code'])->update(array(
        'title' => $data['title'],
        'parent' => null,
        'description' => $data['description'],
        'channels' => $data['channels'],
        'account_id' => $data['account_id'],
        'status' => $data['status'],
        'updated_at' => Carbon::now()
      ));
      if($data['category'] != null){
        PostTarget::where('post_id', '=', $id[0]['id'])->update(array(
          'payload_value' => $data['category'],
          'updated_at' => Carbon::now()
        ));
      }
      $this->response['data'] = true;
      return $this->response();
    }

    public function retrieveByUser(Request $request) {
      $data = $request->all();
      $con = $data['condition'];

        $result = Post::leftJoin('post_targets', 'posts.id', '=', 'post_targets.post_id')
        ->leftJoin('accounts', 'accounts.id', '=', 'posts.account_id')
        ->select('posts.*', 'post_targets.payload_value as category', 'accounts.username as author')
        ->where('posts.account_id', '=', $data['account_id'])
        ->where('posts.'.$con[0]['column'], $con[0]['clause'], $con[0]['value'])
        ->limit($data['limit'])
        ->offset($data['offset'])->orderBy(array_keys($data['sort'])[0], array_values($data['sort'])[0])->get();

        $size = Post::leftJoin('post_targets', 'posts.id', '=', 'post_targets.post_id')
        ->leftJoin('accounts', 'accounts.id', '=', 'posts.account_id')
        ->select('posts.*', 'post_targets.payload_value as category', 'accounts.username as author')
        ->where('posts.account_id', '=', $data['account_id'])
        ->where('posts.'.$con[0]['column'], $con[0]['clause'], $con[0]['value'])
        ->get();

        $i = 0;
        foreach ($result as $key) {
          $result[$i]['created_at_human'] = Carbon::createFromFormat('Y-m-d H:i:s', $result[$i]['created_at'])->copy()->tz($this->response['timezone'])->format('F j, Y ');
          $result[$i]['time'] = Carbon::createFromFormat('Y-m-d H:i:s', $result[$i]['created_at'])->copy()->tz($this->response['timezone'])->format('h:i A');
          $i++;
        }

        $this->response['data'] = $result;
        $this->response['size'] = count($size);
        $this->response['error'] = null;
        return $this->response();
    }

    public function retrieveById(Request $request) {
      $data = $request->all();
      $result = Post::leftJoin('post_targets', 'posts.id', '=', 'post_targets.post_id')
              ->leftJoin('accounts', 'accounts.id', '=', 'posts.account_id')
              ->select('posts.*', 'post_targets.payload_value as category', 'accounts.username as author')
              ->where('posts.code', '=', $data['code'])
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

    public function retrieveByCodeParams($id) {
      $result = Post::leftJoin('post_targets', 'posts.id', '=', 'post_targets.post_id')
              ->leftJoin('accounts', 'accounts.id', '=', 'posts.account_id')
              ->select('posts.*', 'post_targets.payload_value as category', 'accounts.username as author')
              ->where('posts.id', '=', $id)
              ->get();
      return $result;
    }

    public function retrieveHistoryPosts(Request $request){
      $data = $request->all();
      $con = $data['condition'];
      $contains = Str::contains($data['status'], 'post');
      $result = PostHistory::where('account_id', '=', $data['account_id'])
      ->where('status', '=', ($contains ? ('for posting') : ('for review')))
      ->where($con[0]['column'], $con[0]['clause'], $con[0]['value'])
      ->limit($data['limit'])
      ->offset($data['offset'])->orderBy(array_keys($data['sort'])[0], array_values($data['sort'])[0])->get();

      $size = PostHistory::where('account_id', '=', $data['account_id'])
      ->where('status', '=', ($contains ? ('for posting') : ('for review')))
      ->where($con[0]['column'], $con[0]['clause'], $con[0]['value'])
      ->orderBy(array_keys($data['sort'])[0], array_values($data['sort'])[0])->get();

      $i = 0;
      foreach ($result as $key) {
        $result[$i]['post'] = $this->retrieveByCodeParams($result[$i]['post_id']);
        $result[$i]['date'] = Carbon::createFromFormat('Y-m-d H:i:s', $result[$i]['created_at'])->copy()->tz($this->response['timezone'])->format('F j, Y ');
        $result[$i]['time'] = Carbon::createFromFormat('Y-m-d H:i:s', $result[$i]['created_at'])->copy()->tz($this->response['timezone'])->format('h:i A');
        $i++;
      }
      $this->response['data'] = $result;
      $this->response['size'] = count($size);
      $this->response['error'] = null;
      return $this->response();
    }

}
