@extends('layouts.app')
@section('content')

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
<div class="app-box-panel" id="loader-sec-in">
  <div  class="content-wrap box-shadow">
      <div class="share-btn-header">
          <div class="item-img-content">
        <div class="app-box-info">
         <h2 class="title">{{$app_title}}</h2>
        </div>
      <button type="button" class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow" onclick="myFacebookLogin()">
           <p class="text-btn-start"><span></span>Share on Facebook</p>
      </button>
        <div class="border-img">
              <img class="img img-responsive reimg" width="100%"  height="auto" id="youtubeimg" src="{{asset($img_url)}}" alt="">
       </div>
       </div>
        </div>
          <div class="item-img-content">
         <div class="app-box-info">
        <?php echo $app_description;?>
        <?php echo  $app_sub_description;?>
      </div>
         <div class="box-button">
            <button type="button" class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow" onclick="myFacebookLogin()">
           <p class="text-btn-start"><span></span>Share on Facebook</p>
           </button>
           <button class="try-again-btn disabled" onclick="en_app{{$app_no}}_createimg()"><span></span>Try Again</button>
         </div>
       </div>
  </div>
</div>

<?php
  $app_description1 =  trim(preg_replace('/[\s\t\n\r\s]+/',' ', $app_description));
  $app_description2 =  trim(trim($app_description1,"'"),'"');
  $app_description_og = strip_tags((strlen($app_description2) > 180) ? substr($app_description2,0,180).'...' :$app_description2);
?>

@include('js.facebook-on-share')
@section('sidebar')
@parent
@endsection

@endsection
