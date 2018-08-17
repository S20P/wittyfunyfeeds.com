
<script>
window.fbAsyncInit = function() {
  FB.init({                                 // 1827442653951223 is use server app
    appId            : '1827442653951223', // 1361360707308056 it use local id
    autoLogAppEvents : true,
    xfbml            : true,
    cookie           : true,
    version          : 'v2.11'
  });
FB.AppEvents.logPageView();
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

   FB.ui({
   method: 'share_open_graph',
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



}
</script>
