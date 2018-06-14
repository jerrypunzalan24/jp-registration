<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Codedge\Fpdf\Facades\Fpdf;
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
  public function print(){
    $members = \DB::table('members')->orderByRaw('member_id DESC')->get();
    Fpdf::AddPage("P");
    Fpdf::Image('./img/report-bg.jpg',0,0,210,290);
    Fpdf::SetFont('Arial',"", 14);
    Fpdf::Cell(0,30,"Report created - " . date("F d, Y g:i A (l)"),0,0,'C');
    Fpdf::Ln();
    Fpdf::SetFont('Arial',"B", 10);
    Fpdf::Cell(50,10,'Fullname',1,0,'C');
    Fpdf::Cell(30,10,'Student number',1,0,'C');
    Fpdf::Cell(30,10,'Contact',1,0,'C');
    Fpdf::Cell(25,10,'Course',1,0,'C');
    Fpdf::Cell(20,10,'Gender',1,0,'C');
    Fpdf::Cell(35,10,'Date Registered',1,0,'C');
    Fpdf::Ln();
    Fpdf::SetFont("Arial","",10);
    $count = 0;
    foreach($members as $member){
      Fpdf::Cell(50,10, "{$member->member_firstname} {$member->member_lastname}",1,0,'C');
      Fpdf::Cell(30,10, $member->member_studentnumber,1,0,'C');
      Fpdf::Cell(30,10,$member->member_number,1,0,'C');
      Fpdf::Cell(25,10,strtoupper($member->member_course),1,0,'C');
      Fpdf::Cell(20,10,$member->member_gender ? "Female" : "Male" ,1,0,'C');
      Fpdf::Cell(35,10, $member->created_at, 1,0,'C');
      Fpdf::Ln();
      $count++;
      if($count%20==0){
        Fpdf::AddPage();
        Fpdf::Cell(0,30,"",0,0,'C');
        Fpdf::Ln();
        Fpdf::Image('./img/report-bg.jpg',0,0,210,290);
      }
    }
    return response(Fpdf::Output(),200)->header("Content-type", "application/pdf");
  }
  public function index(){
    $members = \DB::table('members')->orderByRaw('member_id DESC')->get();
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
