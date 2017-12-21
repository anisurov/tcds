@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default inside-body-panel-shadow">
                <div class="panel-heading">
                  @foreach($teacher as $data)
                      {{$data->t_name}}
                      <img src="{{Storage::url($data->t_image)}}"
                         alt="" style="max-width: 130px;" width="130" height="100" border="0">
                  @endforeach 
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                Select Course

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
