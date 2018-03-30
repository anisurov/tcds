@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default inside-body-panel-shadow">
              <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
          @php($courseList=App\Semester::where('semesterStatus',1)->get())
                  @if($courseList->count()>0)
                  <table class="table">
                    <thead>
                        <tr>
                            <th>Semester</th>
                            <th>Total course</th>
                            <th>Remaining Time</th>
                            <th>End date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($courseList as $value)
                        <tr>
                            <td><a href="{{route('allotedCourse')}}/?semester_id={{$value->semester_id}}">{{$value->semesterName}}</a></td>
                            @php($courses=DB::select('SELECT COUNT(course_id) as totalCourse FROM `course_in_current_semester` WHERE semester_id='.$value->semester_id))
                            @foreach($courses as $course)
                              @php($total=$course->totalCourse)
                            @endforeach
                            <td>{{$total}}</td>
                            <?php

                                  $diff = abs(strtotime($value->endingDate) - strtotime(date("Y-m-d")));

                                  $years = floor($diff / (365*60*60*24));
                                  $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                  $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                             ?>
                             <td>
                               @if($years==0&&$months==0&&$days==0)
                               Time expired
                               @elseif($years==0&&$months>0&&$days>0)
                               {{$months}} months {{$days}} days
                               @elseif($years==0&&$months>0&&$days==0)
                               {{$months}} months
                               @elseif($years==0&&$months==0&&$days>0)
                                {{$days}} days
                               @elseif($years>0&&$months>0&&$days>0)
                               {{$years}} years {{$months}} months {{$days}} days
                               @endif
                             </td>
                             <td>{{$value->endingDate}}</td>
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
    </div>
</div>
@endsection
