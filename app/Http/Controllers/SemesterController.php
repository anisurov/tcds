<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Semester;
use App\CourseToSemester;
use DB;

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
		$semester->section_female=$request->section_female;
		$semester->section_male=$request->section_male;
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

		$semesterName =$request->semester_name;
		$startingDate=$request->startDate;
		$endingDate=$request->endDate;
		$section_female=$request->section_female;
		$section_male=$request->section_male;
		$semesterStatus=1;
		$semester = Semester::where('semester_id',$request->semester_id)->update(['semesterName'=>$semesterName,'startingDate'=>$startingDate,'endingDate'=>$endingDate,'section_female'=>$section_female,'section_male'=>$section_male]);
		if($semester){
			return redirect(route('profile'))->withSuccess('Semester Updated Successfully');
		}else {
			return redirect(route('profile'))->withFailed('Semester Update Failed!!');
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

	public function alloted(Request $request)
	{
		$semester = $request->semester_id;
		if (Semester::where('semester_id',$semester)->pluck('semesterStatus')->first()==1) {

				$requestd_course=DB::table('course')->select('course.courseName as courseName', 'course.courseIdentity as id', 'course.courseCredit as credit', 'course.contactHrs as hrs', 'course_alloted_to_teacher.section as section','course_alloted_to_teacher.t_id as teacher_id')->join('course_alloted_to_teacher', 'course.course_id', '=', 'course_alloted_to_teacher.course_id')->where('course_alloted_to_teacher.semester_id', $semester)->get();
				return view('admin.course.alloted',compact('requestd_course','semester'));
		}	else {
			return redirect(route('profile'))->withFailed('This semester is not active');
		}
	}

	protected function validator(array $data,$task)
	{

				if ($task=='add') {
					 $semesterName = 'required|max:20';
				}else{
					$semesterName = 'required|max:20';
				}
	    return Validator::make($data, [
					'semester_name' => $semesterName,
	        'startDate' => 'required|date',
	        'endDate' => 'required|date|after:startDate',
	        'section_female' => 'required|numeric',
	        'section_male' => 'required|numeric',
	    ])->validate();
	}
}
