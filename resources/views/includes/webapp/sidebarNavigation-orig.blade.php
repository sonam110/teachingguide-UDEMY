<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="{{ asset('assets/img/Avatar-min.png')}}" />
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs" id="username"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                    </span> <span class="text-muted text-xs block">Profile <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('account') }}">Account Profile</a></li>
                        <li class="divider"></li>
                        <li>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf</form>
                            <a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="active">
                <a href="#">
                  <i class="fa fa-th-large"></i>Dashboards
                  <span class="nav-label"></span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li class="{{ Route::currentRouteName() =='dashboardHome' ? 'active' : '' }}">
                        <a href="{{ route('dashboardHome') }}">Home Dashboard</a>
                    </li>
                    <li class="{{ Route::currentRouteName() =='dashboardCourseMonitor' ? 'active' : '' }}">
                        <a href="{{ route('dashboardCourseMonitor') }}">Course Monitor</a>
                    </li>
                </ul>


                <a href="#" id="damian"><i class="fa fa-search-plus"></i><span class="fa arrow">Search</span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ Route::currentRouteName() =='searchCourseBasic' ? 'active' : '' }}">
                        <a href="{{ route('searchCourseBasic') }}">Basic Course Search</a>
                    </li>
                    <li class="{{ Route::currentRouteName() =='searchCourse' ? 'active' : '' }}">
                        <a href="{{ route('searchCourse') }}">Course Search</a>
                    </li>
                    <li class="{{ Route::currentRouteName() =='searchTopic' ? 'active' : '' }}">
                        <a href="{{ route('searchTopic') }}">Topic Search</a>
                    </li>
                    <li class="{{ Route::currentRouteName() =='searchAuthor' ? 'active' : '' }}">
                        <a href="{{ route('searchAuthor') }}">Author Search</a>
                    </li>
                    <li class="{{ Route::currentRouteName() =='searchKeyword' ? 'active' : '' }}">
                        <a href="{{ route('searchKeyword') }}">Keyword Search</a>
                    </li>

                </ul>


            </li>

            <li>
                <a href="https://teachinguide.zendesk.com" target="_blank"><i class="fa fa-support"></i> <span class="nav-label">Support</span></a>
            </li>

        </ul>

    </div>
</nav>
