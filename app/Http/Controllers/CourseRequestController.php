<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Semester;
use App\CourseRequest;
use App\Course;
use App\CourseToTeacher;
use App\Teacher;
use App\Notify;
use DB;

class CourseRequestController extends Controller
{
    public function addform(Request $request)
    {
      $semester_id = $request->semester_id;
      $data=Semester::where('semester_id',$semester_id)->get();
      foreach($data as $semester){
        $status = $semester->semesterStatus;
      }
      if ($status==1) {
        return view('teacher.course.add',compact('data'));
      }
      else {
        return redirect(route('profile'))->withFailed('sorry!!Error Occured');
      }
    }


    public function add(Request $request)
    {
      $this->validator($request->all());
      $semester_id = $request->semester_id;
      $teacher_id = $request->teacher_id;
      $course_id = $request->course_name;
      $section = $request->section;
      if(Notify::where('semester_id',$semester_id)->where('status',1)->count()<=0)
        return redirect(route('profile'))->withFailed('sorry!!Internal error Occured');

        $requestd = DB::table('course')
                  ->select(DB::raw('sum(course.courseCredit) as takenCredit'))->join('course_request', 'course.course_id', '=', 'course_request.course_id')->where('course_request.semester_id', $semester_id)->where('course_request.teacher_id', $teacher_id)->whereIn('status',[1,7])->get();
      $theroy_credit = DB::table('course')->select(DB::raw('sum(course.courseCredit)  as credit'))->where('course.courseType','core')->where('course.category','theory')->join('course_request', 'course.course_id', '=', 'course_request.course_id')->where('course_request.semester_id', $semester_id)->where('course_request.teacher_id', $teacher_id)->whereIn('status',[1,7])->get();


      $teacher_data= Teacher::where('t_id',$teacher_id)->get();
      foreach($teacher_data as $teacher){
        $designation=$teacher->t_designation;
        $joining_date=$teacher->joining_date;
        $promotion_date=$teacher->promotion_date;
        $busy=$teacher->is_busy;
      }
      if($designation=='Assistant Professor'){
        $priority=3;
        if ($busy == 'yes') {
          $must_take_credit=9;
        }else {
          $must_take_credit=15;
        }
        $quotaCredit=21;
      }
      else if($designation=='Associate Professor'){
        $priority=2;
        $must_take_credit=12;
        $quotaCredit=18;
      }
      else if($designation=='Lecturer'){
        $priority=1;
        $must_take_credit=12;
        $quotaCredit=18;
      }
      foreach($theroy_credit as $value){
        $theoryCredit = $value->credit;
      }

      foreach($requestd as $value){
        $takenCredit = $value->takenCredit;
      }
      if($takenCredit>=$quotaCredit){
        return redirect(route('profile'))->withFailed('sorry!!Your qouta limit already reached . you have taken '.$takenCredit.' Credit');
      }

      $course_requests=CourseRequest::where(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id])->whereIn('status',[1,7])->get();
    //  var_dump($course_requests);
      if ($course_requests) {
        $checker=0;
        $count=$course_requests->count();
        foreach($course_requests as $course_request){
          if($course_request->status==1){
          if ($course_request->priority>$priority) {
            return redirect(route('profile'))->withFailed('sorry!!This course already requested');
          }
          if ($course_request->priority<$priority) {
            CourseRequest::where(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id,'teacher_id'=>$course_request->teacher_id])->update(['status'=>0]);
          }

          if ($course_request->priority==$priority) {
            if (Teacher::where('t_id',$course_request->teacher_id)->pluck('joining_date')->first()<$joining_date) {
              CourseRequest::where(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id,'teacher_id'=>$course_request->teacher_id])->update(['status'=>0]);

            }
            else {
              return redirect(route('profile'))->withFailed('sorry!!This course already requested');
            }

            if (Teacher::where('t_id',$course_request->teacher_id)->pluck('promotion_date')->first()<$promotion_date) {
              CourseRequest::where(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id,'teacher_id'=>$course_request->teacher_id])->update(['status'=>0]);
            }
            else {
              return redirect(route('profile'))->withFailed('sorry!!This course already requested');
            }
          }
        }else if ($course_request->status==7) {

          if ($course_request->priority>$priority) {
            return redirect(route('profile'))->withFailed('sorry!!This course already alloated');
          }
          if ($course_request->priority<$priority) {
            CourseRequest::where(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id,'teacher_id'=>$course_request->teacher_id])->update(['status'=>0]);

            CourseRequest::insert(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id,'teacher_id'=>$course_request->teacher_id,'status'=>7,'priority'=>$priority]);

            if(CourseToTeacher::where(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id,'t_id'=>$course_request->teacher_id])->update(['t_id'=>$teacher_id]))
            return redirect(route('profile'))->withSuccess('course alloated successfully');
          }

          if ($course_request->priority==$priority) {
            if (Teacher::where('t_id',$course_request->teacher_id)->pluck('joining_date')->first()<$joining_date) {
              CourseRequest::where(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id,'teacher_id'=>$course_request->teacher_id])->update(['status'=>0]);

              CourseRequest::insert(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id,'teacher_id'=>$course_request->teacher_id,'status'=>7,'priority'=>$priority]);

              if(CourseToTeacher::where(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id,'t_id'=>$course_request->teacher_id])->update(['t_id'=>$teacher_id]))
              return redirect(route('profile'))->withSuccess('course alloated successfully');
            }
            else {
              return redirect(route('profile'))->withFailed('sorry!!This course already alloted');
            }

            if (Teacher::where('t_id',$course_request->teacher_id)->pluck('promotion_date')->first()<$joining_date) {
              CourseRequest::where(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id,'teacher_id'=>$course_request->teacher_id])->update(['status'=>0]);

              CourseRequest::insert(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id,'teacher_id'=>$course_request->teacher_id,'status'=>7,'priority'=>$priority]);

              if(CourseToTeacher::where(['course_id'=>$course_id,'section'=>$section,'semester_id'=>$semester_id,'t_id'=>$course_request->teacher_id])->update(['t_id'=>$teacher_id]))
              return redirect(route('profile'))->withSuccess('course alloated successfully');
            }
            else {
              return redirect(route('profile'))->withFailed('sorry!!This course already alloted');
            }
          }

          return redirect(route('profile'))->withFailed('sorry!!This course already alloted');
        }

        }
      }
    $store_course_request = new CourseRequest();
    $store_course_request->course_id=$course_id;
    $store_course_request->section=$section;
    $store_course_request->teacher_id=$teacher_id;
    $store_course_request->semester_id=$semester_id;
    $store_course_request->priority=$priority;
    $thisTheoryCredit=Course::where('course_id',$course_id)->where('category','theory')->pluck('courseCredit')->first();
    if ($thisTheoryCredit) {
      $theoryCredit=$thisTheoryCredit+$theoryCredit;
    }
    $takenCredit= $takenCredit+Course::where('course_id',$course_id)->pluck('courseCredit')->first();
    if($store_course_request->save()){
      if(($must_take_credit-$takenCredit)>0){
        if((6-$theoryCredit)>0){
          $extraMsg='Including '.(6-$theoryCredit).' credit theory';
        }else {
          $extraMsg='';
        }
      return redirect(route('profile'))->withSuccess('Course request Successful.You need to take '.($must_take_credit-$takenCredit).' more credit.'.$extraMsg);
    }
      else {
        return redirect(route('profile'))->withSuccess('Course request Successful.You can  take 6 extra credit');
      }
    }else {
      return redirect(route('profile'))->withFailed('Course request Failed!!');
    }

    }

    protected function validator(array $data)
  	{
  	    return Validator::make($data, [
  					'semester_id' => 'required|numeric',
  					'teacher_id' => 'required|numeric',
  					'course_name' => 'required|numeric',
  					'section' => 'required',
  	    ])->validate();
  	}
}
