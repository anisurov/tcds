@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default inside-body-panel-shadow">
                <div class="panel-heading">
					Error!!
		</div>
                <div class="panel-body">
                        <div class="alert alert-danger">
                            <h1>Hey, Maybe you lost your way!!</h1>
                        </div>
			<a href="/" class="btn btn-info" role="button">Go back To Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
