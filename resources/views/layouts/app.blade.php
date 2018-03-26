<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Teacher Course Distribution System') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
        <nav class="navbar navbar-default navbar-static-top panel-head-color">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                       <b style="color: white"> {{ config('app.name', 'Teacher Course Distribution System') }} </b>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left">
                    @auth
                      @if(Auth::user()->check==0)
                  			@include('layouts.navbar')
                      @else

                      <li class="dropdown {{Request::is('#') ? "active" : "" }}">
                                                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                                       Notification
                                                   </a>
                                                   <ul class="dropdown-menu">
                                                     @php($notifications=App\Notify::where('end_date','>',date("Y-m-d"))->get())
                                                     @if($notifications->count()>0)
                                                    @foreach($notifications as $notification)
                                                       <li>
                                                          <a href="{{route('teacherAddcourseForm')}}/?semester_id={{$notification->semester_id}}">
                                                            please add course to <b>{{App\Semester::where('semester_id',$notification->semester_id)->where('semesterStatus','!=','13')->where('semesterStatus','!=','0')->pluck('semesterName')->first()}}</b> within {{$notification->end_date}}
                                                          </a>
                                                       </li>
                                                    @endforeach
                                                    @else
                                                    You have nothing to show
                                                    @endif
                                               </ul>
                      </li>
                      @endif
                     @else
                     &nbsp;
                    @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest


                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <b style="color: white"> {{ Auth::user()->name }} </b> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                              @if(Auth::user()->check==1)
                                    <li>
                                       <a href="{{route('setting')}}">
                                         Settings
                                        </a>
                                    </li>
                              @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
 		   @if (session('success'))
       		      <div class="col-md-8 col-md-offset-2">
                  <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                        {{ session('success') }}
            		  </div>
		           </div>
      @elseif (session('failed'))
       		      <div class="col-md-8 col-md-offset-2">
    			          <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ session('failed') }}
                  </div>
		            </div>
                    @endif
				  @yield('content')

     <nav class="navbar navbar-default navbar-fixed-bottom" style="background-color:#245269;text-align: center; padding-top: 10px;color:white;">
		<footer ><?php echo '&copy  IIUC   ' . date('Y'); ?></footer>
    </nav>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
