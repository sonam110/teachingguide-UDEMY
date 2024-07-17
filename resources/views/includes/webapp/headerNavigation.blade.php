<div class="row border-bottom">

  <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li>
          <a class="page-scroll" href="/">Homepage</a>
        </li>

        <li>
            <form id="logout1-form" method="POST" action="{{ route('logout') }}">@csrf</form>
            <a class="page-scroll" href="#" onclick="document.getElementById('logout1-form').submit();">
              <i class="fa fa-sign-out"></i>Logout
            </a>
        </li>

    </ul>

  </nav>
</div>
