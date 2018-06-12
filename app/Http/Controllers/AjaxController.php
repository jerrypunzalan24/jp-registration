<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
  public function getEditData(Request $request){
    $response_data = \DB::select("SELECT * FROM members WHERE member_id = {$request->id}");
    return $response_data;
  }    
}
