@extends('layouts.app')

@section('content')
@if(isset($requestd_course))
<div class="col-md-8 col-md-offset-3">
  <div class="panel panel-default inside-body-panel-shadow">
    <div class="panel-heading"> Course allotment request for <b>{{$semester}}</b> </div>
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
                   <td>
                       <form action="{{route('indvidual_approve')}}" method="post" class="side-by-side">
                           {!! csrf_field() !!}
                           <input type="hidden" name="request_id" value="{{$value->request_id}}">

                           <input type="submit" class="btn btn-primary  btn-sm" value="Approve">
                       </form>
                   </td>
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
