@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-3">
           <div class="panel panel-default inside-body-panel-shadow">
            <div class="panel-heading">Teacher Registration </div>
            <div class="panel-body">

            {!! Form::open(['url'=>'/registration', 'class'=>'form-horizontal','files' => true]) !!}
            
          <div class="form-group" style="margin-right:2px;margin-left:2px;">
            <div class="input-group">
              {!! Form::label('t_name','Name ( in English )',['class'=>'input-group-addon']) !!}
               {!! Form::text('t_name','',['class'=>'form-control', 'required'=>'required']) !!}
            </div>
          </div>
          <div class="form-group{{ $errors->has('t_email') ? ' has-error' : '' }}" style="margin-right:2px;margin-left:2px;">
            <div class="input-group">
            {!! Form::label('t_email','Email',['class'=>'input-group-addon']) !!}
            {!! Form::email('t_email','',['class'=>'form-control', 'required'=>'required']) !!}
            </div>
		@if ($errors->has('t_email'))
                 <span class="alert-danger">
                      <strong>{{ $errors->first('t_email') }}</strong>
                 </span>
               @endif 
          </div>

          <div class="form-group" style="margin-right:2px;margin-left:2px;">
            <div class="input-group">
            {!! Form::label('t_designation','Designation',['class'=>'input-group-addon']) !!}
            {!! Form::text('t_designation','',['class'=>'form-control', 'required'=>'required']) !!}
             </div>
          </div>
          <div class="form-group{{ $errors->has('t_email') ? ' has-error' : '' }}" style="margin-right:2px;margin-left:2px;">
            <div class="input-group">
            {!! Form::label('joingDate','Joining Date',['class'=>'input-group-addon']) !!}
            {!! Form::date('joingDate','',['class'=>'form-control', 'required'=>'required'], \Carbon\Carbon::now()) !!}
             </div>
		@if ($errors->has('joingDate'))
                 <span class="alert-danger">
                      <strong>{{ $errors->first('joingDate') }}</strong>
                 </span>
               @endif 
          </div>
          <div class="form-group" style="margin-right:2px;margin-left:2px;">
            <div class="input-group">
            {!! Form::label('contact','Contact No',['class'=>'input-group-addon']) !!}
            {!! Form::text('contact','',['class'=>'form-control', 'required'=>'required']) !!}
            </div>
          </div>
          <div class="form-group" style="margin-right:2px;margin-left:2px;">
            <div class="input-group">
            {!! Form::label('image','Picture',['class'=>'input-group-addon']) !!}
            {!! Form::file('image',['class'=>'form-control', 'required'=>'required']) !!}
            </div>
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" 
		style="margin-right:2px;margin-left:2px;">
            <div class="input-group">
            {!! Form::label('password','Password',['class'=>'input-group-addon']) !!} 
            {!! Form::password('password',['class'=>'form-control', 'required'=>'required']) !!}
            </div>
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
		@elseif($errors->has('password'))
		<span class="alert-danger">
                      <strong>{{ $errors->first('password') }}</strong>
                 </span>
               @endif 
          </div>

            {!! Form::submit('Submit',['class'=> 'btn btn-success']) !!}

            {!! Form::close() !!}
          </div>
      </div>
    </div>
</div>

@endsection
