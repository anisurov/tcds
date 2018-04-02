<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;

class teacherController extends Controller
{
    public function all()
    {
      $data = Teacher::paginate(10);
      return view('admin.teacher.all',compact('data'));
    }

    public function individual(Request $request)
    {
      $teacher_id = $request->teacher_id;
      $teacher = Teacher::where('t_id',$teacher_id)->get();
      return view('teacher.profile',compact('teacher'));
    }
}
