@extends('layouts.app')

@section('content')
@if(isset($requestd_course))
<div class="col-md-9 col-md-offset-2">
  <div class="panel panel-default inside-body-panel-shadow">
    <div class="panel-heading"> Course allotment request for <b>{{App\Semester::where('semester_id',$id)->pluck('semesterName')->first()}}</b> </div>
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
                  <th>Designation</th>
                  <th>Joining Date</th>
                  <th>Promotion Date</th>
                  <th>Approve</th>
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
                   <td>{{App\Teacher::where('t_id',$value->teacher_id)->pluck('t_designation')->first()}}</td>
                   <td>{{App\Teacher::where('t_id',$value->teacher_id)->pluck('joining_date')->first()}}</td>
                   <td>{{App\Teacher::where('t_id',$value->teacher_id)->pluck('promotion_date')->first()}}</td>
                   <td>
                     @if($value->status==1)
                       <form action="{{route('indvidual_approve')}}" method="post" class="side-by-side">
                           {!! csrf_field() !!}
                           <input type="hidden" name="request_id" value="{{$value->request_id}}">

                           <input type="image" src="{{asset('images/274e.png')}}" alt="approve">
                       </form>
                    @elseif($value->status==7)
                    <form action="{{route('indvidual_disapprove')}}" method="post" class="side-by-side">
                        {!! csrf_field() !!}
                        <input type="hidden" name="request_id" value="{{$value->request_id}}">

                        <input type="image" src="{{asset('images/2705.png')}}" alt="disapprove">
                    </form>
                    @endif
                   </td>
              </tr>
              @endforeach

          </tbody>
      </table>
      @else
      No course added yet!!
      @endif
      </div>
      <div class="panel-footer">
        <form action="{{route('approveall')}}" method="post" class="side-by-side">
            {!! csrf_field() !!}
            <input type="hidden" name="semester_id" value="{{$id}}">

            <input type="submit" class="btn btn-primary  btn-sm" value="Approve All">
        </form>

      </div>
  </div>
</div>
@endif
@endsection
