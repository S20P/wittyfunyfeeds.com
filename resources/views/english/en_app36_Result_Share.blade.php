<?php
$app_description =  "<b>".$posts->first_name."</b>, you are black as the devil, hot as hell, pure as an angel, sweet as love. You are so hot that no one can resist you and enjoy your company. You know how to impress others through your looks and way of talking.";
?>
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
  <div class="content-wrap box-shadow">

      <div class="share-btn-header">
          <div class="item-img-content">
        <div class="app-box-info">
         <h2 class="title">{{$app_title}}</h2>
        </div>

      <button type="button" class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow" onclick="myFacebookLogin()">
           <p class="text-btn-start"><span></span>Share on Facebook</p>
      </button>
        <div class="border-img">
              <img class="img img-responsive reimg" width="100%"  height="auto" id="app36_img" src="{{asset($img_url)}}" alt="">
         </div>
       </div>
        </div>
          <div class="item-img-content">
         <div class="app-box-info">
          <p class="subtext"><?php echo $app_description;?></p>
          <p class="subtext">Share this result with your friends and let them know about your hotness level.</p>
         </div>

         <div class="box-button">
            <button type="button" class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow" onclick="myFacebookLogin()">
           <p class="text-btn-start"><span></span>Share on Facebook</p>
           </button>
           <button class="try-again-btn disabled" onclick="en_app36_createimg()"><span></span>Try Again</button>
         </div>
       </div>
  </div>
</div>

  @include('js.facebook-on-share')
