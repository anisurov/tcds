<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>{{ config('app.name', 'Teacher Course Distribution System') }}</title>

    <!-- Styles -->
<style type="text/css">
.container-fluid > .navbar-collapse, .container-fluid > .navbar-header, .container > .navbar-collapse, .container > .navbar-header {
	margin-right: 0;
	margin-left: 0;
}
.navbar-header {
	float: left;
}
.navbar::after {
	clear: both;
}.navbar::after, .navbar::before {
	content: " ";
	display: table;
}.navbar-default {
	background-color: #fff;
	border-color: #d3e0e9;
}.navbar-static-top {
	z-index: 1000;
	border-width: 0 0 1px;
}.navbar {
	position: relative;
	min-height: 50px;
	margin-bottom: 22px;
	border: 1px solid transparent;
}*, ::after, ::before {
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
}.container::after {
	clear: both;
}.container::after, .container::before {
	content: " ";
	display: table;
}.container {
	width: 1170px;
}.container {
	margin-right: auto;
	margin-left: auto;
	padding-left: 15px;
	padding-right: 15px;
}.navbar > .container-fluid .navbar-brand, .navbar > .container .navbar-brand {
	margin-left: -15px;
}.navbar-default .navbar-brand {
	color: #777;
}.navbar-brand {
	float: left;
	padding: 14px 15px;
	font-size: 18px;
	line-height: 22px;
	height: 50px;
}a {
	color: #3097d1;
	text-decoration: none;
}.navbar-fixed-bottom {
	bottom: 0;
	margin-bottom: 0;
	border-width: 1px 0 0;
}.navbar-fixed-bottom, .navbar-fixed-top {
	border-radius: 0;
}.navbar-fixed-bottom, .navbar-fixed-top {
	position: fixed;
	right: 0;
	left: 0;
	z-index: 1030;
}.row::after {
	clear: both;
}.row::after, .row::before {
	content: " ";
	display: table;
}.row {
	margin-left: -15px;
	margin-right: -15px;
}.col-md-offset-2 {
	margin-left: 16.66666667%;
}.col-md-8 {
	width: 66.66666667%;
}.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
	float: left;
}.col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
	position: relative;
	min-height: 1px;
	padding-left: 15px;
	padding-right: 15px;
}



body{
background-color:#9BA2AB;
border:5px red;
}
.panel-head-color{
  background-color:#245269 ; 
  color: white;
}
.panel-default > .panel-heading{
  background-color:#245269 ; 
  color: white;
  border-bottom-color:indianred;
  border-bottom-width:4px;
}

</style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top panel-head-color">
            <div class="container">
                <div class="navbar-header">
                  <a class="navbar-brand" href="{{ url('/') }}">
                       <b style="color: white"> {{ config('app.name', 'Teacher Course Distribution System') }} </b>
                    </a>
                </div>
             </div>
        </nav>

    
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default inside-body-panel-shadow">

                <div class="panel-body">
                  <p>
                    Respected,Sir
                  </p>
                  <p>
                    Your registration on <b> {{config('app.name')}}</b> was successful.<br>
                    Here is your credintials<br>
                    <b>Username/Email:</b>{{$title}}<br>
                    <b>Password:</b>{{$content}}<br>
                      <a href="{{config('app.url')}}/login" class="btn btn-primary">login</a>
                  </p>
                  <p>Regards,<br>Admin,<br>{{config('app.name')}}</p>
                </div>
        </div>
    </div>


    </div>
    <div class="navbar navbar-default navbar-fixed-bottom" style="background-color:#245269;text-align: center; padding-top: 10px;color:white;height:20px">


    </div>

  
    <!-- Scripts -->
</body>
</html>
