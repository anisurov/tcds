@extends('layouts.app')

@section('content')
 <div class="col-md-8 col-md-offset-3">
           <div class="panel panel-default inside-body-panel-shadow">
            <div class="panel-heading"> Teacher List </div>
            <div class="panel-body">
            	<table class="table">
                <thead>
                    <tr>
                        <th>Teacher Name</th>
                        <th>Designation</th>
                        <th>Busy</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $teacher)
                    <tr>
                        <td><a href="{{route('teacherdetail')}}?teacher_id={{$teacher->t_id}}">{{$teacher->t_name}}</a></td>
	                     <td>{{$teacher->t_designation}}</td>
                        <td>{{$teacher->is_busy}}</td>                        
                    </tr>

                    @endforeach

                </tbody>
            </table>
          	</div>
          	<div class="panel-footer">{{$data->links()}}</div>
      </div>
    </div>
@endsection
