<?php
$app_description =  "What an amazing description! It's clear that the Lord Almighty is proud of you,  <b>".$posts->first_name."</b>. You have a big heart and strong nature and it's these two factors that make you a fantastic friend and generally, a great human being! The world needs more of you.";
?>
<div class="content-detail-page" id="page-sec">
  <div class="content-wrap box-shadow">
    <div class="item-img">
      <div id="myProgress">
        <div id="myBar"></div>
      </div>
      <div class="text-animation-loder">
        <a href="" class="typewrite" data-period="2000" data-type='[ "Asking angels..."]'>
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
              <img class="img img-responsive reimg" width="100%"  height="auto" id="app106_img" src="{{asset($img_url)}}" alt="">
         </div>
       </div>
        </div>
          <div class="item-img-content">
         <div class="app-box-info">
          <p class="subtext"><?php echo $app_description;?></p>
          <p class="subtext">Remember to SHARE this your loved ones today!</p>
         </div>

         <div class="box-button">
            <button type="button" class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow" onclick="myFacebookLogin()">
           <p class="text-btn-start"><span></span>Share on Facebook</p>
           </button>
           <button class="try-again-btn disabled" onclick="en_app106_createimg()"><span></span>Try Again</button>
         </div>
       </div>
  </div>
</div>

@include('js.facebook-on-share')
