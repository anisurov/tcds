@extends('layouts.app')

@section('content')
@foreach($data as $semester)
@php($id=$semester->semester_id)
@php($semesterName=$semester->semesterName)
@endforeach
<?php
$teacher_infos =App\Teacher::where('t_email', Auth::user()->email)->get();
foreach ($teacher_infos as $value) {
    $t_id=$value->t_id;
    $designation=$value->t_designation;
}
if ($designation=='Assistant Professor') {
    $can_take=15;
} elseif ($designation=='Associate Professor') {
    $can_take=12;
} elseif ($designation=='Lecturer') {
    $can_take=12;
}
$requestd = DB::table('course')
          ->select('course.courseName as courseName', 'course.courseIdentity as id', 'course.courseCredit as credit', 'course.contactHrs as hrs', 'course_request.section as section')->join('course_request', 'course.course_id', '=', 'course_request.course_id')->where('course_request.semester_id', $id)->where('course_request.teacher_id', $t_id)->where('status', 1)->get();

$courseList = DB::table('course')
          ->select('course.course_id as course_id', 'course.courseName as courseName', 'course.courseIdentity as id', 'course.courseCredit as credit', 'course.contactHrs as hrs')
          ->join('course_in_current_semester', 'course_in_current_semester.course_id', '=', 'course.course_id')->where('course_in_current_semester.semester_id', $id)->get();
 ?>
<div class="col-md-6">
          <div class="panel panel-default inside-body-panel-shadow">
           <div class="panel-heading"> Your requested course in  {{$semesterName}}</div>
           <div class="panel-body">
             @php($totalCredit=0)
             @if($requestd->count()>0)
             <table class="table">
               <thead>
                   <tr>
                       <th>Course ID</th>
                       <th>Name</th>
                       <th>Credit</th>
                       <th>Contact Hour</th>
                       <th>Section</th>
                   </tr>
               </thead>

               <tbody>
                   @foreach($requestd as $value)
                   <tr>
                       <td>{{$value->id}}</td>
                       <td>{{$value->courseName}}</td>
                        <td>{{$value->credit}}</td>
                        <td>{{$value->hrs}}</td>
                        <td>{{$value->section}}</td>
                   </tr>
                    @php($totalCredit=$totalCredit+$value->credit)
                   @endforeach

               </tbody>
           </table>
           @else
           No course added yet!!
           @endif
           </div>
          @if(($can_take-$totalCredit)>0) <div class="panel-footer"> you need to take <b>{{$can_take-$totalCredit}}</b> more credit</div>@endif
     </div>
   </div>
 <div class="col-md-6">
           <div class="panel panel-default inside-body-panel-shadow">
            <div class="panel-heading"> Add Course to {{$semesterName}} </div>
            <div class="panel-body">
            	<form  method="POST" action="{{route('teacherAddcourse')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="semester_id" value="{{$id}}">
                        <input type="hidden" name="teacher_id" value="{{$t_id}}">
                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('course_name') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											Course Name*
					  					  </div>
                                <select id="course_name"  class="form-control"  name="course_name" required autofocus>
                                  <option>--select course--</option>
                                  @foreach($courseList as $course)
                                  <option value="{{$course->course_id}}">{{$course->courseName}}</option>
                                  @endforeach
                                </select>
                            </div>
                                @if ($errors->has('course_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('course_name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('course_name') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											Section Name*
					  					  </div>
                                <select id="section"  class="form-control"  name="section" required autofocus>
                                  <option>--select section--</option>

                                  <option value="MA">MA</option>
                                  <option value="MB">MB</option>
                                  <option value="MC">MC</option>
                                  <option value="FA">FA</option>
                                  <option value="FB">FB</option>
                                  <option value="FC">FC</option>

                                </select>
                            </div>
                                @if ($errors->has('section'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary btn-sm pull-left">
                                    Save
                                </button>
										<button type="reset" class="btn btn-primary btn-sm pull-right">
                                    Reset
                                </button>

                            </div>
                        </div>
                    </form>
          	</div>
      </div>
    </div>
@endsection
