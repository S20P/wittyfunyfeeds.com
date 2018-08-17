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
   FB.ui({
   method: 'share_open_graph',
   action_type: 'og.shares',
   display: 'popup',
   action_properties: JSON.stringify({
       object : {
          'og:url': '{{ asset('/')}}',
          'og:title': "{$app_title}}",
          'og:description': "{{$og_description}}",
           'og:site_name':'wittyfunyfeeds',
           'og:image':'{{asset('/'.$img_url)}}',
       }
     })
    });
}
