@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default inside-body-panel-shadow">
                <div class="panel-heading">
                  @foreach($teacher as $data)
                    <div class="pull-right image">
                      <img class="img-circle" src="{{Storage::url($data->t_image)}}"
                         alt="{{$data->t_name}}">
                     </div>
                      {{$data->t_name}}<br>
                      {{$data->t_designation}}<br>
                  @endforeach 
                </div>
                <div class="panel-body">
                Select Course

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
