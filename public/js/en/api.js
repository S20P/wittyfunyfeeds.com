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
  };
  //Facebook
(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "https://connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

//App3 model function

$(function(){
   $('#image_upload_app').click(function() {
        $(".disabled").attr("disabled", true);
        $("#page-sec").show();
        $("#loader-sec-in").css('display','none');
         text_animation_loder();
         progress_loaderGif("en_app3");


          var file_data =  $('.upload-preview').attr('src');

    $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "en_app3_createimg",
            type : "post",
            cache: false,
  	      	contentType: "application/x-www-form-urlencoded",
            mimeType: "multipart/form-data",
            data: {"app_img_url":file_data},
            success: function(response)
            {
            ////console.log("res",response);
             $('#favoritesModal').modal('hide');
             progressbar(response);
            // progress_gif("app3",response);
            },
        });
        return false;
   });
});

//$('.box').jmspinner('large');
//$('.box.well').css('display','block');
//
// var  app_english_list123 = function(lang)
// {
//
//     if(document.location.hash==="#_=_"){
//          var path = lang+'#_=_';
//      }
//      else{
//          var path = lang;
//      }
//    //console.log("new path hash",document.location);
//    //console.log("document.location",document.location.origin+path);
//    var href = document.location.href;
//    //console.log("href",href);
//    var fullApiurl = document.location.origin+path;
//      if(href===fullApiurl){
//        $.ajax({
//               type : 'get',
//               url  : 'en/defult_app_en',
//               dataType: "JSON",
//               data: {
//                 lang : "en",
//                 },
//               success: function(data)
//               {
//                  //console.log(data);
//                 // return;
//               //  $('#app_box').html(data.html);
//                 $('.box').jmspinner(false);
//                 $('.box.well').css('display','none');
//                },
//               error :  function(data)
//               {
//                   alert("error");
//               }
//             });
//           }
// }


 //app1-------------What will God bless you with?-----------------------------------------------------------
        var  en_app1_createimg = function()
         {
          //  console.log("hiiiiii");
           $(".disabled").attr("disabled", true);
           $("#page-sec").show();
           $("#loader-sec-in").css('display','none');
            text_animation_loder();
            progress_loaderGif("en_app1");
           var $request = $.get('en_app1_createimg', function(result)
            {
              //console.log("data",result);
              progressbar(result.html);
            });
         }
//---*end app1*//

//app2----------Which Skills did God gave you?--------------------------------------------------------------
          var  en_app2_createimg = function()
           {
             //console.log("app2_en");
             $(".disabled").attr("disabled", true);
             $("#page-sec").show();
             $("#loader-sec-in").css('display','none');
              text_animation_loder();
              progress_loaderGif("en_app2");
             var $request = $.get('en_app2_createimg', function(result)
              {
                 progressbar(result.html);
              });
           }
//---*end app2*//

//app3-----------How Rich will you be in 7 years?-------------------------------------------------------------

 var en_app3_createimg= function(){
    $('#favoritesModal').modal('show');
    $(".disabled").attr("disabled", false);

 }
 //---*end app3*//


 //app4------------How will your body change in 2018?-----------------------------------------------------------
        var  en_app4_createimg = function()
         {
           //console.log("app4_en");
           $(".disabled").attr("disabled", true);
           $("#page-sec").show();
           $("#loader-sec-in").css('display','none');
            text_animation_loder();
            progress_loaderGif("en_app4");
           var $request = $.get('en_app4_createimg', function(result)
            {
               progressbar(result.html);
            });
         }
   //---*end app4*//

   //app5----------What is the first thing people notice about you?------------------------------------------------------------
          var  en_app5_createimg = function()
           {
             //console.log("app5_en");
             $(".disabled").attr("disabled", true);
             $("#page-sec").show();
             $("#loader-sec-in").css('display','none');
              text_animation_loder();
              progress_loaderGif("en_app5");
             var $request = $.get('en_app5_createimg', function(result)
              {
                 progressbar(result.html);
              });
           }
  //---*end app5*//


  //app6-----------Create Your Personalized Happy NEW YEAR 2018 Greeting Card!------------------------------------------------------------
          var  en_app6_createimg = function()
           {
             //console.log("app6_en");
             $(".disabled").attr("disabled", true);
             $("#page-sec").show();
             $("#loader-sec-in").css('display','none');
              text_animation_loder();
              progress_loaderGif("en_app6");
             var $request = $.get('en_app6_createimg', function(result)
              {
                 progressbar(result.html);
              });
           }
 //---*end app6*//


