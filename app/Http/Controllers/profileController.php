<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $email = Auth::user()->email;
    $check= Auth::user()->check;
    echo "AAA".$check."<br>";
    if($check==0){
      return view('admin');
    }
    if($check==1){
    echo 'teacher';
    }
  }
}
