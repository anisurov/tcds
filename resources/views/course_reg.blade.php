@extends('layouts.app')

@section('content')

    <div class="row" style="color: white">

        <div class="col-md-6 col-md-offset-3">

            <h3 style="color: white"> Course Registration</h3>
            <hr>

            {!! Form::open(['url'=>'/course_regS', 'files' => true]) !!}

            {!! Form::label('c_name','Name') !!}
            {!! Form::text('c_name','',['class'=>'form-control', 'required'=>'required']) !!}

            <br>

            {!! Form::label('c_code','Code') !!}
            {!! Form::text('c_code','',['class'=>'form-control', 'required'=>'required']) !!}

            <br> <br> <br>

            {!! Form::submit('Submit',['class'=> 'btn btn-success']) !!}
            <br> <br> <br>

            {!! Form::close() !!}

        </div>

    </div>

@endsection