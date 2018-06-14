<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
  public function getEditData(Request $request){
    $response_data = \DB::select("SELECT * FROM members WHERE member_id = {$request->id}");
    return $response_data;
  }
  public function getQuestionData(Request $request){
    $response_data = array();
    $response_data['seminars'] = count(\DB::table('questions')->whereRaw("question_number = 1 && question_content  = 'seminars'")->get());
    $response_data['competitions'] = count(\DB::table('questions')->whereRaw("question_number = 1 && question_content  = 'competitions'")->get());
    $response_data['ai'] = count(\DB::table('questions')->whereRaw("question_number = 2 && question_content  = 'ai'")->get());
    $response_data['ar'] = count(\DB::table('questions')->whereRaw("question_number = 2 && question_content  = 'ar'")->get());
    $response_data['esports'] = count(\DB::table('questions')->whereRaw("question_number = 2 && question_content  = 'esports'")->get());
    $response_data['programming'] = count(\DB::table('questions')->whereRaw("question_number = 2 && question_content  = 'programming'")->get());
    $response_data['games'] = count(\DB::table('questions')->whereRaw("question_number = 2 && question_content  = 'games'")->get());
    $response_data['others'] = count(\DB::table('questions')
      ->whereRaw("question_number = 2 && question_content != 'ai' && question_content != 'ar' && question_content != 'esports' && question_content != 'programming' && question_content != 'games'")
      ->get());
    $response_data['topic_list'] = \DB::table('questions')->select(\DB::raw("question_content, COUNT(*) as num"))
      ->whereRaw("question_number = 2 && question_content != 'ai' && question_content != 'ar' && question_content != 'esports' && question_content != 'programming' && question_content != 'games'")
      ->groupBy('question_content')
      ->get();
    return $response_data;
  }    
}
