<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Course;

class CourseController extends Controller
{
	public function index(){
		$data = Course::paginate(10);
		//var_dump($data);
		return view('admin.course.all',compact('data'));
	}

	public function edit(Request $request){
		$data = Course::where('course_id',$request->course_id)->get();
		//var_dump($data);
		return view('admin.course.edit',compact('data'));
	}

	public function add(Request $request){
		$this->validator($request->all(),'add');
		$course=new Course();
		$course->courseName=$request->course_name;
		$course->semester=$request->term;
		$course->courseCredit=$request->course_credit;
		$course->courseIdentity=$request->course_code;
		$course->courseType=$request->course_type;
		$course->contactHrs=$request->course_contact_hour;
		if($course->save()){
			return redirect(route('profile'))->withSuccess('Course Added Successfully');
		}else {
			return redirect(route('profile'))->withFailed('Course Add Failed!!');
		}
	}

	public function update(Request $request){
		$this->validator($request->all(),'update');

		$courseName=$request->course_name;
		$courseCredit=$request->course_credit;
		$course->semester=$request->term;
		$courseIdentity=$request->course_code;
		$courseType=$request->course_type;
		$contactHrs=$request->course_contact_hour;
		$course = Course::where('course_id',$request->course_id)->update(['courseName'=>$courseName,'courseCredit'=>$courseCredit,'courseIdentity'=>$courseIdentity,'courseType'=>$courseType,'contactHrs'=>$contactHrs]);
		if($course){
			return redirect(route('profile'))->withSuccess('Course Updated Successfully');
		}else {
			return redirect(route('profile'))->withFailed('Course Update Failed!!');
		}
	}

	protected function validator(array $data,$task)
	{

				if ($task=='add') {
					 $course_code = 'required|string|max:20|unique:course,courseIdentity';
				}else{
					$course_code = 'required|string|max:20';
				}
	    return Validator::make($data, [
					'course_code' => $course_code,
	        'course_name' => 'required|string|max:500',
	        'course_credit' => 'required|numeric',
	        'term' => 'required|numeric',
	        'course_contact_hour' => 'required|numeric',
	        'course_type' =>  array('required','regex:/core|indp|urem$/'),
	    ])->validate();
	}
}
