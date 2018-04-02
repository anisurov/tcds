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
                        <th>Edit</th>
                    <!--    <th>Active/Deactive</th>
                        <th>Delete</th>-->
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $semester)
                    <tr>
                        <td><a href="{{route('addcourseTosemesterForm')}}?semester_id={{$semester->semester_id}}">{{$semester->semesterName}}</a></td>
	                     <td>{{$semester->startingDate}}</td>
                        <td>{{$semester->endingDate}}</td>
                        <td>
                            <form action="{{route('editsemesterform')}}" method="post" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="semester_id" value="{{$semester->semester_id}}">

                                <input type="submit" class="btn btn-primary  btn-sm" value="Edit">
                            </form>
                        </td>
                        <!--
                        <td>
                            <form action="{{route('activesemester')}}" method="post" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="semester_id" value="{{$semester->semester_id}}">

                                <input type="submit" class="btn btn-primary  btn-sm" value="{{$semester->semesterStatus==1 ? 'Active':'Inactive'}}">
                            </form>
                        </td>
                        <td>
                            <form action="{{route('deletesemester')}}" method="post" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="semester_id" value="{{$semester->semester_id}}">

                                <input type="submit" class="btn btn-primary  btn-sm" value="delete">
                            </form>
                        </td>-->
                    </tr>

                    @endforeach

                </tbody>
            </table>
          	</div>
          	<div class="panel-footer">{{$data->links()}}</div>
      </div>
    </div>
@endsection
