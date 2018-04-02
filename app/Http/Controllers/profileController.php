<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Teacher;
use App\Semester;

class profileController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $check= Auth::user()->check;
   // echo "AAA".$check."<br>";
    if($check==0){
      return view('admin');
    }
    if($check==1){
      $email = Auth::user()->email;
      $teacher = Teacher::where('t_email',$email)->get();
      $semester = Semester::where('semesterStatus',1)->get();
      return view('teacher',compact('teacher','semester'));
    }
  }

  public function teacher(){
    $check= Auth::user()->check;
   // echo "AAA".$check."<br>";
    if($check==0){
      return view('admin');
    }
    if($check==1){
      $email = Auth::user()->email;
      $teacher = Teacher::where('t_email',$email)->get();
      return view('teacher.profile',compact('teacher'));
    }
  }
}
