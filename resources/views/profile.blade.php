@extends('layouts.app')

@section('content')
@guest
<div class="container main-content">
  <div class="row main-page">
    <div class="col-mg-12">
      <div class="panel panel-default" id="user-profile-tab">
          <div class="panel-heading" id="user_profile_heading">

 <h1><i class="fa fa-user-circle-o" aria-hidden="true"></i>  Click login with facebook to show your profile</h1>
  <div class="panel-body" id="user_profile_body">
    <a href="{{ route('redirect') }}" id="log-in-btn1" class="cwf-btn">
       <button class="loginBtn loginBtn--facebook">
         Login with Facebook to view Your Profile
       </button>
    </a>
 </div>
 </div>
</div>
</div>
</div>
</div>
@else
<div class="container main-content">
  <div class="row main-page">
    <div class="col-md-2">
    </div>
     <div class="col-md-8">
       <div class="panel panel-default" id="user-profile-tab">
           <div class="panel-heading" id="user_profile_heading">
             <ul id="user_profile_heading_title">
               <li><h1>User Profile</h1></li>
               <li class="Prof_page_logout_link">
                 <a href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              <i class="fa fa-btn fa-sign-out"></i>
                     Logout
                 </a>
               </li>
             </ul>
           </div>
           <div class="panel-body" id="user_profile_body">
              <div class="user-profile-img">
                  <img src="{{$user->picture}}" alt="" id="avt-profile">
              </div>
               <div class="user-profile-info">
                   <h2><span>Logged in as </span>{{$user->name}}</h2>
                   <?php
                    if(!$user->email=="" && !$user->email=="NULL"){?>
                   <h3><span>email is </span> {{$user->email}} </h3>
                   <?php }
                    ?>

                   <h3><span>Gender is</span> {{$user->Gender}} </h3>
                   <h3><span>Age is</span>  {{$user->age}} </h3>
                   <h3><a href="{{$user->link}}" target="_blank" class="cwf-btn">
                     <button type="button" class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow">
                    <p class="text-btn-start"> <span></span> View Facebook Profile</p>
                     </button>
                   </a>
                 </h3>
               </div>
           </div>
       </div>
     </div>
     <div class="col-md-2">
     </div>
  </div>
</div>
  @endguest
@endsection
