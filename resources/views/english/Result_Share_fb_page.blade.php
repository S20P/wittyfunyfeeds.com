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

  $og_title = stripcslashes($app_title);
  $og_description = stripcslashes($app_description_og);

  //  $id = Auth::id();
  //  $response = ["id"=>$id,"og_img"=>asset($img_url),"og_title"=>$og_title,"og_description"=>$og_description];
    // $fp = fopen('meta-json/data.json','a');
    // fwrite($fp, json_encode($response));
    // fclose($fp);
    //

    // if(file_exists('meta-json/data.json'))
    //           {
    //                $current_data = file_get_contents('meta-json/data.json');
    //                $array_data = json_decode($current_data, true);
    //
    //                $array_data[] = $response;
    //                $final_data = json_encode($array_data);
    //                if(file_put_contents('meta-json/data.json', $final_data))
    //                {
    //                     $message = "<label class='text-success'>File Appended Success fully</p>";
    //                }
    //           }
    //           else
    //           {
    //                $error = 'JSON File not exits';
    //           }

?>

<script type="text/javascript">
// $('meta[property="og:title"]').remove();
// $('meta[property="og:description"]').remove();
// $('meta[property="og:url"]').remove();
// $('meta[property="og:image"]').remove();
//
//  $("head").append('<meta property="fb:app_id" content="1827442653951223">');
//  $("head").append('<meta property="og:url" content="{{url()->current()}}">');
//  $("head").append('<meta property="og:title" content="<?php //echo stripcslashes($app_title);?>">');
//  $("head").append('<meta property="og:description" content="<?php //echo stripcslashes($app_description_og);?>">');
//  $("head").append('<meta property="og:image" content="{{asset($img_url)}}">');
//  $("head").append('<meta property="og:image:width" content="1200">');
//  $("head").append('<meta property="og:image:height" content="630">');

</script>

<!-- <script type="text/javascript">

createCookie("height","This is a dynamic title", "1");


function createCookie(name, value, days) {
var expires;
if (days) {
  var date = new Date();
  date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
  expires = "; expires=" + date.toGMTString();
} else {
 expires = "";
}
document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}
</script> -->

@include('js.facebook-on-share')
