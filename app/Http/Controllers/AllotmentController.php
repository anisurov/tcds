<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Semester;
use App\CourseRequest;
use App\Course;
use App\CourseToTeacher;
use App\Teacher;

class AllotmentController extends Controller
{
    public function Allotment(Request $request)
    {
        $this->validator($request->all());
        $semester = $request->semester;
        $teacher = $request->teacher;
        $course = $request->course;
        $section = $request->section;

        $status=Semester::where('semester_id', $semester)->pluck('semesterStatus')->first();
        if ($status && $status==1) {
            $teacher_data= Teacher::where('t_id', $teacher)->get();
            foreach ($teacher_data as $teacher_data) {
                $designation=$teacher_data->t_designation;
                $joining_date=$teacher_data->joining_date;
                $promotion_date=$teacher_data->promotion_date;
            }
            if ($designation=='Assistant Professor') {
                $priority=3;
            } elseif ($designation=='Associate Professor') {
                $priority=2;
            } elseif ($designation=='Lecturer') {
                $priority=1;
            }

            $course_requests=CourseRequest::where(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester])->whereIn('status', [1,7])->get();

            if ($course_requests && $course_requests->count()>0) {
                foreach ($course_requests as $course_request) {
                    if ($course_request->status==1) {
                        if ($course_request->priority>$priority) {
                            return redirect(route('profile'))->withFailed('sorry!!This course already requested');
                        }
                        if ($course_request->priority<$priority) {
                            CourseRequest::where(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'teacher_id'=>$course_request->teacher_id])->update(['status'=>0]);
                        }

                        if ($course_request->priority==$priority) {
                            if (Teacher::where('t_id', $course_request->teacher_id)->pluck('joining_date')->first()<$joining_date) {
                                CourseRequest::where(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'teacher_id'=>$course_request->teacher_id])->update(['status'=>0]);
                            } else {
                                return redirect(route('profile'))->withFailed('sorry!!This course already requested');
                            }

                            if (Teacher::where('t_id', $course_request->teacher_id)->pluck('promotion_date')->first()<$promotion_date) {
                                CourseRequest::where(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'teacher_id'=>$course_request->teacher_id])->update(['status'=>0]);
                            } else {
                                return redirect(route('profile'))->withFailed('sorry!!This course already requested');
                            }

                            $store_course_request = new CourseRequest();
                            $store_course_request->course_id=$course;
                            $store_course_request->section=$section;
                            $store_course_request->teacher_id=$teacher;
                            $store_course_request->semester_id=$semester;
                            $store_course_request->priority=$priority;
                            $store_course_request->status=7;
                            if (CourseToTeacher::where(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester])->count()>0) {
                              CourseToTeacher::where(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'t_id'=>$course_request->teacher_id])->update(['t_id'=>$teacher]);
                                  return redirect(route('profile'))->withSuccess('course alloated successfully');
                            }else {
                            if ($store_course_request->save()) {
                                $Coursetoteacher = new CourseToTeacher();

                                $Coursetoteacher->semester_id=$semester;
                                $Coursetoteacher->course_id=$course;
                                $Coursetoteacher->t_id=$teacher;
                                $Coursetoteacher->section=$section;

                                if ($Coursetoteacher->save()) {
                                    return redirect(route('profile'))->withSuccess('Course alloted successfully');
                                } else {
                                    return redirect(route('profile'))->withFailed('Course allotement failed');
                                }
                            } else {
                                return redirect(route('profile'))->withFailed('Error!!');
                            }
                          }
                        }
                    } elseif ($course_request->status==7) {
                        if ($course_request->priority>$priority) {
                            return redirect(route('profile'))->withFailed('sorry!!This course already requested');
                        }
                        if ($course_request->priority<$priority) {
                            CourseRequest::where(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'teacher_id'=>$course_request->teacher_id])->update(['status'=>0]);
                            CourseRequest::insert(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'teacher_id'=>$teacher,'status'=>7,'priority'=>$priority]);

                            if (CourseToTeacher::where(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'t_id'=>$course_request->teacher_id])->update(['t_id'=>$teacher])) {
                                return redirect(route('profile'))->withSuccess('course alloated successfully');
                            }
                        }

                        if ($course_request->priority==$priority) {
                            if (Teacher::where('t_id', $course_request->teacher_id)->pluck('joining_date')->first()<$joining_date) {
                                CourseRequest::where(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'teacher_id'=>$course_request->teacher_id])->update(['status'=>0]);

                                CourseRequest::insert(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'teacher_id'=>$teacher,'status'=>7,'priority'=>$priority]);

                                if (CourseToTeacher::where(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'t_id'=>$course_request->teacher_id])->update(['t_id'=>$teacher])) {
                                    return redirect(route('profile'))->withSuccess('course alloated successfully');
                                }
                            } else {
                                return redirect(route('profile'))->withFailed('sorry!!This course already alloted');
                            }

                            if (Teacher::where('t_id', $course_request->teacher_id)->pluck('promotion_date')->first()<$joining_date) {
                                CourseRequest::where(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'teacher_id'=>$course_request->teacher_id])->update(['status'=>0]);

                                CourseRequest::insert(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'teacher_id'=>$teacher,'status'=>7,'priority'=>$priority]);

                                if (CourseToTeacher::where(['course_id'=>$course,'section'=>$section,'semester_id'=>$semester,'t_id'=>$course_request->teacher_id])->update(['t_id'=>$teacher])) {
                                    return redirect(route('profile'))->withSuccess('course alloated successfully');
                                }
                            } else {
                                return redirect(route('profile'))->withFailed('sorry!!This course already alloted');
                            }
                        }

                        return redirect(route('profile'))->withFailed('sorry!!This course already alloted');
                    }

                }
            } else {
                $store_course_request = new CourseRequest();
                $store_course_request->course_id=$course;
                $store_course_request->section=$section;
                $store_course_request->teacher_id=$teacher;
                $store_course_request->semester_id=$semester;
                $store_course_request->priority=$priority;
                $store_course_request->status=7;
                if ($store_course_request->save()) {
                    $Coursetoteacher = new CourseToTeacher();

                    $Coursetoteacher->semester_id=$semester;
                    $Coursetoteacher->course_id=$course;
                    $Coursetoteacher->t_id=$teacher;
                    $Coursetoteacher->section=$section;

                    if ($Coursetoteacher->save()) {
                        return redirect(route('profile'))->withSuccess('..Course alloted successfully');
                    } else {
                        return redirect(route('profile'))->withFailed('Course allotement failed');
                    }
                } else {
                    return redirect(route('profile'))->withFailed('Error!!');
                }
            }
        } else {
            return redirect(route('profile'))->withFailed('Course allotment failed!!');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
                    'semester' =>'required|numeric',
            'course' => 'required|numeric',
            'teacher' => 'required|numeric',
            'section' => 'required',
        ])->validate();
    }
}
