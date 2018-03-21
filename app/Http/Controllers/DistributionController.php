<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Notify;
use App\Semester;
use App\CourseRequest;
use App\CourseToTeacher;
use DB;

class DistributionController extends Controller
{
    public function notifyForm()
    {
      return view('admin.distribution.notify');
    }

    public function notify(Request $request)
    {
      $this->validator($request->all());
      $notify = new Notify();
      $notify->semester_id = $request->semester;
      $notify->start_date = $request->startDate;
      $notify->end_date = $request->endDate;
      if($notify->save()){
  			return redirect(route('profile'))->withSuccess('Notification Added Successfully');
  		}else {
  			return redirect(route('profile'))->withFailed('Notification Add Failed!!');
  		}
    }

    public function active()
    {
      $data = Semester::where('semesterStatus','!=','13')->where('semesterStatus','!=','0')->paginate(10);
  		//var_dump($data);
  		return view('admin.distribution.all',compact('data'));
    }

    public function approve(Request $request)
    {
      $id = $request->semester_id;
      $status  = Semester::where('semester_id',$id)->pluck('semesterStatus')->first();
      $semester  = Semester::where('semester_id',$id)->pluck('semesterName')->first();
      if ($status==1) {
        $end_date = Notify::where('semester_id',$id)->where('status',1)->pluck('end_date')->first();
        $notify_id = Notify::where('semester_id',$id)->where('status',1)->pluck('id')->first();
        $today = date("Y-m-d");
        if($end_date){
        if ($end_date<$today) {
          $course_requests=CourseRequest::where('semester_id', $id)->where('status', 1)->get();
              if ($course_requests) {
                $count=$course_requests->count();
                $checker=0;
                foreach ($course_requests as $course) {
                  $Coursetoteacher = new CourseToTeacher();
                  $Coursetoteacher->semester_id=$id;
                  $Coursetoteacher->course_id=$course->course_id;
                  $Coursetoteacher->t_id=$course->teacher_id;
                  $Coursetoteacher->section=$course->section;
                  if ($Coursetoteacher->save()) {
                    if(CourseRequest::where('semester_id', $id)->where('course_id', $course->course_id)->where('teacher_id', $course->teacher_id)->where('section', $course->section)->update(['status'=>7]))
                    $checker=$checker+1;
                  }
                }
                if($count==$checker){
                  if(Notify::where('semester_id',$id)->where('id',$notify_id)->update(['status'=>0]))
                    return redirect(route('profile'))->withSuccess('all requests approved successfully');
                  echo $notify_id;

                }else {
                  return redirect(route('profile'))->withFailed('sorry!! Error Occured');
                }
              }
            }else {
              $requestd_course=DB::table('course')->select('course.courseName as courseName', 'course.courseIdentity as id', 'course.courseCredit as credit', 'course.contactHrs as hrs', 'course_request.section as section','course_request.teacher_id as teacher_id')->join('course_request', 'course.course_id', '=', 'course_request.course_id')->where('course_request.semester_id', $id)->where('status', 1)->get();
              return view('admin.distribution.requested',compact('requestd_course','semester'));
              }
        }else {
          return redirect(route('profile'))->withFailed('Requests already approved');
        }
      }else {
        return redirect(route('profile'))->withFailed('Your requested semester is not active!!');
      }
    }

    protected function validator(array $data)
  	{
  	    return Validator::make($data, [
  					'semester' => 'required|numeric',
  					'semester_name' => 'regex:/[A-Z]-(\d{4})$/|max:20',
  	        'startDate' => 'required|date',
  	        'endDate' => 'required|date|after:startDate',
  	    ])->validate();
  	}
}
