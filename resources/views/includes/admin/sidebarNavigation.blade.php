<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element" id="step1"> <span>
                    <img alt="image" class="img-circle" src="{{ asset('assets/img/profile_small.jpg')}}" />
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                    </span> <span class="text-muted text-xs block">Profile <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Account Profile</a></li>
                        <li><a href="contacts.html">Change Password</a></li>
                        <li><a href="mailbox.html">Billing Information</a></li>
                        <li><a href="subscription.html">Subscription</a></li>
                        <li class="divider"></li>
                        <li>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf</form>
                            <a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    </ul>
                </div>

            </li>
            <li>
                <a href="index.html"><i class="fa fa-search"></i> <span class="nav-label">Member</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#" id="damian"><i class="fa fa-th-large"></i>Dashboards <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Member Dashboard</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ Route::currentRouteName() =='memberSearch' ? 'active' : '' }}">
                        <a href="{{ route('memberSearch') }}" id="damian"><i class="fa fa-search-plus"></i> Search <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li class="nav-link {{ Route::currentRouteName() =='memberSearch' ? 'active' : '' }}">
                                <a href="{{ route('memberSearch') }}">Course Search</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-pie-chart"></i> <span class="nav-label">Insights </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="#" id="damian"><i class="fa fa-th-large"></i>Dashboards <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Sales Dashboard</a>
                            </li>
                            <li>
                                <a href="#">Topic Dashboard</a>
                            </li>
                            <li>
                                <a href="#">Author Dashboard</a>
                            </li>

                        </ul>
                    </li>
                </ul>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="#" id="damian"><i class="fa fa-search-plus"></i>Advanced Search <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Course Search</a>
                            </li>
                            <li>
                                <a href="#">Topic Search</a>
                            </li>
                            <li>
                                <a href="#">Author Search</a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Compete </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="#" id="damian"><i class="fa fa-th-large"></i>Dashboards <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Sales Dashboard</a>
                            </li>
                            <li>
                                <a href="#">Topic Dashboard</a>
                            </li>
                            <li>
                                <a href="#">Author Dashboard</a>
                            </li>
                            <li>
                                <a href="#">Keywords Dashboard</a>
                            </li>

                        </ul>
                    </li>
                </ul>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="#" id="damian"><i class="fa fa-search-plus"></i>Advanced Search <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Course Search</a>
                            </li>
                            <li>
                                <a href="#">Topic Search</a>
                            </li>
                            <li>
                                <a href="#">Author Search</a>
                            </li>
                            <li>
                                <a href="#">Keyword Search</a>
                            </li>
                            <li>
                                <a href="#">Niche Hunter</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a href="support.html"><i class="fa fa-support"></i> <span class="nav-label">Support</span></a>
            </li>

        </ul>

    </div>
</nav>
