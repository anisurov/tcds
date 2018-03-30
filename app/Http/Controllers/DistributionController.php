<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Notify;
use App\Semester;
use App\CourseRequest;
use App\CourseToTeacher;
use App\Teacher;
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
      if(Semester::where('semester_id',$request->semester)->pluck('semesterStatus')->first()==1){
        $day=date("Y-m-d");
        if(Notify::where('semester_id',$request->semester)->where('status',1)->where('end_date','>',$day)->count()>0){
          return redirect(route('profile'))->withFailed('Already notified!!');
        }
      $notify = new Notify();
      $notify->semester_id = $request->semester;
      $notify->start_date = $request->startDate;
      $notify->end_date = $request->endDate;
      $semester  = Semester::where('semester_id',$request->semester)->pluck('semesterName')->first();
      if($notify->save()){
        $this->notifyThroughmail($semester,$request->endDate);
  			return redirect(route('profile'))->withSuccess('Notification Added Successfully');
  		}else {
  			return redirect(route('profile'))->withFailed('Notification Add Failed!!');
  		}
    }else {
      return redirect(route('profile'))->withFailed('Semester is not active!!');
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
                  //echo $notify_id;

                }else {
                  return redirect(route('profile'))->withFailed('sorry!! Error Occured');
                }
              }
            }else {
              $requestd_course=DB::table('course')->select('course.courseName as courseName', 'course.courseIdentity as id', 'course.courseCredit as credit', 'course.contactHrs as hrs', 'course_request.section as section','course_request.teacher_id as teacher_id','course_request.id as request_id')->join('course_request', 'course.course_id', '=', 'course_request.course_id')->where('course_request.semester_id', $id)->where('status', 1)->get();
              return view('admin.distribution.requested',compact('requestd_course','semester'));
              }
        }else {
          return redirect(route('profile'))->withFailed('Requests already approved');
        }
      }else {
        return redirect(route('profile'))->withFailed('Your requested semester is not active!!');
      }
    }

    public function indvidual_approve(Request $request)
    {
      $request_id = $request->request_id;
      $course_requests=CourseRequest::where('id', $request_id)->where('status', 1)->get();
          if ($course_requests) {

            $Coursetoteacher = new CourseToTeacher();

            foreach ($course_requests as $course) {

              $Coursetoteacher->semester_id=$course->semester_id;
              $Coursetoteacher->course_id=$course->course_id;
              $Coursetoteacher->t_id=$course->teacher_id;
              $Coursetoteacher->section=$course->section;

            }
            if ($Coursetoteacher->save()) {
              if(CourseRequest::where('id', $request_id)->update(['status'=>7]))
                return redirect(route('profile'))->withSuccess('Request approve successfully');
              else {
                return redirect(route('profile'))->withFailed('Request approve Failed');
              }
            }
      }
      else {
        return redirect(route('profile'))->withFailed('Error Occured!!');
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


    public function notifyThroughmail($semester_name,$end_date)
    {
         $title = $semester_name;
        $content = $end_date;
        foreach(Teacher::select('t_email')->get() as $teacher){
          $username = $teacher->t_email;
        Mail::send('emails.notify',['title'=>$title,'content'=>$content],function ($message) use ($username)
        {

          $message->from('no-reply@tcdsystem.com', 'Administrator');

            $message->to($username);

           // $message->attach($attach);

            $message->subject("Course Distribution System - Request for course choice list");

        });
      }

    }
}
