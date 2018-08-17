<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel2">Right Sidebar</h4>
      </div>

      <div class="modal-body">
        <aside id="fh5co-aside" role="complementary" class="border js-fullheight">

    			<h1 id="fh5co-logo"><a href="index.html"><img src="{{ asset('images/logo.png') }}" alt="Free HTML5 Bootstrap Website Template"></a></h1>
    			<nav id="fh5co-main-menu" role="navigation">
    				<!-- <ul>
    					<li class="fh5co-active"><a href="index.html">Home</a></li>
    					<li><a href="/admin">Admin Login</a></li>
              <li><a href="/admin/register">Admin Signup</a></li>
    					<li><a href="about.html">About</a></li>
    					<li><a href="contact.html">Contact</a></li>
    				</ul>
            -->
            <ul>
              	<li class="fh5co-active"><a href="/">Home</a></li>
                @if (!Auth::guard('admin')->check())
                <li><a href="{{ URL::to('admin') }}">Admin Login</a></li>
                <li><a href="{{ URL::to('admin/register') }}">Admin Register</a></li>
            @else
                <li><h1>{{ Auth::guard('admin')->user()->name }} </h1></li>
                <li class="fh5co-active"><a href="{{ URL::to('admin/home') }}">Dashboard</a></li>
                <li>
                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                @endif
            </ul>

    			</nav>
    		</aside>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->
</div><!-- container -->
