$(function(){
   $('#image_upload_app').click(function() {
        $(".disabled").attr("disabled", true);
        $("#page-sec").show();
        $("#loader-sec-in").css('display','none');
         text_animation_loder();
         progress_loaderGif("app3");
          var file_data =  $('.upload-preview').attr('src');
    $.ajax({
            url: 'app3_createimg',
            type: 'POST',
            ContentType: "application/json",
            mimeType: "multipart/form-data",
            data: { "_token": "{{ csrf_token() }}","app_img_url":file_data},
            success: function(response)
            {
             $('#favoritesModal').modal('hide');
             progressbar(response);
            // progress_gif("app3",response);
            },
        });
        return false;
   });
});
// $('.box').jmspinner('large');
// $('.box.well').css('display','block');
//
// var  app_hindi_list = function(lang)
// {
//
// console.log(document.location);
//  if(document.location.hash==="#_=_"){
//       var path = lang+'#_=_';
//   }
//   else{
//       var path = lang;
//   }
//   console.log("document.location",document.location.origin+path);
//   var href = document.location.href;
//   console.log("href",href);
//   var fullApiurl = document.location.origin+path;
//      if(href===fullApiurl){
//        $.ajax({
//               type : 'get',
//               url  : 'hi/defult_app_hi',
//               dataType: "JSON",
//               data: {
//                 lang : "hi",
//                 },
//               success: function(data)
//               {
//                  console.log(data);
//                 // return;
//                 $('#app_box').html(data.html);
//                 $('.box').jmspinner(false);
//                 $('.box.well').css('display','none');
//                },
//               error :  function(data)
//               {
//                   alert("error");
//               }
//             });
//           }
//
//
//
// }
  //app1------------------------------------------------------------------------
         var  hi_app1_createimg = function()
          {
             console.log("hiiiiii");
            $(".disabled").attr("disabled", true);
            $("#page-sec").show();
            $("#loader-sec-in").css('display','none');
             text_animation_loder();
             progress_loaderGif("hi_app1");
            var $request = $.get('hi_app1_createimg', function(result)
             {
               progressbar(result.html);
             });
          }
    //---*end app1*//


//app2---------------------------------------------------------------------
          var  hi_app2_createimg = function()
           {
              console.log("hiiiiii");
             $(".disabled").attr("disabled", true);
             $("#page-sec").show();
             $("#loader-sec-in").css('display','none');
              text_animation_loder();
              progress_loaderGif("hi_app2");
             var $request = $.get('hi_app2_createimg', function(result)
              {
                progressbar(result.html);
              });
           }
  //---*end app2*//


//app3---------------------------------------------------------------------
        var  hi_app3_createimg = function()
         {
            console.log("hiiiiii");
           $(".disabled").attr("disabled", true);
           $("#page-sec").show();
           $("#loader-sec-in").css('display','none');
            text_animation_loder();
            progress_loaderGif("hi_app3");
           var $request = $.get('hi_app3_createimg', function(result)
            {
              progressbar(result.html);
            });
         }
//---*end app3*//


