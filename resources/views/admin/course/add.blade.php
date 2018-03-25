@extends('layouts.app')

@section('content')
 <div class="col-md-8 col-md-offset-3">
           <div class="panel panel-default inside-body-panel-shadow">
            <div class="panel-heading"> Add New Course </div>
            <div class="panel-body">
            	<form  method="POST" action="{{route('addcourse')}}">
                        {{ csrf_field() }}

                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('course_code') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											 Code*
					  					  </div>
                                <input id="course_code " type="text" class="form-control"  name="course_code" value="" placeholder="Ex:CSE-1101" required autofocus>
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
                                <input id="course_name " type="text" class="form-control"  name="course_name" value="" placeholder="Course Name" required autofocus>
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
                                <input id="term " type="text" class="form-control"  name="term" value="" placeholder="Enter semester no." required autofocus>
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
                                <input id="course_credit " type="text" class="form-control"  name="course_credit" value="" placeholder="Course Credit" required autofocus>
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
                                <input id="course_contact_hour " type="text" class="form-control"  name="course_contact_hour" value="" placeholder="Contact hour" required autofocus>
                            </div>
                                @if ($errors->has('course_contact_hour'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('course_contact_hour') }}</strong>
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
													<option value="core">Core</option>
													<option value="indp">Inter-discipline</option>
													<option value="urem">University Requirement</option>
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
                                    Save
                                </button>

										<button type="reset" class="btn btn-primary btn-sm pull-right">
                                    Reset
                                </button>

                            </div>
                        </div>
                    </form>
          	</div>
      </div>
    </div>
@endsection
