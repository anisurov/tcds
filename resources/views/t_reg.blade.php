@extends('layouts.app')

@section('content')

    <div class="row" style="color: white">

        <div class="col-md-6 col-md-offset-3">

            <h3 style="color: white"> Teacher Registration</h3>
            <hr>

            {!! Form::open(['url'=>'/t_regS', 'files' => true]) !!}

            {!! Form::label('t_name','Name ( in English )') !!}
            {!! Form::text('t_name','',['class'=>'form-control', 'required'=>'required']) !!}

            <br>
            {!! Form::label('t_email','Email') !!}
            {!! Form::email('t_email','',['class'=>'form-control', 'required'=>'required']) !!}

            <br>


            {!! Form::label('t_designation','Designation') !!}
            {!! Form::text('t_designation','',['class'=>'form-control', 'required'=>'required']) !!}


            <br>


            {!! Form::label('contact','Contact No') !!}
            {!! Form::text('contact','',['class'=>'form-control', 'required'=>'required']) !!}

            <br>
            {!! Form::label('image','Picture') !!}
            {!! Form::file('image','',['class'=>'form-control', 'required'=>'required']) !!}

            <br>

            <b>Password</b>
            <hr>

            {!! Form::label('password','Password') !!} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            {!! Form::password('password','',['class'=>'form-control', 'required'=>'required']) !!}

            <br><br>

            {!! Form::label('password_confirmation','Confirm Password:') !!} &nbsp;
            {!! Form::password('password_confirmation','',['class'=>'form-control', 'required'=>'required']) !!}

            <br> <br> <br>

            {!! Form::submit('Submit',['class'=> 'btn btn-success']) !!}
            <br> <br> <br>

            {!! Form::close() !!}

        </div>

    </div>

@endsection