//app7-----------What Awaits You From 2018 to 2020?------------------------------------------------------------
            var  en_app7_createimg = function()
             {
               //console.log("app7_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app7");
               var $request = $.get('en_app7_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app7*//

//app8-----------Which Phrase Best Describes Your Life?------------------------------------------------------------
          var  en_app8_createimg = function()
           {
             //console.log("app8_en");
             $(".disabled").attr("disabled", true);
             $("#page-sec").show();
             $("#loader-sec-in").css('display','none');
              text_animation_loder();
              progress_loaderGif("en_app8");
             var $request = $.get('en_app8_createimg', function(result)
              {
                 progressbar(result.html);
              });
           }
//---*end app8*//

//app9----------Which Word Summarise Your Life?-----------------------------------------------------------
            var  en_app9_createimg = function()
             {
               //console.log("app9_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app9");
               var $request = $.get('en_app9_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app9*//

//app10-----------What Does Your Warning Label Say?-----------------------------------------------------------
              var  en_app10_createimg = function()
               {
                 //console.log("app10_en");
                 $(".disabled").attr("disabled", true);
                 $("#page-sec").show();
                 $("#loader-sec-in").css('display','none');
                  text_animation_loder();
                  progress_loaderGif("en_app10");
                 var $request = $.get('en_app10_createimg', function(result)
                  {
                     progressbar(result.html);
                  });
               }
//---*end app10*//

//app11-----------How Fake Are You?------------------------------------------------------------
              var  en_app11_createimg = function()
               {
                 //console.log("app11_en");
                 $(".disabled").attr("disabled", true);
                 $("#page-sec").show();
                 $("#loader-sec-in").css('display','none');
                  text_animation_loder();
                  progress_loaderGif("en_app11");
                 var $request = $.get('en_app11_createimg', function(result)
                  {
                     progressbar(result.html);
                  });
               }
//---*end app11*//

//app12-----------What Is Your Message To The World?------------------------------------------------------------
                var  en_app12_createimg = function()
                 {
                   //console.log("app12_en");
                   $(".disabled").attr("disabled", true);
                   $("#page-sec").show();
                   $("#loader-sec-in").css('display','none');
                    text_animation_loder();
                    progress_loaderGif("en_app12");
                   var $request = $.get('en_app12_createimg', function(result)
                    {
                       progressbar(result.html);
                    });
                 }
//---*end app12*//


//app13----------What's The One Thing You Regret Losing?------------------------------------------------------------
              var  en_app13_createimg = function()
               {
                 //console.log("app13_en");
                 $(".disabled").attr("disabled", true);
                 $("#page-sec").show();
                 $("#loader-sec-in").css('display','none');
                  text_animation_loder();
                  progress_loaderGif("en_app13");
                 var $request = $.get('en_app13_createimg', function(result)
                  {
                     progressbar(result.html);
                  });
               }
//---*end app13*//

//app14-----------What Does Your Profile Photo NOT Reveal About Your Personality?------------------------------------------------------------
                var  en_app14_createimg = function()
                 {
                   //console.log("app14_en");
                   $(".disabled").attr("disabled", true);
                   $("#page-sec").show();
                   $("#loader-sec-in").css('display','none');
                    text_animation_loder();
                    progress_loaderGif("en_app14");
                   var $request = $.get('en_app14_createimg', function(result)
                    {
                       progressbar(result.html);
                    });
                 }
 //---*end app14*//

//app15-----------Which Word Reflects Your Love Life?------------------------------------------------------------
            var  en_app15_createimg = function()
             {
               //console.log("app15_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app15");
               var $request = $.get('en_app15_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app15*//

//app16-----------What Strength Has God Blessed You With?------------------------------------------------------------
          var  en_app16_createimg = function()
           {
             //console.log("app16_en");
             $(".disabled").attr("disabled", true);
             $("#page-sec").show();
             $("#loader-sec-in").css('display','none');
              text_animation_loder();
              progress_loaderGif("en_app16");
             var $request = $.get('en_app16_createimg', function(result)
              {
                 progressbar(result.html);
              });
           }
//---*end app16*//

//app17-----------What Compliment You Are Tired Of?------------------------------------------------------------
              var  en_app17_createimg = function()
               {
                 //console.log("app17_en");
                 $(".disabled").attr("disabled", true);
                 $("#page-sec").show();
                 $("#loader-sec-in").css('display','none');
                  text_animation_loder();
                  progress_loaderGif("en_app17");
                 var $request = $.get('en_app17_createimg', function(result)
                  {
                     progressbar(result.html);
                  });
               }
//---*end app17*//

//app18-----------Create a Beautiful Happy Diwali Greeting and Send Your Loved Ones!------------------------------------------------------------
          var  en_app18_createimg = function()
           {
             //console.log("app18_en");
             $(".disabled").attr("disabled", true);
             $("#page-sec").show();
             $("#loader-sec-in").css('display','none');
              text_animation_loder();
              progress_loaderGif("en_app18");
             var $request = $.get('en_app18_createimg', function(result)
              {
                 progressbar(result.html);
              });
           }
//---*end app18*//

//app19-----------Which Rock Band Do You Belong To?------------------------------------------------------------
          var  en_app19_createimg = function()
           {
             //console.log("app19_en");
             $(".disabled").attr("disabled", true);
             $("#page-sec").show();
             $("#loader-sec-in").css('display','none');
              text_animation_loder();
              progress_loaderGif("en_app19");
             var $request = $.get('en_app19_createimg', function(result)
              {
                 progressbar(result.html);
              });
           }
//---*end app19*//

//app20-----------What Are Three Truths About You?------------------------------------------------------------
            var  en_app20_createimg = function()
             {
               //console.log("app20_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app20");
               var $request = $.get('en_app20_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app20*//

//app21-----------At What Age Will You Get Married?------------------------------------------------------------
            var  en_app21_createimg = function()
             {
               //console.log("app21_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app21");
               var $request = $.get('en_app21_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app21*//

//app22----------How Would Your Indian Army ID Card Look Like?------------------------------------------------------------
            var  en_app22_createimg = function()
             {
               //console.log("app22_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app22");
               var $request = $.get('en_app22_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app22*//

//app23-----------Who Are You When You Get Mad?-----------------------------------------------------------
            var  en_app23_createimg = function()
             {
               //console.log("app23_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app23");
               var $request = $.get('en_app23_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app23*//

//app24-----------What Can Be The Smartest Decision Of Your Life?------------------------------------------------------------
            var  en_app24_createimg = function()
             {
               //console.log("app24_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app24");
               var $request = $.get('en_app24_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app24*//

//app25----------5 Facts About You!------------------------------------------------------------
            var  en_app25_createimg = function()
             {
               //console.log("app25_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app25");
               var $request = $.get('en_app25_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app25*//

//app26-----------You are You Coz?------------------------------------------------------------
            var  en_app26_createimg = function()
             {
               //console.log("app26_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app26");
               var $request = $.get('en_app26_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app26*//

//app27----------How Awesome Are You?------------------------------------------------------------
            var  en_app27_createimg = function()
             {
               //console.log("app27_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app27");
               var $request = $.get('en_app27_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app27*//


//app28----------What Does Your Love First Aid Box Contain?------------------------------------------------------------
            var  en_app28_createimg = function()
             {
               //console.log("app28_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app28");
               var $request = $.get('en_app28_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app28*//

//app29-----------Which Celebrity Would You Date?------------------------------------------------------------
            var  en_app29_createimg = function()
             {
               //console.log("app29_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app29");
               var $request = $.get('en_app29_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app29*//


//app30----------What Is The Color Of Your Heart?------------------------------------------------------------
            var  en_app30_createimg = function()
             {
               //console.log("app30_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app30");
               var $request = $.get('en_app30_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app30*//

//app31----------Which Halloween Creature Are You?------------------------------------------------------------
            var  en_app31_createimg = function()
             {
               //console.log("app31_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app31");
               var $request = $.get('en_app31_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app31*//

//app32----------What Do Your Eyes Reveal About You?------------------------------------------------------------
            var  en_app32_createimg = function()
             {
               //console.log("app32_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app32");
               var $request = $.get('en_app32_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app32*//


//app33---------Which Rapper Wants to Train You?------------------------------------------------------------
            var  en_app33_createimg = function()
             {
               //console.log("app33_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app33");
               var $request = $.get('en_app33_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app33*//

//app34---------Which Half-human Are You Based On Your Photo?------------------------------------------------------------
            var  en_app34_createimg = function()
             {
               //console.log("app34_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app34");
               var $request = $.get('en_app34_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app34*//

//app35----------Which Different Combinations of Hogwarts and Ilvermorny Houses Are You?------------------------------------------------------------
            var  en_app35_createimg = function()
             {
               //console.log("app35_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app35");
               var $request = $.get('en_app35_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app35*//

//app36---------How Hot Are You?------------------------------------------------------------
            var  en_app36_createimg = function()
             {
               //console.log("app36_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app36");
               var $request = $.get('en_app36_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app36*//

//app37----------How Mean Are You?------------------------------------------------------------
            var  en_app37_createimg = function()
             {
               //console.log("app37_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app37");
               var $request = $.get('en_app37_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app37*//

//app38---------What Is The Key To Your Happiness?------------------------------------------------------------
            var  en_app38_createimg = function()
             {
               //console.log("app38_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app38");
               var $request = $.get('en_app38_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app38*//

//app39----------What is your inspiring Bible verse?------------------------------------------------------------
            var  en_app39_createimg = function()
             {
               //console.log("app39_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app39");
               var $request = $.get('en_app39_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app39*//

//app40----------How Old Are You Based On Your Photo?------------------------------------------------------------
            var  en_app40_createimg = function()
             {
               //console.log("app40_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app40");
               var $request = $.get('en_app40_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app40*//
//app41----------How Would Be Your Next Boyfriend/Girlfriend?------------------------------------------------------------
            var  en_app41_createimg = function()
             {
               //console.log("app41_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app41");
               var $request = $.get('en_app41_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app41*//
//app42----------What Are Your Wolf Instincts?------------------------------------------------------------
            var  en_app42_createimg = function()
             {
               //console.log("app42_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app42");
               var $request = $.get('en_app42_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app42*//
//app43----------Can We Guess If 2018 Will Be Better Than 2017 For You?------------------------------------------------------------
            var  en_app43_createimg = function()
             {
               //console.log("app43_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app43");
               var $request = $.get('en_app43_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app43*//
//app44----------How Much Do You Love Him/Her------------------------------------------------------------
            var  en_app44_createimg = function()
             {
               //console.log("app44_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app44");
               var $request = $.get('en_app44_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app44*//
//app45----------Can We Guess Your Future By Your Picture?------------------------------------------------------------
            var  en_app45_createimg = function()
             {
               //console.log("app45_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app45");
               var $request = $.get('en_app45_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app45*//
//app46----------How Would Your Future House, Car and Love Look Like?------------------------------------------------------------
            var  en_app46_createimg = function()
             {
               //console.log("app46_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app46");
               var $request = $.get('en_app46_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app46*//
//app47----------What Is Locked Up In Your Heart?-----------------------------------------------------------
            var  en_app47_createimg = function()
             {
               //console.log("app47_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app47");
               var $request = $.get('en_app47_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app47*//
//app48----------What 6 Word Story Describes Your Personality?------------------------------------------------------------
            var  en_app48_createimg = function()
             {
               //console.log("app48_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app48");
               var $request = $.get('en_app48_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app48*//
//app49----------What type of angel are you------------------------------------------------------------
            var  en_app49_createimg = function()
             {
               //console.log("app49_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app49");
               var $request = $.get('en_app49_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app49*//
//app50----------Which career fits your face?------------------------------------------------------------
            var  en_app50_createimg = function()
             {
               //console.log("app50_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app50");
               var $request = $.get('en_app50_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app50*//

//app51---------5 Things You Should Quit Right Now!------------------------------------------------------------
            var  en_app51_createimg = function()
             {
               //console.log("app51_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app51");
               var $request = $.get('en_app51_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app51*//

//app52----------What Are Your 5 Secrets?------------------------------------------------------------
            var  en_app52_createimg = function()
             {
               //console.log("app52_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app52");
               var $request = $.get('en_app52_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app52*//

//app53----------What Do You Pray For?------------------------------------------------------------
            var  en_app53_createimg = function()
             {
               //console.log("app53_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app53");
               var $request = $.get('en_app53_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app53*//

//app54----------What Is Common Between You And MS Dhoni?-----------------------------------------------------------
            var  en_app54_createimg = function()
             {
               //console.log("app54_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app54");
               var $request = $.get('en_app54_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app54*//

//app55---------How Would Your Official Life Look Like After 10 Years?------------------------------------------------------------
            var  en_app55_createimg = function()
             {
               //console.log("app55_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app55");
               var $request = $.get('en_app55_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app55*//

//app56--------This is what God wants you to hear in 2018!------------------------------------------------------------
            var  en_app56_createimg = function()
             {
               //console.log("app56_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app56");
               var $request = $.get('en_app56_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app56*//


//app57---------What will your biography say?----------------------------------------------------
            var  en_app57_createimg = function()
             {
               //console.log("app57_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app57");
               var $request = $.get('en_app57_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app57*//


//app58---------Find out which 7 things make you unique!------------------------------------------------------------
            var  en_app58_createimg = function()
             {
               //console.log("app58_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app58");
               var $request = $.get('en_app58_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app58*//


//app59---------What will you change about your self in 2018?-----------------------------------------------------------
            var  en_app59_createimg = function()
             {
               //console.log("app59_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app59");
               var $request = $.get('en_app59_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app59*//

//app60---------What will your biggest sin be in 2018?------------------------------------------------------------
            var  en_app60_createimg = function()
             {
               //console.log("app60_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app60");
               var $request = $.get('en_app60_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app60*//


//app61---------What was your profession in the wild west?------------------------------------------------------------
            var  en_app61_createimg = function()
             {
               //console.log("app61_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app61");
               var $request = $.get('en_app61_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app61*//

//app62---------What will happen to you in each month of 2018?-----------------------------------------------------------
            var  en_app62_createimg = function()
             {
               //console.log("app62_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app62");
               var $request = $.get('en_app62_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app62*//

//app63---------What's your DNA ancestry based on your photo?-----------------------------------------------------------
            var  en_app63_createimg = function()
             {
               //console.log("app63_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app63");
               var $request = $.get('en_app63_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app63*//


//app64---------What kind of spirit watches over you?------------------------------------------------------------
            var  en_app64_createimg = function()
             {
               //console.log("app64_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app64");
               var $request = $.get('en_app64_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app64*//

//app65---------Which 3 careers are right for you?------------------------------------------------------------
            var  en_app65_createimg = function()
             {
               //console.log("app65_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app65");
               var $request = $.get('en_app65_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app65*//
//app66---------Let us guess your height!---------------------------------------------------------
            var  en_app66_createimg = function()
             {
               //console.log("app66_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app66");
               var $request = $.get('en_app66_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app66*//
//app67---------Which is more important to you: money or love?-----------------------------------------------------------
            var  en_app67_createimg = function()
             {
               //console.log("app67_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app67");
               var $request = $.get('en_app67_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app67*//
//app68--------Which parent are you like the most?---------------------------------------------------------
            var  en_app68_createimg = function()
             {
               //console.log("app68_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app68");
               var $request = $.get('en_app68_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app68*//
//app69--------Heaven or Hell: Where are you headed?-----------------------------------------------------
            var  en_app69_createimg = function()
             {
               //console.log("app69_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app69");
               var $request = $.get('en_app69_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app69*//
//app70--------How many people want to kiss, marry, and kill you in 2018?--------------------------------------------------------
            var  en_app70_createimg = function()
             {
               //console.log("app70_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app70");
               var $request = $.get('en_app70_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app70*//

//app71--------Who is your famous celebrity lookalike?--------------------------------------------------------
            var  en_app71_createimg = function()
             {
               //console.log("app71_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app71");
               var $request = $.get('en_app71_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app71*//

//app72--------What does Satan have to say about you?--------------------------------------------------------
            var  en_app72_createimg = function()
             {
               //console.log("app72_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app72");
               var $request = $.get('en_app72_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app72*//

//app73--------Which color suits the journey of your life?-----------------------------------------------------
            var  en_app73_createimg = function()
             {
               //console.log("app73_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app73");
               var $request = $.get('en_app73_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app73*//

//app74--------What are your 3 qualities and 1 flaw?--------------------------------------------------------
            var  en_app74_createimg = function()
             {
               //console.log("app74_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app74");
               var $request = $.get('en_app74_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app74*//

//app75--------Can we guess your profession by just one look at your profile picture?-------------------------------------------------------
            var  en_app75_createimg = function()
             {
               //console.log("app75_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app75");
               var $request = $.get('en_app75_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app75*//

//app76--------See your life in 2018!------------------------------------------------------
            var  en_app76_createimg = function()
             {
               //console.log("app76_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app76");
               var $request = $.get('en_app76_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app76*//

//app77--------Can we tell your income based on your face?----------------------------------------------------
            var  en_app77_createimg = function()
             {
               //console.log("app77_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app77");
               var $request = $.get('en_app77_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app77*//



//app78--------Who is the love of your life?-----------------------------------------------------
            var  en_app78_createimg = function()
             {
               //console.log("app78_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app78");
               var $request = $.get('en_app78_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app78*//

//app79--------How dirty is your mind?-------------------------------------------------------
            var  en_app79_createimg = function()
             {
               //console.log("app79_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app79");
               var $request = $.get('en_app79_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app79*//

//app80-------What will your daughter look like?--------------------------------------------------------
            var  en_app80_createimg = function()
             {

               //console.log("app80_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app80");
               var $request = $.get('en_app80_createimg', function(result)
                {

                    progressbar(result.html);

                });
             }
//---*end app80*//

//app81-----------Which friend will influence your year the most?-------------------------------------------------
            var  en_app81_createimg = function()
             {
               //console.log("app81_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app81");
               var $request = $.get('en_app81_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app81*//

//app82-------Which friend will hold your hand forever?---------------------------------------------------------
            var  en_app82_createimg = function()
             {
               //console.log("app82_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app82");
               var $request = $.get('en_app82_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app82*//

//app83--------------Who is the person that will always be by your side?----------------------------
            var  en_app83_createimg = function()
             {
               //console.log("app83_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app83");
               var $request = $.get('en_app83_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app83*//

//app84---------See Your Photo Wall Of Wonderful Memories!--------------------------------------------------
            var  en_app84_createimg = function()
             {
               //console.log("app84_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app84");
               var $request = $.get('en_app84_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app84*//

//app85-----Who's In Your Family Tree?------------------------------------------------------
            var  en_app85_createimg = function()
             {
               //console.log("app85_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app85");
               var $request = $.get('en_app85_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app85*//

//app86--------Which one word describes you-----------------------------------------------------
            var  en_app86_createimg = function()
             {
               //console.log("app86_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app86");
               var $request = $.get('en_app86_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app86*//

//app87--------Whom do you look like?-----------------------------------------------------
            var  en_app87_createimg = function()
             {
               //console.log("app87_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app87");
               var $request = $.get('en_app87_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app87*//

//app88-------What award should you get this year?--------------------------------------------------
            var  en_app88_createimg = function()
             {
               //console.log("app88_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app88");
               var $request = $.get('en_app88_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app88*//

//app89--------Where will you travel in January?-----------------------------------------------------
            var  en_app89_createimg = function()
             {
               //console.log("app89_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app89");
               var $request = $.get('en_app89_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app89*//

//app90-------How will you start 2018 based on your name?------------------------------------------------------
            var  en_app90_createimg = function()
             {
               //console.log("app90_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app90");
               var $request = $.get('en_app90_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app90*//

//app91--------Are you more like your father or your mother?--------------------------------------------------------
            var  en_app91_createimg = function()
             {
               //console.log("app91_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app91");
               var $request = $.get('en_app91_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app91*//

//app92--------What is your word for 2018?-------------------------------------------------------
            var  en_app92_createimg = function()
             {
               //console.log("app92_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app92");
               var $request = $.get('en_app92_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app92*//

//app93--------What is the best thing about you?----------------------------------------------------
            var  en_app93_createimg = function()
             {
               //console.log("app93_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app93");
               var $request = $.get('en_app93_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app93*//

//app94-------What are the 5 things that will make you happy?-------------------------------------------------------
            var  en_app94_createimg = function()
             {
               //console.log("app94_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app94");
               var $request = $.get('en_app94_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app94*//

//app95-------Are you more like a cat or a dog?---------------------------------------------------
            var  en_app95_createimg = function()
             {
               //console.log("app95_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app95");
               var $request = $.get('en_app95_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app95*//

//app96-------See how your life will change in 2018!------------------------------------------------------
            var  en_app96_createimg = function()
             {
               //console.log("app96_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app96");
               var $request = $.get('en_app96_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app96*//

//app97--------What animal is in your heart?-------------------------------------------------------
            var  en_app97_createimg = function()
             {
               //console.log("app97_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app97");
               var $request = $.get('en_app97_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app97*//

//app98--------Which drink is a match for you?------------------------------------------------------
            var  en_app98_createimg = function()
             {
               //console.log("app98_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app98");
               var $request = $.get('en_app98_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app98*//

//app99--------How old does your face look like-------------------------------------------------------
            var  en_app99_createimg = function()
             {
               //console.log("app99_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app99");
               var $request = $.get('en_app99_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app99*//

//app100-------Can we guess what you want in 2018?--------------------------------------------------------
            var  en_app100_createimg = function()
             {
               //console.log("app100_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app100");
               var $request = $.get('en_app100_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app100*//

//app101-------What profession matches your name best?--------------------------------------------------------
            var  en_app101_createimg = function()
             {
               //console.log("app101_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app101");
               var $request = $.get('en_app101_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app101*//

//app102-------Click here to find out why you've gone missing!--------------------------------------------------------
            var  en_app102_createimg = function()
             {
               //console.log("app102_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app102");
               var $request = $.get('en_app102_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app102*//

//app103-------Can we guess who you really are?--------------------------------------------------------
            var  en_app103_createimg = function()
             {
               //console.log("app103_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app103");
               var $request = $.get('en_app103_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app103*//

//app104-------What is the origin of your last name?--------------------------------------------------------
            var  en_app104_createimg = function()
             {
               //console.log("app104_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app104");
               var $request = $.get('en_app104_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app104*//

//app105-------What is your mission for this year?-------------------------------------------------------
            var  en_app105_createimg = function()
             {
               //console.log("app105_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app105");
               var $request = $.get('en_app105_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app105*//

//app106-------How has God written about the rest of your Life?--------------------------------------------------------
            var  en_app106_createimg = function()
             {
               //console.log("app106_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app106");
               var $request = $.get('en_app106_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app106*//

//app107-------How dangerous are you?--------------------------------------------------------
            var  en_app107_createimg = function()
             {
               //console.log("app107_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app107");
               var $request = $.get('en_app107_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app107*//

//app108-------What beautiful traits did your children inherit from You?--------------------------------------------------------
            var  en_app108_createimg = function()
             {
               //console.log("app108_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app108");
               var $request = $.get('en_app108_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app108*//

//app109-------What is your Motto?-------------------------------------------------------
            var  en_app109_createimg = function()
             {
               //console.log("app109_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app109");
               var $request = $.get('en_app109_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app109*//

//app110-------What are 5 reasons people are jealous of You?--------------------------------------------------------
            var  en_app110_createimg = function()
             {
               //console.log("app110_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app110");
               var $request = $.get('en_app110_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app110*//

//app111------What does your face say about your body and soul?--------------------------------------------------------
            var  en_app111_createimg = function()
             {
               //console.log("app111_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app111");
               var $request = $.get('en_app111_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app111*//

//app112------- Which mixed-race are you based on your photo?--------------------------------------------------------
            var  en_app112_createimg = function()
             {
               //console.log("app112_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app112");
               var $request = $.get('en_app112_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app112*//

//app113------ What does 2018 have in store for you?------------------------------------------------------
            var  en_app113_createimg = function()
             {
               //console.log("app113_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app113");
               var $request = $.get('en_app113_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app113*//

//app114-------What is your best asset?--------------------------------------------------------
            var  en_app114_createimg = function()
             {
               //console.log("app114_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app114");
               var $request = $.get('en_app114_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app114*//

//app115-------What describes you best?---------------------------------------------------------
            var  en_app115_createimg = function()
             {
               //console.log("app115_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app115");
               var $request = $.get('en_app115_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app115*//

//app116-------What are 5 reasons people are jealous of You?--------------------------------------------------------
            var  en_app116_createimg = function()
             {
               //console.log("app116_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app116");
               var $request = $.get('en_app116_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app116*//

//app117-------What are 5 reasons people are jealous of You?--------------------------------------------------------
            var  en_app117_createimg = function()
             {
               //console.log("app117_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app117");
               var $request = $.get('en_app117_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app117*//

//app118-------What are 5 reasons people are jealous of You?--------------------------------------------------------
            var  en_app118_createimg = function()
             {
               //console.log("app118_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app118");
               var $request = $.get('en_app118_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app118*//

//app119-------What are 5 reasons people are jealous of You?--------------------------------------------------------
            var  en_app119_createimg = function()
             {
               //console.log("app119_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app119");
               var $request = $.get('en_app119_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app119*//

//app120-------What are 5 reasons people are jealous of You?--------------------------------------------------------
            var  en_app120_createimg = function()
             {
               //console.log("app120_en");
               $(".disabled").attr("disabled", true);
               $("#page-sec").show();
               $("#loader-sec-in").css('display','none');
                text_animation_loder();
                progress_loaderGif("en_app120");
               var $request = $.get('en_app120_createimg', function(result)
                {
                   progressbar(result.html);
                });
             }
//---*end app120*//




 var progress_loaderGif = function(app_define){
   if(app_define=="en_app1"){
        var myArray = ['God gave you','God','give'];
   }
   if(app_define=="en_app2"){
        var myArray = ['God gave you','God','give','Skills'];
   }
   if(app_define=="en_app3"){
     var myArray = ['Rich'];
   }
   if(app_define=="en_app4"){
     var myArray = ['body','gym','muscle','pushups','barbell'];
   }
   if(app_define=="en_app5"){
     var myArray = ["Smile","Hair","face","eye","nose","Cheek","skin","eyebrow","ear","lip","chin","eyelash","teeth"];
   }
   if(app_define=="en_app6"){
     var myArray = ['Happy New years ','2018','card','new year card'];
   }
   if(app_define=="en_app7"){
      var myArray = ['waiting ','2018 to 202','Awaits'];
   }
   if(app_define=="en_app8"){
     var myArray = ['Phrase'];
   }
   if(app_define=="en_app9"){
     var myArray = ['Summarise','Word Summarise','life Summarise'];
   }
   if(app_define=="en_app10"){
     var myArray = ['Warning','Warning Label','Warning Label say','worn'];
   }
   if(app_define=="en_app11"){
     var myArray = ['fake','act','counterfeit','mask'];
   }
   if(app_define=="en_app12"){
     var myArray = ['world Message','world','sms','Message','alert'];
   }
   if(app_define=="en_app13"){
     var myArray = ['Losing','life'];
   }
   if(app_define=="en_app14"){
     var myArray = ['Profile Photo NOT Reveal','Personality','about you'];
   }
   if(app_define=="en_app15"){
     var myArray = ['life','love','love life','reflects word','reflects life','reflects','Romance'];
   }
   if(app_define=="en_app16"){
     var myArray = ['Strength','Determination','Trustworthiness',"Honesty","Creativity","Patience"];
   }
   if(app_define=="en_app17"){
     var myArray = ['Compliment'];
   }
   if(app_define=="en_app18"){
     var myArray = ['divali','happy dipavali','Diwali Greeting'];
   }
   if(app_define=="en_app19"){
     var myArray = ['Rock Band','Band','music','songs','dj'];
   }
   if(app_define=="en_app20"){
     var myArray = ['Truths','Truthness','Truths self'];
   }
   if(app_define=="en_app21"){
     var myArray = ['Married','love','age','Wedding'];
   }
   if(app_define=="en_app22"){
     var myArray = ['Indian Army','Army','soldier','salute','sarge'];
   }
   if(app_define=="en_app23"){
     var myArray = ['Mad','ireful','irascible','peevish'];
   }
   if(app_define=="en_app24"){
     var myArray = ['Smartest','life'];
   }
   if(app_define=="en_app25"){
     var myArray = ['Facts','self','about self'];
   }
   if(app_define=="en_app26"){
     var myArray = ['Coz','because','why'];
   }
   if(app_define=="en_app27"){
     var myArray = ['Awesome','good','nice'];
   }
   if(app_define=="en_app28"){
     var myArray = ['love','romance'];
   }
   if(app_define=="en_app29"){
     var myArray = ['Celebrity','hero','date'];
   }
   if(app_define=="en_app30"){
     var myArray = ['colors','color','paint'];
   }
   if(app_define=="en_app31"){
     var myArray = ["Black Cat","Skeleton","Owl","Warewolf","Halloween","Creature"];
   }
   if(app_define=="en_app32"){
     var myArray = ['Eye'];
   }
   if(app_define=="en_app33"){
     var myArray = ['Rapper'];
   }
   if(app_define=="en_app34"){
     var myArray = ['Half human','Half animals'];
   }
   if(app_define=="en_app35"){
     var myArray = ['Hogwarts','Ilvermorny','Ilvermorny House'];
   }
   if(app_define=="en_app36"){
     var myArray = ['Hotness'];
   }
   if(app_define=="en_app37"){
     var myArray = ['Mean','Mean yourself'];
   }
   if(app_define=="en_app38"){
     var myArray = ['Key','Happiness Key','life Key'];
   }
   if(app_define=="en_app39"){
     var myArray = ['inspiring','Bible','verse'];
   }
   if(app_define=="en_app40"){
     var myArray = ['Old','Old men','Old photos'];
   }
   if(app_define=="en_app41"){
     var myArray = ['Boyfriend','Girlfriend'];
   }
   if(app_define=="en_app42"){
     var myArray = ['Wolf','animal','Instincts'];
   }
   if(app_define=="en_app43"){
     var myArray = ['2017','2018'];
   }
   if(app_define=="en_app44"){
     var myArray = ['love','romance','hart'];
   }
   if(app_define=="en_app45"){
     var myArray = ['Future picture','frame','Old photos','car','kids','income'];
   }
   if(app_define=="en_app46"){
     var myArray = ['House','car','home'];
   }
   if(app_define=="en_app47"){
     var myArray = ['Locked','Heart','Heart Locked'];
   }
   if(app_define=="en_app48"){
     var myArray = ['Story','Personality'];
   }
   if(app_define=="en_app49"){
     var myArray = ['angel'];
   }
   if(app_define=="en_app50"){
     var myArray = ['career','face'];
   }
   if(app_define=="en_app51"){
     var myArray = ['Quit Right Now','Quit'];
   }
   if(app_define=="en_app52"){
     var myArray = ['Secrets','private'];
   }
   if(app_define=="en_app53"){
     var myArray = ['Pray'];
   }
   if(app_define=="en_app54"){
     var myArray = ['MS Dhoni'];
   }
   if(app_define=="en_app55"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app56"){
     var myArray = ['God','lord','pray'];
   }
   if(app_define=="en_app57"){
     var myArray = ['biography','Official Life','Official Look'];
   }
   if(app_define=="en_app58"){
     var myArray = ['unique','things'];
   }
   if(app_define=="en_app59"){
     var myArray = ['honest','2018','about','self','change'];
   }
   if(app_define=="en_app60"){
     var myArray = ['biggest','sin','Gluttony','Lust'];
   }
   if(app_define=="en_app61"){
     var myArray = ['profession','Official Life','wild west'];
   }
   if(app_define=="en_app62"){
     var myArray = ['happen','2018','New friend','hobby','vacation','money','Holidays'];
   }
   if(app_define=="en_app63"){
     var myArray = ['DNA','ancestry','country'];
   }
   if(app_define=="en_app64"){
     var myArray = ['spirit','watches'];
   }
   if(app_define=="en_app65"){
     var myArray = ['Official','Official Life','careers','job'];
   }
   if(app_define=="en_app66"){
     var myArray = ['height'];
   }
   if(app_define=="en_app67"){
     var myArray = ['important','money','love'];
   }
   if(app_define=="en_app68"){
     var myArray = ['parent','father','mother'];
   }
   if(app_define=="en_app69"){
     var myArray = ['Heaven','Hell'];
   }
   if(app_define=="en_app70"){
     var myArray = ['kiss','marry','kill'];
   }
   if(app_define=="en_app71"){
     var myArray = ['celebrity','hero','star'];
   }
   if(app_define=="en_app72"){
     var myArray = ['Satan','about','hell'];
   }
   if(app_define=="en_app73"){
     var myArray = ['color','journey','colors'];
   }
   if(app_define=="en_app74"){
     var myArray = ['qualities','flaw'];
   }
   if(app_define=="en_app75"){
     var myArray = ['profession','profile','Look','picture'];
   }

   if(app_define=="en_app76"){
     var myArray = ['life','2018'];
   }
   if(app_define=="en_app77"){
     var myArray = ['income','salary'];
   }
   if(app_define=="en_app78"){
     var myArray = ['life','love','love life'];
   }
   if(app_define=="en_app79"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app80"){
     var myArray = ['daughter '];
   }
   if(app_define=="en_app81"){
     var myArray = ['friend'];
   }
   if(app_define=="en_app82"){
     var myArray = ['person','friend'];
   }
   if(app_define=="en_app83"){
     var myArray = ['friend','friendship','friend forever'];
   }
   if(app_define=="en_app84"){
     var myArray = ['photos','album','frame'];
   }
   if(app_define=="en_app85"){
        var myArray = ['photos','album','frame'];
   }
   if(app_define=="en_app86"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app87"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app88"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app89"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app90"){
     var myArray = ['Official','Official Life','Official Look'];
   }

   if(app_define=="en_app91"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app92"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app93"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app94"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app95"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app96"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app97"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app98"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app99"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app100"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app101"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app102"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app103"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app104"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app105"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app106"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app107"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app108"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app109"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app110"){
     var myArray = ['Official','Official Life','Official Look'];
   }

   if(app_define=="en_app111"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app112"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app113"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app114"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app115"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app116"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app117"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app118"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app119"){
     var myArray = ['Official','Official Life','Official Look'];
   }
   if(app_define=="en_app120"){
     var myArray = ['Official','Official Life','Official Look'];
   }



           var type = myArray[Math.floor(Math.random() * myArray.length)];
           var gurl = "http://api.giphy.com/v1/gifs/search?q="+type+"&api_key=oMrCV6gvyxDeQwqs51s6yMPGwrCOEpxE&limit=1";
           var xhr = $.get(gurl);
               xhr.done(function(data)
                {
                  $('.show-gif').prepend('<img id="theImg" src="'+data.data[0].images.fixed_height.url+'" />')
                });
 }
  var progressbar = function(result){
    var width = 1;
    var id = setInterval(frame, 80);
    function frame() {
        if (width>=100) {
          clearInterval(id);
          //append new url with param without reloading whole page
    //           if (history.pushState) {
    //     var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?success=true';
    //     window.history.pushState({path:newurl},'',newurl);
    // }
            $('#app').html(result);
            $(document).trigger('fbload');
            $("#page-sec").hide();
            $("#loader-sec-in").css('display','block');
          } else {
         width++;
           $('#myBar').css('width',width + '%');
           $('#myBar').html(width * 1  + '%');
       }
      }
  }


 // Text-loder script
   var text_animation_loder= function(){
     var TxtType = function(el, toRotate, period) {
       this.toRotate = toRotate;
       this.el = el;
       this.loopNum = 0;
       this.period = parseInt(period, 10) || 2000;
       this.txt = '';
       this.tick();
       this.isDeleting = false;
   };

   TxtType.prototype.tick = function() {
       var i = this.loopNum % this.toRotate.length;
       var fullTxt = this.toRotate[i];

       if (this.isDeleting) {
       this.txt = fullTxt.substring(0, this.txt.length - 1);
       } else {
       this.txt = fullTxt.substring(0, this.txt.length + 1);
       }

       this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

       var that = this;
       var delta = 200 - Math.random() * 100;

       if (this.isDeleting) { delta /= 2; }

       if (!this.isDeleting && this.txt === fullTxt) {
       delta = this.period;
       this.isDeleting = true;
       } else if (this.isDeleting && this.txt === '') {
       this.isDeleting = false;
       this.loopNum++;
       delta = 500;
       }

       setTimeout(function() {
       that.tick();
       }, delta);
   };

  // var elements = document.getElementsByClassName('typewrite');

       for (var i=0; i<$('.typewrite').length; i++) {
           var toRotate = $('.typewrite')[i].getAttribute('data-type');
           var period = $('.typewrite')[i].getAttribute('data-period');
           if (toRotate) {
             new TxtType($('.typewrite')[i], JSON.parse(toRotate), period);
           }
       }
   }

// end  Text-loder script
var getPage_englishApp= function()
 {
    var length = parseInt($('#app-length').text());
    var length2 = parseInt($('#app-length2').text());
    if(length==length2){
      $(".disabled").attr("disabled", true);
      $('.next-app-btn').css('display','none');
    }
  else  if(length==0){
      $(".disabled").attr("disabled", true);
      $('.next-app-btn').css('display','none');
    }
    else{
    $(".disabled").attr("disabled", false);
     $('.box.well').css('display','block');
     $('.box').jmspinner('large');
   var number = parseInt($('#total').text());
   var length = parseInt($('#app-length').text());
  // //console.log("length",length);
      number+=12;
      $('#total').text(number);
            ////console.log(number);
  //  //console.log(sum);
  // var number = "6";
  // var skip   = "6";
   $.ajax({
          type : 'get',
          url  : 'en/get_englishapp_data',
          dataType: "JSON",
          data: {
            take: "12",
            offset:number,
            lang : "en",
            },
          success: function(data)
          {
             //console.log(data);
            //console.log("length",data.html.length);
               $('#app-length').text(data.html.length);
                $('#app_box .flex-row').append(data.html);
                $('.box').jmspinner(false);
                $('.box.well').css('display','none');
           },
          error :  function(data)
          {
              alert("error");
          }
        });

        $.ajax({
               type : 'get',
               url  : 'en/get_englishapp_data',
               dataType: "JSON",
               data: {
                 take: "12",
                 offset:number+48,
                 lang : "en",
                 },
               success: function(data)
               {
                  //console.log("pree",data);
                  //console.log("length2",data.html.length);
                   $('#app-length2').text(data.html.length);
                  if(length==data.html.length){
                    $(".disabled").attr("disabled", true);
                    $('.next-app-btn').css('display','none');
                  }
                },
               error :  function(data)
               {
                   alert("error");
               }
             });
        }
 }
