@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default inside-body-panel-shadow">
                <div class="panel-heading">
                  Settings
                </div>
                <div class="panel-body">
		@foreach($teacher as $info)

		@section('name')
                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		<div class="input-group col-md-12">
			   <div class="input-group-addon" style="width:15%">Name</div>
                           <div class="form-control" style="width:60%">{{$info->t_name}}</div>
			   <a class="btn btn-primary pull-right" style="width:15%;margin-right:2px;margin-left:2px;" 				   role="button" href="{!!route('updateProfile','name')!!}">Edit</a>
                        </div>
                  </div>
	       @endsection

		  @section('designation')
                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		<div class="input-group col-md-12">
			   <div class="input-group-addon" style="width:15%">Designation</div>
                           <div class="form-control" style="width:60%">{{$info->t_designation}}</div>
			   <a class="btn btn-primary pull-right" style="width:15%;margin-right:2px;margin-left:2px;" 				   role="button" href="{!!route('updateProfile','designation')!!}">Edit</a>
                        </div>
                  </div>
	       @endsection

		  @section('joining_date')
                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		<div class="input-group col-md-12">
			   <div class="input-group-addon" style="width:15%">Joining Data</div>
                           <div class="form-control" style="width:60%">{{$info->joining_date}}</div>
			   <a class="btn btn-primary pull-right" style="width:15%;margin-right:2px;margin-left:2px;" 				   role="button" href="{!!route('updateProfile','jdate')!!}">Edit</a>
                        </div>
                  </div>
	       @endsection

		  @section('promotion_date')
                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		<div class="input-group col-md-12">
			   <div class="input-group-addon" style="width:15%">Promotion Date</div>
                           <div class="form-control" style="width:60%">{{$info->promotion_date}}</div>
			   <a class="btn btn-primary pull-right" style="width:15%;margin-right:2px;margin-left:2px;" 				   role="button" href="{!!route('updateProfile','pdate')!!}">Edit</a>
                        </div>
                  </div>
	       @endsection

		  @section('changepass')
                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		<div class="input-group col-md-12">
			   <a class="btn btn-primary" style="margin-right:2px;margin-left:2px;" 				   role="button" href="{!!route('updateProfile','changepass')!!}">Change Password</a>
                        </div>
                  </div>
	       @endsection
		   @isset($request)
			@switch($request)
				@case('name')
				{!! Form::open(['url'=>route('update'), 'class'=>'form-horizontal','files' => true]) !!}
                                <div class="form-group" style="margin-right:2px;margin-left:2px;">
                                  <div class="input-group">
                                    {!! Form::label('t_name','Name ( in English )',['class'=>'input-group-addon']) !!}
                                    {!! Form::text('t_name',$info->t_name,['class'=>'form-control', 'required'=>'required']) !!}
		                 </div>
