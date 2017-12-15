@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: whitesmoke"> Dashboard </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <button type="button" class="btn btn-primary btn-lg" style="margin-left: 100px">
                            <a href="t_reg"> <p style="color: white"> Teacher Registration </p> </a> </button>


                        <button type="button" class="btn btn-primary btn-lg" style="margin-left: 50px">
                            <a href="course_reg"> <p style="color: white"> Course Registration </p> </a>
                        </button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
