@extends('layouts.app')
@section('content')



<div id="app">
  <div class="content-detail-page" id="page-sec">
    <div class="content-wrap box-shadow">
      <div class="item-img">
        <div id="myProgress">
          <div id="myBar"></div>
        </div>
        <div class="text-animation-loder">
          <a href="" class="typewrite" data-period="2000" data-type='[ "Hi, Result is finding.", "I am Creative.", "I Love Design.", "I Love to Develop." ]'>
            <span class="wrap"></span>
          </a>
        </div>
      </div>
      <div class="item-img-content">
        <div class="padding-2rem">
          <div class="btns-quiz">
            <div class="app-box-info gif-sec">
               <div class="show-gif"></div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="content-detail-page"  id="loader-sec-in">
  <div class="content-wrap box-shadow">
    <div class="item-img">
  <img class="img img-responsive" width="100%"  height="auto" src="{{$app_img_orignal_url}}" alt="">
    </div>
    <div class="item-img-content">
      <div class="padding-2rem">
        <p class="title">{{$app_title}}</p>
        <p class="subtext">
          {{$app_description}}
         </p>



        <div class="btns-quiz">
          <p class="text-click">
            <i></i>Click to see your result.
          </p>
          @if (Auth::check())

          <button type="button"  class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow disabled" onClick="en_app{{$app_no}}_createimg()">
         <p class="text-btn-start"><span></span>Continue as {{ Auth::user()->first_name }}</p>
          </button>


           @else
         <a href="{{url('redirect')}}" class="cwf-btn"><button type="button" class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow">
          <p class="text-btn-start"><span></span>  Continue with Facebook</p>
           </button>
         </a>
           @endif
        </div>
      </div>
    </div>
  </div>
</div>
</div>






            @section('sidebar')
            @parent
            @endsection

@endsection
