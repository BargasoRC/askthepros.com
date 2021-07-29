<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndustryController extends APIController
{
    //
    public function retrieve(Request $request) {
        $data = $request->all();
        $result = \DB::table('payloads')
        ->where('category', $data['condition'][0]['value'])
        ->get();
        $this->response['data'] = $result;
        return $this->response();
    }
}
