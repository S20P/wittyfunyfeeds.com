<div class="content-detail-page" id="page-sec">
  <div class="content-wrap box-shadow">
    <div class="item-img">
      <div id="myProgress">
        <div id="myBar"></div>
      </div>
      <div class="text-animation-loder">
        <a href="" class="typewrite" data-period="2000" data-type='["आपके परिणाम की गणना कर रहे हैं.."]'>
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
         <p class="subtext">आपके होने वाले बच्चों का नाम क्या होना चाहिए?</p>
         <!-- <h2 class="title">Your new looks seem fantastic overall!</h2> -->
        </div>
      <button type="button" class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow" onclick="myFacebookLogin()">
           <p class="text-btn-start"><span></span>Facebook पर शेयर करें</p>
      </button>
        <div class="border-img">
              <img class="img img-responsive reimg" width="100%"  height="auto" id="app29_img" src="{{asset($img_url)}}" alt="">
       </div>
       </div>
        </div>
          <div class="item-img-content">
         <div class="app-box-info">
           <p  class="subtext"><b> <?php echo $posts->first_name; ?> </b>, आपके दो प्यारे-प्यारे नन्हे मुंहे बच्चे होंगे। जिनका नाम आपको रखना चाहिए;</p>
           <p><b>लड़का - {{$app_result1}}</b></p>
           <p><b>लड़की - {{$app_result2}}</b></p>
        <p class="subtext">उत्तर को अपने सभी मित्रो के साथ साझा करें और उनको बताएं की आप अपने होने वाले बच्चों का नाम क्या रखने वाले हो!</p>
         </div>

         <div class="box-button">
            <button type="button" class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow" onclick="myFacebookLogin()">
           <p class="text-btn-start"><span></span>Facebook पर शेयर करें</p>
           </button>
           <button class="try-again-btn disabled" onclick="hi_app29_createimg()"><span></span>Try Again</button>
         </div>
       </div>
  </div>
</div>




  <script>
  window.fbAsyncInit = function() {
    FB.init({                                 // 1827442653951223 is use server app
      appId            : '1827442653951223', // 1361360707308056 it use local id
      autoLogAppEvents : true,
      xfbml            : true,
      cookie           : true,
      version          : 'v2.11'
    });

    };
    //Facebook
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


   function myFacebookLogin(){

  // var path = document.getElementById("youtubeimg").src;
  // console.log(path);

     FB.ui({
     method: 'share_open_graph',
     action_type: 'og.shares',
     display: 'popup',
     action_properties: JSON.stringify({
         object : {
            'og:url': '{{ asset('/')}}',
            'og:title': 'आपके होने वाले बच्चों का नाम क्या होना चाहिए?',
            'og:description': 'Your out of this world <?php echo $posts->name; ?>',
             //  'og:image:width': '200',
             // 'og:image:height': '200',
             'og:site_name':'Testing apps',
             'og:image':'{{asset('/'.$img_url)}}',
         }
       })
      });
}
</script>
