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
                           <form action="{{route('editTeacherProfile')}}" method="post" class="pull-right">
                               {!! csrf_field() !!}
                               <input type="hidden" name="type" value="name">
                               <input type="hidden" name="email" value="{{$info->t_email}}">

                               <input type="submit" class="btn btn-primary  btn-sm" value="Edit">
                           </form>
                        </div>
                  </div>
	       @endsection
		@section('contact')
                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		<div class="input-group col-md-12">
			   <div class="input-group-addon" style="width:15%">Contact</div>
                           <div class="form-control" style="width:60%">{{$info->t_contact}}</div>
                           <form action="{{route('editTeacherProfile')}}" method="post" class="pull-right">
                               {!! csrf_field() !!}
                               <input type="hidden" name="type" value="contact">
                               <input type="hidden" name="email" value="{{$info->t_email}}">

                               <input type="submit" class="btn btn-primary  btn-sm" value="Edit">
                           </form>
                        </div>
                  </div>
	       @endsection

		  @section('designation')
                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		<div class="input-group col-md-12">
			   <div class="input-group-addon" style="width:15%">Designation</div>
                           <div class="form-control" style="width:60%">{{$info->t_designation}}</div>
                           <form action="{{route('editTeacherProfile')}}" method="post" class="pull-right">
                               {!! csrf_field() !!}
                               <input type="hidden" name="type" value="designation">
                               <input type="hidden" name="email" value="{{$info->t_email}}">

                               <input type="submit" class="btn btn-primary  btn-sm" value="Edit">
                           </form>
                        </div>
                  </div>
	       @endsection

		  @section('joining_date')
                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		<div class="input-group col-md-12">
			   <div class="input-group-addon" style="width:15%">Joining Data</div>
                           <div class="form-control" style="width:60%">{{$info->joining_date}}</div>
                           <form action="{{route('editTeacherProfile')}}" method="post" class="pull-right">
                               {!! csrf_field() !!}
                               <input type="hidden" name="type" value="jdate">
                               <input type="hidden" name="email" value="{{$info->t_email}}">

                               <input type="submit" class="btn btn-primary  btn-sm" value="Edit">
                           </form>
                        </div>
                  </div>
	       @endsection

		  @section('promotion_date')
                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		<div class="input-group col-md-12">
			   <div class="input-group-addon" style="width:15%">Promotion Date</div>
                           <div class="form-control" style="width:60%">{{$info->promotion_date}}</div>
                           <form action="{{route('editTeacherProfile')}}" method="post" class="pull-right">
                               {!! csrf_field() !!}
                               <input type="hidden" name="type" value="pdate">
                               <input type="hidden" name="email" value="{{$info->t_email}}">

                               <input type="submit" class="btn btn-primary  btn-sm" value="Edit">
                           </form>
                        </div>
                  </div>
	       @endsection

         @section('busy')
         <div class="form-group" style="margin-right:2px;margin-left:2px;">
      <div class="input-group col-md-12">
<div class="input-group-addon" style="width:15%">Busy</div>
                  <div class="form-control" style="width:60%">{{$info->is_busy}}</div>
                  <form action="{{route('editTeacherProfile')}}" method="post" class="pull-right">
                      {!! csrf_field() !!}
                      <input type="hidden" name="type" value="busy">
                      <input type="hidden" name="email" value="{{$info->t_email}}">

                      <input type="submit" class="btn btn-primary  btn-sm" value="Edit">
                  </form>
               </div>
         </div>
   	       @endsection
		   @isset($type)
			@switch($type)
				@case('name')
				{!! Form::open(['url'=>route('updateTeacherProfile'), 'class'=>'form-horizontal','files' => true]) !!}
                                <div class="form-group" style="margin-right:2px;margin-left:2px;">
                                  <div class="input-group">
                                    {!! Form::label('t_name','Name ( in English )',['class'=>'input-group-addon']) !!}
                                    {!! Form::text('t_name',$info->t_name,['class'=>'form-control', 'required'=>'required']) !!}
                                    {!! Form::hidden('email',$info->t_email) !!}
		                 </div>
