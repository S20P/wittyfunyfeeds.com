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
         <p class="subtext">आपकी CHRISTMAS PICTURE कैसी दिखेगी?</p>
         <!-- <h2 class="title">Your new looks seem fantastic overall!</h2> -->
        </div>
      <button type="button" class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow" onclick="myFacebookLogin()">
           <p class="text-btn-start"><span></span>Facebook पर शेयर करें</p>
      </button>
        <div class="border-img">
              <img class="img img-responsive reimg" width="100%"  height="auto" id="app8_img" src="{{asset($img_url)}}" alt="">
       </div>
       </div>
        </div>
          <div class="item-img-content">
         <div class="app-box-info">
          <p  class="subtext">बहुत सुन्दर! <b> <?php echo $posts->first_name; ?> </b>, ऐसा लग रहा है जैसे चारो तरफ christmas की लहर सी चल पड़ी है। इस खूबसूरत फोटो फ्रेम को अपने दोस्तों के साथ साझा करे और उन्हे भी मौका दे अपनी christmas picture बनाने का।</p>
          <!-- <h2 class="title">इस उत्तर को अपने सभी दोस्तों को साथ साझा करे और अपने दिल के बारे में बतायें।</h2> -->
         </div>

         <div class="box-button">
            <button type="button" class="btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow" onclick="myFacebookLogin()">
           <p class="text-btn-start"><span></span>Facebook पर शेयर करें</p>
           </button>
           <button class="try-again-btn disabled" onclick="hi_app8_createimg()"><span></span>Try Again</button>
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
            'og:title': 'आपकी CHRISTMAS PICTURE कैसी दिखेगी?',
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
