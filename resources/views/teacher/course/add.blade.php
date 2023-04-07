@extends('layouts.app')

@section('content')
@foreach($data as $semester)
@php($id=$semester->semester_id)
@php($semesterName=$semester->semesterName)
@php($section_male=$semester->section_male)
@php($section_female=$semester->section_female)
@endforeach
<?php
$teacher_infos =App\Teacher::where('t_email', Auth::user()->email)->get();
foreach ($teacher_infos as $value) {
    $t_id=$value->t_id;
    $designation=$value->t_designation;
    $busy=$value->is_busy;
}
if ($designation=='Assistant Professor') {
    if ($busy == 'yes') {
        $can_take=9;
    } else {
        $can_take=15;
    }
} elseif ($designation=='Associate Professor') {
    $can_take=12;
} elseif ($designation=='Lecturer') {
    $can_take=12;
}

$theroy_credit = DB::table('course')->select(DB::raw('sum(course.courseCredit)  as credit'))->where('course.courseType', 'core')->where('course.category', 'theory')->join('course_request', 'course.course_id', '=', 'course_request.course_id')->where('course_request.teacher_id', $t_id)->whereIn('status', [1,7])->get();


        $taken = DB::table('course')
                  ->select(DB::raw('sum(course.courseCredit) as takenCredit'))->join('course_request', 'course.course_id', '=', 'course_request.course_id')->where('course_request.teacher_id', $t_id)->whereIn('status', [1,7])->get();


                        foreach ($taken as $value) {
                            $takenCredit = $value->takenCredit;
                        }

foreach ($theroy_credit as $value) {
    $theoryCredit = $value->credit;
}

$requestd = DB::table('course')
          ->select('course.courseName as courseName', 'course.courseIdentity as id', 'course.courseCredit as credit', 'course.contactHrs as hrs', 'course_request.section as section', 'course_request.id as request_id')->join('course_request', 'course.course_id', '=', 'course_request.course_id')->where('course_request.semester_id', $id)->where('course_request.teacher_id', $t_id)->whereIn('status', [1,7])->get();

$courseList = DB::table('course')
          ->select('course.course_id as course_id', 'course.courseName as courseName', 'course.courseIdentity as id', 'course.courseCredit as credit', 'course.contactHrs as hrs')
          ->join('course_in_current_semester', 'course_in_current_semester.course_id', '=', 'course.course_id')->where(['course_in_current_semester.semester_id'=>$id,'course_in_current_semester.status'=>1])->get();
 ?>
<div class="col-md-6">
          <div class="panel panel-default inside-body-panel-shadow">
           <div class="panel-heading"> Your requested course in  {{$semesterName}}</div>
           <div class="panel-body">
             @php($totalCredit=0)
             @php($totalContactHour=0)
             @if($requestd->count()>0)
             <table class="table">
               <thead>
                    <tr>
                       <th>Course ID</th>
                       <th>Name</th>
                       <th>Credit</th>
                       <th>Contact Hour</th>
                       <th>Section</th>
                       <th>Delete</th>
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
                        <td>
                            <form action="{{route('teacherDelcourse')}}" method="post" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="request_id" value="{{$value->request_id}}">

                                <input type="submit" class="btn btn-primary  btn-sm" value="Delete">
                            </form>
                        </td>
                   </tr>
                    @php($totalCredit=$totalCredit+$value->credit)
                    @php($totalContactHour=$totalContactHour+$value->hrs)
                   @endforeach

               </tbody>
               <tfoot>
                 <tr>
                     <td></td>
                     <td><b>Total</b></td>
                      <td>{{$totalCredit}}</td>
                      <td>{{$totalContactHour}}</td>
                      <td></td>
                 </tr>
               </tfoot>
           </table>
           @else
           No course requested yet!!
           @endif
           </div>
          @if(($can_take-$takenCredit)>0)
          <div class="panel-footer">
            you need to take <b>{{$can_take-$takenCredit}}</b> more credit.
            @if((6-$theoryCredit)>0)
            Including {{6-$theoryCredit}} credit theory.
            @endif
          </div>
          @endif
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
                                  @if($section_male==3)
                                  <option value="MA">MA</option>
                                  <option value="MB">MB</option>
                                  <option value="MC">MC</option>
                                  @elseif($section_male==2)
                                  <option value="MA">MA</option>
                                  <option value="MB">MB</option>
                                  @elseif($section_male==1)
                                  <option value="MA">MA</option>
                                  @endif
                                  @if($section_female==3)
                                  <option value="FA">FA</option>
                                  <option value="FB">FB</option>
                                  <option value="FC">FC</option>
                                  @elseif($section_female==2)
                                  <option value="FA">FA</option>
                                  <option value="FB">FB</option>
                                  @elseif($section_female==1)
                                  <option value="FA">FA</option>
                                  @endif


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

<?php
$requestd_course=DB::table('course')->select('course.courseName as courseName', 'course.courseIdentity as id', 'course.courseCredit as credit', 'course.contactHrs as hrs', 'course_alloted_to_teacher.section as section','course_alloted_to_teacher.t_id as teacher_id')->join('course_alloted_to_teacher', 'course.course_id', '=', 'course_alloted_to_teacher.course_id')->where('course_alloted_to_teacher.semester_id', $id)->where('course_alloted_to_teacher.status',1)->get();
 ?>
    <div class="col-md-6">
      <div class="panel panel-default inside-body-panel-shadow">
        <div class="panel-heading"> Course alloted to <b>{{$semesterName}}</b> </div>
          <div class="panel-body">
            @if($requestd_course->count()>0)
            <table class="table">
              <thead>
                  <tr>
                      <th>Course ID</th>
                      <th>Name</th>
                      <th>Credit</th>
                      <th>Contact Hour</th>
                      <th>Section</th>
                      <th>Teacher</th>
                  </tr>
              </thead>

              <tbody>
                  @foreach($requestd_course as $value)
                  <tr>
                      <td>{{$value->id}}</td>
                      <td>{{$value->courseName}}</td>
                       <td>{{$value->credit}}</td>
                       <td>{{$value->hrs}}</td>
                       <td>{{$value->section}}</td>
                       <td>{{App\Teacher::where('t_id',$value->teacher_id)->pluck('t_name')->first()}}</td>
                  </tr>
                  @endforeach

              </tbody>
          </table>
          @else
          No course added yet!!
          @endif
          </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default inside-body-panel-shadow">
        <div class="panel-heading"> Course's , not alloted yet</b> </div>
          <div class="panel-body">
            @php($not_alloted=DB::select('SELECT * FROM course WHERE course_id  IN (SELECT course_id FROM course_in_current_semester where semester_id='.$id.' and status=1 and course_id NOT IN (SELECT course_id FROM course_alloted_to_teacher where semester_id='.$id.' and status=1) ) '))
            @if($not_alloted)
            <table class="table">
              <thead>
                  <tr>
                      <th>Course ID</th>
                      <th>Name</th>
                      <th>Credit</th>
                      <th>Contact Hour</th>
                      <!-- <th>Section</th>
                      <th>Teacher</th> -->
                  </tr>
              </thead>

              <tbody>
                  @foreach($not_alloted as $value)
                  <tr>
                      <td>{{$value->courseIdentity}}</td>
                      <td>{{$value->courseName}}</td>
                       <td>{{$value->courseCredit}}</td>
                       <td>{{$value->contactHrs}}</td>

                  </tr>
                  @endforeach

              </tbody>
          </table>
          @else
          No course added yet!!
          @endif
          </div>
      </div>
    </div>

@endsection
