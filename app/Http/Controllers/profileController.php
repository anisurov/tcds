<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Teacher;

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
//      var_dump($teacher);
      return view('teacher',compact('teacher'));
    }
  }
}
