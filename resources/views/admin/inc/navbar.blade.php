<header class="nav-header">
<nav class="navbar navbar-inverse navbar-static-top">
<div id="header-region">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-2">

          @if(Request::is('admin'))
          @elseif(Request::is('admin/register'))
          @else

          <div class="navbar-header">
              <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-bars" aria-hidden="true"></i></a>
          </div>


 @endif
        </div>
        <div class="col-md-5 col-sm-4 col-xs-5">
              @if (!Auth::guard('admin')->check())
            <a id="admin-top-bar-logo-without-login" href="{{ route('home') }}" class="logo link"></a>
              @else
            <a id="admin-top-bar-logo" href="{{ route('home') }}" class="logo link"></a>
             @endif
        </div>
        <div class="col-md-4 col-sm-4 col-xs-5">
          <!-- Right Side Of Navbar -->
          <ul id="admin-nav-manu" class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->
              @if (!Auth::guard('admin')->check())
                  <li><a href="{{ URL::to('admin') }}">Login</a></li>
                  <li><a href="{{ URL::to('admin/register') }}">Register</a></li>
              @else
                  <li class="dropdown">
                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                      <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                          <li>

                          </li>
                      </ul> -->
                  </li>
              @endif
          </ul>

        </div>

      </div>

    </div>
    </div>
</nav>
</header>
