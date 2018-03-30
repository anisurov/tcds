@extends('layouts.app')

@section('content')
@foreach($data as $semester)
@php($id=$semester->semester_id)
@php($semesterName=$semester->semesterName)
@endforeach
<?php
$courseList = DB::table('course')
          ->select('course.courseName as courseName','course.courseIdentity as id','course.courseCredit as credit','course.contactHrs as hrs')
          ->join('course_in_current_semester', 'course_in_current_semester.course_id', '=', 'course.course_id')->where('course_in_current_semester.semester_id',$id)->get();
 ?>
<div class="col-md-6">
          <div class="panel panel-default inside-body-panel-shadow">
           <div class="panel-heading"> Course in  {{$semesterName}}</div>
           <div class="panel-body">
             @if($courseList->count()>0)
             <table class="table">
               <thead>
                   <tr>
                       <th>Course ID</th>
                       <th>Name</th>
                       <th>Credit</th>
                       <th>Contact Hour</th>
                   </tr>
               </thead>

               <tbody>
                   @foreach($courseList as $value)
                   <tr>
                       <td>{{$value->id}}</td>
                       <td>{{$value->courseName}}</td>
                        <td>{{$value->credit}}</td>
                        <td>{{$value->hrs}}</td>
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
            <div class="panel-heading"> Add Course to {{$semesterName}} </div>
            <div class="panel-body">
            	<form  method="POST" action="{{route('addcourseTosemester')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="semester_id" value="{{$id}}">
                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('course_name') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											Course Name*
					  					  </div>
                                <select id="course_name"  class="form-control"  name="course_name" required autofocus>
                                  <option>--select course--</option>
                                  @php($courses=DB::select('SELECT * FROM course WHERE course_id not in (SELECT course_id FROM course_in_current_semester where semester_id='.$id.')'))
                                  @foreach($courses as $course)
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
