@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default inside-body-panel-shadow">
                <div class="panel-heading">
                  @foreach($teacher as $data)
                    <div class="pull-right image">
                      <img class="img-circle" src="{{Storage::url($data->t_image)}}"
                         alt="{{$data->t_name}}">
                     </div>
                      {{$data->t_name}}<br>
                      {{$data->t_designation}}<br>
                  @endforeach
                </div>

                <div class="panel-body">
                  @if(isset($semester)&&$semester->count()>0)
                  @foreach($semester as $data)
                  <div class="panel panel-default inside-body-panel-shadow">
                      <div class="panel-heading">
                        Course alloated in <b>{{$data->semesterName}}</b>
                      </div>
                      <div class="panel-body">
                        <?php
                        $t_id= App\Teacher::where('t_email',Auth::user()->email)->pluck('t_id')->first();
                        $alloted_course = DB::table('course')
                                  ->select('course.courseName as courseName','course.courseIdentity as id','course.courseCredit as credit','course.semester as term','course.contactHrs as hrs','course_alloted_to_teacher.section as section')
                                  ->join('course_alloted_to_teacher', 'course_alloted_to_teacher.course_id', '=', 'course.course_id')->where('course_alloted_to_teacher.semester_id',$data->semester_id)->where('course_alloted_to_teacher.t_id',$t_id)->get();
                         ?>
                        @if($alloted_course->count()>0)
                        <table class="table">
                          <thead>
                              <tr>
                                  <th>Course ID</th>
                                  <th>Name</th>
                                  <th>Semester</th>
                                  <th>Credit</th>
                                  <th>Contact Hour</th>
                                  <th>Section</th>
                              </tr>
                          </thead>

                          <tbody>
                            <?php
                              $totalCredit=0;
                              $totalContactHour=0;
                             ?>
                              @foreach($alloted_course as $value)
                              <tr>
                                  <td>{{$value->id}}</td>
                                  <td>{{$value->courseName}}</td>
                                  <td>{{$value->term}}</td>
                                   <td>{{$value->credit}}</td>
                                   <td>{{$value->hrs}}</td>
                                   <td>{{$value->section}}</td>
                              </tr>
                              <?php
                                $totalCredit=$totalCredit+$value->credit;
                                $totalContactHour=$totalContactHour+$value->hrs;
                               ?>
                              @endforeach

                          </tbody>
                          <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><b>Total</b></td>
                                 <td>{{$totalCredit}}</td>
                                 <td>{{$totalContactHour}}</td>
                                 <td></td>
                            </tr>
                          </tfoot>
                      </table>
                      @else
                      No course alloated yet!!
                      @endif
                      </div>
                  </div>
                  @endforeach
                  @else
                  There is no active semester right now!!
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