@if ($errors->has('t_name'))
                               <span class="alert-danger">
                               <strong>{{ $errors->first('t_name') }}</strong>
                               </span>
                               @endif
                               </div>
                               {!! Form::submit('Submit',['class'=> 'btn btn-success']) !!}
                               {!! Form::close() !!}
				<br><hr><br>
          @yield('contact')
					@yield('designation')
					@yield('joining_date')
					@yield('promotion_date')
          @yield('busy')

          			@break

                @case('contact')
        				{!! Form::open(['url'=>route('updateTeacherProfile'), 'class'=>'form-horizontal','files' => true]) !!}
                                        <div class="form-group" style="margin-right:2px;margin-left:2px;">
                                          <div class="input-group">
                                            {!! Form::label('t_contact','Contact',['class'=>'input-group-addon']) !!}
                                            {!! Form::text('t_contact',$info->t_contact,['class'=>'form-control', 'required'=>'required']) !!}
                                            {!! Form::hidden('email',$info->t_email) !!}
        		                 </div>
        @if ($errors->has('t_contact'))
                                       <span class="alert-danger">
                                       <strong>{{ $errors->first('t_contact') }}</strong>
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
                  @yield('busy')

                  			@break


				@case('designation')
				{!! Form::open(['url'=>route('updateTeacherProfile'), 'class'=>'form-horizontal','files' => true]) !!}
		               <div class="form-group" style="margin-right:2px;margin-left:2px;">
                                <div class="input-group">
                                 {!! Form::label('t_designation','Designation',['class'=>'input-group-addon']) !!}
                                 {!! Form::text('t_designation',$info->t_designation,['class'=>'form-control', 'required'=>'required']) !!}
                                 {!! Form::hidden('email',$info->t_email) !!}
                               </div>
                              </div>
                               {!! Form::submit('Submit',['class'=> 'btn btn-success']) !!}
                               {!! Form::close() !!}
				<br><hr><br>
					@yield('name')
          @yield('contact')
					@yield('joining_date')
					@yield('promotion_date')
          @yield('busy')

				@break
				@case('jdate')
       			        <div class="form-group{{ $errors->has('t_email') ? ' has-error' : '' }}" style="margin-right:2px;margin-left:2px;">
                                 <div class="input-group">
                                 {!! Form::label('joingDate','Joining Date',['class'=>'input-group-addon']) !!}
                                 {!! Form::date('joingDate',$info->joining_date,['class'=>'form-control', 'required'=>'required'], \Carbon\Carbon::now()) !!}
                                 {!! Form::hidden('email',$info->t_email) !!}
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
          @yield('contact')
					@yield('designation')
					@yield('promotion_date')
          @yield('busy')

				@break

				@case('pdate')
				{!! Form::open(['url'=>route('updateTeacherProfile'), 'class'=>'form-horizontal']) !!}
                                <div class="form-group{{ $errors->has('promotionDate') ? ' has-error' : '' }}" style="margin-right:2px;margin-left:2px;">
                                 <div class="input-group">
                                 {!! Form::label('promotionDate','Promotion Date',['class'=>'input-group-addon']) !!}
                                 {!! Form::date('promotionDate',$info->promotion_date,['class'=>'form-control', 'required'=>'required'], \Carbon\Carbon::now()) !!}
                                 {!! Form::hidden('email',$info->t_email) !!}
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
          @yield('contact')
					@yield('designation')
					@yield('joining_date')
          @yield('busy')

				@break

        @case('busy')
				{!! Form::open(['url'=>route('updateTeacherProfile'), 'class'=>'form-horizontal']) !!}
                                <div class="form-group{{ $errors->has('promotionDate') ? ' has-error' : '' }}" style="margin-right:2px;margin-left:2px;">
                                 <div class="input-group">
                                 {!! Form::label('busy','Busy',['class'=>'input-group-addon']) !!}
                                 <select name="busy" class="form-control custom-control">
           													<option value="">--- select ---</option>
           													<option value="yse" {{$info->is_busy=='yes' ? 'selected' : ''}}>yes</option>
           													<option value="no" {{$info->is_busy=='no' ? 'selected' : ''}}>no</option>
 											            </select>
                                  {!! Form::hidden('email',$info->t_email) !!}
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
          @yield('contact')
					@yield('designation')
					@yield('joining_date')
          @yield('promotion_date')
				@break

				@default
			@endswitch
		  @endisset
		  @empty($type)
			@yield('name')
      @yield('contact')
			@yield('designation')
			@yield('joining_date')
			@yield('promotion_date')
      @yield('busy')

		  @endempty
	      @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
