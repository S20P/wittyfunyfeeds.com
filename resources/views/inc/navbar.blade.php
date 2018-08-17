<header class="nav-header">
<nav class="navbar navbar-inverse navbar-static-top">
<div id="header-region">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-2">

         <!-- only english -->
          <select class="select-lang " id="pageSelect">
              @if(Request::route()->getPrefix()=="/en")
               <option value="{{Request::route()->getPrefix()}}" selected>English</option>
              @else
              <option value="{{ asset('/')}}" selected>English</option>
              @endif
         </select>

            <!-- with Hindi -->
         <!-- <select class="select-lang " id="pageSelect">
             @if(Request::route()->getPrefix()=="/hi")
              <option value="{{Request::route()->getPrefix()}}" selected>हिंदी</option>
              <option value="/en">English</option>
             @elseif(Request::route()->getPrefix()=="/en")
              <option value="/hi">हिंदी</option>
              <option value="{{Request::route()->getPrefix()}}" selected>English</option>
             @else
             <option value="/hi">हिंदी</option>
             <option value="{{ asset('/')}}" selected>English</option>
             @endif
        </select> -->
        </div>
        <div class="col-md-5 col-sm-4 col-xs-5">
          @guest
            <a id="without-loing-logo" href="{{ route('home') }}" class="logo link"></a>
          @else
            <a href="{{ route('home') }}" class="logo link"></a>
          @endguest
        </div>
        <div class="col-md-4 col-sm-4 col-xs-5">
          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->
              @guest
                  <li>
                  <div class="login">
                  <!-- <a  href="{{ route('redirect') }}" class="login-btn">
                  </a> -->
                  <!-- <a href="{{ route('redirect') }}" target="_blank" class="cwf-btn">
                    <button type="button" id="login_with_fb_btn" class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow">
                   <p class="text-btn-start"> <span></span>    Sign in with Facebook</p>
                    </button>
                  </a> -->
               <a href="{{ route('redirect') }}" id="log-in-btn1" class="cwf-btn">
                  <button class="loginBtn loginBtn--facebook">
                    Login with Facebook
                  </button>
               </a>

               <a href="{{ route('redirect') }}"  id="log-in-btn2" class="cwf-btn">
                  <button class="loginBtn loginBtn--facebook">
                  </button>
               </a>

                  </div>
                  </li>
              @else
                  <li class="dropdown">
                      <a id="nav-prof-img1" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" style="position:relative;padding-left:50px;">
                         <img src="{{Auth::user()->picture}}" id="navbar-right-avt" alt="">
                          {{ Auth::user()->first_name }} <span class="caret"></span>
                      </a>

                      <a id="nav-prof-img" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" style="position:relative;padding-left:50px; display:none">
                         <img src="{{Auth::user()->picture}}" id="navbar-right-avt" alt="">
                      </a>

                      <ul class="dropdown-menu">
                          <li>
                              <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                           <i class="fa fa-btn fa-sign-out"></i>
                                  Logout
                              </a>
                              <a href="{{ url('profile') }}"><i class="fa fa-btn fa-user"></i> Profile </a>
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

    </div>
    </div>
</nav>
</header>
