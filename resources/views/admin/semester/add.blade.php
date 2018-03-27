@extends('layouts.app')

@section('content')
 <div class="col-md-8 col-md-offset-3">
           <div class="panel panel-default inside-body-panel-shadow">
            <div class="panel-heading"> Add New Semester </div>
            <div class="panel-body">
            	<form  method="POST" action="{{route('addsemester')}}">
                        {{ csrf_field() }}

                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('semester_name') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											 Name*
					  					  </div>
                                <input id="semester_name " type="text" class="form-control"  name="semester_name" value="" placeholder="Enter semester Name" required autofocus>
                            </div>
                                @if ($errors->has('semester_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('semester_name') }}</strong>
                                    </span>
                                @endif
                        </div>


                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('startDate') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											 Start date*
					  					  </div>
                                <input id="startDate " type="date" class="form-control"  name="startDate" value="" placeholder="Course Name" required autofocus>
                            </div>
                                @if ($errors->has('startDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('startDate') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('endDate') ? ' has-error' : '' }}">
                            	  <div class="input-group-addon">
											 End date*
					  					  </div>
                                <input id="endDate " type="date" class="form-control"  name="endDate" value="" placeholder="End date of semester" required autofocus>
                            </div>
          @if ($errors->has('endDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('endDate') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('section_male') ? ' has-error' : '' }}">
                                <div class="input-group-addon">
                       No. of section(Male)*
                        </div>
                                <input id="section_male " type="text" class="form-control"  name="section_male" value="" placeholder="Enter Number of male section" required autofocus>
                            </div>
                                @if ($errors->has('section_male'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('section_male') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group col-md-12 ">
                            <div class="input-group {{ $errors->has('section_female') ? ' has-error' : '' }}">
                                <div class="input-group-addon">
                       No. of section(Female)*
                        </div>
                                <input id="section_female " type="text" class="form-control"  name="section_female" value="" placeholder="Enter Number of female section" required autofocus>
                            </div>
                                @if ($errors->has('section_female'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('section_female') }}</strong>
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
