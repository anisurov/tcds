@extends('layouts.app')

@section('content')
 <div class="col-md-8 col-md-offset-3">
           <div class="panel panel-default inside-body-panel-shadow">
            <div class="panel-heading"> Update Course </div>
            <div class="panel-body">
            @if(count($data)!=0)
            @foreach($data as $course)
            	<form  method="POST" action="{{Route('updatecourse')}}">
                        {{ csrf_field() }}
                         <input type="hidden" name="course_id" value="{{$course->course_id}}">
                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('course_code') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											 Code*
					  					  </div>
                                <input id="course_code " type="text" class="form-control"  name="course_code" value="{{$course->courseIdentity}}" placeholder="Ex:CSE-1101" required autofocus>
                            </div>
                                @if ($errors->has('course_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('course_code') }}</strong>
                                    </span>
                                @endif
                        </div>


                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('course_name') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											 Name*
					  					  </div>
                                <input id="course_name " type="text" class="form-control"  name="course_name" value="{{$course->courseName}}" placeholder="Course Name" required autofocus>
                            </div>
                                @if ($errors->has('course_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('course_name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('term') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											 Semester*
					  					  </div>
                                <input id="term " type="text" class="form-control"  name="term" value="{{$course->semester}}" placeholder="Enter semester no." required autofocus>
                            </div>
                                @if ($errors->has('term'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('term') }}</strong>
                                    </span>
                                @endif
                        </div>


                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('course_credit') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											 Credit*
					  					  </div>
                                <input id="course_credit " type="text" class="form-control"  name="course_credit" value="{{$course->courseCredit}}" placeholder="Course Credit" required autofocus>
                            </div>
                                @if ($errors->has('course_credit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('course_credit') }}</strong>
                                    </span>
                                @endif
                        </div>

               			<div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('course_contact_hour') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											 Contact Hour*
					  					  </div>
                                <input id="course_contact_hour " type="text" class="form-control"  name="course_contact_hour" value="{{$course->contactHrs}}" placeholder="Contact hour" required autofocus>
                            </div>
                                @if ($errors->has('course_contact_hour'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('course_contact_hour') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('category') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											 Category*
					  					  </div>
                                <select name="category" class="form-control custom-control">
													<option value="">--- Select Category ---</option>
													<option value="theory" {{$course->category=='theory' ? 'selected' : ''}}>Theory</option>
													<option value="sessional" {{$course->category=='sessional' ? 'selected' : ''}}>Sessional</option>
											</select>
                            </div>
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('course_type') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											 Type*
					  					  </div>
                                <select name="course_type" class="form-control custom-control">
													<option value="">--- Select Course Type ---</option>
													<option value="core" {{$course->courseType=='core' ? 'selected' : ''}} >Core</option>
													<option value="indp" {{$course->courseType=='indp' ? 'selected' : ''}} >Inter-discipline</option>
													<option value="urem" {{$course->courseType=='urem' ? 'selected' : ''}}>University Requirement</option>
											</select>
                            </div>
                                @if ($errors->has('course_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('course_type') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary btn-sm pull-left">
                                    Update
                                </button>

										<button type="reset" class="btn btn-primary btn-sm pull-right">
                                    Reset
                                </button>

                            </div>
                        </div>
                    </form>
                    @endforeach
                    @else
                    Error Occured!!
                    @endif
          	</div>
      </div>
    </div>
@endsection
