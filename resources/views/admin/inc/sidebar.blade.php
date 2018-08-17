@section('sidebar')
<div>
  <nav class="side-navbar">
    <div class="side-navbar-wrapper">
      <div class="sidenav-header d-flex align-items-center justify-content-center">
        <div class="sidenav-header-inner text-center">
          <img src="{{ asset('./images/favicon.jpg') }}" alt="person" class="img-fluid rounded-circle">
          <h2><strong class="text-primary">Witty Funy Feeds  </strong> Admin</h2>
          <!-- <h4 class="text-primary">{{Session::get('email')}}</h4> -->
        </div>
        <div class="sidenav-header-logo"><a href="" class="brand-small text-center"> <strong>WF</strong><strong class="text-primary">F</strong></a></div>
      </div>
      <div class="main-menu">
        <ul id="side-main-menu" class="side-menu list-unstyled">
          <li>
            <a href="{{ route('admin.home') }}">
              <i class="fa fa-home"></i><span>Home</span>
            </a>
          </li>
           <li>
              <a href="{{ route('admin.open-newapp-form') }}">
                <i class="fa fa-plus" aria-hidden="true"></i><span>Add New Application</span>
              </a>
            </li>
          <li>
             <a href="{{ route('admin.deleteimgfolder') }}">
          <i class="fa fa-trash-o" aria-hidden="true"></i><span>Delete  Folder</span>
             </a>
          </li>

        </ul>
      </div>
    </div>
  </nav>
 @show
</div>
