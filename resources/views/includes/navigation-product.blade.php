<div class="navbar-wrapper product-page">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
              <div class="navbar-header page-scroll">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a style="" class="navbar-brand" href="/"><!--Teaching Guide-->
                    <!-- <img class="logowhite" height="30" src="{{ asset('assets/img/logo-white-min2.png') }}"/>
                    <img class="logocolor" height="30" src="{{ asset('assets/img/logo-color-min2.png') }}"/> -->
                    <img class="logowhite" height="50" src="{{ asset('assets/img/logo/logo_white.svg') }}"/>
                    <img class="logocolor" height="50" src="{{ asset('assets/img/logo/logo_color.svg') }}"/>
                  </a>
              </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                          <li><a class="page-scroll" href="/">Home</a></li>
                          <li><a class="page-scroll" href="/product">Product</a></li>
                          <li><a class="page-scroll" href="/blog">Blog</a></li>
                          <li><a class="page-scroll" href="/about">About</a></li>
                          <li><a class="page-scroll" href="{{ route('dashboardHome')}}">Dashboard</a></li>
                          <li>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf</form>
                            <a class="page-scroll" href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
                          </li>
                        @else
                          <li><a class="page-scroll" href="/">Home</a></li>
                          <li><a class="page-scroll" href="/product">Product</a></li>
                          <li><a class="page-scroll" href="/blog">Blog</a></li>
                          <li><a class="page-scroll" href="/about">About</a></li>
                          <li><a class="page-scroll" href="{{ route('login')}}">Login</a></li>
                          <li><a class="page-scroll" href="#pricing">Signup</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
</div>