//app4---------------------------------------------------------------------
      var  hi_app4_createimg = function()
       {
          console.log("hiiiiii");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app4");
         var $request = $.get('hi_app4_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app4*//


//app5---------------------------------------------------------------------
      var  hi_app5_createimg = function()
       {
          console.log("hiiiiii");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app5");
         var $request = $.get('hi_app5_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app5*//

//app6---------------------------------------------------------------------
      var  hi_app6_createimg = function()
       {
          console.log("app6");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app6");
         var $request = $.get('hi_app6_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app6*//

//app7---------------------------------------------------------------------
      var  hi_app7_createimg = function()
       {
          console.log("app7");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app7");
         var $request = $.get('hi_app7_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app7*//

//app8-------------------आपकी CHRISTMAS PICTURE कैसी दिखेगी?--------------------------------------------------
      var  hi_app8_createimg = function()
       {
          console.log("app8");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app8");
         var $request = $.get('hi_app8_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app8*//

//app9-------------------वह क्या एक चीज़ है जो आप में कभी नहीं बदल सकती?--------------------------------------------------
      var  hi_app9_createimg = function()
       {
          console.log("app9");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app9");
         var $request = $.get('hi_app9_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app9*//
//app10-------------------2018 से आप क्या expect कर सकते हो?--------------------------------------------------
      var  hi_app10_createimg = function()
       {
          console.log("app10");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app10");
         var $request = $.get('hi_app10_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app10*//
//app11--------------------जाने गणपति जी आपसे क्या कहना चाहते हैं-------------------------------------------------
      var  hi_app11_createimg = function()
       {
          console.log("app11");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app11");
         var $request = $.get('hi_app11_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app11*//

//app12--------जानिये आपकी आत्मा की उम्र कितनी है?-------------------------------------------------------------
      var  hi_app12_createimg = function()
       {
          console.log("app12");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app12");
         var $request = $.get('hi_app12_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app12*//
//app13--------आपकी कौन सी फोटो गैलरी में लटकनी चाहिए?-------------------------------------------------------------
      var  hi_app13_createimg = function()
       {
          console.log("app13");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app13");
         var $request = $.get('hi_app13_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app13*//
//app14--------------आप कितने सुन्दर हो?------------------------------------------------------
      var  hi_app14_createimg = function()
       {
          console.log("app14");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app14");
         var $request = $.get('hi_app14_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app14*//
//app15------------भगवान् ने आपको धरती पर क्यों भेजा है?--------------------------------------------------------
      var  hi_app15_createimg = function()
       {
          console.log("app15");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app15");
         var $request = $.get('hi_app15_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app15*//
//app16------------आपने कितने लोगों के दिल तोड़े हैं?--------------------------------------------------------
      var  hi_app16_createimg = function()
       {
          console.log("app16");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app16");
         var $request = $.get('hi_app16_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app16*//
//app17------------जानिए आपकी पर्सनालिटी को कौनसी नौकरी सूट करेगी?--------------------------------------------------------
      var  hi_app17_createimg = function()
       {
          console.log("app17");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app17");
         var $request = $.get('hi_app17_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app17*//
//app18------------आपकी फेसबुक प्रोफाइल में आपके लिए क्या सन्देश छुपा है?--------------------------------------------------------
      var  hi_app18_createimg = function()
       {
          console.log("app18");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app18");
         var $request = $.get('hi_app18_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app18*//
//app19------------जानिये आइना आपके बारे में क्या कहता है?--------------------------------------------------------
      var  hi_app19_createimg = function()
       {
          console.log("app19");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app19");
         var $request = $.get('hi_app19_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app19*//
//app20------------जानिए आपकी किस्मत कब चमकेगी?--------------------------------------------------------
      var  hi_app20_createimg = function()
       {
          console.log("app20");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app20");
         var $request = $.get('hi_app20_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app20*//
//app21------------आपको अगले साल क्या सरप्राइज मिलने वाला है?--------------------------------------------------------
      var  hi_app21_createimg = function()
       {
          console.log("app21");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app21");
         var $request = $.get('hi_app21_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app21*//
//app22------------कौनसे 4 शब्द आपकी पर्सनालिटी को दर्शाते हैं?--------------------------------------------------------
      var  hi_app22_createimg = function()
       {
          console.log("app22");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app22");
         var $request = $.get('hi_app22_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app22*//
//app23------------आपकी PROFILE आपके बारे में क्या 4 चीज़े बताती है?--------------------------------------------------------
      var  hi_app23_createimg = function()
       {
          console.log("app23");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app23");
         var $request = $.get('hi_app23_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app23*//
//app24------------आप कौनसे सुपरस्टार की तरह दिखते हैं?--------------------------------------------------------
      var  hi_app24_createimg = function()
       {
          console.log("app24");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app24");
         var $request = $.get('hi_app24_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app24*//
//app25------------आपके परिवार में कौनसा सदस्य आपके लिए ज्यादा भाग्यशाली है?--------------------------------------------------------
      var  hi_app25_createimg = function()
       {
          console.log("app25");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app25");
         var $request = $.get('hi_app25_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app25*//
//app26------------भगवान आपसे प्रस्सन हो जाये तो आप क्या वरदान मांगोगे?--------------------------------------------------------
      var  hi_app26_createimg = function()
       {
          console.log("app26");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app26");
         var $request = $.get('hi_app26_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app26*//
//app27------------जानिए लोग आपकी किन 3 बातों से प्यार करते हैं?--------------------------------------------------------
      var  hi_app27_createimg = function()
       {
          console.log("app27");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app27");
         var $request = $.get('hi_app27_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app27*//
//app28------------आपके खून में अपने माता पिता के कौनसे गुण हैं?--------------------------------------------------------
      var  hi_app28_createimg = function()
       {
          console.log("app28");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app28");
         var $request = $.get('hi_app28_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app28*//
//app29------------आपके होने वाले बच्चों का नाम क्या होना चाहिए?--------------------------------------------------------
      var  hi_app29_createimg = function()
       {
          console.log("app29");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app29");
         var $request = $.get('hi_app29_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app29*//
//app30------------जानिए आपकी जिंदगी मे और कितने साल बाकि हैं?--------------------------------------------------------
      var  hi_app30_createimg = function()
       {
          console.log("app30");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app30");
         var $request = $.get('hi_app30_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app30*//
//app31------------2018 में आपके पास कौन सी तीन चीजें होंगी?--------------------------------------------------------
      var  hi_app31_createimg = function()
       {
          console.log("app31");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app31");
         var $request = $.get('hi_app31_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app31*//
//app32----------------------आपके दिमाग, शरीर और आत्मा कि उम्र क्या है?----------------------------------------------
      var  hi_app32_createimg = function()
       {
          console.log("app32");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app32");
         var $request = $.get('hi_app32_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app32*//
//app33------------आपने कितने दिलों को चुराया, तोडा और ठीक किया है?--------------------------------------------------------
      var  hi_app33_createimg = function()
       {
          console.log("app33");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app33");
         var $request = $.get('hi_app33_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app33*//
//app34------------अपनी ‘जय श्री राम’ की फोटो बनाये और शेयर करें!--------------------------------------------------------
      var  hi_app34_createimg = function()
       {
          console.log("app34");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app34");
         var $request = $.get('hi_app34_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app34*//
//app35------------आप देवता हैं या राक्षस?--------------------------------------------------------
      var  hi_app35_createimg = function()
       {
          console.log("app35");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app35");
         var $request = $.get('hi_app35_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app35*//
//app36------------बाहुबली-मूवी का कौनसा डायलॉग आप पर सूट करता है?--------------------------------------------------------
      var  hi_app36_createimg = function()
       {
          console.log("app36");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app36");
         var $request = $.get('hi_app36_createimg', function(result)
          {

            progressbar(result.html);
          });
       }
//---*end app36*//

//app37------------कौनसा देसी-फास्ट-फूड आपके लिए बना है?--------------------------------------------------------
      var  hi_app37_createimg = function()
       {
          console.log("app37");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app37");
         var $request = $.get('hi_app37_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app37*//
//app38------------कौनसा फ़ोन आपके लिए बना है?--------------------------------------------------------
      var  hi_app38_createimg = function()
       {
          console.log("app38");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app38");
         var $request = $.get('hi_app38_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app38*//
//app39------------आपने अपने जीवन में कितने अच्छे कर्म और शरारती पाप किये है?--------------------------------------------------------
      var  hi_app39_createimg = function()
       {
          console.log("app39");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app39");
         var $request = $.get('hi_app39_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app39*//
//app40------------कितने लोगो ने आपसे 2017 में प्यार किया और कितनो ने नफरत की?--------------------------------------------------------
      var  hi_app40_createimg = function()
       {
          console.log("app40");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app40");
         var $request = $.get('hi_app40_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app40*//
//app41------------अपने रिटायरमेंट के समय आपके पास क्या क्या होगा?--------------------------------------------------------
      var  hi_app41_createimg = function()
       {
          console.log("app41");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app41");
         var $request = $.get('hi_app41_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app41*//
//app42------------यदि आप अपने अतीत में एक चीज बदल सकते हैं, तो वो क्या होगी?--------------------------------------------------------
      var  hi_app42_createimg = function()
       {
          console.log("app42");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app42");
         var $request = $.get('hi_app42_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app42*//
//app43------------कितने लोगो ने आपसे 2017 में प्यार किया और कितनो ने नफरत की?--------------------------------------------------------
      var  hi_app43_createimg = function()
       {
          console.log("app43");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app43");
         var $request = $.get('hi_app43_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app43*//
//app44------------कितने लोगो ने आपसे 2017 में प्यार किया और कितनो ने नफरत की?--------------------------------------------------------
      var  hi_app44_createimg = function()
       {
          console.log("app44");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app44");
         var $request = $.get('hi_app44_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app44*//
//app45------------कितने लोगो ने आपसे 2017 में प्यार किया और कितनो ने नफरत की?--------------------------------------------------------
      var  hi_app45_createimg = function()
       {
          console.log("app45");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app45");
         var $request = $.get('hi_app45_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app45*//
//app46------------कितने लोगो ने आपसे 2017 में प्यार किया और कितनो ने नफरत की?--------------------------------------------------------
      var  hi_app46_createimg = function()
       {
          console.log("app46");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app46");
         var $request = $.get('hi_app46_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app46*//
//app47------------कितने लोगो ने आपसे 2017 में प्यार किया और कितनो ने नफरत की?--------------------------------------------------------
      var  hi_app47_createimg = function()
       {
          console.log("app47");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app47");
         var $request = $.get('hi_app47_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app47*//
//app48------------कितने लोगो ने आपसे 2017 में प्यार किया और कितनो ने नफरत की?--------------------------------------------------------
      var  hi_app48_createimg = function()
       {
          console.log("app48");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app48");
         var $request = $.get('hi_app48_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app48*//
//app49------------कितने लोगो ने आपसे 2017 में प्यार किया और कितनो ने नफरत की?--------------------------------------------------------
      var  hi_app49_createimg = function()
       {
          console.log("app49");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app49");
         var $request = $.get('hi_app49_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app49*//
//app50------------कितने लोगो ने आपसे 2017 में प्यार किया और कितनो ने नफरत की?--------------------------------------------------------
      var  hi_app50_createimg = function()
       {
          console.log("app50");
         $(".disabled").attr("disabled", true);
         $("#page-sec").show();
         $("#loader-sec-in").css('display','none');
          text_animation_loder();
          progress_loaderGif("hi_app50");
         var $request = $.get('hi_app50_createimg', function(result)
          {
            progressbar(result.html);
          });
       }
//---*end app50*//
 var progress_loaderGif = function(app_define){

   if(app_define=="hi_app1"){
     var myArray = ['car','cars'];
   }
   if(app_define=="hi_app2"){
     var myArray = ['temple','god','lords'];
   }
   if(app_define=="hi_app3"){
     var myArray = ['by by','goodby 2017','end2017'];
   }
   if(app_define=="hi_app4"){
     var myArray = ['	body part','body','face','eye','hair'];
   }
   if(app_define=="hi_app5"){
     var myArray = ['date','party','love date'];
   }
   if(app_define=="hi_app6"){
     var myArray = ['atoz','a','b','name','अक्षर'];
   }
   if(app_define=="hi_app7"){
     var myArray = ['hart','hartlove','think'];
   }
   if(app_define=="hi_app8"){
     var myArray = ['CHRISTMAS','frame','photos'];
   }
   if(app_define=="hi_app9"){
     var myArray = ['none','dont','any'];
   }

   if(app_define=="hi_app10"){
     var myArray = ['expect','given','2018'];
   }
   if(app_define=="hi_app11"){
     var myArray = ['गणपति','ganesha','lords','say'];
   }

   if(app_define=="hi_app12"){
     var myArray = ['आत्मा','उम्र','age'];
   }

   if(app_define=="hi_app13"){
     var myArray = ['gallery','frame','photos','albums'];
   }
   if(app_define=="hi_app14"){
     var myArray = ['fine','pretty','cute','wonderful','brilliant','lovely','classy','beauteous'];
   }

   if(app_define=="hi_app15"){
     var myArray = ['temple','god','lords','land'];
   }
   if(app_define=="hi_app16"){
     var myArray = ['break up','stop','end'];
   }

   if(app_define=="hi_app17"){
     var myArray = ['job','personality','courageous','amiable'];
   }

   if(app_define=="hi_app18"){
     var myArray = ['facebook','mail','message','profile'];
   }

   if(app_define=="hi_app19"){
     var myArray = ['glass','mirror','lords'];
   }
   if(app_define=="hi_app20"){
     var myArray = ['lucky','kismet','win'];
   }
   if(app_define=="hi_app21"){
     var myArray = ['amaze','astonish','chill','daunt','surprise'];
   }

   if(app_define=="hi_app22"){
        var myArray = ['job','personality','courageous','amiable'];
   }

   if(app_define=="hi_app23"){
     var myArray = ['profile','self','PICTURE'];
   }

   if(app_define=="hi_app24"){
     var myArray = ['superstar','hero','star','someone'];
   }
   if(app_define=="hi_app25"){
     var myArray = ['lucky','kismet','win','mother','family','son','sister'];
   }
   if(app_define=="hi_app26"){
     var myArray = ['temple','god','lords','asylum','Blessing','pray'];
   }
   if(app_define=="hi_app27"){
     var myArray = ['people','age group','circle','club'];
   }
   if(app_define=="hi_app28"){
     var myArray = ['parents','character','element','kind','nature','affection'];
   }
   if(app_define=="hi_app29"){
     var myArray = ['baby','child','name'];
   }
   if(app_define=="hi_app30"){
     var myArray = ['life','year','endyears','date'];
   }
   if(app_define=="hi_app31"){
     var myArray = ['give','2018'];
   }
   if(app_define=="hi_app32"){
     var myArray = ['body','brean'];
   }
   if(app_define=="hi_app33"){
     var myArray = ['hart','breakup','hat'];
   }
   if(app_define=="hi_app34"){
      var myArray = ['photo','ram','frame'];
   }
   if(app_define=="hi_app35"){
     var myArray = ['gods','Divinity','divyata','Rakshasa'];
   }
   if(app_define=="hi_app36"){
     var myArray = ['bahubali','movie','film','dialogs'];
   }

   if(app_define=="hi_app37"){
     var myArray = ['Fast food','cookery'];

   }

   if(app_define=="hi_app38"){
     var myArray = ['phone','mobile','game'];
   }

   if(app_define=="hi_app39"){
     var myArray = ['bed','good'];
   }
   if(app_define=="hi_app40"){
     var myArray = ['love','hat'];
   }

   if(app_define=="hi_app41"){
     var myArray = ['retirement','withdrawal'];
   }

   if(app_define=="hi_app42"){
     var myArray = ['past','Elapsed','lords'];
   }

   if(app_define=="hi_app43"){
     var myArray = ['temple','god','lords'];
   }

   if(app_define=="hi_app44"){
     var myArray = ['temple','god','lords'];
   }

   if(app_define=="hi_app45"){
     var myArray = ['temple','god','lords'];
   }

   if(app_define=="hi_app46"){
     var myArray = ['temple','god','lords'];
   }

   if(app_define=="hi_app47"){
     var myArray = ['temple','god','lords'];
   }
   if(app_define=="hi_app48"){
     var myArray = ['temple','god','lords'];
   }

   if(app_define=="hi_app49"){
     var myArray = ['temple','god','lords'];
   }
   if(app_define=="hi_app50"){
     var myArray = ['temple','god','lords'];
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
            $('#app').html(result);
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
var getPage_hindiApp= function()
 {
    console.log("reading..");

    var length = parseInt($('#app-length').text());
    var length2 = parseInt($('#app-length2').text());
    if(length==length2){
      $(".disabled").attr("disabled", true);
      $('.next-app-btn').css('display','none');
    }
  else   if(length==0){
      $(".disabled").attr("disabled", true);
    }
    else{
    $(".disabled").attr("disabled", false);
     $('.box.well').css('display','block');
     $('.box').jmspinner('large');
   var number = parseInt($('#total').text());
   var length = parseInt($('#app-length').text());
  // console.log("length",length);
      number+=6;
      $('#total').text(number);
            //console.log(number);
  //  console.log(sum);
  // var number = "6";
  // var skip   = "6";
   $.ajax({
          type : 'get',
          url  : 'hi/get_hindiapp_data',
          dataType: "JSON",
          data: {
            take: "6",
            offset:number,
            lang : "hi",
            },
          success: function(data)
          {
             console.log("proccess...");
          //   console.log("length",data.html.length);
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
                       url  : 'hi/get_hindiapp_data',
                       dataType: "JSON",
                       data: {
                         take: "6",
                         offset:number+6,
                         lang : "hi",
                         },
                       success: function(data)
                       {
                          console.log("pree",data);
                          console.log("length2",data.html.length);
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
