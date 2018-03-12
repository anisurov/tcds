        <li class="{{Request::is('registration') ? "active" : "" }}"><a href="{{ url('/registration') }}">Teacher Registration</a></li>
<li class="dropdown {{Request::is('#') ? "active" : "" }}">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                 Course
                             </a>

                             <ul class="dropdown-menu">
                          
                                 <li>
                                    <a href="{{route('allcourse')}}">           
                                      All Courses
                                     </a>      
                                 </li>
			     <li>
                                    <a href="{{route('addcourseform')}}">           
                                      Add new course
                                     </a>      
                                 </li>
			    <li>
                                    <a href="{{route('setting')}}">           
                                      Course In Current Semester
                                     </a>      
                                 </li>
                         </ul>
</li>        
