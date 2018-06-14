<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class HomeController extends Controller
{
  public function index(){
    $checkboxes = array(
      'ai'          => 'Artificial Intelligence',
      'ar'          => 'AR/VR/Technology',
      'esports'     => 'Esports',
      'programming' => 'Programming Languages',
      'games'       => 'Games',
    );
    return view('index',['checkboxes' => $checkboxes]);
  }
  public function create(Request $request){
    \DB::table('members')->insertgetId([
      'member_firstname'     => $request->firstname,
      'member_lastname'      => $request->lastname,
      'member_gender'        => $request->gender,
      'member_studentnumber' => $request->studentnumber,
      'member_course'        => $request->course,
      'member_number'        => $request->mobilenumber,
      'created_at'           => date("Y-m-d H:i:s"),
      'updated_at'           => date("Y-m-d H:i:s")
    ]);
    $get_latest_id = \DB::table('members')->max('member_id');
    \DB::table('questions')->insertgetId([
      'member_id'        => $get_latest_id,
      'question_number'  => 1,
      'question_content' => $request->question1
    ]);
    if(count($request->question2) != 0){
      foreach($request->question2 as $question){
        \DB::table('questions')->insertgetId([
          'member_id'        => $get_latest_id,
          'question_number'  => 2,
          'question_content' => $question
        ]);
      }
    }
    if($request->others !== null){
      \DB::table('questions')->insertgetId([
        'member_id'        => $get_latest_id,
        'question_number'  => 2,
        'question_content' => $request->others
      ]);
    }
    return redirect('/')->with('success',$request->firstname);
  }
}
