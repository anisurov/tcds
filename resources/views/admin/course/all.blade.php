@extends('layouts.app')

@section('content')
 <div class="col-md-8 col-md-offset-3">
           <div class="panel panel-default inside-body-panel-shadow">
            <div class="panel-heading"> All Course </div>
            <div class="panel-body">
            	<table class="table">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Course No</th>
                        <th>Credit</th>                      
                        <th>Contact Hour</th>
                        <th>Type</th>
                    </tr>
                </thead>

                <tbody>                
                    @foreach ($data as $course)                    
                    <tr>
                        <td>{{$course->courseName}}</td>
	                     <td>{{$course->courseIdentity}}</td>
                        <td>{{$course->courseCredit}}</td>
                        <td>{{$course->contactHrs}}</td>
                        <td>{{$course->courseType}}</td>
                        <td>
                            <form action="{{route('editcourseform')}}" method="get" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="course_id" value="{{$course->course_id}}">
                                
                                <input type="submit" class="btn btn-primary  btn-sm" value="edit">
                            </form>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>          
          	</div>
          	<div class="panel-footer">{{$data->links()}}</div>
      </div>
    </div>   
@endsection
