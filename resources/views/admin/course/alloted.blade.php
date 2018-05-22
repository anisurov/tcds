@extends('layouts.app')

@section('content')
@if(isset($requestd_course))
<?php $semesters = App\Semester::where('semester_id',$semester)->get();
foreach($semesters as $semester_data)
$section_male=$semester_data->section_male;
$section_female=$semester_data->section_female;
$semester_name=$semester_data->semesterName;
?>
<div class="col-md-6">
          <div class="panel panel-default inside-body-panel-shadow">
           <div class="panel-heading"> Allot  Course to teacher </div>
           <div class="panel-body">
             <form  method="POST" action="{{route('allotment')}}">
                       {{ csrf_field() }}
                       <input type="hidden" name="semester" value="{{$semester}}">
                       <div class="form-group col-md-12 ">
                           <div class="input-group {{ $errors->has('course') ? ' has-error' : '' }}">
                               <div class="input-group-addon">
                      Course*
                       </div>
                       <select id="course"  class="form-control"  name="course" required autofocus>
                         <option>--select course--</option>
                         @php($courses=DB::select('SELECT * FROM course WHERE course_id  in (SELECT course_id FROM course_in_current_semester where semester_id='.$semester.' and status=1)'))
                         @foreach($courses as $course)
                         <option value="{{$course->course_id}}">{{$course->courseName}}</option>
                         @endforeach
                       </select>
                           </div>
                               @if ($errors->has('course'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('course') }}</strong>
                                   </span>
                               @endif
                       </div>

                       <div class="form-group col-md-12 ">
                           <div class="input-group {{ $errors->has('teacher') ? ' has-error' : '' }}">
                               <div class="input-group-addon">
                      Teacher*
                       </div>
                       <select id="teacher"  class="form-control"  name="teacher" required autofocus>
                         <option>--select teacher--</option>
                         @foreach(App\Teacher::all() as $teacher)
                         <option value="{{$teacher->t_id}}">{{$teacher->t_name}}</option>
                         @endforeach
                       </select>
                           </div>
                               @if ($errors->has('teacher'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('teacher') }}</strong>
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



<div class="col-md-6">
  <div class="panel panel-default inside-body-panel-shadow">
    <div class="panel-heading"> Course alloted to <b>{{$semester_name}}</b> </div>
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
        @php($not_alloted=DB::select('SELECT * FROM course WHERE course_id  IN (SELECT course_id FROM course_in_current_semester where semester_id='.$semester.' and status=1 and course_id NOT IN (SELECT course_id FROM course_alloted_to_teacher where semester_id='.$semester.' and status=1) ) '))
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
@endif
@endsection
