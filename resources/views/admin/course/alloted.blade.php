@extends('layouts.app')

@section('content')
@if(isset($requestd_course))
<div class="col-md-8 col-md-offset-3">
  <div class="panel panel-default inside-body-panel-shadow">
    <div class="panel-heading"> Course alloted to <b>{{App\Semester::where('semester_id',$semester)->pluck('semesterName')->first()}}</b> </div>
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
@endif
@endsection
