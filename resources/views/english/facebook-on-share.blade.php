
<script>
window.fbAsyncInit = function() {
  FB.init({                                 // 1827442653951223 is use server app
    appId            : '1827442653951223', // 1361360707308056 it use local id
    autoLogAppEvents : true,
    xfbml            : true,
    cookie           : true,
    version          : 'v2.11'
  });
  $(document).trigger('fbload');
  FB.AppEvents.logPageView();
         afterFBInit();
         fbInit = true;
         FB_api = FB.api;

  };
  //Facebook
(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "https://connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));


 // $("meta[name='title']").attr("content", "<?php //echo  stripcslashes($app_title) ;?>");
 // $("meta[name='description']").attr("content", "<?php //echo  stripcslashes($app_description_og) ;?>");
 // $("meta[name='image']").attr("content", "{{asset($img_url)}}");
 // $("meta[property='og\\:title']").attr("content", "<?php //echo stripcslashes($app_title);?>");
 // $("meta[property='og\\:description']").attr("content", "<?php //echo  stripcslashes($app_description_og) ;?>");
 // $("meta[property='og\\:image']").attr("content", "{{asset($img_url)}}");



 $(document).on(
     'fbload',  //  <---- HERE'S OUR CUSTOM EVENT BEING LISTENED FOR
     function(){

       FB.api('https://graph.facebook.com/','post',  {
            id: window.location.href,
            scrape: true,
            access_token:"{{ Auth::user()->fb_token }}"
        }, function(response) {
           console.log('rescrape!',response);

        });

     }

 );
  function myFacebookLogin(){

    // FB.api('https://graph.facebook.com/','post',  {
    //      id: window.location.href,
    //      scrape: true,
    //      access_token:"{{ Auth::user()->fb_token }}"
    //  }, function(response) {
    //      console.log('rescrape!',response);
    //
    //  });

// share Object-------------------------------------------------------------------
   FB.ui({
   method: 'share',
   action_type: 'og.shares',
   display: 'popup',
   action_properties: JSON.stringify({
       object : {
          'og:url': '{{ asset('/')}}',
          'og:title': "<?php echo stripcslashes($app_title);?>",
          'og:description':  "<?php echo  stripcslashes($app_description_og) ;?>" ,
          'og:site_name':'wittyfunyfeeds',
          'og:image':'{{asset('/'.$img_url)}}',
          'og:image:width': '800',
          'og:image:height': '420',
               }
     })


    },
    // callback
    function(response) {
    if (response && !response.error_message) {
        // then get post content
        console.log('successfully posted. Status id : '+response.post_id);
    } else {
        console.log('Something went error.');
    }
});
//--------------------------------------------------------------------------------


// share Dialog-------------------------------------------------------------------
       // FB.ui({
       //     method: 'share',
       //     display: 'popup',
       //     href: window.location.href,
       //   }, function(response){
       //     console.log("Share response",response);
       //   });


//---------------------------------------------------------------------------------



// Feed Dialog-------------------------------------------------------------------
//     FB.ui(
//     {
//     method: 'feed',
//     name: "<?php //echo stripcslashes($app_title);?>",
//     link: window.location.href,
//     picture: "<?php //asset('/'.$img_url); ?>",
//     caption:  window.location.href,
//     description: "<?php //echo  stripcslashes($app_description_og) ;?>",
//     message: "",
//     },
//     // callback
//     function(response) {
//     if (response && !response.error_message) {
//         // then get post content
//         console.log('successfully posted. Status id : '+response.post_id);
//     } else {
//         console.log('Something went error.');
//     }
// });
//------------------------------------------------------------------------------



}
</script>
