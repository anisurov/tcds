@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #245269; border-bottom-color: indianred;border-bottom-width: 2px;color: #cccccc"> <b> Welcome to </b></div>


                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                <b style="font-size: xx-large"> Course Distribution Sytem
                <br> <br>  </b>

                </div>

                <div class="panel-footer" style="background-color: #245269; border-bottom-color: black; border-bottom-width: 2px;color: #cccccc"> <b>
                       <center> Copyright &#169; 2017 |  Department of CSE, IIUC  </center> </b> </div>


            </div>
        </div>
    </div>
</div>

@endsection