@if ($errors->has('joingDate'))
                               <span class="alert-danger">
                               <strong>{{ $errors->first('joingDate') }}</strong>
                               </span>
                               @endif 
                               </div>
                               {!! Form::submit('Submit',['class'=> 'btn btn-success']) !!}
                               {!! Form::close() !!}
				<br><hr><br>
					@yield('designation')
					@yield('joining_date')
					@yield('promotion_date')
					@yield('changepass')
          			@break
				
				@case('designation')
				{!! Form::open(['url'=>route('update'), 'class'=>'form-horizontal','files' => true]) !!}
		               <div class="form-group" style="margin-right:2px;margin-left:2px;">
                                <div class="input-group">
                                 {!! Form::label('t_designation','Designation',['class'=>'input-group-addon']) !!}
                                 {!! Form::text('t_designation',$info->t_designation,['class'=>'form-control', 'required'=>'required']) !!}
                               </div>
                              </div>
                               {!! Form::submit('Submit',['class'=> 'btn btn-success']) !!}
                               {!! Form::close() !!}
				<br><hr><br>
					@yield('name')
					@yield('joining_date')
					@yield('promotion_date')
					@yield('changepass')
				
				@break				
				@case('jdate')
       			        <div class="form-group{{ $errors->has('t_email') ? ' has-error' : '' }}" style="margin-right:2px;margin-left:2px;">
                                 <div class="input-group">
                                 {!! Form::label('joingDate','Joining Date',['class'=>'input-group-addon']) !!}
                                 {!! Form::date('joingDate',$info->joining_date,['class'=>'form-control', 'required'=>'required'], \Carbon\Carbon::now()) !!}
                                </div>
	                	@if ($errors->has('joingDate'))
                               <span class="alert-danger">
                               <strong>{{ $errors->first('joingDate') }}</strong>
                               </span>
                               @endif 
                                </div>
                               {!! Form::submit('Submit',['class'=> 'btn btn-success']) !!}
                               {!! Form::close() !!}
				<br><hr><br>
					@yield('name')
					@yield('designation')
					@yield('promotion_date')
					@yield('changepass')
				
				@break				
				
				@case('pdate')
				{!! Form::open(['url'=>route('update'), 'class'=>'form-horizontal']) !!}
                                <div class="form-group{{ $errors->has('promotionDate') ? ' has-error' : '' }}" style="margin-right:2px;margin-left:2px;">
                                 <div class="input-group">
                                 {!! Form::label('promotionDate','Promotion Date',['class'=>'input-group-addon']) !!}
                                 {!! Form::date('promotionDate',$info->promotion_date,['class'=>'form-control', 'required'=>'required'], \Carbon\Carbon::now()) !!}
                                </div>
	                	@if ($errors->has('promotionDate'))
                               <span class="alert-danger">
                               <strong>{{ $errors->first('promotionDate') }}</strong>
                               </span>
                               @endif 
                                </div>
                               {!! Form::submit('Submit',['class'=> 'btn btn-success']) !!}
                               {!! Form::close() !!}
				<br><hr><br>
					@yield('name')
					@yield('designation')
					@yield('joining_date')
					@yield('changepass')
				
				@break				
				
				@case('changepass')
				{!! Form::open(['url'=>route('changepass'), 'class'=>'form-horizontal']) !!}
                                <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}" 
		style="margin-right:2px;margin-left:2px;">
            <div class="input-group">
            {!! Form::label('current_password','Current Password',['class'=>'input-group-addon']) !!} 
            {!! Form::password('current_password',['class'=>'form-control', 'required'=>'required']) !!}
            </div>
		@if($errors->has('current_password'))
		<span class="alert-danger">
                      <strong>{{ $errors->first('password') }}</strong>
                 </span>
               @endif 
          </div>
			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" 
		style="margin-right:2px;margin-left:2px;">
            <div class="input-group">
            {!! Form::label('password','Password',['class'=>'input-group-addon']) !!} 
            {!! Form::password('password',['class'=>'form-control', 'required'=>'required']) !!}
            </div>
		@if($errors->has('password'))
		<span class="alert-danger">
                      <strong>{{ $errors->first('password') }}</strong>
                 </span>
               @endif 
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" 
		style="margin-right:2px;margin-left:2px;">
            <div class="input-group">
            {!! Form::label('password_confirmation','Confirm Password',['class'=>'input-group-addon']) !!}
            {!! Form::password('password_confirmation',['class'=>'form-control', 'required'=>'required']) !!}
	   </div>
		@if ($errors->has('password_confirmation'))
                 <span class="alert-danger">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                 </span>
		@endif 
          </div>		
                               {!! Form::submit('Submit',['class'=> 'btn btn-success']) !!}
                               {!! Form::close() !!}
				<br><hr><br>
					@yield('name')
					@yield('designation')
					@yield('joining_date')
					@yield('promotion_date')
				
				@break				
				
				
				@default 
			@endswitch
		  @endisset
		  @empty($request)
			@yield('name')
			@yield('designation')
			@yield('joining_date')
			@yield('promotion_date')
			@yield('changepass')
		  @endempty	
	      @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
