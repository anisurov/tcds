        <li class="{{Request::is('registration') ? "active" : "" }}"><a href="{{ url('/registration') }}">Teacher Registration</a></li>

        <li class="{{Request::is('/teacher/all') ? "active" : "" }}"><a href="{{ route('teacherlist') }}">Teacher List</a></li>
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
			                   </ul>
</li>

<li class="dropdown {{Request::is('#') ? "active" : "" }}">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                 Semester
                             </a>
                             <ul class="dropdown-menu">

                                 <li>
                                    <a href="{{route('allsemester')}}">
                                      All Semester
                                    </a>
                                 </li>
			    <li>
                                    <a href="{{route('addsemesterform')}}">
                                      Add new Semester
                                     </a>
                                 </li>
                         </ul>
</li>


<li class="dropdown {{Request::is('#') ? "active" : "" }}">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                 Course Distribution
                             </a>
                             <ul class="dropdown-menu">

                                 <li>
                                    <a href="{{route('notifyForm')}}">
                                      Notify
                                    </a>
                                 </li>
			                            <li>
                                    <a href="{{route('active')}}">
                                      Approve  Course Request
                                     </a>
                                 </li>
                                 <li>
                                    <a href="{{route('allotCourse')}}">
                                      Allot Course
                                    </a>
                                 </li>
                                 <li>
                                    <a href="{{route('details')}}">
                                      Distributed
                                    </a>
                                 </li>
                         </ul>
</li>
