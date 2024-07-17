<nav class="navbar-default navbar-static-side " role="navigation">
      <div class="sidebar-collapse" id="tsideMenu">
        <ul class="nav metismenu" id="side-menu" style="">
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
            <!--<li class="{{ substr(Route::currentRouteName(),0,9) =='dashboard' ? 'active' : '' }}"> -->
            <li class="active">
                <a href="#"><i class="fa fa-th-large"></i><span class="nav-label">Dashboards</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ Route::currentRouteName() =='dashboardHome' ? 'active' : '' }}">
                        <a href="{{ route('dashboardHome') }}">Home Dashboard</a>
                    </li>
                    <li class="{{ Route::currentRouteName() =='dashboardCourseMonitor' ? 'active' : '' }}">
                        <a href="{{ route('dashboardCourseMonitor') }}">Course Monitor</a>
                    </li>
                </ul>
            </li>

            <!--<li class="{{ substr(Route::currentRouteName(),0,6) =='search' ? 'active' : '' }}">-->
            <li class="active">
              <a href="#"><i class="fa fa-search-plus"></i><span class="nav-label">Search</span><span class="fa arrow"></span></a>
              <ul class="nav nav-second-level">
                  <?php use App\Http\Controllers\MemberController;?>
                  @if(!MemberController::hasStudent())
                  <li class="{{ Route::currentRouteName() =='searchCourseBasic' ? 'active' : '' }}">
                      <a href="{{ route('searchCourseBasic') }}">Basic Course Search</a>
                  </li>
                  @endif
                  <li class="{{ Route::currentRouteName() =='searchSubCat' ? 'active' : '' }}">
                      <a href="{{ route('searchSubCat') }}">Subcategories</a>
                  </li>
                  <li class="{{ Route::currentRouteName() =='searchCourse' ? 'active' : '' }}">
                      <a href="{{ route('searchCourse') }}">Course Database</a>
                  </li>
                  <li class="{{ Route::currentRouteName() =='searchTopic' ? 'active' : '' }}">
                      <a href="{{ route('searchTopic') }}">Topic Finder</a>
                  </li>
                  <li class="{{ Route::currentRouteName() =='searchAuthor' ? 'active' : '' }}">
                      <a href="{{ route('searchAuthor') }}">Author Search</a>
                  </li>
                  <li class="{{ Route::currentRouteName() =='keywordAnalytics' ? 'active' : '' }}">
                      <a href="{{ route('keywordAnalytics') }}">Keyword Analytics</a>
                  </li>

              </ul>
            </li>
            <li class="{{ Route::currentRouteName() =='filterindex' ? 'active' : '' }}">
                <a href="{{ route('filterindex') }}"><i class="fa fa-filter"></i> <span class="nav-label">Filter</span></a>
            </li>
            <li>
                <a href="https://teachinguide.zendesk.com" target="_blank"><i class="fa fa-support"></i> <span class="nav-label">Support</span></a>
            </li>
        </ul>
    </div>
</nav>
