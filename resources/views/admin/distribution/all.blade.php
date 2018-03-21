@extends('layouts.app')

@section('content')
 <div class="col-md-8 col-md-offset-3">
           <div class="panel panel-default inside-body-panel-shadow">
            <div class="panel-heading"> All Semester </div>
            <div class="panel-body">
            	<table class="table">
                <thead>
                    <tr>
                        <th>Semester Name</th>
                        <th>Start date</th>
                        <th>End date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $semester)
                    <tr>
                        <td><a href="{{route('requestapprove')}}?semester_id={{$semester->semester_id}}">{{$semester->semesterName}}</a></td>
	                     <td>{{$semester->startingDate}}</td>
                        <td>{{$semester->endingDate}}</td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
          	</div>
          	<div class="panel-footer">{{$data->links()}}</div>
      </div>
    </div>
@endsection
