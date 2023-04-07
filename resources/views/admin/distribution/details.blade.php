@extends('layouts.app')

@section('content')
 <div class="col-md-8 col-md-offset-3">
   <?php
   foreach(App\Teacher::select('t_id')->get() as $teacher){
     $t_id=$teacher->t_id;
     $alloted_course = DB::table('course')
               ->select('course.courseName as courseName','course.courseIdentity as id','course.courseCredit as credit','course.semester as term','course.contactHrs as hrs','course_alloted_to_teacher.section as section','course_alloted_to_teacher.calt_id as calt_id')->join('course_alloted_to_teacher', 'course_alloted_to_teacher.course_id', 'course.course_id')->where('course_alloted_to_teacher.t_id',$t_id)->where('course_alloted_to_teacher.status',1)->get();

               // echo $t_id."::".count($alloted_course)."  ";
?>
           <div class="panel panel-default inside-body-panel-shadow">
            <div class="panel-heading">
              @foreach(App\Teacher::where('t_id',$t_id)->get() as $data)
              <div class="pull-right image">
                  Busy : {{$data->is_busy}}
               </div>
              {{$data->t_name}}<br>
              {{$data->t_designation}}<br>
              @php($result=DB::select('SELECT SUM(course.courseCredit) as creditTotal FROM `course` JOIN course_alloted_to_teacher ON course_alloted_to_teacher.course_id=course.course_id WHERE course_alloted_to_teacher.t_id='.$data->t_id))
              @if($result)
              @foreach($result as $creditHours)
              @php($count = $creditHours->creditTotal)
              @endforeach
              Total Credit : <b>{{$count}}</b>
              @endif
              @endforeach
            </div>
            <div class="panel-body">
            	<table class="table">
                @if(count($alloted_course)>0)
                <thead>
                    <tr>
                      <th>Course ID</th>
                      <th>Name</th>
                      <th>Semester</th>
                      <th>Credit</th>
                      <th>Contact Hour</th>
                      <th>Section</th>
                      <th>Delete</th>
                    </tr>
                </thead>
                <?php
                foreach($alloted_course as $key=> $value){
                ?>
                <tbody>
                  <tr>
                      <td>{{$value->id}}</td>
                      <td>{{$value->courseName}}</td>
                      <td>{{$value->term}}</td>
                       <td>{{$value->credit}}</td>
                       <td>{{$value->hrs}}</td>
                       <td>{{$value->section}}</td>
                       <td>
                           <form action="{{route('indvidual_disapprove')}}" method="post" class="side-by-side">
                               {!! csrf_field() !!}
                               <input type="hidden" name="request_id" value="{{$value->calt_id}}">

                               <input type="submit" class="btn btn-primary  btn-sm" value="Delete">
                           </form>
                       </td>
                  </tr>
                </tbody>
                <?php } ?>
                @else
                <tr>
                  <td></td>
                  <td>No course alloted</td>
                </tr>
                @endif
            </table>
          </div>
      </div>
      <?php } ?>
      <div class="panel panel-footer">
        <a href="{{route('pdf')}}">download as PDF</a>
      </div>
    </div>
@endsection
