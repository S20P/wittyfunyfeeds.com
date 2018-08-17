<?php

namespace App\Http\Controllers\hindi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\SocialFacebookAccount;
use Image;
use Route;
use DB;
use Redirect;
use Session;
use File;
use Response;
use View;
use Schema;
class AppCreateController_hi extends Controller
{

  public function __construct()
   {
     //its just a dummy data object.

     // Sharing is caring
        if(Schema::hasTable('application_store')){
          $sn = rand(1,42);
             $student = DB::table('application_store')->where('lang','hi')->orderBy('id', 'desc')->skip($sn)->take('5')->get();
               View::share('student', $student);

               $skip_no = $sn+6;
               $app_btm_list = DB::table('application_store')->where('lang','hi')->orderBy('id', 'desc')->skip($skip_no)->take('6')->get();
               View::share('app_btm_list', $app_btm_list);
           }
 }




//----2018में_आप_कौनसी_कार_खरीदेंगै-------------------------------------------app1--
        public function hi_app1(){
           return  view('hindi.hi_app1');
        }

        public function hi_app1_createimg(){

          if (Auth::check()){

          // paste another image
            $posts  = User::find(Auth::user()->id);


            $dir = "images/hindi/app1/bg-sample/";
            $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
            $img_path = $pictures[mt_rand(0,count($pictures)-1)];

            $img = Image::make($img_path);
            $ext = pathinfo($img_path);
            $car_name = $ext['filename'];

          $overtxt = $posts->first_name;
          $img->text($overtxt, 140, 348, function($font) {
              $font->file('fonts/theboldfont.ttf');
              $font->size(20);
              $font->color('#000');
              $font->align('center');   //left, right and center
              $font->valign('middle');  //top, bottom , middle
              $font->angle(0);       //0,45,90,180
          });

          $markimg = $posts->picture;
          $watermark = Image::make($markimg);
          $watermark->resize(220, 220, function ($constraint){
              $constraint->aspectRatio();
          });

          $canvas = Image::canvas(800, 420);
          $canvas->insert($watermark, 'top-left', 45, 105);
          $canvas->insert($img);

          //$canvas->save('images/final.png');
          // $markimg = $posts->picture;
          // $watermark = Image::make($markimg);
          // $watermark->resize(195, 201);

        //  $img->insert($watermark, 'top-left',50,107);

          //$img->resize(800, 420);
          $ldate = date('d-m-Y');
          $t=time();
          $fb_id = $posts['Fb_uid'];
          $image_dirctory_path = 'uploads/'.$ldate;
          File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
          $image_name = 'hi_app1_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
          $fullimage_path = $image_dirctory_path.'/'.$image_name;
          $canvas->save($fullimage_path);
         // $img->save('images/fb1.jpg');

           //save to images
           //  $img->save('images/dd.jpg', 60); //save to set image quality
         //return  $img->response('jpg');
         //return view('/share',array('posts' => $posts,'img'=>$img));
         $html = view('hindi.hi_app1_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'car_name'=>$car_name), compact('view'))->render();
         return response()->json(compact('html'));
          }
         else{
               return Redirect::route('redirect');
              }

          }

//--------------------------------------------------------------------end app1--



  //----कौनसा_तीर्थ_स्थान_आपको_बुला_रहा_है-------------------------------------app2--

           public function hi_app2(){
              return  view('hindi.hi_app2');
           }

           public function hi_app2_createimg(){

             if (Auth::check()){

             // paste another image
               $posts  = User::find(Auth::user()->id);

               $dir = "images/hindi/app2/bg-sample/";
               $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
               $img_path = $pictures[mt_rand(0,count($pictures)-1)];

               $img = Image::make($img_path);
               $ext = pathinfo($img_path);
               $temple_name = $ext['filename'];
               if($temple_name=="bg1"){
                       $temple_name ="अक्षरधाम";
                       $temple_desc = "नई दिल्ली में बना स्वामिनारायण अक्षरधाम मन्दिर एक अनोखा सांस्कृतिक तीर्थ है";
               }
               if($temple_name=="bg2"){
                       $temple_name ="बगदाना मंदिर";
                       $temple_desc = "हिंदू मिथक संत बजरंगदास बापा के अनुयायी के लिए गांव एक प्रमुख तीर्थ स्थान है";
               }
               if($temple_name=="bg3"){
                       $temple_name ="सुवर्णमंदिर";
                       $temple_desc = "जिसे दरबार साहिब या स्वर्ण मन्दिर भी कहा जाता है सिख धर्मावलंबियों का पावनतम धार्मिक स्थल या सबसे प्रमुख गुरुद्वारा है";
               }
               if($temple_name=="bg4"){
                       $temple_name ="द्वारकाधीश";
                       $temple_desc = "हिन्दू धर्मग्रन्थों के अनुसार, भगवान कॄष्ण ने इसे बसाया था। यह श्रीकृष्ण की कर्मभूमि है।";
               }
               if($temple_name=="bg5"){
                       $temple_name ="जैनमंदिर";
                       $temple_desc = "जैन धर्म का पालीताना मंदिर शत्रुंजय पहाड़ी पर शहर पालीताना जिले भावनगर गुजरात राज्य, भारत में स्थित हैं।";
               }
               if($temple_name=="bg6"){
                       $temple_name ="खोडलधाम";
                       $temple_desc = "भारत के सौराष्ट्र गाम कागवाड में माँ खोदल का यह पवित्र मंदिर है, जो भारत और विदेशों के लाखों श्रद्धालुओं को आकर्षित करता है। ";
               }
               if($temple_name=="bg7"){
                       $temple_name ="मथुरा";
                       $temple_desc = "लंबे समय से मथुरा प्राचीन भारतीय संस्कृति  एवं सभ्यता का केंद्र रहा है। मथुरा को श्रीकृष्ण की जन्म भूमि के नाम से भी जाना जाता है। ";
               }
               if($temple_name=="bg8"){
                       $temple_name ="सिद्धिविनायक";
                       $temple_desc = "मुंबई के प्रभा देवी इलाके का सिद्धिविनायक मंदिर उन गणेश मंदिरों में से एक है, जहां हर धर्म के लोग दर्शन के लिए आते हैं।";
               }
               if($temple_name=="bg9"){
                       $temple_name ="सारंगपुर मंदिर";
                       $temple_desc = "गुजरात में भावनगर के सारंगपुर में हनुमान जी का एक अति प्राचीन मंदिर स्तिथ है जो की कष्टभंजन हनुमानजी के नाम से जाना जाता है";
               }
               if($temple_name=="bg10"){
                       $temple_name ="शिरडी साई";
                       $temple_desc = "यह स्थान सांई बाबा के लिए बहुत प्रसिद्ध है यहां उनका एक विशाल मंदिर है।";
               }
               if($temple_name=="bg11"){
                       $temple_name ="सोमनाथ";
                       $temple_desc = "अत्यन्त प्राचीन व ऐतिहासिक सूर्य मन्दिर का नाम है। यह भारतीय इतिहास तथा हिन्दुओं के चुनिन्दा और महत्वपूर्ण मन्दिरों में से एक है";
               }
               if($temple_name=="bg12"){
                       $temple_name ="केदारनाथ";
                       $temple_desc = "उत्तराखण्ड में हिमालय पर्वत की गोद में केदारनाथ मन्दिर स्थित है। इसका निर्माण पाण्डव वंश के जनमेजय ने कराया था";
               }
               if($temple_name=="bg13"){
                       $temple_name ="तिरुपति बालाजी";
                       $temple_desc = "भारत के आन्ध्रप्रदेश राज्य चित्तोड़ जिले के  तिरुपति में स्थित है। यह मंदिर भगवान वेंकटेश्वर को समर्पित है जो भगवान विष्णु के अवतार थे";
               }
               if($temple_name=="bg14"){
                       $temple_name ="महाकालेश्वर";
                       $temple_desc = "महाकालेश्वर मंदिर भारत के बारह ज्योतिर्लिंगों में से एक है। यह मध्यप्रदेश राज्य के उज्जैन नगर में स्थित, महाकालेश्वर भगवान का प्रमुख मंदिर है।";
               }


             $markimg = $posts->picture;
             $watermark = Image::make($markimg);
             $watermark->resize(220, 220, function ($constraint){
                 $constraint->aspectRatio();
             });

             $canvas = Image::canvas(800, 420);
             $canvas->insert($watermark, 'top-right', 30, 40);
             $canvas->insert($img);

             //$canvas->save('images/final.png');
             // $markimg = $posts->picture;
             // $watermark = Image::make($markimg);
             // $watermark->resize(195, 201);

           //  $img->insert($watermark, 'top-left',50,107);

             //$img->resize(800, 420);
             $ldate = date('d-m-Y');
             $t=time();
             $fb_id = $posts['Fb_uid'];
             $image_dirctory_path = 'uploads/'.$ldate;
             File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
             $image_name = 'hi_app2_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
             $fullimage_path = $image_dirctory_path.'/'.$image_name;
             $canvas->save($fullimage_path);
            // $img->save('images/fb1.jpg');

              //save to images
              //  $img->save('images/dd.jpg', 60); //save to set image quality
            //return  $img->response('jpg');
            //return view('/share',array('posts' => $posts,'img'=>$img));
            $html = view('hindi.hi_app2_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'temple_name'=>$temple_name,'temple_desc'=>$temple_desc), compact('view'))->render();
            return response()->json(compact('html'));
             }
            else{
                  return Redirect::route('redirect');
                 }

             }
//--------------------------------------------------------------------end app2--




//----2017 ख़तम होने से पहले आपको कौनसे काम पूरे कर लेने चाहिए?-------------------------------------app3--

         public function hi_app3(){
            return  view('hindi.hi_app3');
         }

         public function hi_app3_createimg(){

                     if (Auth::check()){

                     // paste another image
                       $posts  = User::find(Auth::user()->id);

                    //   $dir = "images/hindi/app3/bg-sample/Product_bg.png";
                      // $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
                      // $img_path = $pictures[mt_rand(0,count($pictures)-1)];

                       $img = Image::make("images/hindi/app3/bg-sample/Product_bg.png");
                    //   $ext = pathinfo($img_path);
                    //   $car_name = $ext['filename'];
                    $txtarry1 = array( 'अपने  सभी  उधार-खाते नपिता लेने चाहिए' ,
                                       'अपने  दिल की  बात  ह  देनी  चाहिए  कल  हो  न  हो',
                                       'अपने  बीते  हुए  कल  को  भूल  जाना  चाहिए',
                                       'अपने  आधार कार्ड को फोन नंबर से  जोड़ लेना  चाहिए',
                                       'अपने  दोस्तों  से  पेंडिंग पार्टीस  ले-लेनी  चाहिए',
                                       'अपने  आधार कार्ड को   बैंक  अकाउंट  से  जोड़ लेना  चाहिए',
                                       'अपने फण्ड  सही  है ! इनमें  इन्वेस्ट  करना  शरू करदो');
                     $i = rand(0, count($txtarry1)-1); // generate random number size of the array
                     $overtxt1 = $txtarry1[$i];

                           $string = wordwrap($overtxt1,30,"|");

                           //create array of lines
                           $strings = explode("|",$string);
                           $i=95; //top position of string
                           //for each line added
                           foreach($strings as $string){
                           $img->text($string, 467, $i, function($font) {
                           $font->file('fonts/hindi/NotoSans-Regular.ttf');
                           // $font->file('fonts/hindi/Khula/Khula-Regular.ttf');
                           // $font->file('fonts/hindi/Sarala/Sarala-Regular.ttf');
                           // $font->file('fonts/hindi/Khand/Khand-Regular.ttf');
                           // $font->file('fonts/hindi/ex/Akshar.ttf');
                           // $font->file('fonts/hindi/Rajdhani/Rajdhani-Regular.ttf');
                           // $font->file('fonts/hindi/Teko/Teko-Regular.ttf');
                           // $font->file('fonts/hindi/Ranga/Ranga-Regular.ttf');
                           // $font->file('fonts/hindi/Pragati_Narrow/PragatiNarrow-Regular.ttf');
                           // $font->file('fonts/hindi/Glegoo/Glegoo-Regular.ttf');
                           // $font->file('fonts/hindi/Jaldi/Jaldi-Regular.ttf');
                           // $font->file('fonts/hindi/Baloo/Baloo-Regular.ttf');
                           // $font->file('fonts/hindi/Cambay/Cambay-Regular.ttf');
                           // $font->file('fonts/hindi/Karma/Karma-Regular.ttf');
                           // $font->file('fonts/hindi/Martel_Sans/MartelSans-Regular.ttf');
                           // $font->file('fonts/hindi/Palanquin/Palanquin-Regular.ttf');
                           // $font->file('fonts/hindi/Kurale/Kurale-Regular.ttf');
                           // $font->file('fonts/hindi/Sumana/Sumana-Regular.ttf');
                           // $font->file('fonts/hindi/Biryani/Biryani-Regular.ttf');
                           // $font->file('fonts/hindi/Eczar/Eczar-Regular.ttf');
                           // $font->file('fonts/hindi/Amiko/Amiko-Regular.ttf');
                           // $font->file('fonts/hindi/Kadwa/Kadwa-Regular.ttf');
                           // $font->file('fonts/hindi/Laila/Laila-Regular.ttf');
                           // $font->file('fonts/hindi/Rhodium_Libre/RhodiumLibre-Regular.ttf');
                           // $font->file('fonts/hindi/Dekko/Dekko-Regular.ttf');
                           // $font->file('fonts/hindi/Yatra_One/YatraOne-Regular.ttf');
                           // $font->file('fonts/hindi/Sahitya/Sahitya-Regular.ttf');
                           // $font->file('fonts/hindi/Tillana/Tillana-Regular.ttf');
                           // $font->file('fonts/hindi/Inknut_Antiqua/InknutAntiqua-Regular.ttf');
                           // $font->file('fonts/hindi/Sura/Sura-Regular.ttf');


                           $font->size(32);
                           $font->color('#000');
                           $font->align('center');
                           $font->valign('middle');
                           });
                         $i=$i+40; //shift top postition down 42
                           }

                    // $img->text("निपटा ", 467,100, function($font) {
                    //     $font->file('fonts/hindi/NotoSans-Regular.ttf');
                    //     $font->size(30);
                    //     $font->color('#000');
                    //     $font->align('center');   //left, right and center
                    //     $font->valign('middle');  //top, bottom , middle
                    //     $font->angle(0);       //0,45,90,180
                    // });

                     $overtxt = $posts->first_name;
                     $img->text($overtxt, 180, 338, function($font) {
                         $font->file('fonts/theboldfont.ttf');
                         $font->size(20);
                         $font->color('#fff');
                         $font->align('center');   //left, right and center
                         $font->valign('middle');  //top, bottom , middle
                         $font->angle(0);       //0,45,90,180
                     });



                     $markimg = $posts->picture;
                     $watermark = Image::make($markimg);
                     $watermark->resize(315, 315, function ($constraint){
                         $constraint->aspectRatio();
                     });

                     $canvas = Image::canvas(800, 420);
                     $canvas->insert($watermark, 'top-left', 35, 45);
                     $canvas->insert($img);

                     $canvas->response('png', 70);

                     //$canvas->save('images/final.png');
                     // $markimg = $posts->picture;
                     // $watermark = Image::make($markimg);
                     // $watermark->resize(195, 201);

                   //  $img->insert($watermark, 'top-left',50,107);

                     //$img->resize(800, 420);
                     $ldate = date('d-m-Y');
                     $t=time();
                     $fb_id = $posts['Fb_uid'];
                     $image_dirctory_path = 'uploads/'.$ldate;
                     File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
                     $image_name = 'hi_app3_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
                     $fullimage_path = $image_dirctory_path.'/'.$image_name;
                     $canvas->save($fullimage_path);
                    // $img->save('images/fb1.jpg');

                      //save to images
                      //  $img->save('images/dd.jpg', 60); //save to set image quality
                    //return  $img->response('jpg');
                    //return view('/share',array('posts' => $posts,'img'=>$img));
                    $html = view('hindi.hi_app3_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
                    return response()->json(compact('html'));
                     }
                    else{
                          return Redirect::route('redirect');
                         }
                     }

//--------------------------------------------------------------------end app3--




//----लोग आपके चेहरे में सबसे पहले क्या देखते हैं?-------------------------------------app4--

         public function hi_app4(){
            return  view('hindi.hi_app4');
         }

         public function hi_app4_createimg(){

                                if (Auth::check()){

                                // paste another image
                                  $posts  = User::find(Auth::user()->id);

                               //   $dir = "images/hindi/app3/bg-sample/Product_bg.png";
                                 // $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
                                 // $img_path = $pictures[mt_rand(0,count($pictures)-1)];

                                  $img = Image::make("images/hindi/app4/bg-sample/Product_bg.png");
                               //   $ext = pathinfo($img_path);
                               //   $car_name = $ext['filename'];
                               $txtarry1  = array("आपकी  नशीली आंखे",
                                             "आपके चहेरे  के  डिम्पल ",
                                             "आपका  बात  करने  का तरीका",
                                             "आपकी  हंसी ",
                                             "आपके लाल होंठ ",
                                             "आपकी  खूबसूरत  आंखे ",
                                             "आपकी  प्यारी  सी हँसी ",
                                             "आपकी  प्यारी  सी मुस्कराहट ",
                                             "आपके  चहेरे  के भाव ",
                                             "आपकी मधुर  आवाज ");
                                $i = rand(0, count($txtarry1)-1); // generate random number size of the array
                                $overtxt1 = $txtarry1[$i];

                               $img->text($overtxt1, 400, 395, function($font) {
                               $font->file('fonts/hindi/NotoSans-Regular.ttf');
                            //    $font->file('fonts/hindi/Khula/Khula-Regular.ttf');
                               //  $font->file('fonts/hindi/Sarala/Sarala-Regular.ttf');
                                   //$font->file('fonts/hindi/Khand/Khand-Regular.ttf');
                               $font->size(40);
                               $font->color('#000');
                               $font->align('center');
                               $font->valign('middle');
                               });


                                $overtxt = $posts->first_name;
                                $img->text($overtxt, 395, 320, function($font) {
                                    $font->file('fonts/theboldfont.ttf');
                                    $font->size(20);
                                    $font->color('#000');
                                    $font->align('center');   //left, right and center
                                    $font->valign('middle');  //top, bottom , middle
                                    $font->angle(0);       //0,45,90,180
                                });



                                $markimg = $posts->picture;
                                $watermark = Image::make($markimg);
                                $watermark->resize(280, 280, function ($constraint){
                                    $constraint->aspectRatio();
                                });

                                $canvas = Image::canvas(800, 420);
                                $canvas->insert($watermark, 'top-left' ,270,20);
                                $canvas->insert($img);

                                //$canvas->save('images/final.png');
                                // $markimg = $posts->picture;
                                // $watermark = Image::make($markimg);
                                // $watermark->resize(195, 201);

                              //  $img->insert($watermark, 'top-left',50,107);

                                //$img->resize(800, 420);
                                $ldate = date('d-m-Y');
                                $t=time();
                                $fb_id = $posts['Fb_uid'];
                                $image_dirctory_path = 'uploads/'.$ldate;
                                File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
                                $image_name = 'hi_app4_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
                                $fullimage_path = $image_dirctory_path.'/'.$image_name;
                                $canvas->save($fullimage_path);
                               // $img->save('images/fb1.jpg');

                                 //save to images
                                 //  $img->save('images/dd.jpg', 60); //save to set image quality
                               //return  $img->response('jpg');
                               //return view('/share',array('posts' => $posts,'img'=>$img));
                               $html = view('hindi.hi_app4_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt1), compact('view'))->render();
                               return response()->json(compact('html'));
                                }
                               else{
                                     return Redirect::route('redirect');
                                    }

           }
//--------------------------------------------------------------------end app4--




//----2018 मे कितने लोगों को आप DATE करेंगे?------------------------------------app5--

         public function hi_app5(){
            return  view('hindi.hi_app5');
         }

         public function hi_app5_createimg(){

                  if (Auth::check()){

                  // paste another image
                    $posts  = User::find(Auth::user()->id);

                 //   $dir = "images/hindi/app3/bg-sample/Product_bg.png";
                   // $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
                   // $img_path = $pictures[mt_rand(0,count($pictures)-1)];

                    $img = Image::make("images/hindi/app5/bg-sample/Product_bg.png");
                 //   $ext = pathinfo($img_path);
                 //   $car_name = $ext['filename'];
               // generate random number size of the array
                 $no_pepole = rand(4,30); // set variable equal to which random filename was chosen
                 $overtxt1 = "2018 मे आप ".$no_pepole." लोगों को DATE करेंगे?";

                 $string = wordwrap($overtxt1,35,"|");
                 //create array of lines
                 $strings = explode("|",$string);
                 $i=250; //top position of string
                 //for each line added
                 foreach($strings as $string){
                 $img->text($string, 640, $i, function($font) {
                 $font->file('fonts/hindi/NotoSans-Regular.ttf');
              //    $font->file('fonts/hindi/Khula/Khula-Regular.ttf');
                 //  $font->file('fonts/hindi/Sarala/Sarala-Regular.ttf');
                     //$font->file('fonts/hindi/Khand/Khand-Regular.ttf');
                 $font->size(44);
                 $font->color('#fff');
                 $font->align('center');
                 $font->valign('middle');
                 });
               $i=$i+50; //shift top postition down 42
                 }

                  $markimg = $posts->picture;
                  $watermark = Image::make($markimg);
                  $watermark->resize(200,200, function ($constraint){
                      $constraint->aspectRatio();
                  });

                  $canvas = Image::canvas(800, 420);
                  $canvas->insert($watermark, 'top-right', 20, 25);
                  $canvas->insert($img);

                  //$canvas->save('images/final.png');
                  // $markimg = $posts->picture;
                  // $watermark = Image::make($markimg);
                  // $watermark->resize(195, 201);

                //  $img->insert($watermark, 'top-left',50,107);

                  //$img->resize(800, 420);
                  $ldate = date('d-m-Y');
                  $t=time();
                  $fb_id = $posts['Fb_uid'];
                  $image_dirctory_path = 'uploads/'.$ldate;
                  File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
                  $image_name = 'hi_app5_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
                  $fullimage_path = $image_dirctory_path.'/'.$image_name;
                  $canvas->save($fullimage_path);
                 // $img->save('images/fb1.jpg');

                   //save to images
                   //  $img->save('images/dd.jpg', 60); //save to set image quality
                 //return  $img->response('jpg');
                 //return view('/share',array('posts' => $posts,'img'=>$img));
                 $html = view('hindi.hi_app5_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$no_pepole), compact('view'))->render();
                 return response()->json(compact('html'));
                  }
                 else{
                       return Redirect::route('redirect');
                      }

           }
//--------------------------------------------------------------------end app5--



//----आपके हमसफ़र के नाम का पहला अक्षर क्या होगा?------------------------------------app6--

         public function hi_app6(){
            return  view('hindi.hi_app6');
         }

         public function hi_app6_createimg(){
           if (Auth::check()){

           // paste another image
             $posts  = User::find(Auth::user()->id);

          //   $dir = "images/hindi/app3/bg-sample/Product_bg.png";
            // $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
            // $img_path = $pictures[mt_rand(0,count($pictures)-1)];

             $img = Image::make("images/hindi/app6/bg-sample/Product_bg.png");
             $hindi_alfano = array("क","ख","ग","घ","ङ","च","छ","ज","झ","ञ","ट","ठ","ड","ढ","ण","त","थ","द","ध","न","प","फ","ब",
             "भ","म","य","र","ल","व","उ","श","ष","स","ह","अ","आ","इ");

             $i = rand(0, count($hindi_alfano)-1); // generate random number size of the array
             $overtxt = $hindi_alfano[$i]; // set variable equal to which random filename was chosen

             $img->text($overtxt, 276, 298, function($font) {
             $font->file('fonts/hindi/NotoSans-Regular.ttf');
             $font->size(140);
             $font->color('#fff');
             $font->align('center');
             $font->valign('middle');
             });

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(280,280, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-right', 18, 80);
           $canvas->insert($img);

           //$canvas->save('images/final.png');
           // $markimg = $posts->picture;
           // $watermark = Image::make($markimg);
           // $watermark->resize(195, 201);

         //  $img->insert($watermark, 'top-left',50,107);

           //$img->resize(800, 420);
           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app6_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);
          // $img->save('images/fb1.jpg');

            //save to images
            //  $img->save('images/dd.jpg', 60); //save to set image quality
          //return  $img->response('jpg');
          //return view('/share',array('posts' => $posts,'img'=>$img));
          $html = view('hindi.hi_app6_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app6--


//----आपके दिल में क्या है?------------------------------------app7--

         public function hi_app7(){
            return  view('hindi.hi_app7');
         }

         public function hi_app7_createimg(){

           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app7/bg-sample/Product_bg.png");
           $overtxt1 = rand(5, 90).'%';
           $overtxt2 = rand(5,90).'%';
           $overtxt3 = rand(5,90).'%';

            $img->text($overtxt1, 710, 138, function($font) {
            $font->file('fonts/Questrial-Regular.ttf');
            $font->size(40);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });
            $img->text($overtxt2, 710, 238, function($font) {
            $font->file('fonts/Questrial-Regular.ttf');
            $font->size(40);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });
            $img->text($overtxt3, 720, 338, function($font) {
            $font->file('fonts/Questrial-Regular.ttf');
            $font->size(40);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });


           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(228, 228, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,100,135);
           $canvas->insert($img);


           //$canvas->save('images/final.png');
           // $markimg = $posts->picture;
           // $watermark = Image::make($markimg);
           // $watermark->resize(195, 201);

         //  $img->insert($watermark, 'top-left',50,107);

           //$img->resize(800, 420);
           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app7_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app7_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
     }
//--------------------------------------------------------------------end app7--



//----आपकी CHRISTMAS PICTURE कैसी दिखेगी?-----------------------------------app8--

         public function hi_app8(){
            return  view('hindi.hi_app8');
         }

         public function hi_app8_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app8/bg-sample/Product_bg.png");

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(228, 228, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,290,130);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app8_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app8_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app8--



//----वह क्या एक चीज़ है जो आप में कभी नहीं बदल सकती?-----------------------------app9--

         public function hi_app9(){
            return  view('hindi.hi_app9');
         }

         public function hi_app9_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app9/bg-sample/Product_bg.png");


           $app_result_array = array("आपकी वफादारी",
           "आपका जूनून",
           "आपकी ईमानदारी",
           "आपका समर्पण", );

           $i = rand(0, count($app_result_array)-1); // generate random number size of the array
           $overtxt = $app_result_array[$i]; // set variable equal to which random filename was chosen

           $img->text($overtxt, 244, 358, function($font) {
           $font->file('fonts/hindi/NotoSans-Regular.ttf');
           $font->size(50);
           $font->color('#000');
           $font->align('center');
           $font->valign('middle');
           });



           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(228, 228, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,140,70);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app9_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app9_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app9--


//----2018 से आप क्या expect कर सकते हो?-------------------------------------app10--

         public function hi_app10(){
            return  view('hindi.hi_app10');
         }

         public function hi_app10_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app10/bg-sample/Product_bg.png");

           $overtxt1 = $posts->first_name;
           $img->text($overtxt1, 550, 130, function($font) {
               $font->file('fonts/en/PatuaOne/PatuaOne-Regular.ttf');
               $font->size(30);
               $font->color('#FF0000');
               $font->align('center');   //left, right and center
               $font->valign('middle');  //top, bottom , middle
               $font->angle(0);       //0,45,90,180
           });

           $app_result_array = array("2018 में आप कामदेव की कृपा expect कर सकते हो। इससे आपका पारिवारिक जीवन बेहद सुखद हो जाएगा। ",
           "2018 में आप पर शनि देव की नज़र का असर काम हो जाएगा और आपके सभी रुके हुए काम बनने लग जाएंगे। ",
           "2018 में आप एक बहादुर निर्णय लेंगे और 5 महीने के लिए दुनिया घूमने के लिए जाएंगे। आप पुरे दिल से घूमेंगे और नयी नयी जगहों की खोज करेंगे। ",
           "2018 में आपको अपना सच्चा प्यार मिल सकता है। इस क्षण के साथ ही आपकी जिंदगी एक नया मोड़ लेगी और पूरी तरह बदल जाएगी। ",
           "2018 में आप एक अच्छी जगह बड़ा घर और बड़ी गाड़ी खरीदेंगे। ",);

           $i = rand(0, count($app_result_array)-1); // generate random number size of the array
           $overtxt = $app_result_array[$i]; // set variable equal to which random filename was chosen

           $string = wordwrap($overtxt,70,"|");

           $strings = explode("|",$string);
           $i=180; //top position of string
           foreach($strings as $string){
           $img->text($string, 560, $i, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(24);
           $font->color('#000');
           $font->align('center');
           $font->valign('middle');
           });
           $i=$i+35; //shift top postition down 42
           }



           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(300, 300, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,20,100);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app10_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app10_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app10--

//----जाने गणपति जी आपसे क्या कहना चाहते हैं?-------------------------------------app11--

         public function hi_app11(){
            return  view('hindi.hi_app11');
         }

         public function hi_app11_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app11/bg-sample/Product_bg.png");
           $overtxt1 = $posts->first_name;
           $img->text($overtxt1, 330, 207, function($font) {
                $font->file('fonts/en/Berkshire_Swash/BerkshireSwash-Regular.ttf');
              // $font->file('fonts/theboldfont.ttf');
               $font->size(40);
               $font->color('#FF0000');
               $font->align('center');   //left, right and center
               $font->valign('middle');  //top, bottom , middle
               $font->angle(0);       //0,45,90,180
           });


           $txtarry = array("आपका सच्चा प्यार आपका wait कर रहा है, जल्दी से उसे ढुंढलें।",
             "आपके पिछले जनम के फल आपको इस जनम में मिल रहे हैं।",
             "आपको विश्व-भ्रमण पे निकलना चाहिए।",
             "आपको एक नए शहर में रहना का सोचना चाहिए।",
             "आपको एक नया काम शुरू करना चाहिए।",
             "आपको जल्दी ही शादी करलेनी चाहिए",
             "आपको बच्चे पैदा करलेने चाहिए",
             "आपके इस जनम के कर्म अच्छे करलो आपका आने वाला जीवन अदभूत होगा।");

           $i = rand(0, count($txtarry)-1); // generate random number size of the array
           $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen
           $string = wordwrap($overtxt,60,"|");
           //create array of lines
           $strings = explode("|",$string);
           $i=270; //top position of string
           //for each line added
           foreach($strings as $string){
           $img->text($string, 240, $i, function($font) {
          // $font->file('fonts/hindi/NotoSans-Regular.ttf');

             //$font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
          //   $font->file('fonts/hindi/Devanagari/gargi.ttf');
            $font->file('fonts/hindi/Rozha_One/RozhaOne-Regular.ttf');
             //$font->file('fonts/hindi/Devanagari/gargi.ttf');

           $font->size(36);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $i=$i+42; //shift top postition down 42
           }

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(320,320, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-right' ,5,100);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app11_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app11_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app11--



//----जानिये आपकी आत्मा की उम्र कितनी है?-------------------------------------app12--

         public function hi_app12(){
            return  view('hindi.hi_app12');
         }

         public function hi_app12_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app12/bg-sample/Product_bg.png");
           $overtxt1 = $posts->first_name;
           $img->text($overtxt1, 225, 275, function($font) {
                $font->file('fonts/en/Berkshire_Swash/BerkshireSwash-Regular.ttf');
              // $font->file('fonts/theboldfont.ttf');
               $font->size(45);
               $font->color('#fff');
               $font->align('center');   //left, right and center
               $font->valign('middle');  //top, bottom , middle
               $font->angle(0);       //0,45,90,180
           });



           $i = rand(5, 100); // generate random number size of the array
           $overtxt = $i." साल"; // set variable equal to which random filename was chosen


           $img->text($overtxt, 230, 365, function($font) {
           $font->file('fonts/hindi/Rozha_One/RozhaOne-Regular.ttf');
           $font->size(45);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });


           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(200,200, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,130,20);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app12_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app12_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app12--


//----आपकी कौन सी फोटो गैलरी में लटकनी चाहिए?-------------------------------------app13--

         public function hi_app13(){
            return  view('hindi.hi_app13');
         }

         public function hi_app13_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app13/bg-sample/Product_bg.png");

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(228, 228, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,290,50);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app13_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app13_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app13--


//----आप कितने सुन्दर हो?------------------------------------app14--

         public function hi_app14(){
            return  view('hindi.hi_app14');
         }

         public function hi_app14_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app14/bg-sample/Product_bg.png");

             $overtxt1 = rand(0,99)."/100"; // generate random number size of the array
             $overtxt2 = rand(5, 99)."/100";
             $overtxt3 = rand(5, 99)."/100";
             $overtxt4 = rand(5, 99)."/100";
             $a = "%";
             $overtxt5 = mt_rand(1,99)/100..$a;

            $img->text($overtxt1, 770, 48, function($font) {
            $font->file('fonts/Noto_Serif/NotoSerif-Bold.ttf');
            $font->size(30);
            $font->color('#FF006C');
            $font->align('right');
            $font->valign('middle');
            });
            $img->text($overtxt2, 770, 130, function($font) {
            $font->file('fonts/Noto_Serif/NotoSerif-Bold.ttf');
            $font->size(30);
            $font->color('#FF006C');
            $font->align('right');
            $font->valign('middle');
            });
            $img->text($overtxt3, 770, 213, function($font) {
            $font->file('fonts/Noto_Serif/NotoSerif-Bold.ttf');
            $font->size(30);
            $font->color('#FF006C');
            $font->align('right');
            $font->valign('middle');
            });
            $img->text($overtxt4, 770, 292, function($font) {
            $font->file('fonts/Noto_Serif/NotoSerif-Bold.ttf');
            $font->size(30);
            $font->color('#FF006C');
            $font->align('right');
            $font->valign('middle');
            });
            $img->text($overtxt5, 770, 372, function($font) {
            $font->file('fonts/Noto_Serif/NotoSerif-Bold.ttf');
            $font->size(30);
            $font->color('#FF006C');
            $font->align('right');
            $font->valign('middle');
            });

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(345, 345, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,20,80);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app14_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app14_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app14--


//----भगवान् ने आपको धरती पर क्यों भेजा है?-------------------------------------app15--

         public function hi_app15(){
            return  view('hindi.hi_app15');
         }

         public function hi_app15_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app15/bg-sample/Product_bg.png");


           $txtarry = array( "बच्चे पैदा करने के लिए ",
             "बहुत सारे पाप करने के लिए",
             "भ्रष्टाचार को मिटाने के लिये ",
             "बहुत सारा पैसा कमाने के लिये ",
             "दुनिया भर का खाना खाने के लिए",
             "लड़की पटाने के लिए");

           $i = rand(0, count($txtarry)-1); // generate random number size of the array
           $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen

           $img->text($overtxt, 400,382, function($font) {
           $font->file('fonts/hindi/NotoSans-Regular.ttf');

             //$font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
          //   $font->file('fonts/hindi/Devanagari/gargi.ttf');
            //$font->file('fonts/hindi/Rozha_One/RozhaOne-Regular.ttf');
          //$font->file('fonts/hindi/Khula/Khula-Regular.ttf');

           $font->size(36);
           $font->color('#000');
           $font->align('center');
           $font->valign('middle');
           });


           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(200,200, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,38,120);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app15_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app15_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app15--

//----आपने कितने लोगों के दिल तोड़े हैं?-------------------------------------app16--

         public function hi_app16(){
            return  view('hindi.hi_app16');
         }

         public function hi_app16_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app16/bg-sample/Product_bg.png");


           $overtxt1 = $posts->first_name;
           $img->text($overtxt1, 400, 395, function($font) {
              //  $font->file('fonts/en/BerkshireSwash-Regular.ttf');
               $font->file('fonts/en/Lalezar/Lalezar-Regular.ttf');
               $font->size(38);
               $font->color('#fff');
               $font->align('center');   //left, right and center
               $font->valign('bottom');  //top, bottom , middle
               $font->angle(0);       //0,45,90,180
           });


           $overtxt = rand(5, 99); // generate random number size of the array
           // set variable equal to which random filename was chosen

           $img->text($overtxt, 140, 350, function($font) {
        //   $font->file('fonts/theboldfont.ttf');
              $font->file('fonts/en/Lalezar/Lalezar-Regular.ttf');
           $font->size(80);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt, 700, 350, function($font) {
          // $font->file('fonts/theboldfont.ttf');
              $font->file('fonts/en/Lalezar/Lalezar-Regular.ttf');
           $font->size(80);
           $font->color('#fff');
           $font->align('right');
           $font->valign('middle');
           });



           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(200,200, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,300,170);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app16_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app16_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }

             }
//--------------------------------------------------------------------end app16--


//----जानिए आपकी पर्सनालिटी को कौनसी नौकरी सूट करेगी?-------------------------------------app17--

         public function hi_app17(){
            return  view('hindi.hi_app17');
         }

         public function hi_app17_createimg(){
           if (Auth::check()){

           // paste another image
             $posts  = User::find(Auth::user()->id);

             $dir = "images/hindi/app17/bg-sample/";
             $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
             $img_path = $pictures[mt_rand(0,count($pictures)-1)];

             $img = Image::make($img_path);
             $ext = pathinfo($img_path);
             $app_result_name = $ext['filename'];

             if($app_result_name=="bg1"){
                 $app_result_no="91%";
                 $job_name = "इंजीनियर";
             }
             if($app_result_name=="bg2"){
                 $app_result_no="98%";
                  $job_name = "कंपनी के CEO";
             }
             if($app_result_name=="bg3"){
                 $app_result_no="94%";
                 $job_name = "डॉक्टर";

             }
             if($app_result_name=="bg4"){
                 $app_result_no="95%";
                 $job_name = "फिल्म निर्मात";
             }
             if($app_result_name=="bg5"){
                 $app_result_no="92%";
                 $job_name = "फोटोग्राफर";
             }
             if($app_result_name=="bg6"){
                 $app_result_no="90%";
                 $job_name = "वकील";
             }
             if($app_result_name=="bg7"){
                 $app_result_no="93%";
                 $job_name = "वीडियो गेमर";
             }
             if($app_result_name=="bg8"){
                 $app_result_no="97%";
                 $job_name = "टीचर";
             }


             $overtxt1 = $posts->first_name;
             $img->text($overtxt1, 680, 50, function($font) {
                //  $font->file('fonts/en/BerkshireSwash-Regular.ttf');
                 $font->file('fonts/en/Lalezar/Lalezar-Regular.ttf');
                 $font->size(45);
                 $font->color('#000');
                 $font->align('right');   //left, right and center
                 $font->valign('top');  //top, bottom , middle
                 $font->angle(0);       //0,45,90,180
             });

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(440, 420, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left',0,0);
           $canvas->insert($img);

           //$canvas->save('images/final.png');
           // $markimg = $posts->picture;
           // $watermark = Image::make($markimg);
           // $watermark->resize(195, 201);

          //$img->insert($watermark, 'top-left',50,107);

           //$img->resize(800, 420);
           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app17_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);
          // $img->save('images/fb1.jpg');

            //save to images
            //  $img->save('images/dd.jpg', 60); //save to set image quality
          //return  $img->response('jpg');
          //return view('/share',array('posts' => $posts,'img'=>$img));
          $html = view('hindi.hi_app17_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result_name'=>$job_name,'app_result_no'=>$app_result_no), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
              }
        }
//--------------------------------------------------------------------end app17--



//----आपकी फेसबुक प्रोफाइल में आपके लिए क्या सन्देश छुपा है?-------------------------------------app18--

         public function hi_app18(){
            return  view('hindi.hi_app18');
         }

         public function hi_app18_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app18/bg-sample/Product_bg.png");
           $overtxt1 = $posts->first_name;
           $img->text($overtxt1, 550, 200, function($font) {
              //  $font->file('fonts/en/BerkshireSwash-Regular.ttf');
               $font->file('fonts/en/Bungee/Bungee-Regular.ttf');
               $font->size(55);
               $font->color('#000');
               $font->align('center');   //left, right and center
               $font->valign('middle');  //top, bottom , middle
               $font->angle(0);       //0,45,90,180
           });

           $txtarry = array("समय किसी के लिए नहीं रुकता है और ये बदलने का समय है।",
           "वो करें जिसे करने में आपको ख़ुशी मिलती है वर्ना आपको दुख होगा।",
           "ज्यादा न सोचें, बस अपने जीवन का आनंद लें।",
           "अब और एक जैसे जिंदगी को न कहें। अब एक नए रास्ते पर चलो।",
           "जिंदगी न मिलेगी दोबारा, सही निर्णय लेकर अपनी जिंदगी बदलें।",
           "आपको जिदंगी सिर्फ एक बार मिलती है। कहीं घूम के आइये।");

           $i = rand(0, count($txtarry)-1); // generate random number size of the array
           $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen
           $string = wordwrap($overtxt,70,"|");
           //create array of lines
           $strings = explode("|",$string);
           $i=300; //top position of string
           //for each line added
           foreach($strings as $string){
           $img->text($string, 560, $i, function($font) {
          // $font->file('fonts/hindi/NotoSans-Regular.ttf');

             $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
          //   $font->file('fonts/hindi/Devanagari/gargi.ttf');
             //$font->file('fonts/hindi/Rozha_One/RozhaOne-Regular.ttf');
             //$font->file('fonts/hindi/Devanagari/gargi.ttf');

           $font->size(24);
           $font->color('#000');
           $font->align('center');
           $font->valign('middle');
           });
           $i=$i+35; //shift top postition down 42
           }

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(280,280, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,25,130);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app18_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app18_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app18--

//----जानिये आइना आपके बारे में क्या कहता है?-------------------------------------app19--

         public function hi_app19(){
            return  view('hindi.hi_app19');
         }

         public function hi_app19_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app19/bg-sample/Product_bg.png");

           $txtarry = array("समय किसी के लिए नहीं रुकता है और अब बदलने का समय है।",
           "वो करें जिसे करने में आपको ख़ुशी मिलती है वर्ना आपको दुख होगा।",
           "ज्यादा न सोचें, बस अपने जीवन का आनंद लें।",
           "अब और एक जैसे जिंदगी को न कहें। अब एक नए रास्ते पर चलो।",
           "जिंदगी न मिलेगी दोबारा, सही निर्णय लेकर अपनी जिंदगी बदलें।",
           "आपको जिदंगी सिर्फ एक बार मिलती है। कहीं घूम के आइये।");

           $i = rand(0, count($txtarry)-1); // generate random number size of the array
           $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen
           $string = wordwrap($overtxt,30,"|");
           //create array of lines
           $strings = explode("|",$string);
           $i=115; //top position of string
           //for each line added
           foreach($strings as $string){
           $img->text($string, 650, $i, function($font) {
          // $font->file('fonts/hindi/NotoSans-Regular.ttf');

             //$font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
          //   $font->file('fonts/hindi/Devanagari/gargi.ttf');
            // $font->file('fonts/hindi/Rozha_One/RozhaOne-Regular.ttf');
            // $font->file('fonts/hindi/Kalam/Kalam-Light.ttf');


             $font->file('fonts/hindi/Arya/Arya-Regular.ttf');

           $font->size(28);
           $font->color('#000');
           $font->align('center');
           $font->valign('middle');
           });
           $i=$i+40; //shift top postition down 42
           }

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(280,280, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,45,90);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app19_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app19_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app19--


//----जानिए आपकी किस्मत कब चमकेगी?------------------------------------app20--

         public function hi_app20(){
            return  view('hindi.hi_app20');
         }

         public function hi_app20_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app20/bg-sample/Product_bg.png");


           $start = strtotime("10 December 2017");
           $end = strtotime("22 July 2020");
           $timestamp = mt_rand($start, $end);
           $overtxt =  date("d-m-Y", $timestamp);

           $img->text($overtxt, 395,385, function($font) {
          // $font->file('fonts/hindi/NotoSans-Regular.ttf');

             //$font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
          //   $font->file('fonts/hindi/Devanagari/gargi.ttf');
            // $font->file('fonts/hindi/Rozha_One/RozhaOne-Regular.ttf');
            // $font->file('fonts/hindi/Kalam/Kalam-Light.ttf');

           $font->file('fonts/hindi/Arya/Arya-Regular.ttf');
           $font->size(35);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });


           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(330,330, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,225,20);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app20_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app20_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app20--


//----आपको अगले साल क्या सरप्राइज मिलने वाला है?-------------------------------------app21--

         public function hi_app21(){
            return  view('hindi.hi_app21');
         }

         public function hi_app21_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app21/bg-sample/Product_bg.png");


           $overtxt1 = $posts->first_name;
           $img->text($overtxt1, 600, 125, function($font) {
              //  $font->file('fonts/en/BerkshireSwash-Regular.ttf');
               //$font->file('fonts/en/Bungee/Bungee-Regular.ttf');
               $font->file('fonts/hindi/NotoSans-Regular.ttf');
               $font->size(40);
               $font->color('#fff');
               $font->align('center');   //left, right and center
               $font->valign('middle');  //top, bottom , middle
               $font->angle(0);       //0,45,90,180
           });



           $txtarry = array( "आपके  जीवन  में  एक  सुन्दर सी लड़की  का  आगमन  होगा ",
                             "आपको अपनी  DREAM COMPANY से  जॉब  कॉल  आएगा ",
                             "आपके नाम का 1 करोड़ का चैक आएगा ",
                             "आपको  आपके बचपन की दोस्त PROPOSE करेगी ",
                             "आपको कार गिफ्ट में मिलेगी",
                             "आपको एक साथ 5 लड़किया PROPOSE करेंगे ");

           $i = rand(0, count($txtarry)-1); // generate random number size of the array
           $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen
           $string = wordwrap($overtxt,30,"|");
           //create array of lines
           $strings = explode("|",$string);
           $i=200; //top position of string
           //for each line added
           foreach($strings as $string){
           $img->text($string, 600, $i, function($font) {
           // $font->file('fonts/hindi/NotoSans-Regular.ttf');

             //$font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           //   $font->file('fonts/hindi/Devanagari/gargi.ttf');
            // $font->file('fonts/hindi/Rozha_One/RozhaOne-Regular.ttf');
            // $font->file('fonts/hindi/Kalam/Kalam-Light.ttf');


             $font->file('fonts/hindi/Arya/Arya-Regular.ttf');

           $font->size(30);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $i=$i+40; //shift top postition down 42
           }

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(400,400, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,0,20);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app21_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

           $html = view('hindi.hi_app21_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
           return response()->json(compact('html'));
           }
           else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app21--


//----कौनसे 4 शब्द आपकी पर्सनालिटी को दर्शाते हैं?-------------------------------------app22--

         public function hi_app22(){
            return  view('hindi.hi_app22');
         }

         public function hi_app22_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app22/bg-sample/Product_bg.png");

           $overtxt1 = $posts->first_name;
           $img->text($overtxt1, 200, 340, function($font) {
              //  $font->file('fonts/en/BerkshireSwash-Regular.ttf');
               //$font->file('fonts/en/Bungee/Bungee-Regular.ttf');
               $font->file('fonts/hindi/NotoSans-Regular.ttf');
               $font->size(40);
               $font->color('#fff');
               $font->align('center');   //left, right and center
               $font->valign('middle');  //top, bottom , middle
               $font->angle(0);       //0,45,90,180
           });


           $a = array("विनीत","कल्पनाशील","बुद्धिमान","लोकप्रिय","सज्जन","मेहनती","उपयोगी","अनुकूल","रचनात्मक","शक्तिशाली","सहयोगी","ईमानदार","प्रतिभाशाली","रोमांटिक","चंचल","आकर्षक","शांत","वफादार","आशावादी","निष्ठावान");


           $random_keys=array_rand($a,8);

           $overtxt1 =  $a[$random_keys[0]];
           $overtxt2 = $a[$random_keys[1]];
           $overtxt3 = $a[$random_keys[2]];
           $overtxt4 = $a[$random_keys[3]];

           $img->text($overtxt1, 620, 60, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(35);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt2, 620, 160, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(35);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt3, 620, 255, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(35);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt4, 620, 350, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(35);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });



           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(400,400, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,0,20);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app22_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

           $html = view('hindi.hi_app22_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
           return response()->json(compact('html'));
           }
           else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app22--

//----आपकी PROFILE आपके बारे में क्या 4 चीज़े बताती है?-------------------------------------app23--

         public function hi_app23(){
            return  view('hindi.hi_app23');
         }

         public function hi_app23_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app23/bg-sample/Product_bg.png");


           $a = array("विनीत","कल्पनाशील","बुद्धिमान","लोकप्रिय","सज्जन","मेहनती","उपयोगी","अनुकूल","रचनात्मक","शक्तिशाली","सहयोगी","ईमानदार","प्रतिभाशाली","रोमांटिक","चंचल","आकर्षक","शांत","वफादार","आशावादी","निष्ठावान");

           $random_keys=array_rand($a,8);

           $overtxt1 = $a[$random_keys[0]];
           $overtxt2 = $a[$random_keys[1]];
           $overtxt3 = $a[$random_keys[2]];
           $overtxt4 = $a[$random_keys[3]];

           $img->text($overtxt1, 150, 100, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt2, 150, 235, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt3, 650, 100, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt4, 648, 233, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });



           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(220,220, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,300,90);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app23_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

           $html = view('hindi.hi_app23_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result1'=>$overtxt1,'app_result2'=>$overtxt2,'app_result3'=>$overtxt3,'app_result4'=>$overtxt4), compact('view'))->render();
           return response()->json(compact('html'));
           }
           else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app23--


//----आप कौनसे सुपरस्टार की तरह दिखते हैं?-------------------------------------app24--

         public function hi_app24(){
            return  view('hindi.hi_app24');
         }

         public function hi_app24_createimg(){
           if (Auth::check()){

           // paste another image
             $posts  = User::find(Auth::user()->id);

             $dir = "images/hindi/app24/bg-sample/";
             $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
             $img_path = $pictures[mt_rand(0,count($pictures)-1)];

             $img = Image::make($img_path);
             $ext = pathinfo($img_path);
             $app_result_name = $ext['filename'];
             if($app_result_name=="bg1"){
                     $bg_name = "अक्षय कुमार";
             }
             if($app_result_name=="bg2"){
                     $bg_name = "टॉम क्रूज";
             }
             if($app_result_name=="bg3"){
                     $bg_name = "ब्रेड पिट";
             }
             if($app_result_name=="bg4"){
                     $bg_name = "रणवीर सिंह";
             }
             if($app_result_name=="bg5"){
                     $bg_name = "रॉबर्ट डाउनी जूनियर";
             }
             if($app_result_name=="bg6"){
                     $bg_name = "लिओनार्डो दी केप्रिओ";
             }
             if($app_result_name=="bg7"){
                     $bg_name = "वरुण धवन";
             }
             if($app_result_name=="bg8"){
                     $bg_name = "शाहरुख खान";
             }
             if($app_result_name=="bg9"){
                     $bg_name = "सलमान खान";
             }
             $overtxt1 = $posts->first_name;
             $img->text($overtxt1, 170, 325, function($font) {
                //  $font->file('fonts/en/BerkshireSwash-Regular.ttf');
                 $font->file('fonts/en/Lalezar/Lalezar-Regular.ttf');
                 $font->size(28);
                 $font->color('#fff');
                 $font->align('left');   //left, right and center
                 $font->valign('top');  //top, bottom , middle
                 $font->angle(0);       //0,45,90,180
             });

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(265, 265, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left',75,140);
           $canvas->insert($img);

           //$canvas->save('images/final.png');
           // $markimg = $posts->picture;
           // $watermark = Image::make($markimg);
           // $watermark->resize(195, 201);

          //$img->insert($watermark, 'top-left',50,107);

           //$img->resize(800, 420);
           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app24_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);
          // $img->save('images/fb1.jpg');

            //save to images
            //  $img->save('images/dd.jpg', 60); //save to set image quality
          //return  $img->response('jpg');
          //return view('/share',array('posts' => $posts,'img'=>$img));
          $html = view('hindi.hi_app24_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$bg_name), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
              }
           }
//--------------------------------------------------------------------end app24--


//----आपके परिवार में कौनसा सदस्य आपके लिए ज्यादा भाग्यशाली है-------------------------------------app25--

         public function hi_app25(){
            return  view('hindi.hi_app25');
         }

         public function hi_app25_createimg(){
           if (Auth::check()){

           // paste another image
             $posts  = User::find(Auth::user()->id);

             $dir = "images/hindi/app25/bg-sample/";
             $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
             $img_path = $pictures[mt_rand(0,count($pictures)-1)];

             $img = Image::make($img_path);
             $ext = pathinfo($img_path);
             $app_result_name = $ext['filename'];
             if($app_result_name=="fm1"){
                     $f_name = "पिता";
             }
             if($app_result_name=="fm2"){
                     $f_name = "बहन";
             }
             if($app_result_name=="fm3"){
                     $f_name = "भाई";
             }
             if($app_result_name=="fm4"){
                     $f_name = "मम्मी";
             }

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(265, 265, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left',60,75);
           $canvas->insert($img);

           //$canvas->save('images/final.png');
           // $markimg = $posts->picture;
           // $watermark = Image::make($markimg);
           // $watermark->resize(195, 201);

          //$img->insert($watermark, 'top-left',50,107);

           //$img->resize(800, 420);
           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app25_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);
          // $img->save('images/fb1.jpg');

            //save to images
            //  $img->save('images/dd.jpg', 60); //save to set image quality
          //return  $img->response('jpg');
          //return view('/share',array('posts' => $posts,'img'=>$img));
          $html = view('hindi.hi_app25_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$f_name), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
              }
        }
//--------------------------------------------------------------------end app25--

//----भगवान आपसे प्रस्सन हो जाये तो आप क्या वरदान मांगोगे?-------------------------------------app26--

         public function hi_app26(){
            return  view('hindi.hi_app26');
         }

         public function hi_app26_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app26/bg-sample/Product_bg.png");


           $txtarry = array("एक अच्छा सा लाइफ पार्टनर","MS Dhoni जितनी शोहरत ","अम्बानी जितना पैसा"," शाहरुख़ खान जितना ग्लैमर","खूब सारा पैसा और पैसे खर्च करने का समय",
             "MODI JI जितनी पॉवर","अपने माता पिता की अच्छी सेहत ","Jacqueline Fernandez जैसी गर्लफ्रेंड ","गायब होने की शक्ति","IRON MAN जैसा सूट",
             "अपने पार्टनर को मनाने के 1 करोड़ तरीके","Hrithik Roshan जैसी पर्सनालिटी ");

           $i = rand(0, count($txtarry)-1); // generate random number size of the array
           $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen

           $img->text($overtxt, 400,392, function($font) {
           $font->file('fonts/hindi/NotoSans-Regular.ttf');

             //$font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
          //   $font->file('fonts/hindi/Devanagari/gargi.ttf');
            //$font->file('fonts/hindi/Rozha_One/RozhaOne-Regular.ttf');
          //$font->file('fonts/hindi/Khula/Khula-Regular.ttf');

           $font->size(35);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });


           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(260,260, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-right' ,60,60);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app26_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app26_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app26--


//----जानिए लोग आपकी किन 3 बातों से प्यार करते हैं?-------------------------------------app27--

         public function hi_app27(){
            return  view('hindi.hi_app27');
         }

         public function hi_app27_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app27/bg-sample/Product_bg.png");

           $a = array("विनीत","कल्पनाशील","बुद्धिमान","लोकप्रिय","सज्जन","मेहनती","उपयोगी","अनुकूल","रचनात्मक","शक्तिशाली","सहयोगी","ईमानदार","प्रतिभाशाली","रोमांटिक","चंचल","आकर्षक","शांत","वफादार","आशावादी","निष्ठावान","अखंडता","व्यव्हार","सत्यता","उदारता");

           $random_keys=array_rand($a,8);

           $overtxt1 = $a[$random_keys[0]];
           $overtxt2 = $a[$random_keys[1]];
           $overtxt3 = $a[$random_keys[2]];


           $img->text($overtxt1, 130, 90, function($font) {
           $font->file('fonts/hindi/NotoSans-Regular.ttf');
           $font->size(40);
           $font->color('#5d6d1d');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt2, 250, 148, function($font) {
           $font->file('fonts/hindi/NotoSans-Regular.ttf');
           $font->size(40);
           $font->color('#5d6d1d');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt3, 360, 90, function($font) {
           $font->file('fonts/hindi/NotoSans-Regular.ttf');
           $font->size(40);
           $font->color('#5d6d1d');
           $font->align('center');
           $font->valign('middle');
           });




           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(220,220, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-right' ,40,100);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app27_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

           $html = view('hindi.hi_app27_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
           return response()->json(compact('html'));
           }
           else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app27--



//----आपके खून में अपने माता पिता के कौनसे गुण हैं?-------------------------------------app28--

         public function hi_app28(){
            return  view('hindi.hi_app28');
         }

         public function hi_app28_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app28/bg-sample/Product_bg.png");


           $a = array("विनीत","कल्पनाशील","बुद्धिमान","लोकप्रिय","सज्जन","मेहनती","उपयोगी","अनुकूल","रचनात्मक","शक्तिशाली","सहयोगी","ईमानदार","प्रतिभाशाली","रोमांटिक","चंचल","आकर्षक","शांत","वफादार","आशावादी","निष्ठावान",
                             "साहसी ","निपुण","विनम्रता","उदारता","शीतलपन"
                               );

           $random_keys=array_rand($a,8);

           $overtxt1 =  $a[$random_keys[0]];
           $overtxt2 = $a[$random_keys[1]];
           $overtxt3 = $a[$random_keys[2]];
           $overtxt4 = $a[$random_keys[3]];
           $overtxt5 = $a[$random_keys[4]];
           $overtxt6 = $a[$random_keys[5]];
           $overtxt7 = $a[$random_keys[6]];
           $overtxt8 = $a[$random_keys[7]];

           $img->text($overtxt1, 150, 120, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt2, 150, 195, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt3, 150, 280, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt4, 150,360, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt5, 648, 120, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt6, 648, 195, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt7, 648, 280, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt8, 648, 360, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });



           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(250,250, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,280,85);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app28_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

           $html = view('hindi.hi_app28_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
           return response()->json(compact('html'));
           }
           else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app28--


//----आपके होने वाले बच्चों का नाम क्या होना चाहिए?-------------------------------------app29--

         public function hi_app29(){
            return  view('hindi.hi_app29');
         }

         public function hi_app29_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app29/bg-sample/Product_bg.png");




           $Result_1_boy= ["आदर्श","आदेश","आदित","आदि","आकाश","अभय","अभीक","अभिजित","अभिमन्यु","अभिषेक","अभ्युदय","अचल","आदर्श","आदिनाथ","आदितेय","आदित्य","आदि","अजय","अक्षय","आलोक","अमर","अम्बर",
                            "अमित","अमोल","अनन्त","आनंद","अनिल","अन्कुर","अंकुश","अनुराग","आशीष","आशुतोष","बद्री","बलराम","बलवान","भरत","भास्कर","भीष्म","भूदेव","भूपेन्द्र","भुवन","ब्रज","बुद्ध","चंचल","चंदन","चन्द्र","चरण",
                            "चिरंजीव","चिरायु","दहन","दमन","दामोदर","धनंजय","धर्म","ध्रुव","दिनेश","दिनकर","दिवाकर","एकलव्य","गौरव","गौतम","घनश्याम","गिरिधर","गिरीश","गोपाल","हर्ष","हितेन्द्र","हितेश","जयदेव","जयन्त","जीवन",
                            "जितेन्द्र","कमल","कन्हैया","कार्तिकेय","कार्तिक","कैलाश","केशव","किशोर","कृष्ण","कुश","ललित","माधव","मधुसूदन","महादेव","महावीर","महेश","मनीष","मारूति","मिहिर","मुकुन्द","निर्मल","निरुपम","पल्लव","पंकज",
                            "पार्थ","पीयूष","प्रभाकर","प्रफुल्ल","प्रकाश","प्रणव","प्रसन्न","पुष्कर","रजनीश","रवि","श्याम","सुदर्शन","सुंदर","सूरज","सुयश","तुषार","उदय","उत्तम","विमल","विनय","विनीत","विश्वनाथ","यश","योगेंद्र"
                          ];

           $Result_2_girl=[
                             "अभिलाषा","अचला","अहल्या","आकांक्षा","आकृति","अंबिका","अमिता","अमृता","आनंदी","अंजली","अंजना","अंकिता","अनुराधा","अपूर्वा","आराधना","अर्चना","अरुणा","आर्या","आशा","अवनि","अवन्तिका","भगवती","भारती","बिंदिया","चंद्रिका",
                             "छाया","चित्रांगदा","दक्षा","दीपिका","दीप्ती","धरणी","दिव्या","दृष्टि","एकता","गायिका","गीतांजली","हर्षिता","इंन्दिरा","जागृति","जानकी","ज्योति","काजल","कल्‍पना","कविता","किरण","कीर्ति","कोमल","कुमुद","माधविका","मैत्री",
                             "मल्लिका","मानवी","मयूरी","मीनाक्षि","मीरा","मोहिनी","नैना","नन्दिनी","निधि","निशा","पूजा","रचना","रोशनी","शक्ति","श्रद्धा","शिवानी","उर्वि","वसुंधरा","वीणा"
                           ];
           $i = rand(0, count($Result_1_boy)-1); // generate random number size of the array
           $overtxt1 = $Result_1_boy[$i]; // set variable equal to which random filename was chosen

           $j = rand(0, count($Result_2_girl)-1); // generate random number size of the array
           $overtxt2 = $Result_2_girl[$j]; // set variable equal to which random filename was chosen

           $img->text($overtxt2, 90, 381, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(34);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });


           $img->text($overtxt1, 690, 380, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(34);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(250,250, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,290,90);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app29_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

           $html = view('hindi.hi_app29_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result1'=>$overtxt1,'app_result2'=>$overtxt2), compact('view'))->render();
           return response()->json(compact('html'));
           }
           else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app29--

//----जानिए आपकी जिंदगी मे और कितने साल बाकि हैं?-------------------------------------app30--

         public function hi_app30(){
            return  view('hindi.hi_app30');
         }

         public function hi_app30_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app30/bg-sample/Product_bg.png");
           $overtxt1 = $posts->first_name;
           $img->text($overtxt1, 610, 385, function($font) {
                $font->file('fonts/en/Berkshire_Swash/BerkshireSwash-Regular.ttf');
              // $font->file('fonts/theboldfont.ttf');
               $font->size(45);
               $font->color('#fff');
               $font->align('center');   //left, right and center
               $font->valign('middle');  //top, bottom , middle
               $font->angle(0);       //0,45,90,180
           });



           $i = rand(5, 100); // generate random number size of the array
           $overtxt = $i." साल"; // set variable equal to which random filename was chosen


           $img->text($overtxt, 100, 60, function($font) {
           $font->file('fonts/hindi/Rozha_One/RozhaOne-Regular.ttf');
           $font->size(45);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });


           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(300,300, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-right' ,40,25);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app30_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app30_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app30--


//----2018 में आपके पास कौन सी तीन चीजें होंगी?-------------------------------------app31--

         public function hi_app31(){
            return  view('hindi.hi_app31');
         }

         public function hi_app31_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app31/bg-sample/Product_bg.png");


           $a = array("बड़ी कार","एक  साथी","बहुत सारे अच्छे दोस्त","बहुत सारा पैसा","आपकी ड्रीम कार","माता पिता का आशीर्वाद","आपकी ड्रीम जॉब","एक बड़ा सा घर",
           "अच्छा स्वास्थ","लक्जरी कार","पैसे खर्च करने का समय ","घूमने का समय","एक बहुत बड़ी कम्पनी","ढेर सारा बैंक बैलेंस","Bandra में बंगला ","बहुत बड़ा Business");


           $random_keys=array_rand($a,8);

           $overtxt1 =  $a[$random_keys[0]];
           $overtxt2 = $a[$random_keys[1]];
           $overtxt3 = $a[$random_keys[2]];

           $img->text($overtxt1, 640, 165, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(23);
           $font->color('#155A9C');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt2, 640, 269, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(23);
           $font->color('#155A9C');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt3, 640, 372, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(23);
           $font->color('#155A9C');
           $font->align('center');
           $font->valign('middle');
           });


           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(470,470, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,0,0);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app31_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

           $html = view('hindi.hi_app31_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
           return response()->json(compact('html'));
           }
           else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app31--


//----आपके दिमाग, शरीर और आत्मा कि उम्र क्या है?-----------------------------------app32--

         public function hi_app32(){
            return  view('hindi.hi_app32');
         }

         public function hi_app32_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app32/bg-sample/Product_bg.png");

           $i = rand(5, 100);
           $overtxt1 = $i." साल";
           $j = rand(5, 100);
           $overtxt2 = $j." साल";
           $k = rand(5, 100);
           $overtxt3 = $k." साल";

           if($overtxt1==$overtxt2){
             $i = rand(5, 100);
             $overtxt1 = $i." साल";
           }
           if($overtxt1==$overtxt3){
              $k = rand(5, 100);
             $overtxt3 = $k." साल";
           }
           if($overtxt2==$overtxt3){
           $j = rand(5, 100);
             $overtxt2 = $j." साल";
           }


           $img->text($overtxt1, 640, 70, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(43);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt2, 640, 210, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(43);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt3, 640, 340, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(43);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(320,320, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,23,65);
           $canvas->insert($img);

           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app32_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

           $html = view('hindi.hi_app32_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
           return response()->json(compact('html'));
           }
           else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app32--


//----आपने कितने दिलों को चुराया, तोडा और ठीक किया है??-----------------------------------app33--


          public function hi_app33(){
             return  view('hindi.hi_app33');
          }

         public function hi_app33_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app33/bg-sample/Product_bg.png");

           $overtxt1 = rand(5, 100);
           $overtxt2 = rand(5, 100);
           $overtxt3 = rand(5, 100);

           $img->text($overtxt1, 650, 262, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(30);
           $font->color('#DB000E');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt2, 650, 322, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(30);
           $font->color('#DB000E');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt3, 675, 380, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(30);
           $font->color('#DB000E');
           $font->align('center');
           $font->valign('middle');
           });

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(300,300, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-right' ,30,15);
           $canvas->insert($img);

           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app33_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

           $html = view('hindi.hi_app33_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
           return response()->json(compact('html'));
           }
           else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app33--

//----अपनी ‘जय श्री राम’ की फोटो बनाये और शेयर करें!-----------------------------------app34--

        public function hi_app34(){
           return  view('hindi.hi_app34');
        }

         public function hi_app34_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app34/bg-sample/Product_bg.png");

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(300,300, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-right' ,60,70);
           $canvas->insert($img);

           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app34_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app34_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app34--


//----आप देवता हैं या राक्षस?-------------------------------------app35--

         public function hi_app35(){
            return  view('hindi.hi_app35');
         }

         public function hi_app35_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app35/bg-sample/Product_bg.png");

            $i = rand(03, 90); //देवताओं
            $overtxt1 = $i."%";
           //$J = rand(02, 20);//राक्षसों
           // $overtxt2 = $J."%";
            $J = 100 - $i;
            $overtxt2 = $J."%";

           $img->text($overtxt1, 200, 381, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#000');
           $font->align('center');
           $font->valign('middle');
           });

           $img->text($overtxt2, 730, 380, function($font) {
           $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
           $font->size(40);
           $font->color('#000');
           $font->align('center');
           $font->valign('middle');
           });

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(220,220, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,290,100);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app35_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

           $html = view('hindi.hi_app35_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result1'=>$overtxt1,'app_result2'=>$overtxt2), compact('view'))->render();
           return response()->json(compact('html'));
           }
           else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app35--

//----बाहुबली-मूवी का कौनसा डायलॉग आप पर सूट करता है?-------------------------------------app36--

         public function hi_app36(){
            return  view('hindi.hi_app36');
         }

         public function hi_app36_createimg(){
           if (Auth::check()){
           // paste another image
           $posts  = User::find(Auth::user()->id);
           $img = Image::make("images/hindi/app36/bg-sample/Product_bg.png");

           $txtarry = array("एक राजा का धर्म सिर्फ शत्रु को मारना ही नहीं होता प्रजाओं बचाना भी होता है",
           "औरत पर हाथ डालने वाले की उँगलियाँ नहीं काटते, काटते हैं तो गला ",
           "सिंघासन के लिये अपने वचन तोड़ दूँ तो आपकी परवरिश का अपमान होगा माँ",
           "देवसेना को किसी ने हाथ लगाया तो समझो बाहुबली की तलवार को हाथ लगाया ",
           "जो प्राण देता है वो भगवान है जो प्राण की रक्षा करता है वो वैद्य और प्राण बचाने वाला छत्रिय ",
           "जब तक तुम मेरे साथ हो मुझे मारने वाला पैदा नहीं हुआ मामा ",
           "अपने हाथो को हथियार बना लो अपनी साँसों को आँधी में बदल दो हमारा रक्त ही हमारी महासेना हे ",
           "ऐसे उपहार के लिए आप जैसे लोग पूछ ही लेते होंगे मेर,मेरे लिए यह फिर की धूल भी नहीं ",
           "युद्ध  में सैकड़ों को मारने वाला नायक है ,लेकिन जो किसी  एक के भी प्राण बचाये ,वह देवता है ");

           $i = rand(0, count($txtarry)-1); // generate random number size of the array
           $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen
           $string = wordwrap($overtxt,100,"|");
           //create array of lines
           $strings = explode("|",$string);
           $i=340; //top position of string
           //for each line added
           foreach($strings as $string){
           $img->text($string,400, $i, function($font) {
          // $font->file('fonts/hindi/NotoSans-Regular.ttf');

             $font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
          //   $font->file('fonts/hindi/Devanagari/gargi.ttf');
             //$font->file('fonts/hindi/Rozha_One/RozhaOne-Regular.ttf');
             //$font->file('fonts/hindi/Devanagari/gargi.ttf');
           $font->size(25);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $i=$i+33; //shift top postition down 42
           }

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(280,280, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,270,25);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app36_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app36_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app36--




//----कौनसा देसी-फास्ट-फूड आपके लिए बना है?-------------------------------------app37--

         public function hi_app37(){
            return  view('hindi.hi_app37');
         }

         public function hi_app37_createimg(){
           if (Auth::check()){

           // paste another image
             $posts  = User::find(Auth::user()->id);

             $dir = "images/hindi/app37/bg-sample/";
             $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
             $img_path = $pictures[mt_rand(0,count($pictures)-1)];

             $img = Image::make($img_path);
             $ext = pathinfo($img_path);
             $overtxt_food = $ext['filename'];

             if($overtxt_food=="food1"){
                     $food = "चॉकलेट थिकशेक";
             }
             if($overtxt_food=="food2"){
                     $food = "छोले भटुरे";
             }
             if($overtxt_food=="food3"){
                     $food = "दाबेली";
             }
             if($overtxt_food=="food4"){
                     $food = "पानी पूरी";
             }
             if($overtxt_food=="food5"){
                   $food = "पिज़्जा";
             }
             if($overtxt_food=="food6"){
                     $food = "फ्रैंकी";
             }
             if($overtxt_food=="food7"){
                     $food = "बर्गर";
             }
             if($overtxt_food=="food8"){
                     $food = "मंचूरियन";
             }
             if($overtxt_food=="food9"){
                     $food = "वडापाव";
             }
             if($overtxt_food=="food10"){
                     $food = "वेनिला आइसक्रीम";
             }



           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(300, 300, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-right', 25, 72);
           $canvas->insert($img);

           //$canvas->save('images/final.png');
           // $markimg = $posts->picture;
           // $watermark = Image::make($markimg);
           // $watermark->resize(195, 201);

         //  $img->insert($watermark, 'top-left',50,107);

           //$img->resize(800, 420);
           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app37_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);
          // $img->save('images/fb1.jpg');

            //save to images
            //  $img->save('images/dd.jpg', 60); //save to set image quality
          //return  $img->response('jpg');
          //return view('/share',array('posts' => $posts,'img'=>$img));
          $html = view('hindi.hi_app37_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$food), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
        }
//--------------------------------------------------------------------end app37--


//----कौनसा फ़ोन आपके लिए बना है?-------------------------------------app38--

         public function hi_app38(){
            return  view('hindi.hi_app38');
         }

         public function hi_app38_createimg(){
           if (Auth::check()){

           // paste another image
             $posts  = User::find(Auth::user()->id);

             $dir = "images/hindi/app38/bg-sample/";
             $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
             $img_path = $pictures[mt_rand(0,count($pictures)-1)];

             $img = Image::make($img_path);
             $ext = pathinfo($img_path);
             $overtxt = $ext['filename'];

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(380, 380, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-right',0,10);
           $canvas->insert($img);

           //$canvas->save('images/final.png');
           // $markimg = $posts->picture;
           // $watermark = Image::make($markimg);
           // $watermark->resize(195, 201);

         //  $img->insert($watermark, 'top-left',50,107);

           //$img->resize(800, 420);
           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app38_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);
          // $img->save('images/fb1.jpg');

            //save to images
            //  $img->save('images/dd.jpg', 60); //save to set image quality
          //return  $img->response('jpg');
          //return view('/share',array('posts' => $posts,'img'=>$img));
          $html = view('hindi.hi_app38_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
        }
//--------------------------------------------------------------------end app38--



//----आपने अपने जीवन में कितने अच्छे कर्म और शरारती पाप किये है?-------------------------------------app39--

         public function hi_app39(){
            return  view('hindi.hi_app39');
         }

         public function hi_app39_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app39/bg-sample/Product_bg.png");


           $overtxt1 = $posts->first_name;
           $img->text($overtxt1, 400, 400, function($font) {
              //  $font->file('fonts/en/BerkshireSwash-Regular.ttf');
               $font->file('fonts/en/Lalezar/Lalezar-Regular.ttf');
               $font->size(60);
               $font->color('#000');
               $font->align('center');   //left, right and center
               $font->valign('bottom');  //top, bottom , middle
               $font->angle(0);       //0,45,90,180
           });


           $overtxt1 = rand(10,90);
           $overtxt2 = rand(10,25000);

           $img->text($overtxt2, 140, 210, function($font) {
        //   $font->file('fonts/theboldfont.ttf');
              $font->file('fonts/en/Lalezar/Lalezar-Regular.ttf');
           $font->size(65);
           $font->color('#000');
           $font->align('center');
           $font->valign('middle');
           });
           $img->text($overtxt1, 700, 210, function($font) {
          // $font->file('fonts/theboldfont.ttf');
              $font->file('fonts/en/Lalezar/Lalezar-Regular.ttf');
           $font->size(65);
           $font->color('#000');
           $font->align('right');
           $font->valign('middle');
           });



           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(240,240, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,285,85);
           $canvas->insert($img);


           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app39_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app39_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }

           }
//--------------------------------------------------------------------end app39--



//----कितने लोगो ने आपसे 2017 में प्यार किया और कितनो ने नफरत की?-------------------------------------app40--

         public function hi_app40(){
            return  view('hindi.hi_app40');
         }

         public function hi_app40_createimg(){

                      if (Auth::check()){

                      // paste another image
                      $posts  = User::find(Auth::user()->id);

                      $img = Image::make("images/hindi/app40/bg-sample/Product_bg.png");


                      $overtxt1 = $posts->first_name;
                      $img->text($overtxt1, 180, 365, function($font) {
                         //  $font->file('fonts/en/BerkshireSwash-Regular.ttf');
                          $font->file('fonts/en/Lalezar/Lalezar-Regular.ttf');
                          $font->size(55);
                          $font->color('#fff');
                          $font->align('center');   //left, right and center
                          $font->valign('bottom');  //top, bottom , middle
                          $font->angle(0);       //0,45,90,180
                      });

                      $overtxt2 = rand(20,90);
                      $overtxt3 = rand(5,20);

                       $img->text($overtxt2, 730, 160, function($font) {
                       $font->file('fonts/Questrial-Regular.ttf');
                       $font->size(60);
                       $font->color('#000');
                       $font->align('center');
                       $font->valign('middle');
                       });
                       $img->text($overtxt3, 730, 320, function($font) {
                       $font->file('fonts/Questrial-Regular.ttf');
                       $font->size(60);
                       $font->color('#000');
                       $font->align('center');
                       $font->valign('middle');
                       });


                      $markimg = $posts->picture;
                      $watermark = Image::make($markimg);
                      $watermark->resize(350,350, function ($constraint){
                          $constraint->aspectRatio();
                      });

                      $canvas = Image::canvas(800, 420);
                      $canvas->insert($watermark, 'top-left' ,10,60);
                      $canvas->insert($img);


                      //$canvas->save('images/final.png');
                      // $markimg = $posts->picture;
                      // $watermark = Image::make($markimg);
                      // $watermark->resize(195, 201);

                    //  $img->insert($watermark, 'top-left',50,107);

                      //$img->resize(800, 420);
                      $ldate = date('d-m-Y');
                      $t=time();
                      $fb_id = $posts['Fb_uid'];
                      $image_dirctory_path = 'uploads/'.$ldate;
                      File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
                      $image_name = 'hi_app40_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
                      $fullimage_path = $image_dirctory_path.'/'.$image_name;
                      $canvas->save($fullimage_path);

                     $html = view('hindi.hi_app40_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path), compact('view'))->render();
                     return response()->json(compact('html'));
                      }
                     else{
                           return Redirect::route('redirect');
                          }
           }
//--------------------------------------------------------------------end app40--

//----अपने रिटायरमेंट के समय आपके पास क्या क्या होगा?-------------------------------------app41--

         public function hi_app41(){
            return  view('hindi.hi_app41');
         }

         public function hi_app41_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app41/bg-sample/Product_bg.png");

           $overtxt_many =  number_format(rand(10,100000),3,",",",");
           $overtxt_pension =  number_format(rand(10,1000),3,",",",");
           $overtxt_home = rand(2,7);

             $arr_car=array("Audi","Mercedes","Duster","Innova","BMW","Swift", "Fortuner","Jaguar","Honda City","Skoda","Toyota","Volkswagen","Volvo","Tesla","Suzuki","Tata","Subaru","Saab","Rolls Royce","Renault","Ram","Porsche","Peugeot",
             "Pagani","Nissan","Lexus");
             $no_car = rand(2,4);
             if($no_car===2) {
               $random_keys=array_rand($arr_car,$no_car);
               $car_list = $no_car."  (".$arr_car[$random_keys[0]].",".$arr_car[$random_keys[1]].")";
                }
           else{
                 $random_keys=array_rand($arr_car,3);
                 $car_list = "3  (".$arr_car[$random_keys[0]].",".$arr_car[$random_keys[1]].",".$arr_car[$random_keys[2]].")";
                }
           $overtxt_car = $car_list;

            $img->text($overtxt_many, 675, 105, function($font) {
            $font->file('fonts/Questrial-Regular.ttf');
            $font->size(33);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });
            $img->text($overtxt_pension, 575, 195, function($font) {
            $font->file('fonts/Questrial-Regular.ttf');
            $font->size(33);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });
            $img->text($overtxt_home, 480, 285, function($font) {
            $font->file('fonts/Questrial-Regular.ttf');
            $font->size(33);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });
            $img->text($overtxt_car, 630, 376, function($font) {
            $font->file('fonts/Questrial-Regular.ttf');
            $font->size(30);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(340,340, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-left' ,20,79);
           $canvas->insert($img);


           //$canvas->save('images/final.png');
           // $markimg = $posts->picture;
           // $watermark = Image::make($markimg);
           // $watermark->resize(195, 201);

         //  $img->insert($watermark, 'top-left',50,107);

           //$img->resize(800, 420);
           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app41_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app41_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result_many'=>$overtxt_many,'app_result_pension'=>$overtxt_pension,'app_result_home'=>$overtxt_home,'app_result_car'=>$overtxt_car), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app41--



//----यदि आप अपने अतीत में एक चीज बदल सकते हैं, तो वो क्या होगी?-------------------------------------app42--

         public function hi_app42(){
            return  view('hindi.hi_app42');
         }

         public function hi_app42_createimg(){
           if (Auth::check()){

           // paste another image
           $posts  = User::find(Auth::user()->id);

           $img = Image::make("images/hindi/app42/bg-sample/Product_bg.png");
           $overtxt1 = $posts->first_name;
           $img->text($overtxt1, 600, 362, function($font) {
              //  $font->file('fonts/en/BerkshireSwash-Regular.ttf');
               $font->file('fonts/theboldfont.ttf');
               $font->size(40);
               $font->color('#000');
               $font->align('center');   //left, right and center
               $font->valign('middle');  //top, bottom , middle
               $font->angle(0);       //0,45,90,180
           });

           $txtarry = array("आप Wish करते हो की आप अपने दोनों की बिच की गलतफहमी दूर कर पाते ",
             "आप Wish करते हो की आप अपने माता पिता की बात भी सुनी होती ",
             "आप Wish करते हो की आप अभी भी उसके  साथ होते ",
             "आप Wish करते हो की आप अपने दोस्त की बात मान ली  होती ",
             "आप Wish करते हो की आप अपने Future के लिए और Serious होते ",
            "आप अपनी जिंदगी के लिए हुए सभी Negative Decisions को बदलना चाहोगे ",);
           $i = rand(0, count($txtarry)-1); // generate random number size of the array
           $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen
           $string = wordwrap($overtxt,50,"|");
           //create array of lines
           $strings = explode("|",$string);
           $i=290; //top position of string
           //for each line added
           foreach($strings as $string){
           $img->text($string, 200, $i, function($font) {
          // $font->file('fonts/hindi/NotoSans-Regular.ttf');

            //$font->file('fonts/hindi/Devanagari/chandas1-2.ttf');
            $font->file('fonts/hindi/Devanagari/gargi.ttf');
          //  $font->file('fonts/hindi/Rozha_One/RozhaOne-Regular.ttf');
             //$font->file('fonts/hindi/Devanagari/gargi.ttf');
           $font->size(26);
           $font->color('#fff');
           $font->align('center');
           $font->valign('middle');
           });
           $i=$i+35; //shift top postition down 42
           }

           $markimg = $posts->picture;
           $watermark = Image::make($markimg);
           $watermark->resize(380,380, function ($constraint){
               $constraint->aspectRatio();
           });

           $canvas = Image::canvas(800, 420);
           $canvas->insert($watermark, 'top-right' ,5,10);
           $canvas->insert($img);

           $ldate = date('d-m-Y');
           $t=time();
           $fb_id = $posts['Fb_uid'];
           $image_dirctory_path = 'uploads/'.$ldate;
           File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
           $image_name = 'hi_app42_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
           $fullimage_path = $image_dirctory_path.'/'.$image_name;
           $canvas->save($fullimage_path);

          $html = view('hindi.hi_app42_Result_Share',array('posts' => $posts,'img_url'=>$fullimage_path,'app_result'=>$overtxt), compact('view'))->render();
          return response()->json(compact('html'));
           }
          else{
                return Redirect::route('redirect');
               }
           }
//--------------------------------------------------------------------end app42--


   public function test(){


$start = strtotime("10 December 2017");

//End point of our date range.
$end = strtotime("22 July 2020");

//Custom range.
$timestamp = mt_rand($start, $end);

//Print it out.
echo date("d-m-Y", $timestamp);
   return;



    echo rand(5, 100);
    echo rand(5, 100);
    echo rand(5, 100);
    echo rand(5, 100);
  echo   mt_rand(1,99)/100;
     return;
     $number_arry = array("10%","12%","15%","18%","20%","22%","24%","25%","28%","30%","32%","40%","45%","50%","55%","60%","65%","70%","75%","80%","82%","85%",
                "90%","95%","99%","23%","32%","34%","77%","87%","39%","44%","43%","48%","67%","77%","87%","88%");

     $i = rand(0, count($number_arry)-1); // generate random number size of the array
     $overtxt1 = $number_arry[$i]; // set variable equal to which random filename was chosen
     $j = rand(5, count($number_arry)-7);
     $overtxt2 = $number_arry[$j];
     $k = rand(10, count($number_arry)-3);
     $overtxt3 = $number_arry[$k];

      echo  "i".$overtxt1;
      echo  "j".$overtxt2;
      echo  "k".$overtxt3;
   }

}
