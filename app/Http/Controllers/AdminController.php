<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request){
      if($request->password =='jpcs'){
        $request->session()->put('login',true);
        return redirect('/admin');
      }
      return view('adminside.login');
    }
    public function logout(Request $request){
      $request->session()->flush();
      return redirect('/login');
    }
    public function index(){
      $members = \DB::select("SELECT * FROM members");
      return view('adminside.index',['members' => $members]);
    }
    public function edit(Request $request){
      \DB::table('members')->where('member_id',$request->id)->update([
        'member_firstname'     => $request->firstname,
        'member_lastname'      => $request->lastname,
        'member_gender'        => $request->gender,
        'member_studentnumber' => $request->studentnumber,
        'member_course'        => $request->course,
        'member_number'        => $request->mobilenumber,
        'updated_at'           => date("Y-m-d H:i:s")
      ]);
      return redirect('/admin')->with('edit-success','Member updated successfully!');
    }
    public function delete(Request $request){
      \DB::table('members')->where('member_id',$request->id)->delete();
      \DB::table('questions')->where('member_id', $request->id)->delete();
      return redirect('/admin')->with('edit-success','Member has been deleted! Goodbye :(');
    }
}
