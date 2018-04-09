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
                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		        <div class="input-group col-md-12">
			                     <div class="input-group-addon" style="width:15%">Joining Date</div>
                           <div class="form-control" style="width:60%">{{$data->joining_date}}</div>
                        </div>
                  </div>

                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		        <div class="input-group col-md-12">
			                     <div class="input-group-addon" style="width:15%">Promotion Date</div>
                           <div class="form-control" style="width:60%">{{$data->promotion_date}}</div>
                        </div>
                  </div>

                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		        <div class="input-group col-md-12">
			                     <div class="input-group-addon" style="width:15%">Email</div>
                           <div class="form-control" style="width:60%">{{$data->t_email}}</div>
                        </div>
                  </div>
                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		        <div class="input-group col-md-12">
			                     <div class="input-group-addon" style="width:15%">Contact</div>
                           <div class="form-control" style="width:60%">{{$data->t_contact}}</div>
                        </div>
                  </div>
                  @if(Auth::user()->check==0)
                  <div class="form-group" style="margin-right:2px;margin-left:2px;">
            		        <div class="input-group col-md-12">
			                     <div class="input-group-addon" style="width:15%">Busy</div>
                           <div class="form-control" style="width:60%">{{$data->is_busy}}</div>
                        </div>
                  </div>
                  @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
