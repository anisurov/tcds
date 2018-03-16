<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Semester;
use App\CourseToSemester;

class SemesterController extends Controller
{
	public function index(){
		$data = Semester::where('semesterStatus','!=','13')->paginate(10);
		//var_dump($data);
		return view('admin.semester.all',compact('data'));
	}

	/*
	semesterStatus=1 is active semester
	semesterStatus=0 is inactive semester
	semesterStatus=13 is deleted semester
	*/

	public function add(Request $request){
		$this->validator($request->all(),'add');
		$semester=new Semester();
		$semester->semesterName =$request->semester_name;
		$semester->startingDate=$request->startDate;
		$semester->endingDate=$request->endDate;
		$semester->semesterStatus=1;
		if($semester->save()){
			return redirect(route('profile'))->withSuccess('Semester Added Successfully');
		}else {
			return redirect(route('profile'))->withFailed('Semester Add Failed!!');
		}
	}
	public function edit(Request $request){
		$data = Semester::where('semester_id',$request->semester_id)->get();
		//var_dump($data);
		return view('admin.semester.edit',compact('data'));
	}
	public function update(Request $request){
		$this->validator($request->all(),'update');

		$semesterName=$request->course_name;
		$semesterCredit=$request->course_credit;
		$semesterIdentity=$request->course_code;
		$semesterType=$request->course_type;
		$contactHrs=$request->course_contact_hour;
		$semester = Course::where('course_id',$request->course_id)->update(['courseName'=>$semesterName,'courseCredit'=>$semesterCredit,'courseIdentity'=>$semesterIdentity,'courseType'=>$semesterType,'contactHrs'=>$contactHrs]);
		if($semester){
			return redirect(route('profile'))->withSuccess('Course Updated Successfully');
		}else {
			return redirect(route('profile'))->withFailed('Course Update Failed!!');
		}
	}

	public function toggleStatus(Request $request){
		$id = $request->semester_id;
		$semesters = Semester::where('semester_id',$id)->get();
		foreach ($semesters as $semester) {
			$status = $semester->semesterStatus;
		}
		if($status==0){
					if(Semester::where('semester_id',$id)->update(['semesterStatus'=>1])){
						return redirect(route('profile'))->withSuccess('Semester Activated Successfully');
					}
					else{
						return redirect(route('profile'))->withFailed('Semester activation Failed!!');
					}
		}
		elseif ($status==1) {
					if(Semester::where('semester_id',$id)->update(['semesterStatus'=>0])){
						return redirect(route('profile'))->withSuccess('Semester deactivated Successfully');
					}
					else{
						return redirect(route('profile'))->withFailed('Semester activation Failed!!');
					}
		}
		else {
			return redirect(route('profile'))->withFailed('Semester activation/deactivation Failed!!');
		}
	}

	public function delete(Request $request){
		$id = $request->semester_id;
					if(Semester::where('semester_id',$id)->update(['semesterStatus'=>13])){
						return redirect(route('profile'))->withSuccess('Semester deleted Successfully');
					}
					else{
						return redirect(route('profile'))->withFailed('Semester deletion Failed!!');
					}
	}

	public function addCourseForm(Request $request)
	{
		$id = $request->semester_id;
		$data = Semester::where('semester_id',$id)->get();
		foreach ($data as $semester) {
			$semesterName=$semester->semesterName;
			$status = $semester->semesterStatus;
		}
		if($status==1){
			return view('admin.semester.addcourse',compact('data'));
		}
		else {
			return redirect(route('profile'))->withFailed('Semester '.$semesterName.' is not active!!');
		}
	}

	public function addCourse(Request $request)
	{
		$semester_id = $request->semester_id;
		$course_id = $request->course_name;
		$courseTosemester = new CourseToSemester();

		$courseTosemester->course_id=$course_id;
		$courseTosemester->semester_id=$semester_id;
		if($courseTosemester->save()){
			return redirect(route('profile'))->withSuccess('Course added to semester Successfully');
		}
		else{
			return redirect(route('profile'))->withFailed('operation Failed!!');
		}
	}

	protected function validator(array $data,$task)
	{

				if ($task=='add') {
					 $semesterName = 'required|regex:/[A-Z]-(\d{4})$/|max:20|unique:semester,semesterName';
				}else{
					$semesterName = 'required|regex:/[A-Z]-(\d{4})$/|max:20';
				}
	    return Validator::make($data, [
					'semester_name' => $semesterName,
	        'startDate' => 'required|date',
	        'endDate' => 'required|date|after:startDate',
	    ])->validate();
	}
}
