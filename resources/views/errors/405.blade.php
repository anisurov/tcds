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
                        <div class="alert alert-failed">
                            <h1>Sorry, Page Not Found 405</h1>
			<a href="/" class="btn btn-info" role="button">Go back To Home</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
