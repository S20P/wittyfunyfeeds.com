<?php

namespace App\Http\Controllers\english;

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
use View;
use Schema;
use MetaTag;


class AppCreateController_en extends Controller
{

private $projects;
private $app_title;
public $newCollection;
   public function __construct(Request $req)
   {

//--------------Laravel Collections: PHP Arrays On Steroids---------------------

      $this->newCollection = collect([1, 2, 3, 4, 5]);
     //dd($newCollection);

     // $this->newCollection->contains(function ($key, $value) {
     //        return $value <= 5;
     //
     //    });

     //  $allCoolPeople =  $this->newCollection->union([
     //                2,2,2,2,2,2,
     //            ]);


      // $coolPeople = collect([
      //            1 => 'John', 2 => 'James', 3 => 'Jack'
      //        ]);
      //  $veryCoolPeople = $coolPeople->intersect(['Sarah', 'Jack', 'James']);
      //  dd($veryCoolPeople->toArray());



//-----------------------------------------------------------------------------




  $this->middleware('preventBackHistory')->except('logout');

  $this->app_title_list();


if(Schema::hasTable('application_store')){

     $student = DB::table('application_store')->orderBy(DB::raw('RAND()'))->where('lang','en')->take('13')->get();

     View::share('student', $student);

       $app_btm_list = DB::table('application_store')->where('lang','en')->orderBy(DB::raw('RAND()'))->take('36')->get();
       View::share('app_btm_list', $app_btm_list);
   }

  //  if(Auth::guest())
  // {
  //  if(Schema::hasTable('application_meta_tag')){
  //
  //    $meta_info_data = DB::table('application_meta_tag')->get();
  //    if(count($meta_info_data)>0){
  //
  //     $this->middleware(function ($request, $next) {
  //                $this->projects = Auth::user()->Fb_uid;
  //                $meta_info = DB::table('application_meta_tag')->where('mt_user_id',$this->projects)->orderBy('mt_img', 'desc')->orderBy('mt_id', 'desc')->take('1')->get();
  //
  //                 View::share('meta_info',$meta_info);
  //
  //
  //                 //return $meta_info;
  //                return $next($request);
  //            });
  //    }
  //     }
  // }
  // else{
  //
  //  if(Schema::hasTable('application_meta_tag')){
  //
  //    $meta_info_data = DB::table('application_meta_tag')->get();
  //    if(count($meta_info_data)>0){
  //
  //     $this->middleware(function ($request, $next) {
  //                $this->projects = Auth::user()->Fb_uid;
  //                $meta_info = DB::table('application_meta_tag')->where('mt_user_id',$this->projects)->orderBy('mt_img', 'desc')->orderBy('mt_id', 'desc')->take('1')->get();
  //
  //                 View::share('meta_info',$meta_info);
  //
  //                return $next($request);
  //            });
  //    }
  //     }
  //
  //     }






 }



 private function app_title_list(){

   $app_info = DB::table('application_store')->where('lang','en')->get();
   $this->app_store_info = [];

   for($i=0;$i<count($app_info);$i++){
       $this->title_app[$i] = $app_info[$i]->app_name;
       $this->app_home_desc[$i] = $app_info[$i]->app_description;
       $this->app_meta_desc[$i] = $app_info[$i]->app_meta_description;
       $this->app_img_orignal_url[$i] = asset('images/project_home_img/en/orignal/'.$app_info[$i]->app_img_url);
       array_push($this->app_store_info,[
                                           "app_meta_desc"=>$this->app_meta_desc[$i],
                                           "app_title"=>$this->title_app[$i],
                                           "app_description" => $this->app_home_desc[$i],
                                           "app_img_orignal_url"=>$this->app_img_orignal_url[$i],
                                         ]);
   //dd( $this->app_store_info);

  // dd($this->app_store_info[0]['app_img_orignal_url']);
   }


 }



 //----What will God bless you with?----------------------------------------------------app1--
             public function en_app1(){
               MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[0]['app_title']);
               MetaTag::set('description',$this->app_store_info[0]['app_meta_desc']);
               return  view('english.app_view_home',array('app_no'=>"1",'app_title'=>$this->app_store_info[0]['app_title'],'app_img_orignal_url'=>$this->app_store_info[0]['app_img_orignal_url'],'app_description'=>$this->app_store_info[0]['app_description']));
             }

             public function en_app1_createimg(){

               if (Auth::check()){

               // paste another image
               $posts  = User::find(Auth::user()->id);
          //     $dir = asset("images/english/app1/bg-sample/Product_bg.png");
              //$dir =  '/images/english/app1/bg-sample/Product_bg.png')
               $img = Image::make("images/english/app1/bg-sample/Product_bg.png");

               $god = array('Your Beautiful Smile',
                                 'Your Strong Intuition',
                                 'Your Speaking Eyes',
                                 'Your Attractive Smile',
                                 'Your Beautiful Voice',
                                 'Your Seanse Of Humor',
                                 'Your Golden Heart');
               $random_keys=array_rand($god,2);
               $overtxt1 = $god[$random_keys[0]];

               $string2 = wordwrap($overtxt1,12,"|");
               //create array of lines
               $strings2 = explode("|",$string2);
               $i=180; //top position of string
               //for each line added
               foreach($strings2 as $string){
               $img->text($string, 550, $i, function($font) {
               $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
               $font->size(70);
               $font->color('#00FFB4');
               $font->align('center');
               $font->valign('middle');
               });
               $i=$i+70; //shift top postition down 42
               }


               $markimg = $posts->picture;
               $watermark = Image::make($markimg);
               $watermark->resize(300,300, function ($constraint){
                   $constraint->aspectRatio();
               });

               $canvas = Image::canvas(800, 420);
               $canvas->insert($watermark, 'top-left' ,30,89);
               $canvas->insert($img);

               $ldate = date('d-m-Y');
               $t=time();
               $fb_id = $posts['Fb_uid'];
               $image_dirctory_path = 'uploads/'.$ldate;
               File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
               $image_name = 'en_app1_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
               $fullimage_path = $image_dirctory_path.'/'.$image_name;
               $canvas->save($fullimage_path);

              $app_description = "<p class='subtext'>Everyone has their own wild streaks. You are not totally crazy, but you just think and behave totally more fun and random than the rest! </p>";
              $app_sub_description = "<p class='subtext'>Share with your friends and family, and let them see their own level of craziness!</p>";

              $html = view('english.Result_Share_fb_page',array('app_no'=>"1",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[0]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
              return response()->json(compact('html'));
               }
              else{
                    return Redirect::route('redirect');
                   }
             }


  //--------------------------------------------------------------------end app1--


  //----Which Skills did God gave you?----------------------------------------------------app2--
                  public function en_app2(){
                    MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[1]['app_title']);
                    MetaTag::set('description',$this->app_store_info[1]['app_meta_desc']);
                    return  view('english.app_view_home',array('app_no'=>"2",'app_title'=>$this->app_store_info[1]['app_title'],'app_img_orignal_url'=>$this->app_store_info[1]['app_img_orignal_url'],'app_description'=>$this->app_store_info[1]['app_description']));
                    }

                  public function en_app2_createimg(){
                    if (Auth::check()){

                    // paste another image
                    $posts  = User::find(Auth::user()->id);

                    $img = Image::make("images/english/app2/bg-sample/Product_bg.png");

                    $txtarry =array( "Advising",
                                      "Coaching",
                                      "Conflict resolution",
                                      "Decision making",
                                      "Delegating",
                                      "Diplomacy",
                                      "Interviewing",
                                      "Motivation",
                                      "People management",
                                      "Problem solving",
                                      "Strategic thinking",
                                      "Dedication",
                                      "Ethics",
                                      "Honesty",
                                      "Integrity",
                                      "Maturity",
                                      "Patience",
                                      "Presentation,",
                                      "Reliability",
                                      "confidence",
                                      "Categorizing data",
                                      "Coordinating",
                                      "Goal setting",
                                      "Meeting deadlines",
                                      "Multi-tasking",
                                      "Prioritizing",
                                      "Project management",
                                      "Scheduling",
                                      "Strategic Planning",
                                      "Time management",
                                      "Collaboration",
                                      "Communication",
                                      "Flexibility",
                                      "Listening",
                                      "Observation",
                                      "Participation",
                                      "Respect",
                                      "Sharing",
                                      "Critical thinking",
                                      "Data analysis",
                                      "Numeracy",
                                      "Reporting",
                                      "Research",
                                      "Troubleshooting",
                                      "Adaptability",
                                      "Caring",
                                      "Common sense",
                                      "Cooperation",
                                      "Curiosity",
                                      "Effort",
                                      "Flexibility",
                                      "Friendship",
                                      "Initiative",
                                      "Integrity",
                                      "Organization",
                                      "Patience",
                                      "Perseverance",
                                      "Problem solving",
                                      "Responsibility",
                                      "Sense of humor",
                                      "Stress management"
                                    );
                    $random_keys=array_rand($txtarry,4);
                    $overtxt1 = $txtarry[$random_keys[0]];
                    $overtxt2 = $txtarry[$random_keys[1]];
                    $overtxt3 = $txtarry[$random_keys[2]];
                    $overtxt4 = $txtarry[$random_keys[3]];

                            $img->text($overtxt1,405,130, function($font) {
                            $font->file('fonts/en/Volkhov/Volkhov-Regular.ttf');
                            $font->size(33);
                            $font->color('#1E6F9D');
                            $font->align('left');
                            $font->valign('middle');
                            });

                            $img->text($overtxt2,405, 197, function($font) {
                            $font->file('fonts/en/Volkhov/Volkhov-Regular.ttf');
                            $font->size(33);
                            $font->color('#1E6F9D');
                            $font->align('left');
                            $font->valign('middle');
                            });

                            $img->text($overtxt3,405,272, function($font) {
                            $font->file('fonts/en/Volkhov/Volkhov-Regular.ttf');
                            $font->size(33);
                            $font->color('#1E6F9D');
                            $font->align('left');
                            $font->valign('middle');
                            });

                            $img->text($overtxt4,405,350, function($font) {
                            $font->file('fonts/en/Volkhov/Volkhov-Regular.ttf');
                            $font->size(33);
                            $font->color('#1E6F9D');
                            $font->align('left');
                            $font->valign('middle');
                            });

                    $markimg = $posts->picture;
                    $watermark = Image::make($markimg);
                    $watermark->resize(300,300, function ($constraint){
                        $constraint->aspectRatio();
                    });

                    $canvas = Image::canvas(800, 420);
                    $canvas->insert($watermark, 'top-left' ,15,90);
                    $canvas->insert($img);

                    $ldate = date('d-m-Y');
                    $t=time();
                    $fb_id = $posts['Fb_uid'];
                    $image_dirctory_path = 'uploads/'.$ldate;
                    File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
                    $image_name = 'en_app2_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
                    $fullimage_path = $image_dirctory_path.'/'.$image_name;
                    $canvas->save($fullimage_path);

                    $app_description = "<p class='subtext'>Everyone has their own wild streaks. You are not totally crazy, but you just think and behave totally more fun and random than the rest!</p>";
                    $app_sub_description = "<p class='subtext'>Share with your friends and family, and let them see their own level of craziness!</p>";

                   $html = view('english.Result_Share_fb_page',array('app_no'=>"2",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[1]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
                   return response()->json(compact('html'));
                    }
                   else{
                         return Redirect::route('redirect');
                        }
                  }


          //--------------------------------------------------------------------end app2--


//----How Rich will you be in 7 years?----------------------------------------------------app3--
                public function en_app3(){
                  MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[2]['app_title']);
                  MetaTag::set('description',$this->app_store_info[2]['app_meta_desc']);
                  return  view('english.app_view_home',array('app_no'=>"3",'app_title'=>$this->app_store_info[2]['app_title'],'app_img_orignal_url'=>$this->app_store_info[2]['app_img_orignal_url'],'app_description'=>$this->app_store_info[2]['app_description']));
                }

                public function en_app3_createimg(request $request){
                  if (Auth::check()){

                  // paste another image
                  $posts  = User::find(Auth::user()->id);

                  $img = Image::make("images/english/app3/bg-sample/Product_bg.png");

                          $overtxt1 = rand(5,100)." Buildings";
                          $overtxt2 = rand(10,50)." Luxurious Cars";
                          $overtxt3 = rand(1,10)." Mansions Cars ".rand(1,10)." Villas";
                          $overtxt4 = "$".number_format(rand(10,100000),3,",",",");

                          $img->text($overtxt1,400,160, function($font) {
                          $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                          $font->size(24);
                          $font->color('#000');
                          $font->align('left');
                          $font->valign('middle');
                          });

                          $img->text($overtxt2,400, 195, function($font) {
                          $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                          $font->size(24);
                          $font->color('#000');
                          $font->align('left');
                          $font->valign('middle');
                          });

                        $img->text($overtxt3,400,230, function($font) {
                        $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                        $font->size(24);
                        $font->color('#000');
                        $font->align('left');
                        $font->valign('middle');
                        });

                        $img->text($overtxt4,380,355, function($font) {
                        $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                        $font->size(40);
                        $font->color('#FF0000');
                        $font->align('left');
                        $font->valign('middle');
                        });

                        $filedata = $request->app_img_url;
                        $path = $filedata;
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        $base64_img = Image::make(base64_decode(explode(',',$base64)[1]));
                        $watermark = Image::make($base64_img);

                      $watermark->resize(310,310, function ($constraint){
                      $constraint->aspectRatio();
                  });

                  $canvas = Image::canvas(800, 420);
                  $canvas->insert($watermark, 'top-left' ,25,85);
                  $canvas->insert($img);

                  $ldate = date('d-m-Y');
                  $t=time();
                  $fb_id = $posts['Fb_uid'];
                  $image_dirctory_path = 'uploads/'.$ldate;
                  File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
                  $image_name = 'en_app3_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
                  $fullimage_path = $image_dirctory_path.'/'.$image_name;
                  $canvas->save($fullimage_path);

                  $app_description = "<p class='subtext'>Everyone has their own wild streaks. You are not totally crazy, but you just think and behave totally more fun and random than the rest!</p>";
                  $app_sub_description = "<p class='subtext'>Share with your friends and family, and let them see their own level of craziness!</p>";

                  $html = view('english.Result_Share_fb_page',array('app_no'=>"3",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[2]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
                   return $html;
                  }
                  else{
                       return Redirect::route('redirect');
                      }
                }


  //--------------------------------------------------------------------end app3--


//----How will your body change in 2018?----------------------------------------------------app4--
                        public function en_app4(){
                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[3]['app_title']);
                          MetaTag::set('description',$this->app_store_info[3]['app_meta_desc']);
                          return  view('english.app_view_home',array('app_no'=>"4",'app_title'=>$this->app_store_info[3]['app_title'],'app_img_orignal_url'=>$this->app_store_info[3]['app_img_orignal_url'],'app_description'=>$this->app_store_info[3]['app_description']));
                            }

                        public function en_app4_createimg(request $request){
                          if (Auth::check()){

                          // paste another image
                          $posts  = User::find(Auth::user()->id);

                          $img = Image::make("images/english/app4/bg-sample/Product_bg.png");

                          $txtarry = array(' Small Waist and big butt','Bigger butt','Flat tummy','Younger looking and big boobs','big butt and big boobs','Big boobs and flat tummy','Perfect body and big butt','Bigger chest','Bigger beer belly');

                          $random_keys=array_rand($txtarry,2);
                          $overtxt1 = $txtarry[$random_keys[0]];

                          $string2 = wordwrap($overtxt1,12,"|");
                          //create array of lines
                          $strings2 = explode("|",$string2);
                          $i=180; //top position of string
                          //for each line added
                          foreach($strings2 as $string){
                          $img->text($string, 550, $i, function($font) {
                          $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                          $font->size(60);
                          $font->color('#fff');
                          $font->align('center');
                          $font->valign('middle');
                          });
                          $i=$i+62; //shift top postition down 42
                          }


                          $markimg = $posts->picture;
                          $watermark = Image::make($markimg);
                          $watermark->resize(300,300, function ($constraint){
                              $constraint->aspectRatio();
                          });

                          $canvas = Image::canvas(800, 420);
                          $canvas->insert($watermark, 'top-left' ,30,89);
                          $canvas->insert($img);

                          $ldate = date('d-m-Y');
                          $t=time();
                          $fb_id = $posts['Fb_uid'];
                          $image_dirctory_path = 'uploads/'.$ldate;
                          File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
                          $image_name = 'en_app4_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
                          $fullimage_path = $image_dirctory_path.'/'.$image_name;
                          $canvas->save($fullimage_path);

                          $app_description = "<p class='subtext'>The future is looking very bright, <b>".$posts->first_name."</b>! The change in your appearance is unbelievable!</p>";
                          $app_sub_description = "<p class='subtext'>Share with your family and friends!</p>";

                         $html = view('english.Result_Share_fb_page',array('app_no'=>"4",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[3]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
                         return response()->json(compact('html'));
                          }
                         else{
                               return Redirect::route('redirect');
                              }
                        }


//--------------------------------------------------------------------end app4--

//----What is the first thing people notice about you?----------------------------------------------------app5--

          public function en_app5(){

            MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[4]['app_title']);
            MetaTag::set('description',$this->app_store_info[4]['app_meta_desc']);
            return  view('english.app_view_home',array('app_no'=>"5",'app_title'=>$this->app_store_info[4]['app_title'],'app_img_orignal_url'=>$this->app_store_info[4]['app_img_orignal_url'],'app_description'=>$this->app_store_info[4]['app_description']));

          }

          public function en_app5_createimg(request $request){

            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app5/bg-sample/Product_bg.png");

            $god = array("Smile","Hair","face","eye","nose","Cheek","skin","eyebrow","ear","lip","chin","eyelash","teeth");

            $random_keys=array_rand($god,2);
            $overtxt1 = $god[$random_keys[0]];

            $img->text($overtxt1, 550, 240, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(80);
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
            $canvas->insert($watermark, 'top-left' ,30,89);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app5_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>If you've got it, flaunt it!</p>";
            $app_sub_description = "<p class='subtext'>Share with your family and friends!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"5",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[4]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }

          }


//--------------------------------------------------------------------end app5--





//----Create Your Personalized Happy NEW YEAR 2018 Greeting Card!-------------------------app6--

          public function en_app6(){

            MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[5]['app_title']);
            MetaTag::set('description',$this->app_store_info[5]['app_meta_desc']);
            return  view('english.app_view_home',array('app_no'=>"6",'app_title'=>$this->app_store_info[5]['app_title'],'app_img_orignal_url'=>$this->app_store_info[5]['app_img_orignal_url'],'app_description'=>$this->app_store_info[5]['app_description']));

          }

          public function en_app6_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app6/bg-sample/Product_bg.png");

            $txtarry = array(
              "May this New Year brings you a peace filled life,warmth and togetherness in your family and much prosperity Happy New Year!",
              "The start of every year takes you a step closer to the attainment of your dreams. Hope this year is the breakthrough one and your dreams finally turn into reality.",
              "May you be blessed enough to spend this new year with your parents,friends, loved ones.Be grateful and you will have only good things come your way.Happy 2018!",
              "May God bless you and keep you protected and in good health so that you cna witness many more such new years'!but first og all, enjoy this one and stay happy!",
            );

            $i = rand(0, count($txtarry)-1); // generate random number size of the array
            $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen
            $string = wordwrap($overtxt,40,"|");
            //create array of lines
            $strings = explode("|",$string);
            $i=220; //top position of string
            //for each line added
            foreach($strings as $string){
            $img->text($string, 760, $i, function($font) {
            $font->file('fonts/en/Lora/Lora-Bold.ttf');
            $font->size(26);
            $font->color('#fff');
            $font->align('right');
            $font->valign('middle');
            });
            $i=$i+40; //shift top postition down 42
            }

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(240,240, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,20,20);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app6_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,this how your greeting card will look like.</p>";
            $app_sub_description = "<p class='subtext'>Tag your friends and share this greeting card with everyone to wish a Happy new Year 2018.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"6",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[5]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app6--
//-----What Awaits You From 2018 to 2020?----------------------------------------------------app7--

          public function en_app7(){

            MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[6]['app_title']);
            MetaTag::set('description',$this->app_store_info[6]['app_meta_desc']);
            return  view('english.app_view_home',array('app_no'=>"7",'app_title'=>$this->app_store_info[6]['app_title'],'app_img_orignal_url'=>$this->app_store_info[6]['app_img_orignal_url'],'app_description'=>$this->app_store_info[6]['app_description']));

          }

          public function en_app7_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $dir = 'images/english/app7/bg-sample/';
            $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
            $img_path = $pictures[mt_rand(0,count($pictures)-1)];
            $img = Image::make($img_path);

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(150,150, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,25,205);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app7_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, You're life is going to be perfect! You deserve a wonderful future, because you always try to have a positive attitude towards life.</p>";
            $app_sub_description = "<p class='subtext'>Think this is the life for you? Share this result with your friends!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"7",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[6]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app7--

//----Which Phrase Best Describes Your Life?------------------------------------------------app8--

          public function en_app8(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[7]['app_title']);
                MetaTag::set('description',$this->app_store_info[7]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"8",'app_title'=>$this->app_store_info[7]['app_title'],'app_img_orignal_url'=>$this->app_store_info[7]['app_img_orignal_url'],'app_description'=>$this->app_store_info[7]['app_description']));
          }

          public function en_app8_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app8/bg-sample/Product_bg.png");

            $txtarry = array(
              "Last night confused. slept, Morning, Eureka!",
              "Learn to color outside the lines.",
              "Enjoy the little things",
              "I learned to expect the unexpected.",
              "Never give up,great things take time",
              "Dancing with ideas og infinite possibilities."
                  );

            $i = rand(0, count($txtarry)-1); // generate random number size of the array
            $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen
            $string = wordwrap($overtxt,12,"|");
            //create array of lines
            $strings = explode("|",$string);
            $i=170; //top position of string
            //for each line added
            foreach($strings as $string){
            $img->text($string, 560, $i, function($font) {
            $font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            $font->size(36);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+45; //shift top postition down 42
            }

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(280,280, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,50,120);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app8_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,this phrase perfectly describes you. You are the person of your principles. You will never leave the path of truth, no matter what the situation is! You are a bit creative too and always open to learn new things. You live your life to the fullest and enjoy every moment of it.</p>";
            $app_sub_description = "<p class='subtext'>Share this beautiful result with everyone and let them know about this.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"8",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[7]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app8--

//---Which Word Summarise Your Life?--------------------------------------------------app9--

          public function en_app9(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[8]['app_title']);
                MetaTag::set('description',$this->app_store_info[8]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"9",'app_title'=>$this->app_store_info[8]['app_title'],'app_img_orignal_url'=>$this->app_store_info[8]['app_img_orignal_url'],'app_description'=>$this->app_store_info[8]['app_description']));

          }

          public function en_app9_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app9/bg-sample/Product_bg.png");



            $txtarry = array(
              "REGRET","EAT","MONEY","ENJOY ","LOVE","MEDITATION","CURIOSITY","FRIENDS",
              "LAPTOP","SLEEP"
                  );

            $random_keys=array_rand($txtarry,3);
            $overtxt1 = $txtarry[$random_keys[0]];
            $overtxt2 = $txtarry[$random_keys[1]];
            $overtxt3 = $txtarry[$random_keys[2]];

            $img->text($overtxt1, 250, 140, function($font) {
            $font->file('fonts/en/Ewert/Ewert-Regular.ttf');
            $font->size(45);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $img->text($overtxt2, 250, 250, function($font) {
            $font->file('fonts/en/Ewert/Ewert-Regular.ttf');
            $font->size(40);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $img->text($overtxt3, 250, 360, function($font) {
            $font->file('fonts/en/Ewert/Ewert-Regular.ttf');
            $font->size(30);
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
            $canvas->insert($watermark, 'top-right' ,0,108);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app9_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,your mission in life is not merely to survive, but to thrive; and to do so with some passion, some compassion, some humor, and some style.</p>";
            $app_sub_description = "<p class='subtext'>All of life is peak and valley and don’t let the peaks get too high and the valley to low. Share this beautiful result with your friends and let them know about these words.</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"9",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[8]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app9--

//-----What Does Your Warning Label Say?-------------------------------------------------app10--

          public function en_app10(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[9]['app_title']);
                MetaTag::set('description',$this->app_store_info[9]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"10",'app_title'=>$this->app_store_info[9]['app_title'],'app_img_orignal_url'=>$this->app_store_info[9]['app_img_orignal_url'],'app_description'=>$this->app_store_info[9]['app_description']));

          }

          public function en_app10_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app10/bg-sample/Product_bg.png");

            $txtarry = array("DIRTY JOKES INSIDE","HEART BREAKER KEEP YOUR DISTANCE","BEWARE OF ME","HOT SURFACE DO NOT TOUCH");

            $i = rand(0, count($txtarry)-1); // generate random number size of the array
            $overtxt1 = $txtarry[$i];

            $img->text($overtxt1, 400, 383, function($font) {
            $font->file('fonts/en/Spicy_Rice/SpicyRice-Regular.ttf');
            $font->size(40);
            $font->color('#E2BC1B');
            $font->align('center');
            $font->valign('middle');
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(260,260, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,40,10);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app10_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,see what your warning label says. You love your attitude and never regret your decisions once taken.</p>";
            $app_sub_description = "<p class='subtext'>Share with your family and friends!</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"10",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[9]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app10--

//----How Fake Are You?----------------------------------------------------app11--

          public function en_app11(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[10]['app_title']);
                MetaTag::set('description',$this->app_store_info[10]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"11",'app_title'=>$this->app_store_info[10]['app_title'],'app_img_orignal_url'=>$this->app_store_info[10]['app_img_orignal_url'],'app_description'=>$this->app_store_info[10]['app_description']));

                }

          public function en_app11_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app11/bg-sample/Product_bg.png");

            $txtarry = array(
            "You Are Always At Your 3 am version Honest & Real.",
            "You Don't Have To Maintain An Image. Real People Just Don't Care.",
            "You may not be the perfect but at least you are not fake",
            "You Be The Same Person PRIVATELY, PUBLICLY & PERSONALLY",
                  );

            $i = rand(0, count($txtarry)-1); // generate random number size of the array
            $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen
            $string = wordwrap($overtxt,15,"|");
            //create array of lines
            $strings = explode("|",$string);
            $i=170; //top position of string
            //for each line added
            foreach($strings as $string){
            $img->text($string, 540, $i, function($font) {
          //  $font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
          //  $font->file('fonts/en/Fascinate_Inline/FascinateInline-Regular.ttf');
            $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
            $font->size(36);
            $font->color('#FF9600');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+45; //shift top postition down 42
            }

            $fake_no = rand(0,80);
            $fake_str = "You Are ".$fake_no."% Fake";
            $img->text($fake_str, 540,50, function($font) {
            $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
            $font->size(36);
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
            $canvas->insert($watermark, 'top-left' ,10,12);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app11_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,you are a real person, and there is no place of fakeness in you. You don’t have two faces and will never betray anyone. Sometimes your talks become harsh for someone, but it’s good to be real than fake.</p>";
            $app_sub_description = "<p class='subtext'>Share this result with everyone and let them know about the real you.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"11",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[10]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app11--

//----What Is Your Message To The World?--------------------------------------------------app12--

          public function en_app12(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[11]['app_title']);
                MetaTag::set('description',$this->app_store_info[11]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"12",'app_title'=>$this->app_store_info[11]['app_title'],'app_img_orignal_url'=>$this->app_store_info[11]['app_img_orignal_url'],'app_description'=>$this->app_store_info[11]['app_description']));

          }

          public function en_app12_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app12/bg-sample/Product_bg.png");

            $txtarry = array(
               "Smile like a baby,Shine like a dew drop,Be confident like the sun,Fly like a butterfly,And trust me,no one can stop you from being successful. ",
                "Don’t blame God for not showering you with gifts. He gives you the gift of a new day with every single morning.",
                "The best time to plant a tree was 20 years ago. The next best time is today. ",
                "It is impossible to change your past,But you can surely design your future! So, don’t worry about your past,Just think about your future!! ",
                "If you try to follow someone,Then you will always live behind that person.Just stand out and make your own way,And you will see yourself leading the world. ",
                "Too many of us are not living our dreams because we are living our fears.",
                "Fear is an interesting thing. By studying your own fear, you can learn quite a bit about yourself.",
                  );

            $i = rand(0, count($txtarry)-1); // generate random number size of the array
            $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen
            $string = wordwrap($overtxt,30,"|");
            //create array of lines
            $strings = explode("|",$string);
            $i=170; //top position of string
            //for each line added
            foreach($strings as $string){
            $img->text($string, 545, $i, function($font) {
            //$font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            //$font->file('fonts/en/Faster_One/FasterOne-Regular.ttf');
            $font->file('fonts/en/Risque/Risque-Regular.ttf');
            $font->size(34);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+34; //shift top postition down 42
            }

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(240,240, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,0,140);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app12_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);


            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, your message to the world is:<b>".$overtxt."</b></p>";
            $app_description .="<p class='subtext'>No matter what people tell you, you believe that words and ideas can change the world.</p>";
            $app_sub_description = "<p class='subtext'>Share this beautiful result with your friends and let them know about your message to the world!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"12",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[11]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app12--

//----What's The One Thing You Regret Losing?-----------------------------------------------app13--

          public function en_app13(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[12]['app_title']);
                MetaTag::set('description',$this->app_store_info[12]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"13",'app_title'=>$this->app_store_info[12]['app_title'],'app_img_orignal_url'=>$this->app_store_info[12]['app_img_orignal_url'],'app_description'=>$this->app_store_info[12]['app_description']));

            }

          public function en_app13_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app13/bg-sample/Product_bg.png");

            $txtarry = array(
              "You are incredibly curious. You can ask 1,000 questions, and after those have been answered, you have 1,000 more to ask.",
              "You are seemingly amazed by something new every five minutes. It doesn’t matter where you are; you become entranced by the simplest objects and environments.",
              "Whatever problems you had during the day are erased by a good nights sleep, and the next morning they are reset",
              "You develop the persistence of a child when attempting to tackle your goals and ambitions. You Don’t give up until you get what you want. ",
              "You are not afraid to try a diverging path for fear of failure. You Develop the faith like a child and use it to take the leaps necessary to live a successful and rewarding life.",
            );

            $i = rand(0, count($txtarry)-1); // generate random number size of the array
            $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen
            $string = wordwrap($overtxt,42,"|");
            //create array of lines
            $strings = explode("|",$string);
            $i=270; //top position of string
            //for each line added
            foreach($strings as $string){
            $img->text($string, 400, $i, function($font) {
            //$font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            //$font->file('fonts/en/Risque/Risque-Regular.ttf');
            $font->file('fonts/en/Josefin_Sans/JosefinSans-Regular.ttf');
            $font->size(30);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+30; //shift top postition down 42
            }



            $uname = $posts->first_name;
            $img->text($uname, 150, 180, function($font) {
                $font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
                $font->size(30);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });


            $txtarry2 = array(
                              "PERSISTENC",
                              "CURIOSITY",
                              "SHORT MEMORY",
                              "WONDER",
                              "FAITH",
                            );
            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt2 = $txtarry2[$i];
            $img->text("YOUR CHILD LIKE", 540,70, function($font) {
            $font->file('fonts/en/Slackey/Slackey-Regular.ttf');

            $font->size(33);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $img->text($overtxt2, 540,130, function($font) {
          //  $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
            $font->file('fonts/en/Faster_One/FasterOne-Regular.ttf');
            $font->size(50);
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
            $canvas->insert($watermark, 'top-left' ,5,5);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app13_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$overtxt."</b></p>";
            $app_sub_description = "<p class='subtext'>Share this result with your everyone and let them know about this.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"13",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[12]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app13--

//----What Does Your Profile Photo NOT Reveal About Your Personality?---------------------app14--

          public function en_app14(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[13]['app_title']);
                MetaTag::set('description',$this->app_store_info[13]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"14",'app_title'=>$this->app_store_info[13]['app_title'],'app_img_orignal_url'=>$this->app_store_info[13]['app_img_orignal_url'],'app_description'=>$this->app_store_info[13]['app_description']));

          }

          public function en_app14_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app14/bg-sample/Product_bg.png");

            $txtarry = array(
              "Your profile photo does not reveal your - Positive Attitude and Perseverance ",
              "Your profile photo does not reveal your - Willpower",
              "Your profile photo does not reveal your - Action Oriented Nature",
              "Your profile photo does not reveal your - Expertise and Excellence ",
              "Your profile photo does not reveal your - Definite Aim, Vision, and Purpose ",
            );

            $i = rand(0, count($txtarry)-1); // generate random number size of the array
            $overtxt = $txtarry[$i]; // set variable equal to which random filename was chosen
            $string = wordwrap($overtxt,30,"|");
            //create array of lines
            $strings = explode("|",$string);
            $i=50; //top position of string
            //for each line added
            foreach($strings as $string){
            $img->text($string, 240, $i, function($font) {
            //$font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            //$font->file('fonts/en/Risque/Risque-Regular.ttf');
            $font->file('fonts/en/Josefin_Sans/JosefinSans-Regular.ttf');
            $font->size(30);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+32; //shift top postition down 42
            }

            $txtarry2 = array(
              "You have realistic optimism. Realistic because you take action and optimistic because no matter what the result may be,you believe your success is inevitable.",
              "You do not waste your willpower on irrelevant challenges Instead,you make sure to only concern yourself with that which matters to you.",
              "You are doers and not a tolker.you don`t wait for condition to be perfect before you take action.you just go for it,observe the feedback and than modify your next action accordingly.",
              "No matter what you pursue,you become the best in your field. There is no job too small,and you strive for excellence.",
              "You constantly seek clarity in your life.You know what you want and follow your dream.Vague desires and beliefs lead to vague outcomes."
            );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt2 = $txtarry2[$i]; // set variable equal to which random filename was chosen
            $string2 = wordwrap($overtxt2,35,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=210; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 250, $i, function($font) {
            //$font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            //$font->file('fonts/en/Risque/Risque-Regular.ttf');
          //  $font->file('fonts/en/Josefin_Sans/JosefinSans-Regular.ttf');
            $font->file('fonts/en/Acme/Acme-Regular.ttf');
            $font->size(30);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+34; //shift top postition down 42
            }


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(350,350, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,470,35);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app14_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, you are an expert in hiding many facts about you. Nobody can predict what’s running in your mind through your face too.</p>";
            $app_description .= "<p class='subtext'><b>".$overtxt."</b></p>";
            $app_sub_description = "<p class='subtext'>Share the result with your friends and reveal your secrets.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"14",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[13]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app14--

//-----Which Word Reflects Your Love Life?------------------------------------------------app15--

          public function en_app15(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[14]['app_title']);
                MetaTag::set('description',$this->app_store_info[14]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"15",'app_title'=>$this->app_store_info[14]['app_title'],'app_img_orignal_url'=>$this->app_store_info[14]['app_img_orignal_url'],'app_description'=>$this->app_store_info[14]['app_description']));

          }

          public function en_app15_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app15/bg-sample/Product_bg.png");

            $txtarry2 = array(
                            "Loyalty","Romance","Forever","Caring","Unconditional","Beautiful","Wild","Special"
                            );
            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt = $txtarry2[$i];
            $img->text($overtxt, 400,145, function($font) {
          //  $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
            //$font->file('fonts/en/Faster_One/FasterOne-Regular.ttf');
            $font->file('fonts/en/Monoton/Monoton-Regular.ttf');
            $font->size(40);
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
            $canvas->insert($watermark, 'top-left' ,305,210);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app15_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,<b>".$overtxt."</b> is a perfect word that reflects your love life. You love your partner a lot and always try to keep them happy and safe. Their happiness matters a lot to you, and you arrange frequent surprises and gifts to keep your love refreshing and exciting.</p>";
            $app_sub_description = "<p class='subtext'>Tag your love; share this result with everyone and let them also discover the word that reflects their love life.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"15",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[14]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app15--

//----What Strength Has God Blessed You With?----------------------------------------------------app16--

          public function en_app16(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[15]['app_title']);
                MetaTag::set('description',$this->app_store_info[15]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"16",'app_title'=>$this->app_store_info[15]['app_title'],'app_img_orignal_url'=>$this->app_store_info[15]['app_img_orignal_url'],'app_description'=>$this->app_store_info[15]['app_description']));

          }

          public function en_app16_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app16/bg-sample/Product_bg.png");

            $txtarry2 = array(
                            "Loyalty","Romance","Forever","Caring","Unconditional","Beautiful","Wild","Special"
                            );
            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt = $txtarry2[$i];
            $img->text($overtxt, 230,375, function($font) {
          //  $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
            //$font->file('fonts/en/Faster_One/FasterOne-Regular.ttf');
            //$font->file('fonts/en/Monoton/Monoton-Regular.ttf');
          //  $font->file('fonts/en/BungeeInline/BungeeInline-Regular.ttf');
            $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
            $font->size(36);
            $font->color('#FFEA00');
            $font->align('center');
            $font->valign('middle');
            });


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(210,210, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,100,10);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app16_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, God has blessed you with many strengths; one of them is <b>".$overtxt."</b>. GOD help those who help themselves. You always put your best efforts to make the work complete efficiently. You didn't believe on procrastination and never leave the work for tomorrow. You put all your hard work and creativity in a single work.</p>";
            $app_sub_description = "<p class='subtext'>Share this result with your friends and let them know about the strength god blessed them with.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"16",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[15]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app16--

//-----What Compliment You Are Tired Of?----------------------------------------------------app17--

          public function en_app17(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[16]['app_title']);
                MetaTag::set('description',$this->app_store_info[16]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"17",'app_title'=>$this->app_store_info[16]['app_title'],'app_img_orignal_url'=>$this->app_store_info[16]['app_img_orignal_url'],'app_description'=>$this->app_store_info[16]['app_description']));

          }

          public function en_app17_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app17/bg-sample/Product_bg.png");

            $txtarry2 = array(
                              "You have the best ideas.",
                              "Your smile is contagious.",
                              "Your eyes are breathtaking",
                              "Your hair looks stunning.",
                              "You have a great sense of humor.",
                              "Your voice is magnificent.",
                              "You light up the room.",
                              "You look great today"
                              );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt2 = $txtarry2[$i]; // set variable equal to which random filename was chosen
            $string2 = wordwrap($overtxt2,18,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=300; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 580, $i, function($font) {
            //$font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            //$font->file('fonts/en/Risque/Risque-Regular.ttf');
          //  $font->file('fonts/en/Josefin_Sans/JosefinSans-Regular.ttf');
          //  $font->file('fonts/en/Acme/Acme-Regular.ttf');
            $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
          //  $font->file('fonts/en/FredokaOne/FredokaOne-Regular.ttf');
            //$font->file('fonts/en/SigmarOne/SigmarOne-Regular.ttf');
            $font->size(34);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+45; //shift top postition down 42
            }


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(220,220, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,100,15);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app17_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>AHA! That’s nice. <b>".$posts->first_name."</b>, you are such an extraordinary person that now you are tired of the compliments. There was a time when you felt great when people gave compliments, and now you won’t get excited about them anymore.</p>";
            $app_sub_description = "<p class='subtext'>Share this result with everyone and ask them to come up with something new.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"17",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[16]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app17--
//----Create a Beautiful Happy Diwali Greeting and Send Your Loved Ones!-------------------app18--

          public function en_app18(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[17]['app_title']);
                MetaTag::set('description',$this->app_store_info[17]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"18",'app_title'=>$this->app_store_info[17]['app_title'],'app_img_orignal_url'=>$this->app_store_info[17]['app_img_orignal_url'],'app_description'=>$this->app_store_info[17]['app_description']));

          }

          public function en_app18_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app18/bg-sample/Product_bg.png");

            $txtarry2 = array(
                              "May millions of lamps illuminate Ur life with endless joy,prosperity,health and wealth forever.",
                              "Light a lamp of love! Blast a chain of sorrow!Shoot a rocket of prosperity!",
                              "Fortunate is the one who has learned to admire, but not to envy. Good wishes for a peaceful and prosperous Diwali.",
                              "May the divine light of Diwali spread into your life / Peace, prosperity, happiness and good health. Happy Deepawali",
                              "On the auspicious day of Diwali, Wishing you success, Happiness, and Prosperity, Happy Diwali.",
                              "I'm maachis and you're pataka, Together we are and it will be double dhamaka!!! Happy Diwali.",
                              "Trouble as light as air, love as deep as the ocean / Friends as solid as diamonds, success as bright as gold",
                              "Happiness is in air Its Deepawali everywhere Lets show some love and Respect And wish everyone out there Happy Diwali.",
                              "Diwali night is full of lights,Crackers may your life be filled with colors and lights of happiness",
                              );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt2 = $txtarry2[$i]; // set variable equal to which random filename was chosen
            $string2 = wordwrap($overtxt2,20,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=120; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 200, $i, function($font) {
            //$font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            //$font->file('fonts/en/Risque/Risque-Regular.ttf');
            $font->file('fonts/en/Josefin_Sans/JosefinSans-Regular.ttf');
          //  $font->file('fonts/en/Acme/Acme-Regular.ttf');
            //$font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
           //$font->file('fonts/en/FredokaOne/FredokaOne-Regular.ttf');
            //$font->file('fonts/en/SigmarOne/SigmarOne-Regular.ttf');
            $font->size(32);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+34; //shift top postition down 42
            }


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
            $image_name = 'en_app18_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>Send this beautiful Happy Diwali Greeting with your family and friends!</p>";
            $app_sub_description = "<p class='subtext'></p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"18",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[17]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app18--

//----Which Rock Band Do You Belong To?----------------------------------------------------app19--

          public function en_app19(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[18]['app_title']);
                MetaTag::set('description',$this->app_store_info[18]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"19",'app_title'=>$this->app_store_info[18]['app_title'],'app_img_orignal_url'=>$this->app_store_info[18]['app_img_orignal_url'],'app_description'=>$this->app_store_info[18]['app_description']));

          }

          public function en_app19_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app19/bg-sample/Product_bg.png");

            $txtarry2 = array(
                            "The Beatles","Guns N Roses","Pink Floyd","Metallica","Led Zeppelin",
                            "AC/DC",
                              );

                              $i = rand(0, count($txtarry2)-1); // generate random number size of the array
                              $overtxt = $txtarry2[$i];
                              $img->text($overtxt,640,380, function($font) {
                            //  $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                              //$font->file('fonts/en/Faster_One/FasterOne-Regular.ttf');
                              //$font->file('fonts/en/Monoton/Monoton-Regular.ttf');
                            //  $font->file('fonts/en/BungeeInline/BungeeInline-Regular.ttf');
                            //  $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                              $font->file('fonts/en/Creepster/Creepster-Regular.ttf');
                              $font->size(40);
                              $font->color('#fff');
                              $font->align('center');
                              $font->valign('middle');
                              });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(240,240, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,5,110);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app19_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,you belong to <b>".$overtxt."</b>. You have such an amazing voice and knows to play many instruments. You deserve to be in <b>".$overtxt."</b></p>";
            $app_sub_description = "<p class='subtext'>Share this result with everyone and let them know about this.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"19",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[18]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app19--

//----What Are Three Truths About You?-----------------------------------------------------app20--

          public function en_app20(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[19]['app_title']);
                MetaTag::set('description',$this->app_store_info[19]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"20",'app_title'=>$this->app_store_info[19]['app_title'],'app_img_orignal_url'=>$this->app_store_info[19]['app_img_orignal_url'],'app_description'=>$this->app_store_info[19]['app_description']));

          }

          public function en_app20_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app20/bg-sample/Product_bg.png");

            $txtarry = array(
                              "Very fond of trying new cuisines.",
                              "Never depend on anyone for anything.",
                              "Change the gear of life according to the situation.",
                              "Extremely cool and generous person.",
                              "Knows how to make a place in someone`s heart.",
                              "Never betray anyone",
                              "Prisoner of own beliefs.",
                              );

                              $random_keys=array_rand($txtarry,3);
                              $overtxt1 = $txtarry[$random_keys[0]];
                              $overtxt2 = $txtarry[$random_keys[1]];
                              $overtxt3 = $txtarry[$random_keys[2]];

                              $string1 = wordwrap($overtxt1,30,"|");
                              $strings1= explode("|",$string1);
                              $i=60;
                              foreach($strings1 as $string){
                              $img->text($string,225, $i, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(28);
                              $font->color('#fff');
                              $font->align('center');
                              $font->valign('middle');
                              });
                              $i=$i+34; //shift top postition down 42
                              }


                              $string2 = wordwrap($overtxt2,30,"|");
                              $strings2 = explode("|",$string2);
                              $i=200;
                              foreach($strings2 as $string){
                              $img->text($string,225, $i, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(28);
                              $font->color('#fff');
                              $font->align('center');
                              $font->valign('middle');
                              });
                              $i=$i+34; //shift top postition down 42
                              }

                              $string3 = wordwrap($overtxt3,30,"|");
                              $strings3 = explode("|",$string3);
                              $i=340;
                              foreach($strings3 as $string){
                              $img->text($string,225, $i, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(28);
                              $font->color('#fff');
                              $font->align('center');
                              $font->valign('middle');
                              });
                              $i=$i+34; //shift top postition down 42
                              }
            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(440,440, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,420,0);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app20_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, these are the three truths about you. No one knows about this except you. Now it’s the time to reveal it in public and collect some compliments and appreciation for yourself.</p>";
            $app_sub_description = "<p class='subtext'>Share this result with your everyone and let them know about this.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"20",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[19]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app20--

//----At What Age Will You Get Married?----------------------------------------------------app21--

          public function en_app21(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[20]['app_title']);
                MetaTag::set('description',$this->app_store_info[20]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"21",'app_title'=>$this->app_store_info[20]['app_title'],'app_img_orignal_url'=>$this->app_store_info[20]['app_img_orignal_url'],'app_description'=>$this->app_store_info[20]['app_description']));

          }

          public function en_app21_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app21/bg-sample/Product_bg.png");

                              $overtxt = rand(20,60);
                              $img->text($overtxt,200,320, function($font) {
                            //  $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                              //$font->file('fonts/en/Faster_One/FasterOne-Regular.ttf');
                            //  $font->file('fonts/en/Monoton/Monoton-Regular.ttf');
                              $font->file('fonts/en/Nosifer/Nosifer-Regular.ttf');
                              $font->size(150);
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
            $canvas->insert($watermark, 'top-right' ,10,130);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app21_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>Wow <b>".$posts->first_name."</b>! You would get married at the age of <b>".$overtxt."</b>. The real act of marriage takes place in the heart, not in the ballroom or church or synagogue. It's a choice you make–not just on your wedding day, but over and over again–and that choice is reflected in the way you treat your husband or wife.</p>";
            $app_sub_description = "<p class='subtext'>Share the result with your friends and let them find out their age of marriage.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"21",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[20]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app21--

//----How Would Your Indian Army ID Card Look Like?----------------------------------------app22--

          public function en_app22(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[21]['app_title']);
                MetaTag::set('description',$this->app_store_info[21]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"22",'app_title'=>$this->app_store_info[21]['app_title'],'app_img_orignal_url'=>$this->app_store_info[21]['app_img_orignal_url'],'app_description'=>$this->app_store_info[21]['app_description']));

          }

          public function en_app22_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app22/bg-sample/Product_bg.png");

            $uname = $posts->name;
            $img->text($uname, 122, 136, function($font) {
              $font->file('fonts/en/Source_Sans_Pro/SourceSansPro-Regular.ttf');
                $font->size(21);
                $font->color('#000');
                $font->align('left');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $Gender = $posts->Gender;
            $img->text($Gender, 100,178, function($font) {
              $font->file('fonts/en/Source_Sans_Pro/SourceSansPro-Regular.ttf');
                $font->size(21);
                $font->color('#000');
                $font->align('left');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });



        $Regiment = array("Madras Regiment",
                                 "Rajputana Rifle",
                                 "Rajput Regiment",
                                 "Dogra Regiment",
                                 "Sikh Regiment",
                                 "Jat Regiment",
                                 "Parachute Regiment",
                                 "Punjab Regiment",
                                 "The Grenadiers",
                                 "Sikh Light Infantry",
                                 "Maratha Light Infantry",
                                 "The Garhwal Rifles",
                                 "Kumaon Regiment",
                                 "Assam Regiment",
                                 "Bihar Regiment",
                                 "Mahar Regiment",
                                 "Jammu & Kashmir Rifles",
                                 "Jammu and Kashmir Light Infantry",
                                 "Gorkha Rifles",
                          );



          $location = array("Wellington, Tamil Nadu",
                               "Delhi Cantonment",
                               "Fatehgarh, Uttar Pradesh",
                               "Faizabad, Uttar Pradesh",
                               "Ramgarh Cantonment, Jharkhand",
                               "Bareilly, Uttar Pradesh",
                               "Bangalore, Karnataka",
                               "Ramgarh Cantonment, Jharkhand",
                               "Jabalpur, Madhya Pradesh",
                               "Fatehgarh, Uttar Pradesh",
                               "Belgaum, Karnataka",
                               "Lansdowne, Uttarakhand",
                               "Ranikhet, Uttarakhand",
                               "Shillong, Meghalaya",
                               "Danapur, Bihar",
                               "Saugor, Madhya Pradesh",
                               "Jabalpur, Madhya Pradesh",
                               "Avantipur, Jammu and Kashmir",
                               "Sabathu, Himachal Pradesh",
                            );


                          $i = rand(0, count($Regiment)-1); // generate random number size of the array
                          $overtxt1 = $Regiment[$i];
                          $overtxt2 = $location[$i];

                          $img->text($overtxt1,158,222, function($font) {
                          $font->file('fonts/en/Source_Sans_Pro/SourceSansPro-Regular.ttf');
                          $font->size(21);
                          $font->color('#000');
                          $font->align('left');
                          $font->valign('middle');
                          });


                        $img->text($overtxt2,145,265, function($font) {
                        $font->file('fonts/en/Source_Sans_Pro/SourceSansPro-Regular.ttf');
                        $font->size(21);
                        $font->color('#000');
                        $font->align('left');
                        $font->valign('middle');
                        });
        $designation = array("General",
                                  "Lt. General",
                                  "Major General",
                                  "Brigadier",
                                  "Colonel",
                                  "Lt. Colonel",
                                  "Major",
                                  "Captain",
                                  "Lieutenant",
                                  "The Grenadiers",
                                  "5 Armoured Regiment",
                                  "Sikh Regiment",
                                  "Scouts",
                                  "8 Cavalry",
                                  "Lance Naik",
                                  "Naib subedar",
                                  "Havildar",
                                  "Field Marshal",
                                  "Lieutenant General",
                          );

                          $a = rand(0, count($designation)-1); // generate random number size of the array
                          $overtxt3 = $designation[$a];

                          $img->text($overtxt3,180,305, function($font) {
                          $font->file('fonts/en/Source_Sans_Pro/SourceSansPro-Regular.ttf');
                          $font->size(21);
                          $font->color('#000');
                          $font->align('left');
                          $font->valign('middle');
                          });

                       $cardID = mt_rand(10000000, 99999999);

                        $img->text($cardID,690,378, function($font) {
                      //$font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                        $font->file('fonts/en/Source_Sans_Pro/SourceSansPro-Regular.ttf');
                        $font->size(21);
                        $font->color('#000');
                        $font->align('center');
                        $font->valign('middle');
                        });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(280,280, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,10,122);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app22_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>Wow <b>".$posts->first_name.".</b> This is how your ID Card would look like if you would join Indian Army. You sleep peacefully at your homes because Indian Army is guarding frontiers. Let us salute the Army</p>";
            $app_sub_description = "<p class='subtext'>Share the result with everyone and let them make their ID Card.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"22",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[21]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app22--

//----Who Are You When You Get Mad?----------------------------------------------------app23--

          public function en_app23(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[22]['app_title']);
                MetaTag::set('description',$this->app_store_info[22]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"23",'app_title'=>$this->app_store_info[22]['app_title'],'app_img_orignal_url'=>$this->app_store_info[22]['app_img_orignal_url'],'app_description'=>$this->app_store_info[22]['app_description']));

          }

          public function en_app23_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);


              $dir = "images/english/app23/bg-sample/";
              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);
              $ext = pathinfo($img_path);
              $overtxt = $ext['filename'];

            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 200, 303, function($font) {
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
              //  $font->file('fonts/en/Lora/Lora-Bold.ttf');
                $font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
                $font->size(42);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(400, 400, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',0, 0);
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
            $image_name = 'en_app23_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
           // $img->save('images/fb1.jpg');

           $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, you turn into <b>".$overtxt."</b> when you get mad. You can become mad and angry at the same time, but you have some control. You know to be angry at the right person and to the right degree and at the right time and for the right purpose, and in the right way — that is not within everybody's power and is not easy.</p>";
           $app_sub_description = "<p class='subtext'>Share the result and beware people not to make you mad.</p>";

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
           //return  $img->response('jpg');
           //return view('/share',array('app_no'=>"1",'img'=>$img));
           $html = view('english.Result_Share_fb_page',array('app_no'=>"23",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[22]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app23--

//----What Can Be The Smartest Decision Of Your Life?--------------------------------app24--

          public function en_app24(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[23]['app_title']);
                MetaTag::set('description',$this->app_store_info[23]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"24",'app_title'=>$this->app_store_info[23]['app_title'],'app_img_orignal_url'=>$this->app_store_info[23]['app_img_orignal_url'],'app_description'=>$this->app_store_info[23]['app_description']));

          }

          public function en_app24_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app24/bg-sample/Product_bg.png");

            $txtarry2 = array(
                                  "Stop Talking and Start Listening To Become a Better Person.",
                                  "Investing Money To Have a  Better Future.",
                                  "Travel A New Destination in Every 2 Months To Keep Yourself Rejuvenated",
                                  "Stop Thinking 'What People Will Think About You.'",
                                  "Remove All Negativity From Your Life & Only Look Forward.",
                                  "Exercise On Daily Basis To Keep Yourself Fit.",
                              );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt1 = $txtarry2[$i]; // set variable equal to which random filename was chosen
            $string2 = wordwrap($overtxt1,15,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=125; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 620, $i, function($font) {
        //    $font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            //$font->file('fonts/en/Risque/Risque-Regular.ttf');
          //  $font->file('fonts/en/Josefin_Sans/JosefinSans-Regular.ttf');
          //  $font->file('fonts/en/Acme/Acme-Regular.ttf');
            //$font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
           //$font->file('fonts/en/FredokaOne/FredokaOne-Regular.ttf');
            //$font->file('fonts/en/SigmarOne/SigmarOne-Regular.ttf');
            $font->size(36);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+40; //shift top postition down 42
            }

            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 180, 340, function($font) {
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
              //  $font->file('fonts/en/Lora/Lora-Bold.ttf');
              //  $font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
                $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                $font->size(35);
                $font->color('#000');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(300,300, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,35,45);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app24_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, the decision which can change your life forever and become the smartest one ever is</p>";
            $app_sub_description = "<p class='subtext'>Share the result and let your friends know what your next big decision will be.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"24",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[23]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app24--

//----5 Facts About You!----------------------------------------------------app25--

          public function en_app25(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[24]['app_title']);
                MetaTag::set('description',$this->app_store_info[24]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"25",'app_title'=>$this->app_store_info[24]['app_title'],'app_img_orignal_url'=>$this->app_store_info[24]['app_img_orignal_url'],'app_description'=>$this->app_store_info[24]['app_description']));

          }

          public function en_app25_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app25/bg-sample/Product_bg.png");
            $overtxt2 = $posts->name;
            $img->text($overtxt2, 200, 80, function($font) {
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
              // $font->file('fonts/en/Lora/Lora-Bold.ttf');
               //$font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
               $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
            //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                $font->size(40);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });
            $txtarry = array(
                            "Clear-headed",
                            "Daring",
                            "Stylish",
                            "Ambitious",
                            "Naughty",
                            "Pure",
                            "Soft",
                            "Emotional ",
                            "Artful",
                            "Selfless",
                            "Creative",
                            "Adventurous",
                            "Attractive",
                            "Colorful",
                            "Loves Driving",
                            "Romantic",
                            "Foody",
                            "Protective",
                            "Unpredictable"
                              );

                              $random_keys=array_rand($txtarry,5);
                              $overtxt1 = "Is ".$txtarry[$random_keys[0]];
                              $overtxt2 = "Is ".$txtarry[$random_keys[1]];
                              $overtxt3 = "Is ".$txtarry[$random_keys[2]];
                              $overtxt4 = "Is ".$txtarry[$random_keys[3]];
                              $overtxt5 = "Is ".$txtarry[$random_keys[4]];


                              $img->text($overtxt1,80, 148, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(32);
                              $font->color('#4519D2');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt2,80,204, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(32);
                              $font->color('#19C3D2');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt3,80, 260, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(32);
                              $font->color('#D219B1');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt4,80, 320, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(32);
                              $font->color('#D24919');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt5,80, 380, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(32);
                              $font->color('#D2B619');
                              $font->align('left');
                              $font->valign('middle');
                              });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(440,440, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,450,0);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app25_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,these are the five facts about you. No beauty shines better than that of your good heart.</p>";
            $app_description .="<p class='subtext'>Your every struggle of your life has shaped you into the person you are today. BE THANKFUL for the hard time you had; they can only make you STRONGER.</p>";
            $app_sub_description = "<p class='subtext'>Share this result with your friends and let them know facts about you.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"25",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[24]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app25--

//----You are You Coz?---------------------------------------------------app26--

          public function en_app26(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[25]['app_title']);
                MetaTag::set('description',$this->app_store_info[25]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"26",'app_title'=>$this->app_store_info[25]['app_title'],'app_img_orignal_url'=>$this->app_store_info[25]['app_img_orignal_url'],'app_description'=>$this->app_store_info[25]['app_description']));

          }

          public function en_app26_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app26/bg-sample/Product_bg.png");

            $txtarry2 = array(
                                "You never stop fighting until you arrive at your destined place - that is, the unique you. ",
                                "You stay true to yourself and never give up on your dreams, even when nobody else believes they can come true but you do. ",
                                "When something is important enough, you do it even if the odds are not in your favor. ",
                                "It does not matter how slowly you go as long as you don't stop.",
                                "You work hard for what you want because it won't come to you without a fight.",
                               " You are strong enough and courageous and know that you can do anything you put your mind to. ",
                          );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt = $txtarry2[$i]; // set variable equal to which random filename was chosen
            $string2 = wordwrap($overtxt,20,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=160; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 560, $i, function($font) {
            //$font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            //$font->file('fonts/en/Risque/Risque-Regular.ttf');
            $font->file('fonts/en/Josefin_Sans/JosefinSans-Regular.ttf');
          //  $font->file('fonts/en/Acme/Acme-Regular.ttf');
            //$font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
           //$font->file('fonts/en/FredokaOne/FredokaOne-Regular.ttf');
            //$font->file('fonts/en/SigmarOne/SigmarOne-Regular.ttf');
            $font->size(34);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+36; //shift top postition down 42
            }


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(300,300, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,20,70);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app26_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, you are you coz: <b>".$overtxt."</b></p>";
            $app_sub_description = "<p class='subtext'>Share this result with everyone and let them know about yourself.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"26",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[25]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app26--

//---How Awesome Are You?-----------------------------------------------------app27--

          public function en_app27(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[26]['app_title']);
                MetaTag::set('description',$this->app_store_info[26]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"27",'app_title'=>$this->app_store_info[26]['app_title'],'app_img_orignal_url'=>$this->app_store_info[26]['app_img_orignal_url'],'app_description'=>$this->app_store_info[26]['app_description']));

          }

          public function en_app27_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app27/bg-sample/Product_bg.png");


            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 140, 358, function($font) {
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
              //  $font->file('fonts/en/Lora/Lora-Bold.ttf');
              //  $font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                  $font->file('fonts/en/Lobster/Lobster-Regular.ttf');
                $font->size(35);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });




            $txtarry2 = array(
                                "Your smile lights up the room,Your mind is insanely cool.You are Way more than enough.And you are doing an amazing job at life",
                                "You Show respect even to people who don't deserve it,not as a reflection of their character,but as a reflection of yours.",
                                "You don't let other to rent a space in your head unless they are a good tenant.",
                             );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt = $txtarry2[$i]; // set variable equal to which random filename was chosen
            $string2 = wordwrap($overtxt,22,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=90; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 550, $i, function($font) {
          $font->file('fonts/en/Lobster/Lobster-Regular.ttf');
          //  $font->file('fonts/en/ConcertOne/ConcertOne-Regular.ttf');
            $font->size(44);
            $font->color('#007EFF');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+45; //shift top postition down 42
            }


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(400,400, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,-30,0);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app27_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>In case you have not been adequately informed, please consider this official notification that you are AWESOME.</p>";
            $app_sub_description = "<p class='subtext'>Share this beautiful result with your everyone and let them know about your AWESOME version.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"27",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[26]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app27--

//----What Does Your Love First Aid Box Contain?---------------------------------------------app28--

          public function en_app28(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[27]['app_title']);
                MetaTag::set('description',$this->app_store_info[27]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"28",'app_title'=>$this->app_store_info[27]['app_title'],'app_img_orignal_url'=>$this->app_store_info[27]['app_img_orignal_url'],'app_description'=>$this->app_store_info[27]['app_description']));

          }

          public function en_app28_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app28/bg-sample/Product_bg.png");

            $txtarry = array(
                              "ANTISEPTIC OF TRUST",
                              "BANDAGE OF COMPLETE CARE",
                              "INJECTION OF LOVE ",
                              "SOME MOTIVATING WORDS",
                              "HIGH DOSE OF LOVE",
                              "INJECTION OF HIGH COMMUNICATION",
                              "BUNDLE OF CARE ",
                              "GOOD MUSIC TO RELIEVE PAIN",
                              "BANDAGE OF UNDERSTANDINGS",
                              "TABLETS OF GOOD MEMORIES",
                              );

                              $random_keys=array_rand($txtarry,3);
                              $overtxt1 = $txtarry[$random_keys[0]];
                              $overtxt2 = $txtarry[$random_keys[1]];
                              $overtxt3 = $txtarry[$random_keys[2]];


                              $img->text($overtxt1,400,65, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(22);
                              $font->color('#FA111A');
                              $font->align('left');
                              $font->valign('middle');
                              });


                              $img->text($overtxt2,400,180, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(22);
                              $font->color('#FA111A');
                              $font->align('left');
                              $font->valign('middle');
                              });


                              $img->text($overtxt3,400,295, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(22);
                              $font->color('#FA111A');
                              $font->align('left');
                              $font->valign('middle');
                              });


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(200,200, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,60,105);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app28_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, your Love First Aid box contains: <br> <b>".$overtxt1."</b> <br> <b>".$overtxt2."</b> <br> <b>".$overtxt3."</b></p>";
            $app_sub_description = "<p class='subtext'>You believe that love is the only component that makes life complete and worth living. Share this result with everyone and let them know about your Love First Aid Box.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"28",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[27]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app28--

//----Which Celebrity Would You Date?----------------------------------------------------app29--

          public function en_app29(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[28]['app_title']);
                MetaTag::set('description',$this->app_store_info[28]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"29",'app_title'=>$this->app_store_info[28]['app_title'],'app_img_orignal_url'=>$this->app_store_info[28]['app_img_orignal_url'],'app_description'=>$this->app_store_info[28]['app_description']));

          }

          public function en_app29_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);

              if($posts->Gender == "male"){
              $dir = "images/english/app29/bg-sample/female";
               }
              else{
              $dir = "images/english/app29/bg-sample/male";
              }

              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];




              $img = Image::make($img_path);
              $ext = pathinfo($img_path);
              $overtxt = $ext['filename'];

            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 140,27, function($font) {
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                $font->file('fonts/en/Lora/Lora-Bold.ttf');
                //$font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
                $font->size(33);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(300, 300, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',5,65);
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
            $image_name = 'en_app29_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
            // $img->save('images/fb1.jpg');

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
            //return  $img->response('jpg');
            //return view('/share',array('app_no'=>"1",'img'=>$img));

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,you would date <b>".$overtxt."</b> in future. You both share the common interest and nature. You look perfect with each other and when someone comes into your life God sent them for a reason, Either to learn from them or to be with them until the end.</p>";
            $app_sub_description = "<p class='subtext'>Share this result with your friends and make them jealous.</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"29",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[28]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app29--

//----What Is The Color Of Your Heart?----------------------------------------------------app30--

          public function en_app30(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[29]['app_title']);
                MetaTag::set('description',$this->app_store_info[29]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"30",'app_title'=>$this->app_store_info[29]['app_title'],'app_img_orignal_url'=>$this->app_store_info[29]['app_img_orignal_url'],'app_description'=>$this->app_store_info[29]['app_description']));

          }

          public function en_app30_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);


              $dir = "images/english/app30/bg-sample/";
              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);

              $markimg = $posts->picture;
              $watermark = Image::make($markimg);
              $watermark->resize(400, 400, function ($constraint){
                  $constraint->aspectRatio();
              });

              $canvas = Image::canvas(800, 420);
              $canvas->insert($watermark, 'top-left',-30,60);
              $canvas->insert($img);


            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app30_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,your attitude is like a box of crayons that color your world. You always start a day with a grateful heart. Deep inside, you have a kind soul that shines brightly in this wonderful color. That's why this color reflects your best qualities as well. </p>";
            $app_sub_description = "<p class='subtext'>Share your result so your friends can also find out which color their heart is!</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"30",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[29]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app30--
//----Which Halloween Creature Are You?-------------------------------------------------app31--

          public function en_app31(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[30]['app_title']);
                MetaTag::set('description',$this->app_store_info[30]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"31",'app_title'=>$this->app_store_info[30]['app_title'],'app_img_orignal_url'=>$this->app_store_info[30]['app_img_orignal_url'],'app_description'=>$this->app_store_info[30]['app_description']));

          }

          public function en_app31_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);

              $dir = "images/english/app31/bg-sample/";
              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);
              $ext = pathinfo($img_path);
              $overtxt = $ext['filename'];


              $markimg = $posts->picture;
              $watermark = Image::make($markimg);
              $watermark->resize(250, 250, function ($constraint){
                  $constraint->aspectRatio();
              });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right',73,73);
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
            $image_name = 'en_app31_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
            // $img->save('images/fb1.jpg');

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
            //return  $img->response('jpg');
            //return view('/share',array('app_no'=>"1",'img'=>$img));

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, Boo! Bet you didn't expect it. But, that's the truth. You are a <b>".$overtxt."</b>  Halloween has been associated with scary monsters, strange creatures and you are one of them.</p>";
            $app_sub_description = "<p class='subtext'>Let's share the result with your friends and family, Give them a chance to find out the Halloween creature they are!</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"31",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[30]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app31--

//-----What Do Your Eyes Reveal About You?--------------------------------------------------app32--

          public function en_app32(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[31]['app_title']);
                MetaTag::set('description',$this->app_store_info[31]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"32",'app_title'=>$this->app_store_info[31]['app_title'],'app_img_orignal_url'=>$this->app_store_info[31]['app_img_orignal_url'],'app_description'=>$this->app_store_info[31]['app_description']));

          }

          public function en_app32_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app32/bg-sample/Product_bg.png");


            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 550, 70, function($font) {
                $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
              //  $font->file('fonts/en/Lora/Lora-Bold.ttf');
              //  $font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                  //$font->file('fonts/en/Lobster/Lobster-Regular.ttf');
                //  $font->file('fonts/en/Macondo/Macondo-Regular.ttf');
                $font->size(34);
                $font->color('#00CCFF');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });


            $txtarry2 = array(
                                  "Your eyes reveal that Your mission in life is not merely to survive ,but to thrive ; and to do so with some passion,somw compassion,some humor,and some style.",
                                  "Your eyes reveal that you always stay true to yourself,yet always be open to learn. work hard,and never give up on your dreams,even when nobody else believes they ans come true but you.",
                                  "Your eyes reveal that you never get tired of smiling. you're just the kind of person who likes to smile.",
                             );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt = $txtarry2[$i]; // set variable equal to which random filename was chosen
            $string2 = wordwrap($overtxt,25,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=170; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 600, $i, function($font) {
              //$font->file('fonts/en/Lobster/Lobster-Regular.ttf');
           //$font->file('fonts/en/ConcertOne/ConcertOne-Regular.ttf');
           $font->file('fonts/en/Macondo/Macondo-Regular.ttf');
            $font->size(28);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+30; //shift top postition down 42
            }

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(150,150, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,-5,6); //right - top
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app32_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,your eyes are the window to your personality and truly reflect your soul. You are very passionate and creative in your personality. You look at the world through a more logical, analytical lens. Your eyes mark great creativity and imagination, and you often escape reality by going inside your mind </p>";
            $app_sub_description = "<p class='subtext'>Share this result with everyone and let them know what does your eye reveals about you!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"32",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[31]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app32--
//----Which Rapper Wants to Train You?-------------------------------------------------app33--

          public function en_app33(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[32]['app_title']);
                MetaTag::set('description',$this->app_store_info[32]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"33",'app_title'=>$this->app_store_info[32]['app_title'],'app_img_orignal_url'=>$this->app_store_info[32]['app_img_orignal_url'],'app_description'=>$this->app_store_info[32]['app_description']));

          }

          public function en_app33_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);


              $dir = "images/english/app33/bg-sample/";
              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);
              $ext = pathinfo($img_path);
              $overtxt = $ext['filename'];

            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 230,310, function($font) {
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                //$font->file('fonts/en/Lora/Lora-Bold.ttf');
                 $font->file('fonts/en/Oswald/Oswald-Bold.ttf');
                $font->size(36);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(300, 300, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',80,10);
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
            $image_name = 'en_app33_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
            // $img->save('images/fb1.jpg');

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
            //return  $img->response('jpg');
            //return view('/share',array('app_no'=>"1",'img'=>$img));

            $app_description = "<p class='subtext'>OMFG! <b>".$posts->first_name."</b>, you are going to get a chance of RAP TRAINING from none other than <b>".$overtxt."</b> . Yes, we know, it's unbelievable but it's true. This is one in a lifetime chance which will get soon. All you need is to spread the news.</p>";
            $app_sub_description = "<p class='subtext'>Share the result with your friends and tell the whole world about it good news.</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"33",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[32]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app33--

//----Which Half-human Are You Based On Your Photo?------------------------------------------app34--

          public function en_app34(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[33]['app_title']);
                MetaTag::set('description',$this->app_store_info[33]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"34",'app_title'=>$this->app_store_info[33]['app_title'],'app_img_orignal_url'=>$this->app_store_info[33]['app_img_orignal_url'],'app_description'=>$this->app_store_info[33]['app_description']));

          }

          public function en_app34_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);


              $img = Image::make("images/english/app34/bg-sample/Product_bg.png");

              $txtarry = array(
                                "Alien.","Spider.","Owl","Cartoon"
                               );

              $i = rand(0, count($txtarry)-1); // generate random number size of the array
              $overtxt = $txtarry[$i];
              $img->text($overtxt,610,357, function($font) {
            //  $font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
              $font->file('fonts/en/RobotoMono/RobotoMono-Bold.ttf');
              $font->size(39);
              $font->color('#FF0000');
              $font->align('left');
              $font->valign('middle');
              });

            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 210,376, function($font) {
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                //$font->file('fonts/en/Lora/Lora-Bold.ttf');
                 $font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
                $font->size(36);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(240,240, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',100,110);
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
            $image_name = 'en_app34_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
            // $img->save('images/fb1.jpg');

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
            //return  $img->response('jpg');
            //return view('/share',array('app_no'=>"1",'img'=>$img));

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, It runs in your blood...You are <b>You are Half-Human & ".$overtxt."</b> Feel free to spread the news </p>";
            $app_sub_description = "<p class='subtext'>share the result on social media</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"34",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[33]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app34--

//----Which Different Combinations of Hogwarts and Ilvermorny Houses Are You?-------------app35--

          public function en_app35(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[34]['app_title']);
                MetaTag::set('description',$this->app_store_info[34]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"35", 'app_title'=>$this->app_store_info[34]['app_title'],'app_img_orignal_url'=>$this->app_store_info[34]['app_img_orignal_url'],'app_description'=>$this->app_store_info[34]['app_description']));

          }

          public function en_app35_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);


              $dir = "images/english/app35/bg-sample/";
              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);

            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 395,368, function($font) {
                $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                //$font->file('fonts/en/Lora/Lora-Bold.ttf');
                // $font->file('fonts/en/Oswald/Oswald-Bold.ttf');
                $font->size(36);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(250, 250, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',275,85);
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
            $image_name = 'en_app35_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
            // $img->save('images/fb1.jpg');

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
            //return  $img->response('jpg');
            //return view('/share',array('app_no'=>"1",'img'=>$img));

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,you have an ambitious personality. A person who is intelligent and determined to achieve the goals of life. You do what is needed to get the job done. You also have natural leadership qualities among others.</p>";
            $app_sub_description = "<p class='subtext'>Share the result with your friends and let them know about your Hogwarts+Ilvermorny houses combination.</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"35",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[34]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app35--

//----How Hot Are You?---------------------------------------------------app36--

          public function en_app36(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[35]['app_title']);
                MetaTag::set('description',$this->app_store_info[35]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"36",'app_title'=>$this->app_store_info[35]['app_title'],'app_img_orignal_url'=>$this->app_store_info[35]['app_img_orignal_url'],'app_description'=>$this->app_store_info[35]['app_description']));

          }

          public function en_app36_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app36/bg-sample/Product_bg.png");
            $overtxt = $posts->first_name;
            $img->text($overtxt,649, 369, function($font) {
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
               //$font->file('fonts/en/Lora/Lora-Bold.ttf');
              //$font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
              $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
            //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');

                $font->size(40);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });



                              $overtxt1 = rand(1,5);
                              $overtxt2 = rand(1,5);
                              $overtxt3 = rand(1,5);
                              $overtxt4 = rand(1,5);


                              $img->text($overtxt1,348, 105, function($font) {
                              $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                              $font->size(49);
                              $font->color('#FFE400');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt2,348,194, function($font) {
                              $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                              $font->size(49);
                              $font->color('#FFE400');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt3,348, 282, function($font) {
                              $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                              $font->size(49);
                              $font->color('#FFE400');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt4,348, 372, function($font) {
                              $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                              $font->size(49);
                              $font->color('#FFE400');
                              $font->align('left');
                              $font->valign('middle');
                              });



            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(300,300, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,-10,85);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app36_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, you are black as the devil, hot as hell, pure as an angel, sweet as love. You are so hot that no one can resist you and enjoy your company. You know how to impress others through your looks and way of talking.</p>";
            $app_sub_description = "<p class='subtext'>Share this result with your friends and let them know about your hotness level.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"36",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[35]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app36--

//---How Mean Are You?------------------------------------------app37--

          public function en_app37(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[36]['app_title']);
                MetaTag::set('description',$this->app_store_info[36]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"37",'app_title'=>$this->app_store_info[36]['app_title'],'app_img_orignal_url'=>$this->app_store_info[36]['app_img_orignal_url'],'app_description'=>$this->app_store_info[36]['app_description']));

          }

          public function en_app37_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app37/bg-sample/Product_bg.png");


            $overtxt1 = $posts->first_name;
            $img->text($overtxt1, 140, 368, function($font) {
                $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                $font->size(35);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $overtxt2 = rand(0,40)."%";
            $img->text($overtxt2,535,152, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(52);
            $font->color('#5DB216');
            $font->align('center');
            $font->valign('middle');
            });


            $txtarry3 = array(
                              "Aggressive","Honest","Just Real","Just Blunt","Brutally Honest"
                             );

            $i = rand(0, count($txtarry3)-1); // generate random number size of the array
            $overtxt3 = $txtarry3[$i];

            $overtxt3 = "You Are Not Mean, Your Are Just  ".$overtxt3;

            $string3 = wordwrap($overtxt3,20,"|");
            //create array of lines
            $strings3 = explode("|",$string3);
            $i=250; //top position of string
            //for each line added
            foreach($strings3 as $string){
            $img->text($string, 550, $i, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(35);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+45; //shift top postition down 42
            }



            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(300,300, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,5,83);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app37_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,you are  <b>".$overtxt2."</b> mean. This is absolutely right. You always believed in giving and helping others in your way. Sometimes you are so straightforward that people consider you a mean person, but that’s not true. You just don’t want to lose your identity and work accordingly.</p>";
            $app_sub_description = "<p class='subtext'>Share this result with everyone around you and tell them about it.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"37",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[36]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app37--

//-----What Is The Key To Your Happiness?-----------------------------------------------------app38--

          public function en_app38(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[37]['app_title']);
                MetaTag::set('description',$this->app_store_info[37]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"38",'app_title'=>$this->app_store_info[37]['app_title'],'app_img_orignal_url'=>$this->app_store_info[37]['app_img_orignal_url'],'app_description'=>$this->app_store_info[37]['app_description']));

          }

          public function en_app38_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app38/bg-sample/Product_bg.png");

            $txtarry = array(
                          "APPRECIATE SIMPLE THINGS",
                          "LIVE IN THE PRESENT!",
                          "FIND WAYS TO BOUNCE BACK ",
                          "HAVE A POSITIVE MINDSET ",
                          "LIVE LIFE MINDFULLY",
                          "BE SOCIAL",
                          "BE GRATEFUL",
                          "HAVE LOVE IN YOUR LIFE",
                          "HAVE THE RIGHT ATTITUDE",
                          "HAVE A POSITIVE MINDSET",
                          "DOING THINGS FOR OTHERS",
                          "KEEP LEARNING NEW THINGS",
                              );

                    $random_keys=array_rand($txtarry,3);
                    $overtxt1 = $txtarry[$random_keys[0]];
                    $overtxt2 = $txtarry[$random_keys[1]];
                    $overtxt3 = $txtarry[$random_keys[2]];


                    $img->text($overtxt1,100, 128, function($font) {
                    $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                    $font->size(22);
                    $font->color('#000');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $img->text($overtxt2,100, 245, function($font) {
                    $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                    $font->size(22);
                    $font->color('#000');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $img->text($overtxt3,100,358, function($font) {
                    $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                    $font->size(22);
                    $font->color('#000');
                    $font->align('left');
                    $font->valign('middle');
                    });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(300,300, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,-10,115);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app38_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,happiness is not something you postpone for the future; it is something you design for the present. Happiness cannot be traveled to, owned, earned, worn or consumed. Happiness is the spiritual experience of living every minute with love, grace, and gratitude.</p>";
            $app_sub_description = "<p class='subtext'>Share this result with everyone and let them know about the secret of your happiness.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"38",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[37]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app38--


//----What is your inspiring Bible verse?--------------------------------------------------app39--

          public function en_app39(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[38]['app_title']);
                MetaTag::set('description',$this->app_store_info[38]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"39",'app_title'=>$this->app_store_info[38]['app_title'],'app_img_orignal_url'=>$this->app_store_info[38]['app_img_orignal_url'],'app_description'=>$this->app_store_info[38]['app_description']));

          }

          public function en_app39_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app39/bg-sample/Product_bg.png");

            $txtarry2 = array(
                    "The LORD is my light and my salvation; whom shall I fear? The LORD is the strength of my life; of whom shall I be afraid?",
                    "But the salvation of the righteous is from the LORD; He is their strength in time of trouble.",
                    "In the day when I cried out, You answered me, and made me bold with strength in my soul.",
                    "Even though I walk through the darkest valley, I will fear no evil, for you are with me; your rod and your staff, they comfort me.",
                    "Taste and see that the LORD is good; blessed is the one who takes refuge in him.",
                    "The righteous person may have many troubles, but the LORD delivers him from them all;",
                    "Take delight in the LORD, and he will give you the desires of your heart.",
                    "Cast your cares on the LORD and he will sustain you; he will never let the righteous be shaken.",
                    "May the favor of the Lord our God rest on us; establish the work of our hands for us—yes, establish the work of our hands.",
                    "Your word is a lamp for my feet, a light on my path.",
                    "I lift up my eyes to the mountains—where does my help come from? My help comes from the LORD,  the Maker of heaven and earth.",
                    "Commit to the LORD whatever you do,  and he will establish your plans.",
                );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt2 = $txtarry2[$i]; // set variable equal to which random filename was chosen

            $txtarry3 = array(
              "Psalm 27:1",
              "Psalm 37:39",
              "Psalm 138:3",
              "Psalm 23:4",
              "Psalm 34:8",
              "Psalm 34:19",
              "Psalm 37:4",
              "Psalm 55:22",
              "Psalm 90:17",
              "Psalm 119:105",
              "Psalm 121:1-2",
              "Proverbs 16:3",
                );

            $overtxt3 = $txtarry3[$i];
            $string2 = wordwrap($overtxt2,23,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=120; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 220, $i, function($font) {
            $font->file('fonts/en/OriginalSurfer/OriginalSurfer-Regular.ttf');
            $font->size(30);
            $font->color('#FFFF00');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+34; //shift top postition down 42
            }


            $img->text($overtxt3, 220, 380, function($font) {
            $font->file('fonts/en/Risque/Risque-Regular.ttf');
            $font->size(32);
            $font->color('#FFFF00');
            $font->align('center');
            $font->valign('middle');
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(300,300, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,30,120);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app39_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,GOD is always there to help you and inspire you. He is there to give you courage, make you strong and help you achieve your goals of life.</p>";
            $app_sub_description = "<p class='subtext'>Share this beautiful Bible Verse with everyone.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"39",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[38]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app39--

//----How Old Are You Based On Your Photo?------------------------------------------------app40--

          public function en_app40(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[39]['app_title']);
                MetaTag::set('description',$this->app_store_info[39]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"40",'app_title'=>$this->app_store_info[39]['app_title'],'app_img_orignal_url'=>$this->app_store_info[39]['app_img_orignal_url'],'app_description'=>$this->app_store_info[39]['app_description']));

          }

          public function en_app40_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app40/bg-sample/Product_bg.png");

            $uname = $posts->first_name;

            $img->text($uname, 132, 330, function($font) {
                $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                $font->size(30);
                $font->color('#6acbf2');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

                    $overtxt1 = rand(10,80)." Years Old";
                    $overtxt2 = rand(10,80)." Years Old";
                    $overtxt3 = rand(10,80)." Years Old";


                    $img->text($overtxt1,530,68, function($font) {
                    $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                    $font->size(30);
                    $font->color('#6acbf2');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $img->text($overtxt2,530, 208, function($font) {
                    $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                    $font->size(30);
                    $font->color('#6acbf2');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $img->text($overtxt3,530,358, function($font) {
                    $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                    $font->size(30);
                    $font->color('#6acbf2');
                    $font->align('left');
                    $font->valign('middle');
                    });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(240,240, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,10,65);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app40_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>No kidding...<b>".$posts->first_name."</b> you act like a <b>".$overtxt1."</b> , thinks like a <b>".$overtxt2."</b>  and looks like a <b>".$overtxt3."</b>.</p>";
            $app_sub_description = "<p class='subtext'>Share the result with your friends and tell them about it.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"40",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[39]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app40--

//---How Would Be Your Next Boyfriend/Girlfriend?---------------------------------------------app41--

          public function en_app41(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[40]['app_title']);
                MetaTag::set('description',$this->app_store_info[40]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"41",'app_title'=>$this->app_store_info[40]['app_title'],'app_img_orignal_url'=>$this->app_store_info[40]['app_img_orignal_url'],'app_description'=>$this->app_store_info[40]['app_description']));

          }

          public function en_app41_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);
            if($posts->Gender == "male"){
            $img = Image::make("images/english/app41/bg-sample/Gf.png");
             }
            else{
            $img = Image::make("images/english/app41/bg-sample/Bf.png");
            }
            $uname = $posts->first_name;

            $img->text($uname, 650, 365, function($font) {
                $font->file('fonts/en/Lora/Lora-Bold.ttf');
                $font->size(30);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });


                    $txtarry1 = array(
                            "Black","Red","Brown"
                        );
                    $i = rand(0, count($txtarry1)-1);
                    $overtxt1 = $txtarry1[$i];
                    $img->text($overtxt1,160,112, function($font) {
                    $font->file('fonts/en/Lora/Lora-Bold.ttf');
                    $font->size(40);
                    $font->color('#FFE400');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $txtarry2 = array(
                          "Amber","Grey","Brown","Blue","Green","Hazel","Red" ,"violet"
                        );
                    $j = rand(0, count($txtarry2)-1);
                    $overtxt2 = $txtarry2[$j];
                    $img->text($overtxt2,166, 202, function($font) {
                    $font->file('fonts/en/Lora/Lora-Bold.ttf');
                    $font->size(40);
                    $font->color('#FFE400');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $overtxt3 = mt_rand(5, 100 ) / 10;
                    $img->text($overtxt3,220,290, function($font) {
                    $font->file('fonts/en/Lora/Lora-Bold.ttf');
                    $font->size(40);
                    $font->color('#FFE400');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $txtarry4 = array(
                        "White","Brown","Black","yellow","tanned","swarthy","sallow","ruddy","rubicund","olive","gray","fair"
                        );
                    $k = rand(0, count($txtarry1)-1);
                    $overtxt4 = $txtarry4[$k];
                    $img->text($overtxt4,166,379, function($font) {
                    $font->file('fonts/en/Lora/Lora-Bold.ttf');
                    $font->size(40);
                    $font->color('#FFE400');
                    $font->align('left');
                    $font->valign('middle');
                    });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(250,250, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,10,85);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app41_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b> you are damn lucky. Your next partner would have some of the best features. They would have: </p>";

                if($posts->Gender == "male")
                {

              $app_description .="<p class='subtext'>Your Next Girlfriend Will Have:</p>";

                   }
              else{

              $app_description .=  "<p class='subtext'>Your Next Boyfriend Will Have:</p>";
                   }
              $app_description .=" <p class='subtext'> Hair: <b>".$overtxt1."</b></p>
              <p class='subtext'> Eyes: <b>".$overtxt2."</b></p>
              <p class='subtext'> Height: <b>".$overtxt3."</b></p>
              <p class='subtext'> Skin: <b>".$overtxt4."</b></p>";

               $app_sub_description ="<p class='subtext'> That's what you have always wanted in your partner. Share the result with your friends and let them find out about their future partner.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"41",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[40]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app41--

//---What Are Your Wolf Instincts?--------------------------------------app42--

          public function en_app42(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[41]['app_title']);
                MetaTag::set('description',$this->app_store_info[41]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"42",'app_title'=>$this->app_store_info[41]['app_title'],'app_img_orignal_url'=>$this->app_store_info[41]['app_img_orignal_url'],'app_description'=>$this->app_store_info[41]['app_description']));


          }

          public function en_app42_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app42/bg-sample/Product_bg.png");


            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 530, 70, function($font) {
                $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
              //  $font->file('fonts/en/Lora/Lora-Bold.ttf');
              //  $font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                  //$font->file('fonts/en/Lobster/Lobster-Regular.ttf');
                //  $font->file('fonts/en/Macondo/Macondo-Regular.ttf');
                $font->size(34);
                $font->color('#00CCFF');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });


            $overtxt1 = "- ".rand(1,5)."/5";
            $overtxt2 = "- ".rand(1,5)."/5";
            $overtxt3 = "- ".rand(1,5)."/5";
            $overtxt4 = "- ".rand(1,5)."/5";
            $overtxt5 = "- ".rand(1,5)."/5";

            $img->text($overtxt1,695,172, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(28);
            $font->color('#5540A1');
            $font->align('left');
            $font->valign('middle');
            });

            $img->text($overtxt2,525, 228, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(28);
            $font->color('#5540A1');
            $font->align('left');
            $font->valign('middle');
            });

            $img->text($overtxt3,590,276, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(28);
            $font->color('#5540A1');
            $font->align('left');
            $font->valign('middle');
            });

            $img->text($overtxt4,583,330, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(28);
            $font->color('#5540A1');
            $font->align('left');
            $font->valign('middle');
            });

            $img->text($overtxt5,610,380, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(28);
            $font->color('#5540A1');
            $font->align('left');
            $font->valign('middle');
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(150,150, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,-5,6); //right - top
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app42_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>No kidding...<b>".$posts->first_name."</b> you are athletic, good-looking and brimming with self-confidence. With an innate understanding of the value of teamwork, you're always ready to take your place in the chain of command either as a leader or as simply a member of the pack. You are intensely ambitious and never shy from hard work.</p>";
            $app_sub_description = "<p class='subtext'>Share this result with everyone and let them know about your Wolf instincts.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"42",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[41]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app42--

//-----Can We Guess If 2018 Will Be Better Than 2017 For You?------------------------------app43--

          public function en_app43(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[42]['app_title']);
                MetaTag::set('description',$this->app_store_info[42]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"43",'app_title'=>$this->app_store_info[42]['app_title'],'app_img_orignal_url'=>$this->app_store_info[42]['app_img_orignal_url'],'app_description'=>$this->app_store_info[42]['app_description']));

          }

          public function en_app43_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app43/bg-sample/Product_bg.png");

            $overtxt1 = $posts->first_name;
            $img->text($overtxt1, 120, 355, function($font) {
                $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                $font->size(35);
                $font->color('#D60055');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });



            $txtarry3 = array(
                            "You’ll Buy 5 Supercars",
                            "You’ll Have a Hot Body",
                            "You’ll Get To Eat 365 New Cuisines ",
                            "You’ll Own a Beach Resort",
                            "You’ll Be Ultrarich",
                            "You’ll Have Babies",
                            "You’ll Be Ultrarich",
                            "You’ll Get A Better Partner",
                            "You’ll Travel The World",
                            "You’ll Buy 5 Supercars"
                             );

            $i = rand(0, count($txtarry3)-1); // generate random number size of the array
            $overtxt3 = $txtarry3[$i];

            $string3 = wordwrap($overtxt3,15,"|");
            //create array of lines
            $strings3 = explode("|",$string3);
            $i=250; //top position of string
            //for each line added
            foreach($strings3 as $string){
            $img->text($string, 545, $i, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(60);
            $font->color('#F68300');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+60; //shift top postition down 42
            }

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(280,280, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,-10,32);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app43_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>No doubt 2018 will be much better than 2017 for you. <b>".$overtxt3."</b> in 2018. Gear up for it.</p>";
            $app_sub_description = "<p class='subtext'>Share the result with your buddies and tell them about it.</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"43",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[42]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app43--

//----How Much Do You Love Him/Her---------------------------------------------------app44--

          public function en_app44(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[43]['app_title']);
                MetaTag::set('description',$this->app_store_info[43]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"44",'app_title'=>$this->app_store_info[43]['app_title'],'app_img_orignal_url'=>$this->app_store_info[43]['app_img_orignal_url'],'app_description'=>$this->app_store_info[43]['app_description']));

          }

          public function en_app44_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app44/bg-sample/Product_bg.png");


            $txtarry = array(
                                "you hate February because it gives you a couple of days less to hug her, kiss her and tell her how much you love her.",
                                "you love her, not only for what she is but for what you are when you are with her. A hundred hearts would be too few to carry all your love for her.",
                                "you look at her and see the rest of your life in front of your eyes. Thinking of her keeps you awake. Dreaming of her keeps you asleep. Being with her keeps you alive.",
                                "you love her, not only for what she is but for what you are when you are with her. A hundred hearts would be too few to carry all your love for her",
                             );

            $i = rand(0, count($txtarry)-1); // generate random number size of the array
            $overtxt = $txtarry[$i];

            $string = wordwrap($overtxt,22,"|");
            //create array of lines
            $strings = explode("|",$string);
            $i=70; //top position of string
            //for each line added
            foreach($strings as $string){
            $img->text($string,700, $i, function($font) {
            //$font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->file('fonts/en/Satisfy/Satisfy-Regular.ttf');
            $font->size(30);
            $font->color('#FE4455');
            $font->align('right');
            $font->valign('middle');
            $font->angle(13); //0,45,90,180
            });
            $i=$i+30; //shift top postition down 42
            }

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(240,240, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,60,110);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app44_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name." ".$overtxt."</b></p>";
            $app_sub_description = "<p class='subtext'>Share this beautiful result with your partner and let others also know about this.</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"44",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[43]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app44--

//-----Can We Guess Your Future By Your Picture?------------------------------------------app45--

          public function en_app45(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[44]['app_title']);
                MetaTag::set('description',$this->app_store_info[44]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"45",'app_title'=>$this->app_store_info[44]['app_title'],'app_img_orignal_url'=>$this->app_store_info[44]['app_img_orignal_url'],'app_description'=>$this->app_store_info[44]['app_description']));

          }

          public function en_app45_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app45/bg-sample/Product_bg.png");

            $uname = $posts->first_name;

            $img->text($uname, 132, 330, function($font) {
                //$font->file('fonts/en/TradeWinds/TradeWinds-Regular.ttf');
              //  $font->file('fonts/en/Frijole/Frijole-Regular.ttf');
                $font->file('fonts/en/Audiowide/Audiowide-Regular.ttf');
                $font->size(30);
                $font->color('#F56E00');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

                    $overtxt1 = rand(1,5);
                    $overtxt2 = rand(10,80);
                    $overtxt3 = number_format(rand(10,1000),3,",",",");


                    $img->text($overtxt1,580,60, function($font) {
                    $font->file('fonts/en/Anton/Anton-Regular.ttf');
                    $font->size(35);
                    $font->color('#008900');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $img->text($overtxt2,580, 166, function($font) {
                    $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                    $font->size(30);
                    $font->color('#DC004D');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $img->text($overtxt3,580,269, function($font) {
                    $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                    $font->size(30);
                    $font->color('#FBC555');
                    $font->align('left');
                    $font->valign('middle');
                    });

                  $arr_car=array("Audi","Mercedes","Duster","Innova","BMW","Swift", "Fortuner","Jaguar","Honda City","Skoda","Toyota","Volkswagen","Volvo","Tesla","Suzuki","Tata","Subaru","Saab","Rolls Royce","Renault","Ram","Porsche","Peugeot",
                  "Pagani","Nissan","Lexus");

                  $i = rand(0, count($arr_car)-1); // generate random number size of the array
                  $overtxt4 = $arr_car[$i];

                  $img->text($overtxt4,570,362, function($font) {
                  $font->file('fonts/en/Volkhov/Volkhov-Bold.ttf');
                  $font->size(33);
                  $font->color('#F1F915');
                  $font->align('left');
                  $font->valign('middle');
                  });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(240,240, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,10,65);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app45_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,It’s like a dream come true. Isn’t it? Getting married at the right age, earning a good amount per month with supercar in the garage; And, most importantly having kids. It’s a dream life that you would live.</p>";
            $app_sub_description = "<p class='subtext'>Share this amazing result with the world and tell them about your future.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"45",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[44]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app45--

//----How Would Your Future House, Car and Love Look Like?---------------------------------------------------app46--

          public function en_app46(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[45]['app_title']);
                MetaTag::set('description',$this->app_store_info[45]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"46",'app_title'=>$this->app_store_info[45]['app_title'],'app_img_orignal_url'=>$this->app_store_info[45]['app_img_orignal_url'],'app_description'=>$this->app_store_info[45]['app_description']));

          }

          public function en_app46_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            if($posts->Gender == "male"){
              $dir = "images/english/app46/bg-sample/female";
               }
              else{
              $dir = "images/english/app46/bg-sample/male";
              }


            $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
            $img_path = $pictures[mt_rand(0,count($pictures)-1)];

            $img = Image::make($img_path);


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(180,180, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,14,90);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app46_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, that’s pretty darn cool. You would get what you have always dreamt of. This saying fits you the best “The future belongs to those who believe in the beauty of their dreams.”</p>";
            $app_sub_description = "<p class='subtext'>Share your future with your friends and let them find their future house, car, and love.</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"46",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[45]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app46--

//----What Is Locked Up In Your Heart?------------------------------------------------app47--

          public function en_app47(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[46]['app_title']);
                MetaTag::set('description',$this->app_store_info[46]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"47",'app_title'=>$this->app_store_info[46]['app_title'],'app_img_orignal_url'=>$this->app_store_info[46]['app_img_orignal_url'],'app_description'=>$this->app_store_info[46]['app_description']));

          }

          public function en_app47_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app47/bg-sample/Product_bg.png");

            $uname = $posts->first_name;

            $img->text($uname, 145, 335, function($font) {
                //$font->file('fonts/en/TradeWinds/TradeWinds-Regular.ttf');
              //  $font->file('fonts/en/Frijole/Frijole-Regular.ttf');
              //  $font->file('fonts/en/Audiowide/Audiowide-Regular.ttf');
                //  $font->file('fonts/en/Bellefair/Bellefair-Regular.ttf');
                  $font->file('fonts/en/Satisfy/Satisfy-Regular.ttf');
                $font->size(40);
                $font->color('#FB3842');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $txtarry = array(
                               "I just have to be myself. I'm not perfect,and I'm going to make mistakes; I might say the wrong thing. I have to be responsible to my community,and I feel like I am,but then I have to not be so hard on myself.",
                               "I Like second chances.I've given people second chances.You have fallouts with friends,and forgiveness is a great thing to have.It's not easy to forgive. I definitely don't forget,but I do forgive.",
                               "I always try to improve, to find new ways of expressing myself,to keep looking for truth and originality.",
                             );

            $i = rand(0, count($txtarry)-1); // generate random number size of the array
            $overtxt = $txtarry[$i];

            $string = wordwrap($overtxt,28,"|");
            //create array of lines
            $strings = explode("|",$string);
            $i=70; //top position of string
            //for each line added
            foreach($strings as $string){
            $img->text($string,560, $i, function($font) {
            //$font->file('fonts/en/Righteous/Righteous-Regular.ttf');
        //    $font->file('fonts/en/Satisfy/Satisfy-Regular.ttf');
          //  $font->file('fonts/en/Audiowide/Audiowide-Regular.ttf');
            $font->file('fonts/en/Bellefair/Bellefair-Regular.ttf');
            $font->size(32);
            $font->color('#042866');
            $font->align('center');
            $font->valign('top');
            $font->angle(10); //0,45,90,180
            });
            $i=$i+36; //shift top postition down 42
            }

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(240,240, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,28,60);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app47_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,your heart is a secret garden and the walls are very high. No one can guess what's inside your heart, unless and until you open your heart. Things you are hiding inside your heart worthy enough.</p>";
            $app_sub_description = "<p class='subtext'>Share it with everyone and let them know about that hidden secret.</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"47",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[46]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app47--

//-----What 6 Word Story Describes Your Personality?---------------------------------------app48--

          public function en_app48(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[47]['app_title']);
                MetaTag::set('description',$this->app_store_info[47]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"48",'app_title'=>$this->app_store_info[47]['app_title'],'app_img_orignal_url'=>$this->app_store_info[47]['app_img_orignal_url'],'app_description'=>$this->app_store_info[47]['app_description']));

          }

          public function en_app48_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $dir = "images/english/app48/bg-sample/";
            $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
            $img_path = $pictures[mt_rand(0,count($pictures)-1)];

            $img = Image::make($img_path);


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(170,170, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,14,90);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app48_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, that’s your 6-word story. You never really mind what people say about you - you are far too unconventional and far too dedicated to being true to yourself.</p>";
            $app_sub_description = "<p class='subtext'>Share this amazing result and give your friends a chance to create their 6-word story.</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"48",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[47]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app48--

//----What type of angel are you--------------------------------------------------app49--

          public function en_app49(){
              MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[48]['app_title']);
              MetaTag::set('description',$this->app_store_info[48]['app_meta_desc']);

              return  view('english.app_view_home',array('app_no'=>"49",'app_title'=>$this->app_store_info[48]['app_title'],'app_img_orignal_url'=>$this->app_store_info[48]['app_img_orignal_url'],'app_description'=>$this->app_store_info[48]['app_description']));

          }

          public function en_app49_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $dir = "images/english/app49/bg-sample/";
            $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
            $img_path = $pictures[mt_rand(0,count($pictures)-1)];

            $img = Image::make($img_path);

            $txtarry = array(
                        "You have a kind heart. You’re  always going out of your way to give your help where it’s needed most. From donating to charity or volunteering for a cause, you've done it all.",
                        "You’re a supportive person-one who is more than willing to empower others and boost their confidence. When someone is feeling inadequate you’re the first person to tell them otherwise.",
                        "They sometimes call you the “mom friend.” You make the effort to get to know others well, giving them the kind of love and care they need most at the moment",
                        "Brimming with authority and charisma, you’re one who takes the lead and protects those who walk with you. You help others fight their battles when the need calls for it."
                     );

            $i = rand(0, count($txtarry)-1); // generate random number size of the array
            $overtxt = $txtarry[$i];

            $string = wordwrap($overtxt,28,"|");
            //create array of lines
            $strings = explode("|",$string);
            $i=100; //top position of string
            //for each line added
            foreach($strings as $string){
            $img->text($string,560, $i, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
          //    $font->file('fonts/en/Satisfy/Satisfy-Regular.ttf');
          //  $font->file('fonts/en/Audiowide/Audiowide-Regular.ttf');
          //  $font->file('fonts/en/Bellefair/Bellefair-Regular.ttf');
            $font->size(32);
            $font->color('#229FC0');
            $font->align('center');
            $font->valign('top');
            //$font->angle(10); //0,45,90,180
            });
            $i=$i+36; //shift top postition down 42
            }
            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(200,200, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,20,210);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app49_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>You bring light and warmth with you wherever you go. Your family and friends are lucky to have someone like you!</p>";
            $app_sub_description = "<p class='subtext'>SHARE this result with your friends and family!.</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"49",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[48]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app49--

//----Which career fits your face?----------------------------------------------------app50--

          public function en_app50(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[49]['app_title']);
                MetaTag::set('description',$this->app_store_info[49]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"50",'app_title'=>$this->app_store_info[49]['app_title'],'app_img_orignal_url'=>$this->app_store_info[49]['app_img_orignal_url'],'app_description'=>$this->app_store_info[49]['app_description']));

          }

          public function en_app50_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app50/bg-sample/Product_bg.png");

                    $arr_career=array("CELEBRITY","MAFIYA BOSS","KING","MODEL","LAWYER");

                    $i = rand(0, count($arr_career)-1); // generate random number size of the array
                    $overtxt1 = $arr_career[$i];

                    $img->text($overtxt1,570,120, function($font) {
                    //$font->file('fonts/en/Anton/Anton-Regular.ttf');
                  //  $font->file('fonts/en/Aclonica/Aclonica-Regular.ttf');
                    //$font->file('fonts/en/BungeeInline/BungeeInline-Regular.ttf');
                    $font->file('fonts/en/VastShadow/VastShadow-Regular.ttf');
                    $font->size(43);
                    $font->color('#F1F915');
                    $font->align('center');
                    $font->valign('middle');
                    });

                    $arr_other =array(  "Independent",
                                         "Observant",
                                         "Disciplined",
                                         "Talented",
                                         "Fun",
                                         "Wise",
                                         "Believer",
                                         "Respectful",
                                         "Confident",
                                         "Attractive",
                                         "Patient",
                                         "Intellectual",
                                         "Calm",
                                        );

                                        $random_keys=array_rand($arr_other,3);
                                        $overtxt2 = $arr_other[$random_keys[0]];
                                        $overtxt3 = $arr_other[$random_keys[1]];
                                        $overtxt4 = $arr_other[$random_keys[2]];

                    $img->text($overtxt2,484, 218, function($font) {
                    //$font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                    $font->file('fonts/en/Aclonica/Aclonica-Regular.ttf');
                    $font->size(30);
                    $font->color('#F1F915');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $img->text($overtxt3,490,296, function($font) {
                    $font->file('fonts/en/Aclonica/Aclonica-Regular.ttf');
                    $font->size(30);
                    $font->color('#F1F915');
                    $font->align('left');
                    $font->valign('middle');
                    });

                  $img->text($overtxt4,570,367, function($font) {
                  $font->file('fonts/en/Aclonica/Aclonica-Regular.ttf');
                  $font->size(30);
                  $font->color('#F1F915');
                  $font->align('left');
                  $font->valign('middle');
                  });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(400,400, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,-30,25);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app50_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>Prepare your resume, <b>".$posts->first_name."</b>, this is the job for you! You are perfect for this career, and you know it. Step up and chase your dreams!</p>";
            $app_sub_description = "<p class='subtext'>Share this result with your family and friends!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"50",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[49]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app50--


//---5 Things You Should Quit Right Now!----------------------------------------------------app51--

          public function en_app51(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[50]['app_title']);
                MetaTag::set('description',$this->app_store_info[50]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"51",'app_title'=>$this->app_store_info[50]['app_title'],'app_img_orignal_url'=>$this->app_store_info[50]['app_img_orignal_url'],'app_description'=>$this->app_store_info[50]['app_description']));

          }

          public function en_app51_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app51/bg-sample/Product_bg.png");

            $txtarry = array(
                              "Stop fearing change.",
                              "Stop living in the past.",
                              "Stop putting Yourself down.",
                              "Quit ego and self-centrism.",
                              "Quit negativity as mush as possible",
                              "Stop regretting your past/mistakes.",
                              "Stop crying and keep trying.",
                              "Quite blaming people and situation.",
                              "Quite the fear about society.",
                              "Quit trying to be a perfectionist.",
                              "Quit developing feelings easily.",
                              "Quit laziness & procrastination.",
                              "Quit giving up on your dreams and passions.",
                              "Stop comparing yourself with others.",
                              "Stop expecting from others." ,
                              "Quit discussing other people.",
                              "Quit chasing people. Chase Your goals.",
                              "Quit living the life of others",
                              "Quit thinking too much.",
                              );

                              $random_keys=array_rand($txtarry,5);
                              $overtxt1 = $txtarry[$random_keys[0]];
                              $overtxt2 = $txtarry[$random_keys[1]];
                              $overtxt3 = $txtarry[$random_keys[2]];
                              $overtxt4 = $txtarry[$random_keys[3]];
                              $overtxt5 = $txtarry[$random_keys[4]];

                              $img->text($overtxt1,70, 38, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(24);
                              $font->color('#CB0000');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt2,70, 119, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(24);
                              $font->color('#CB0000');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt3,70, 205, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(24);
                              $font->color('#CB0000');
                              $font->align('left');
                              $font->valign('middle');
                              });
                              $img->text($overtxt4,70, 296, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(24);
                              $font->color('#CB0000');
                              $font->align('left');
                              $font->valign('middle');
                              });
                              $img->text($overtxt5,70, 389, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(24);
                              $font->color('#CB0000');
                              $font->align('left');
                              $font->valign('middle');
                              });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(180,180, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,15,10);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app51_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,you have to quit these 5 things immediately. Some said that very well “Winners never quit and quitters never win”. But in this case, if you quit these things: you are already the winner. You don't have to be over dramatic about it, but you have to start looking your bad habits to get the best of you. </p>";
            $app_sub_description = "<p class='subtext'>Share this result with your everyone and let them also find out what they need to quit from their life.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"51",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[50]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app51--

//---What Are Your 5 Secrets?--------------------------------------------------app52--

          public function en_app52(){

                MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[51]['app_title']);
                MetaTag::set('description',$this->app_store_info[51]['app_meta_desc']);

                return  view('english.app_view_home',array('app_no'=>"52",'app_title'=>$this->app_store_info[51]['app_title'],'app_img_orignal_url'=>$this->app_store_info[51]['app_img_orignal_url'],'app_description'=>$this->app_store_info[51]['app_description']));

          }

          public function en_app52_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app52/bg-sample/Product_bg.png");

            $txtarry = array(
                              "conﬁdent about the future.",
                              "benevolent to others.",
                              "a good listener.",
                              "listens to his brain.",
                              "loves freedom.",
                              "believes in the good of others.",
                              "never stops dreaming.",
                              "loves life.",
                              "listens to his heart.",
                              "has a strong will.",
                              "smiles during storms.",
                              "now afraid of failures.",
                              "Very broad minded.",
                              "Honesty is his way of life.",
                              "respectful of others.",
                              "emotionally open.",
                              "loves his life.",
                              "a dreamer.",
                              );

                              $random_keys=array_rand($txtarry,5);

                              $overtxt1 = $txtarry[$random_keys[0]];
                              $overtxt2 = $txtarry[$random_keys[1]];
                              $overtxt3 = $txtarry[$random_keys[2]];
                              $overtxt4 = $txtarry[$random_keys[3]];
                              $overtxt5 = $txtarry[$random_keys[4]];

                              if($posts->Gender == "male"){
                                $overtxt1 = "He is ".$overtxt1;
                                $overtxt2 = "He is ".$overtxt2;
                                $overtxt3 = "He is ".$overtxt3;
                                $overtxt4 = "He is ".$overtxt4;
                                $overtxt5 = "He is ".$overtxt5;
                               }
                               else{
                                 $overtxt1 = "She is ".$overtxt1;
                                 $overtxt2 = "She is ".$overtxt2;
                                 $overtxt3 = "She is ".$overtxt3;
                                 $overtxt4 = "She is ".$overtxt4;
                                 $overtxt5 = "She is ".$overtxt5;
                               }




                              $img->text($overtxt1,340, 152, function($font) {
                          //    $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->file('fonts/en/IM_Fell_English/IMFeENrm28P.ttf');
                              $font->size(30);
                              $font->color('#CB0000');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt2,340, 209, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->file('fonts/en/IM_Fell_English/IMFeENrm28P.ttf');
                              $font->size(30);
                              $font->color('#CB0000');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt3,340, 270, function($font) {
                              $font->file('fonts/en/IM_Fell_English/IMFeENrm28P.ttf');
                              $font->size(30);
                              $font->color('#CB0000');
                              $font->align('left');
                              $font->valign('middle');
                              });
                              $img->text($overtxt4,340, 328, function($font) {
                              $font->file('fonts/en/IM_Fell_English/IMFeENrm28P.ttf');
                              $font->size(30);
                              $font->color('#CB0000');
                              $font->align('left');
                              $font->valign('middle');
                              });
                              $img->text($overtxt5,340, 386, function($font) {
                              $font->file('fonts/en/IM_Fell_English/IMFeENrm28P.ttf');
                              $font->size(30);
                              $font->color('#CB0000');
                              $font->align('left');
                              $font->valign('middle');
                              });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(420,420, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,-40,0);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app52_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,the secret of your future is hidden in your daily routine. You don’t need the other’s eyes to see the world, you have your own perspective towards life and live it to your style.</p>";
            $app_sub_description = "<p class='subtext'>Share your secrets with everyone and let them know about your 5 secrets of living a happy life.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"52",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[51]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app52--

//----What Do You Pray For?-----------------------------------------------app53--

          public function en_app53(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[52]['app_title']);
          MetaTag::set('description',$this->app_store_info[52]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"53",'app_title'=>$this->app_store_info[52]['app_title'],'app_img_orignal_url'=>$this->app_store_info[52]['app_img_orignal_url'],'app_description'=>$this->app_store_info[52]['app_description']));

          }

          public function en_app53_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app53/bg-sample/Product_bg.png");

            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 130, 342, function($font) {
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
              //  $font->file('fonts/en/Lora/Lora-Bold.ttf');
              //  $font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
              //  $font->file('fonts/en/Lobster/Lobster-Regular.ttf');
                $font->file('fonts/en/Kameron/Kameron-Regular.ttf');
                $font->size(40);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });


            $txtarry2 = array(
                                  "You pray to start your day and ﬁnish it in prayer.You're just thankful for eyerything, all the blessings in your life, trying to stay that way. You think that's the best way to start your day and ﬁnish your day.It keeps everything in perspective.",
                                  "You pray for strength, for guidance, for comfort.When there is someone you know who is struggling, ill, or in pain, you pray that God would help them.",
                                  "You pray for humility, because it's very easy to be caught up in this world.",
                                  "You pray for forgiveness. Farhelp and guidance.To be a better person.For the health afyaurﬁzmily.For the world to be a better place.",
                             );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt = $txtarry2[$i]; // set variable equal to which random filename was chosen
            $string2 = wordwrap($overtxt,30,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=90; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 535, $i, function($font) {
            //$font->file('fonts/en/Lobster/Lobster-Regular.ttf');
            //  $font->file('fonts/en/ConcertOne/ConcertOne-Regular.ttf');
          //  $font->file('fonts/en/IM_Fell_English/IMFeENrm28P.ttf');
            $font->file('fonts/en/Kameron/Kameron-Regular.ttf');
            $font->size(33);
            $font->color('#fff');
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
            $canvas->insert($watermark, 'top-left' ,0,50);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app53_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, we respect your thought. You have a great heart and you always pray for well being of others. You always want the beautiful world where there are no false people and no one trying to pull each other down.</p>";
            $app_sub_description = "<p class='subtext'>Share this result with everyone and let them know what do you pray for!</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"53",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[52]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app53--
//---What Is Common Between You And MS Dhoni?----------------------------------------------------app54--

          public function en_app54(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[53]['app_title']);
          MetaTag::set('description',$this->app_store_info[53]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"54",'app_title'=>$this->app_store_info[53]['app_title'],'app_img_orignal_url'=>$this->app_store_info[53]['app_img_orignal_url'],'app_description'=>$this->app_store_info[53]['app_description']));

          }

          public function en_app54_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app54/bg-sample/Product_bg.png");

            $txtarry = array(
                              "He is benevolent to others.",
                              "He is a good listener.",
                              "He listens to his brain.",
                              "He loves freedom.",
                              "He believes in the good.",
                              "He never stops dreaming.",
                              "He loves life.",
                              "He listens to his heart.",
                              "He has a strong will.",
                              "He smiles during storms.",
                              "He now afraid of failures.",
                              "He is Very broad minded.",
                              "Honesty is his way of life.",
                              "He is respectful of others.",
                              "He is emotionally open.",
                              "He loves his life.",
                              "He is a dreamer.",
                              );

                              $random_keys=array_rand($txtarry,3);
                              $overtxt1 = $txtarry[$random_keys[0]];
                              $overtxt2 = $txtarry[$random_keys[1]];
                              $overtxt3 = $txtarry[$random_keys[2]];

                              $img->text($overtxt1,400, 140, function($font) {
                              $font->file('fonts/en/TradeWinds/TradeWinds-Regular.ttf');
                              $font->size(26);
                              $font->color('#fff');
                              $font->align('center');
                              $font->valign('middle');
                              });

                              $img->text($overtxt2,400, 240, function($font) {
                              $font->file('fonts/en/TradeWinds/TradeWinds-Regular.ttf');
                              $font->size(26);
                              $font->color('#fff');
                              $font->align('center');
                              $font->valign('middle');
                              });

                              $img->text($overtxt3,400, 350, function($font) {
                              $font->file('fonts/en/TradeWinds/TradeWinds-Regular.ttf');
                              $font->size(26);
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
            $canvas->insert($watermark, 'top-left' ,10,160);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app54_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>Amazing!! <b>".$posts->first_name.",</b> these three things are common between you and M.S Dhoni </p>";
            $app_sub_description = "<p class='subtext'>Share this result with your friends and let them know about common things between you and M.S Dhoni.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"54",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[53]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app54--
//----How Would Your Official Life Look Like After 10 Years?---------------------------------------------------app55--

          public function en_app55(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[54]['app_title']);
          MetaTag::set('description',$this->app_store_info[54]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"55",'app_title'=>$this->app_store_info[54]['app_title'],'app_img_orignal_url'=>$this->app_store_info[54]['app_img_orignal_url'],'app_description'=>$this->app_store_info[54]['app_description']));
          }

          public function en_app55_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app55/bg-sample/Product_bg.png");

            $uname = $posts->first_name;

            $img->text($uname, 100, 364, function($font) {
              //  $font->file('fonts/en/Lora/Lora-Bold.ttf');
                $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                $font->size(30);
                $font->color('#000');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });


                    $txtarry1 = array(
                      "Chief Technical Officer",
                      "Sr. Executive Engineer ",
                      "Managing Director",
                      "Animation Director ",
                      "General Manager"
                        );

                      $i = rand(0, count($txtarry1)-1); // generate random number size of the array
                      $overtxt1 = $txtarry1[$i]; // set variable equal to which random filename was chosen
                      $string1 = wordwrap($overtxt1,12,"|");
                      //create array of lines
                      $strings1 = explode("|",$string1);
                      $i=340; //top position of string
                      //for each line added
                      foreach($strings1 as $string){
                      $img->text($string,300, $i, function($font) {
                      $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                      $font->size(22);
                      $font->color('#000');
                      $font->align('center');
                      $font->valign('middle');
                      });
                      $i=$i+23; //shift top postition down 42
                      }


                    $overtxt2 = "$".number_format(rand(10,1000),3,",",",");

                    $img->text($overtxt2,500, 365, function($font) {
                    //$font->file('fonts/en/Lora/Lora-Bold.ttf');
                    $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                    $font->size(27);
                    $font->color('#000');
                    $font->align('center');
                    $font->valign('middle');
                    });

                    $txtarry3 = array(
                      "50 members.",
                      "60 people.",
                      "500 employees.",
                      "You are the BOSS.",
                      "25 people.",
                      "100 people."
                    );
                    $i = rand(0, count($txtarry3)-1); // generate random number size of the array
                    $overtxt3 = $txtarry3[$i]; // set variable equal to which random filename was chosen
                    $string3 = wordwrap($overtxt3,12,"|");
                    //create array of lines
                    $strings3 = explode("|",$string3);
                    $i=355; //top position of string
                    //for each line added
                    foreach($strings3 as $string){
                    $img->text($string,700, $i, function($font) {
                    $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                    $font->size(22);
                    $font->color('#000');
                    $font->align('center');
                    $font->valign('middle');
                    });
                    $i=$i+22; //shift top postition down 42
                    }

                    $txtarry4 = array(
                      "You would never stop until you find the solution to a given development problem.",
                      "You’re the perfect team player.",
                      "You have a thirst for knowledge and look at each opportunity to grow as a way to grow their business.",
                      "Your aim is both personal development as well as professional growth.",
                      "You are open to learning new things every day. ",
                      "You always listen to your staff and share your knowledge with them. "

                        );
                    $k = rand(0, count($txtarry1)-1);
                    $overtxt4 = $txtarry4[$k];


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(200,200, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,10,135);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app55_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>, your professional life, and your creative life are all intertwined. You went through a few very difficult years where you felt like a failure. But it was actually really important for you to go through that. This is how your official life would look like after 10 years.<br> <b>Designation: </b>".$overtxt1."<br> <b>Salary: </b>".$overtxt2."<br> <b>Team Size: </b>".$overtxt3."<br> <b>Working Attitude: </b>".$overtxt4."</p>";
            $app_sub_description = "<p class='subtext'>Share this result with your friends and tell them about this change.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"55",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[54]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }
//--------------------------------------------------------------------end app55--

//app56--------This is what God wants you to hear in 2018!-----------------------------------------------------

          public function en_app56(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[55]['app_title']);
          MetaTag::set('description',$this->app_store_info[55]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"56",'app_title'=>$this->app_store_info[55]['app_title'],'app_img_orignal_url'=>$this->app_store_info[55]['app_img_orignal_url'],'app_description'=>$this->app_store_info[55]['app_description']));

          }

          public function en_app56_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app56/bg-sample/Product_bg.png");

            $txtarry2 = array(
                              "I will never leave your side. Though you may think that  no one has your back, know that I am always here for you.",
                              "Trust in Me with all your heart when you I have no one to depend on. I will always be there for you. Your faith will lead you from the darkness.",
                              "You don’t need to compare yourself to other people. I made you in My image, and you are perfect the way you are.",
                              "No matter how grave you think your sins are, I will always forgive you. There is still a chance for you to change your ways.",
                              "You may be struggling right now and feel like life isn’t worth living. Be strong, for I believe in you.",
                            );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt = $txtarry2[$i]; // set variable equal to which random filename was chosen
            $string2 = wordwrap($overtxt,20,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=80; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 560, $i, function($font) {
            //$font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            //$font->file('fonts/en/Risque/Risque-Regular.ttf');
          //  $font->file('fonts/en/Josefin_Sans/JosefinSans-Regular.ttf');
            $font->file('fonts/en/Acme/Acme-Regular.ttf');
            //$font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
           //$font->file('fonts/en/FredokaOne/FredokaOne-Regular.ttf');
            //$font->file('fonts/en/SigmarOne/SigmarOne-Regular.ttf');
            $font->size(38);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+40; //shift top postition down 42
            }


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(430,430, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,-20,0);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app56_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>Don't worry too much, <b>".$posts->first_name."</b>. Trust in God for He has a plan for you</p>";
            $app_sub_description = "<p class='subtext'>Share this result with your family and friends.</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"56",'img_url'=>$fullimage_path,'app_result'=>$overtxt,'app_title'=>$this->app_store_info[55]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app56--

//app57--------What will your biography say?-----------------------------------------------------

          public function en_app57(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[56]['app_title']);
          MetaTag::set('description',$this->app_store_info[56]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"57",'app_title'=>$this->app_store_info[56]['app_title'],'app_img_orignal_url'=>$this->app_store_info[56]['app_img_orignal_url'],'app_description'=>$this->app_store_info[56]['app_description']));

          }

          public function en_app57_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app57/bg-sample/Product_bg.png");


            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 140, 358, function($font) {
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
              //  $font->file('fonts/en/Lora/Lora-Bold.ttf');
              //  $font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                  $font->file('fonts/en/Lobster/Lobster-Regular.ttf');
                $font->size(35);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });




            $txtarry2 = array(
                                  "He actively shaped his own  future. Not one to leave things to  the whimsies of fate, he strived  hard to create his own destiny.  Whatever he has now is the fruit of his wit and hard labor. He made himself his own person.",
                                  "He has gone through one ordeal after another, but he never failed to get through them with his head held high. Failures don’t deter him from reaching his dreams - if anything, he uses them as motivation to do better next time.",
                                  "He spares no effort when it comes to chasing after his dreams. Whenever he ventures out into something new, he gives his all. Not one to settle for half-assed things, he aims for nothing but perfection. His meticulous ways inspire others to be the same.",
                                  "He has always looked for a greater meaning in life. For him, simply acquiring material belongings isn’t a measure of success. He dreams of something bigger— of changing the world. He is ready to pour all his love, blood, sweat, and tears to make the world a better place.",
                                  "He never let the opinions of others get in his way. Though everyone was skeptical of his skills and talent, he proved them wrong with his hard work. He doesn’t let negativity get in the way of his road to success. He always ﬁnds the silver lining in the most difficult of situations.",
                             );


             $txtarry_f = array(
                                   "She actively shaped his own  future. Not one to leave things to  the whimsies of fate, she strived  hard to create his own destiny.  Whatever she has now is the fruit of his wit and hard labor. She made himself his own person.",
                                   "She has gone through one ordeal after another, but she never failed to get through them with his head held high. Failures don’t deter him from reaching his dreams - if anything, she uses them as motivation to do better next time.",
                                   "She spares no effort when it comes to chasing after his dreams. Whenever she ventures out into something new, she gives his all. Not one to settle for half-assed things, she aims for nothing but perfection. His meticulous ways inspire others to be the same.",
                                   "She has always looked for a greater meaning in life. For him, simply acquiring material belongings isn’t a measure of success. She dreams of something bigger— of changing the world. She is ready to pour all his love, blood, sweat, and tears to make the world a better place.",
                                   "She never let the opinions of others get in his way. Though everyone was skeptical of his skills and talent, she proved them wrong with his hard work. She doesn’t let negativity get in the way of his road to success. She always ﬁnds the silver lining in the most difficult of situations.",
                              );



            if($posts->Gender == "male"){
              $i = rand(0, count($txtarry2)-1);
              $overtxt = $txtarry2[$i];
             }
            else{
              $i = rand(0, count($txtarry_f)-1);
              $overtxt = $txtarry_f[$i];
            }


            $string2 = wordwrap($overtxt,29,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=60; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 550, $i, function($font) {
        //  $font->file('fonts/en/Lobster/Lobster-Regular.ttf');
          //  $font->file('fonts/en/ConcertOne/ConcertOne-Regular.ttf');
             $font->file('fonts/en/BreeSerif/BreeSerif-Regular.ttf');
            $font->size(25);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+30; //shift top postition down 42
            }


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(420,420, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,-30,0);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app57_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>Years from now, people will turn to your success story for inspiration. They will know what you are capable of, and that your actions are worth emulating.</p>";
            $app_sub_description = "<p class='subtext'>SHARE your biography with your friends and family!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"57",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[56]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app57--

//app58--------Find out which 7 things make you unique!----------------------------------------------------

          public function en_app58(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[57]['app_title']);
          MetaTag::set('description',$this->app_store_info[57]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"58",'app_title'=>$this->app_store_info[57]['app_title'],'app_img_orignal_url'=>$this->app_store_info[57]['app_img_orignal_url'],'app_description'=>$this->app_store_info[57]['app_description']));

          }

          public function en_app58_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app58/bg-sample/Product_bg.png");

            $uname1 = "7 things make";
            $img->text($uname1, 150, 340, function($font) {
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
              //  $font->file('fonts/en/Lora/Lora-Bold.ttf');
              //  $font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
                $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                //  $font->file('fonts/en/Lobster/Lobster-Regular.ttf');
                $font->size(35);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $uname2 = $posts->first_name." unique";
            $img->text($uname2, 150, 380, function($font) {
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
              //  $font->file('fonts/en/Lora/Lora-Bold.ttf');
              //  $font->file('fonts/en/Oswald/Oswald-SemiBold.ttf');
                $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                //  $font->file('fonts/en/Lobster/Lobster-Regular.ttf');
                $font->size(35);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $txtarry = array(
                              "Would love to see the world",
                              "Has strong,informed opinions",
                              "Assertive yet considerate",
                              "Immensely attractive",
                              "Easy to approach and befriend",
                              "Full of unique ideas",
                              "Unafraid of the unknown",
                              "Gets along with everyone",
                              "A very loyal friend",
                              "Hates fake people",
                              "Ready to take the lead",
                              "Full og fun ideas",
                              "Strong  and independent",
                              "Selfless but not naive",
                              "Able to cope with stress well",
                              "The life of the party",
                              "Is full of innovative ideas",
                              "Has a strong sense of justice",
                              "Dislikes dishonest people",
                              "Adventurous and outgoing",
                              "Has a strong sex appeal",
                              "Modest and humble",
                              "Always sees the good in people",
                              "Knows how to have a good time",
                              "Would love to see the world",
                              "Values honesty more than anything",
                              "Has strong,informed opinions",
                              "Assertive yet considerate",
                              "Immensely attractive",
                              "Easy to approach and befriend",
                              "Knows how to enjoy life",
                              "Looks at the bright side of things",
                              "Easy to get along with",
                              "Knows when to be serious"
                              );

                              $random_keys=array_rand($txtarry,7);
                              $overtxt1 = $txtarry[$random_keys[0]];
                              $overtxt2 = $txtarry[$random_keys[1]];
                              $overtxt3 = $txtarry[$random_keys[2]];
                              $overtxt4 = $txtarry[$random_keys[3]];
                              $overtxt5 = $txtarry[$random_keys[4]];
                              $overtxt6 = $txtarry[$random_keys[5]];
                              $overtxt7 = $txtarry[$random_keys[6]];



                              $img->text($overtxt1,380,38, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(22);
                              $font->color('#FA4F67');
                              $font->align('left');
                              $font->valign('middle');
                              });


                              $img->text($overtxt2,380,94, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(22);
                              $font->color('#FA4F67');
                              $font->align('left');
                              $font->valign('middle');
                              });


                              $img->text($overtxt3,380,156, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(22);
                              $font->color('#FA4F67');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt4,380,210, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(22);
                              $font->color('#FA4F67');
                              $font->align('left');
                              $font->valign('middle');
                              });

                              $img->text($overtxt5,380,270, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(22);
                              $font->color('#FA4F67');
                              $font->align('left');
                              $font->valign('middle');
                              });


                              $img->text($overtxt6,380,327, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(22);
                              $font->color('#FA4F67');
                              $font->align('left');
                              $font->valign('middle');
                              });


                              $img->text($overtxt7,380,384, function($font) {
                              $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                              $font->size(22);
                              $font->color('#FA4F67');
                              $font->align('left');
                              $font->valign('middle');
                              });


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(300,300, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,5,5);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app58_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>You truly are unlike any other! With so many good qualities, it's no wonder others are gravitate towards you and are enchanted by your presence. To them, your unique traits make you an indispensable person!</p>";
            $app_sub_description = "<p class='subtext'>SHARE this with your friends and family!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"58",'img_url'=>$fullimage_path,'app_result1'=>$overtxt1,'app_result2'=>$overtxt2,'app_result3'=>$overtxt3,'app_title'=>$this->app_store_info[57]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app58--

//app59--------What will you change about your self in 2018?-----------------------------------------------------

          public function en_app59(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[58]['app_title']);
          MetaTag::set('description',$this->app_store_info[58]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"59",'app_title'=>$this->app_store_info[58]['app_title'],'app_img_orignal_url'=>$this->app_store_info[58]['app_img_orignal_url'],'app_description'=>$this->app_store_info[58]['app_description']));
              }

          public function en_app59_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app59/bg-sample/Product_bg.png");

          $txtarry2 = array(
                                "Be more honest - not only with others, but with yourself as well. You're not trying to help anyone by lying, you're only prolonging the inevitable. The truth will hurt at first, but it will also set you free.",
                                "Live a little more! Don’t let the fear of the unknown stop you from going on the best adventures of your life. Take a chance! The best things in life are outside your comfort zone.",
                                "Challenge yourself more! Life is a never-ending learning experience. Be more afraid of not trying than of failing. Doing things that you haven't done before is the only way for you to grow into the person that you want to be.",
                                "Have a grateful heart at all times. Instead of thinking about the things that you don‘t have, be thankful for the things that you do have. Show your loved ones that you appreciate them and everything that they do- it will make their day!",
                             );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt = $txtarry2[$i]; // set variable equal to which random filename was chosen
            $string2 = wordwrap($overtxt,26,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=80; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 550, $i, function($font) {
          //  $font->file('fonts/en/Lobster/Lobster-Regular.ttf');
          //  $font->file('fonts/en/ConcertOne/ConcertOne-Regular.ttf');
             $font->file('fonts/en/BreeSerif/BreeSerif-Regular.ttf');
            $font->size(32);
            $font->color('#4519d2');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+32; //shift top postition down 42
            }


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(320,320, function ($constraint){
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
            $image_name = 'en_app58_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>It's hard at first, messy in the middle, but glorious at the end. Take the first step today!</p>";
            $app_sub_description = "<p class='subtext'>Don't forget to share this result with your friends, and have yourselves an unrecognizable but beautiful year!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"59",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[58]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app59--

//app60--------What will your biggest sin be in 2018?-----------------------------------------------------

          public function en_app60(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[59]['app_title']);
          MetaTag::set('description',$this->app_store_info[59]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"60",'app_title'=>$this->app_store_info[59]['app_title'],'app_img_orignal_url'=>$this->app_store_info[59]['app_img_orignal_url'],'app_description'=>$this->app_store_info[59]['app_description']));
          }

          public function en_app60_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app60/bg-sample/Product_bg.png");


            $uname = $posts->name;
            $img->text($uname, 460, 48, function($font) {
              $font->file('fonts/en/Source_Sans_Pro/SourceSansPro-Bold.ttf');
                $font->size(30);
                $font->color('#fff');
                $font->align('left');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $Gender = $posts->Gender;
            $img->text($Gender, 490,130, function($font) {
              $font->file('fonts/en/Source_Sans_Pro/SourceSansPro-Bold.ttf');
                $font->size(30);
                $font->color('#fff');
                $font->align('left');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });


          $txtarry = array(  "Gluttony",
                              "Lust",
                              "Wrath",
                              "Greed",
                              "Envy",
                              "Pride",
                          );
                          $random_keys=array_rand($txtarry,2);
                          $overtxt1 = $txtarry[$random_keys[0]];

                          $img->text($overtxt1,550,300, function($font) {
                          $font->file('fonts/en/Source_Sans_Pro/SourceSansPro-Bold.ttf');
                          $font->size(80);
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
            $canvas->insert($watermark, 'top-left' ,-20,10);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app60_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>You don't have to be shy; everyone gets a bit bad once in a while. Just don't let it consume you!</p>";
            $app_sub_description = "<p class='subtext'>Share this result with your family and friends!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"60",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[59]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app60--

//app61-------What was your profession in the wild west?----------------------------------------------------

          public function en_app61(){


          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[60]['app_title']);
          MetaTag::set('description',$this->app_store_info[60]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"61",'app_title'=>$this->app_store_info[60]['app_title'],'app_img_orignal_url'=>$this->app_store_info[60]['app_img_orignal_url'],'app_description'=>$this->app_store_info[60]['app_description']));

          }

          public function en_app61_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);


              if($posts->Gender == "male"){
                $dir = "images/english/app61/bg-sample/male";
                 }
                else{
                $dir = "images/english/app61/bg-sample/female";
                }


              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);
              $ext = pathinfo($img_path);
              $overtxt = $ext['filename'];

            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 150, 385, function($font) {
                 $font->file('fonts/en/Roboto/Roboto-Medium.ttf');
                $font->size(40);
                $font->color('#000');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(250, 250, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',35, 85);
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
            $image_name = 'en_app61_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
           // $img->save('images/fb1.jpg');

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
           //return  $img->response('jpg');
           //return view('/share',array('app_no'=>"1",'img'=>$img));

           $app_description = "<p class='subtext'>Courage is being scared to death and saddling up anyway. You run this town so act like it!</p>";
           $app_sub_description = "<p class='subtext'>Share with your family and friends!</p>";


           $html = view('english.Result_Share_fb_page',array('app_no'=>"61",'img_url'=>$fullimage_path,'app_result'=>$overtxt,'app_title'=>$this->app_store_info[60]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app61--

//app62--------What will happen to you in each month of 2018?----------------------------------------------------

          public function en_app62(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[61]['app_title']);
          MetaTag::set('description',$this->app_store_info[61]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"62",'app_title'=>$this->app_store_info[61]['app_title'],'app_img_orignal_url'=>$this->app_store_info[61]['app_img_orignal_url'],'app_description'=>$this->app_store_info[61]['app_description']));
          }

          public function en_app62_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);

              $dir = "images/english/app62/bg-sample/";
              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);
              $ext = pathinfo($img_path);
              $overtxt = $ext['filename'];

            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 120, 380, function($font) {
                 $font->file('fonts/en/Roboto/Roboto-Medium.ttf');
                $font->size(40);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(250, 250, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',0, 85);
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
            $image_name = 'en_app62_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
           // $img->save('images/fb1.jpg');

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
           //return  $img->response('jpg');
           //return view('/share',array('app_no'=>"1",'img'=>$img));

           $app_description = "<p class='subtext'>You have a lot happening for you this year, <b>".$posts->first_name."</b> It's looking like 2018 will be an unforgettable ride.</p>";
           $app_sub_description = "<p class='subtext'>Don't forget to share this result with your friends, and let them know how in demand you are right now!</p>";


           $html = view('english.Result_Share_fb_page',array('app_no'=>"62",'img_url'=>$fullimage_path,'app_result'=>$overtxt,'app_title'=>$this->app_store_info[61]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app62--

//app63--------What's your DNA ancestry based on your photo?-----------------------------------------------------

          public function en_app63(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[62]['app_title']);
          MetaTag::set('description',$this->app_store_info[62]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"63",'app_title'=>$this->app_store_info[62]['app_title'],'app_img_orignal_url'=>$this->app_store_info[62]['app_img_orignal_url'],'app_description'=>$this->app_store_info[62]['app_description']));

          }

          public function en_app63_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);

              $dir = "images/english/app63/bg-sample/";
              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);
              $ext = pathinfo($img_path);
              $overtxt = $ext['filename'];

            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 150, 375, function($font) {
                $font->file('fonts/en/Roboto/Roboto-Regular.ttf');
                $font->size(30);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(385,385, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',-15, 15);
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
            $image_name = 'en_app63_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
           // $img->save('images/fb1.jpg');

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
           //return  $img->response('jpg');
           //return view('/share',array('app_no'=>"1",'img'=>$img));

           $app_description = "<p class='subtext'> Your beautiful genes are well-spread all over the world.</p>";
           $app_sub_description = "<p class='subtext'>Share with your family and friends!</p>";


           $html = view('english.Result_Share_fb_page',array('app_no'=>"63",'img_url'=>$fullimage_path,'app_result'=>$overtxt,'app_title'=>$this->app_store_info[62]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app63--

//app64-------What kind of spirit watches over you?-------------------------------------------------

          public function en_app64(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[63]['app_title']);
          MetaTag::set('description',$this->app_store_info[63]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"64",'app_title'=>$this->app_store_info[63]['app_title'],'app_img_orignal_url'=>$this->app_store_info[63]['app_img_orignal_url'],'app_description'=>$this->app_store_info[63]['app_description']));
          }

          public function en_app64_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);

              $dir = "images/english/app64/bg-sample/";
              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(420,420, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',-20, 0);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app64_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
           // $img->save('images/fb1.jpg');

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
           //return  $img->response('jpg');
           //return view('/share',array('app_no'=>"1",'img'=>$img));

           $app_description = "<p class='subtext'>You're never so lost that your guardian angel cannot find you.</p>";
           $app_sub_description = "<p class='subtext'>Don't forget to share this result with your friends!</p>";


           $html = view('english.Result_Share_fb_page',array('app_no'=>"64",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[63]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app64--
//app65------Which 3 careers are right for you?-------------------------------------------------

          public function en_app65(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[64]['app_title']);
          MetaTag::set('description',$this->app_store_info[64]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"65",'app_title'=>$this->app_store_info[64]['app_title'],'app_img_orignal_url'=>$this->app_store_info[64]['app_img_orignal_url'],'app_description'=>$this->app_store_info[64]['app_description']));
          }

          public function en_app65_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);

              $dir = "images/english/app65/bg-sample/";
              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(390,390, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',-20, 15);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app65_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
           // $img->save('images/fb1.jpg');

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
           //return  $img->response('jpg');
           //return view('/share',array('app_no'=>"1",'img'=>$img));

           $app_description = "<p class='subtext'>What do you think, <b>".$posts->first_name."</b>? Thinking of switching careers already? You've got these three to choose from!</p>";
           $app_sub_description = "<p class='subtext'>Share with your family and friends!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"65",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[64]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app65--
//app66-----Let us guess your height!-------------------------------------------------

          public function en_app66(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[65]['app_title']);
          MetaTag::set('description',$this->app_store_info[65]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"66",'app_title'=>$this->app_store_info[65]['app_title'],'app_img_orignal_url'=>$this->app_store_info[65]['app_img_orignal_url'],'app_description'=>$this->app_store_info[65]['app_description']));
          }

          public function en_app66_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app66/bg-sample/Product_bg.png");
            $line1 =  "This is ".$posts->first_name."'s";
            $img->text($line1, 600, 80, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(30);
            $font->color('#FFD54F');
            $font->align('center');
            $font->valign('middle');
            });

            $line2 =  "height!";
            $img->text($line2, 600, 130, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(30);
            $font->color('#FFD54F');
            $font->align('center');
            $font->valign('middle');
            });

            $string1 =  rand(4,8)." feet";
            $img->text($string1, 600, 240, function($font) {
            //$font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            $font->size(60);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });
            $string2 = rand(4,8)." inches";
            $img->text($string2, 600, 310, function($font) {
          //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            $font->size(60);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(420,420, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,-30,0);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app66_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,Have we guessed right? This is how tall we think you are! </p>";
            $app_sub_description = "<p class='subtext'>Share this result, and let us know if we're right!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"66",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[65]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app66--

//app67------Which is more important to you: money or love?----------------------------------------

          public function en_app67(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[66]['app_title']);
          MetaTag::set('description',$this->app_store_info[66]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"67",'app_title'=>$this->app_store_info[66]['app_title'],'app_img_orignal_url'=>$this->app_store_info[66]['app_img_orignal_url'],'app_description'=>$this->app_store_info[66]['app_description']));
          }

          public function en_app67_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app67/bg-sample/Product_bg.png");
            $line1 =  $posts->first_name;
            $img->text($line1, 400, 330, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(30);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });

            $i = rand(0,100);
            $no1 = $i."%";

            $j = (100)-$i;
            $no2 =$j ."%";


            $img->text($no1, 150, 180, function($font) {
        //  $font->file('fonts/en/Berkshire_Swash/BerkshireSwash-Regular.ttf');
          $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(60);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });

            $img->text($no2, 630, 180, function($font) {
      //  $font->file('fonts/en/Berkshire_Swash/BerkshireSwash-Regular.ttf');
        $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(60);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });

            $string1 = "Money";
            $img->text($string1, 150, 260, function($font) {
          $font->file('fonts/en/Berkshire_Swash/BerkshireSwash-Regular.ttf');
            $font->size(70);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });
            $string2 = "Love";
            $img->text($string2, 620, 260, function($font) {
           $font->file('fonts/en/Berkshire_Swash/BerkshireSwash-Regular.ttf');
            $font->size(70);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(225,225, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,290,65);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app67_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,Though you know that money is necessary to maintain a decent standard of living, you believe that it won't be worth it unless you have people to share it with. </p>";
            $app_sub_description = "<p class='subtext'>SHARE this result with your friends and family!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"67",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[66]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app67--

//app68------Which parent are you like the most?------------------------------------------------

          public function en_app68(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[67]['app_title']);
          MetaTag::set('description',$this->app_store_info[67]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"68",'app_title'=>$this->app_store_info[67]['app_title'],'app_img_orignal_url'=>$this->app_store_info[67]['app_img_orignal_url'],'app_description'=>$this->app_store_info[67]['app_description']));
          }

          public function en_app68_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app68/bg-sample/Product_bg.png");
            $line1 =  $posts->first_name;
            $img->text($line1, 400, 330, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(30);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });
            $i = rand(0,100);
            $no1 = $i."%";

            $j = (100)-$i;
            $no2 =$j ."%";
            $img->text($no1, 150, 180, function($font) {
          //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            //$font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            $font->file('fonts/en/BungeeInline/BungeeInline-Regular.ttf');
            $font->size(60);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });

            $img->text($no2, 635, 180, function($font) {
            //$font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            //$font->file('fonts/en/JacquesFrancoisShadow/JacquesFrancoisShadow-Regular.ttf');
            $font->file('fonts/en/BungeeInline/BungeeInline-Regular.ttf');
            $font->size(60);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(225,225, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,290,65);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app68_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,Don't forget to keep thanking them for everything that they've given to you!</p>";
            $app_sub_description = "<p class='subtext'>Share this with your friends, and tag your family to see if they agree!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"68",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[67]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app68--

//app69---Heaven or Hell: Where are you headed?-----------------------------------------

          public function en_app69(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[68]['app_title']);
          MetaTag::set('description',$this->app_store_info[68]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"69",'app_title'=>$this->app_store_info[68]['app_title'],'app_img_orignal_url'=>$this->app_store_info[68]['app_img_orignal_url'],'app_description'=>$this->app_store_info[68]['app_description']));
          }

          public function en_app69_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app69/bg-sample/Product_bg.png");

            $uname = $posts->first_name;

            $img->text($uname, 490,77, function($font) {
                //$font->file('fonts/en/TradeWinds/TradeWinds-Regular.ttf');
              //  $font->file('fonts/en/Frijole/Frijole-Regular.ttf');
                $font->file('fonts/en/Audiowide/Audiowide-Regular.ttf');
                $font->size(30);
                $font->color('#F56E00');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

                    $overtxt1 = rand(1,5);
                    $overtxt2 = number_format(rand(10,1000),3,",",",");
                    $overtxt3 = number_format(rand(10,1000),2,".",",")."%";

                    $img->text($overtxt1,390,132, function($font) {
                    $font->file('fonts/en/Anton/Anton-Regular.ttf');
                    $font->size(30);
                    $font->color('#008900');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $img->text($overtxt2,530, 193, function($font) {
                    $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                    $font->size(30);
                    $font->color('#DC004D');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $img->text($overtxt3,465,251, function($font) {
                    $font->file('fonts/en/Slackey/Slackey-Regular.ttf');
                    $font->size(30);
                    $font->color('#FBC555');
                    $font->align('left');
                    $font->valign('middle');
                    });

                  $arr_car=array("Heaven","Hell");

                  $i = rand(0, count($arr_car)-1); // generate random number size of the array
                  $overtxt4 = $arr_car[$i];

                  $img->text($overtxt4,360,351, function($font) {
                  $font->file('fonts/en/Volkhov/Volkhov-Bold.ttf');
                  $font->size(40);
                  $font->color('#F1F915');
                  $font->align('left');
                  $font->valign('middle');
                  });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(270,270, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,25,30);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app69_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$posts->first_name."</b>,The way you live your life reflects the kind of soul you have. Remember to be a little more kinder, loving, and giving to those around you!</p>";
            $app_sub_description = "<p class='subtext'>Don't forget to share this with your friends!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"69",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[68]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app69--

//app70----How many people want to kiss, marry, and kill you in 2018?---------------------------------------------

          public function en_app70(){

          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[69]['app_title']);
          MetaTag::set('description',$this->app_store_info[69]['app_meta_desc']);

          return  view('english.app_view_home',array('app_no'=>"70",'app_title'=>$this->app_store_info[69]['app_title'],'app_img_orignal_url'=>$this->app_store_info[69]['app_img_orignal_url'],'app_description'=>$this->app_store_info[69]['app_description']));
          }

          public function en_app70_createimg(){
            if (Auth::check()){
            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app70/bg-sample/Product_bg.png");

            $uname = $posts->first_name;

            $img->text($uname, 140, 366, function($font) {
                $font->file('fonts/en/Lora/Lora-Bold.ttf');
                $font->size(34);
                $font->color('#000');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

                    $overtxt1 = rand(0, 100);

                    $img->text($overtxt1,545,70, function($font) {
                    $font->file('fonts/en/Lora/Lora-Bold.ttf');
                    $font->size(50);
                    $font->color('#fff');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $overtxt2 = rand(0, 100);
                    $img->text($overtxt2,620, 213, function($font) {
                    $font->file('fonts/en/Lora/Lora-Bold.ttf');
                    $font->size(50);
                    $font->color('#fff');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $overtxt3 = rand(0, 100);
                    $img->text($overtxt3,550,354, function($font) {
                    $font->file('fonts/en/Lora/Lora-Bold.ttf');
                    $font->size(50);
                    $font->color('#fff');
                    $font->align('left');
                    $font->valign('middle');
                    });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(310,310, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,5,15);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app70_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>Looks like you're a popular one, <b>".$posts->first_name."</b> Everyone seems to have an agenda for you! All you have to do now is find out who's who.</p>";
            $app_sub_description = "<p class='subtext'>Share this result with your family and friends!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"70",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[69]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app70--

//app71----Who is your famous celebrity lookalike?-------------------------------------------

          public function en_app71(){

                      MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[70]['app_title']);
                      MetaTag::set('description',$this->app_store_info[70]['app_meta_desc']);

                      return  view('english.app_view_home',array('app_no'=>"71",'app_title'=>$this->app_store_info[70]['app_title'],'app_img_orignal_url'=>$this->app_store_info[70]['app_img_orignal_url'],'app_description'=>$this->app_store_info[70]['app_description']));
          }

          public function en_app71_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);


              if($posts->Gender == "male"){
              $dir = "images/english/app71/bg-sample/male";
               }
              else{
              $dir = "images/english/app71/bg-sample/female";
              }



              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);
              $ext = pathinfo($img_path);
              $overtxt = $ext['filename'];

            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 200,380, function($font) {
                $font->file('fonts/en/Roboto/Roboto-Bold.ttf');
                $font->size(36);
                $font->color('#000');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(360, 360, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',25,60);
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
            $image_name = 'en_app71_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
            // $img->save('images/fb1.jpg');

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
            //return  $img->response('jpg');
            //return view('/share',array('app_no'=>"1",'img'=>$img));

            $app_description = "<p class='subtext'>You deserve to be a star.</p>";
            $app_sub_description = "<p class='subtext'>Share with your family and friends!</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"71",'img_url'=>$fullimage_path,'app_result'=>$overtxt,'app_title'=>$this->app_store_info[70]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app71--

//app72----What does Satan have to say about you?--------------------------------------------

          public function en_app72(){

                      MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[71]['app_title']);
                      MetaTag::set('description',$this->app_store_info[71]['app_meta_desc']);

                      return  view('english.app_view_home',array('app_no'=>"72",'app_title'=>$this->app_store_info[71]['app_title'],'app_img_orignal_url'=>$this->app_store_info[71]['app_img_orignal_url'],'app_description'=>$this->app_store_info[71]['app_description']));
          }

          public function en_app72_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app72/bg-sample/Product_bg.png");

            $txtarry2 = array(
                                  "Unfortunately, your application to join my legion of demons has been rejected. You’re too nice. We don't need saints like you in hell. We’re looking for someone more deceitful and conniving.",
                                  "Please give us a week's notice before your arrival in hell. We need to prepare another, deeper level of hell just for you. The 3 ones we have aren’t enough.",
                                  "I’ve been looking for someone like you to be my right hand. With the amount of broken hearts and crushed hopes you've brought upon the people around you, I’m sure you’re more than qualified.",
                                  "Your horns haven’t grown in yet. You're too much of a goody-two-shoes. If you want to join my army of devils, you have to up your sinning game and make sure those horns get nice and long.",
                                  "I have a feeling that you will have no problem fitting with all the other sinners in hell. However,,I can’t have you usurping my throne and replacing me as King of Hell.",
                             );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt = $txtarry2[$i]; // set variable equal to which random filename was chosen
            $string2 = wordwrap($overtxt,28,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=120; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 350, $i, function($font) {
            $font->file('fonts/en/TradeWinds/TradeWinds-Regular.ttf');
            $font->size(28);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+30; //shift top postition down 42
            }


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(120,120, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-right' ,110,30);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app72_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>We're not sure if that was a burn, but Satan sure does have a lot to say about you. What you do with that information is up to you. We won't judge. Neither would Satan. That's not his job. It's Someone else's.</p>";
            $app_sub_description = "<p class='subtext'>SHARE Satan's message with your friends and family!</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"72",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[71]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app72--

//app73----Which color suits the journey of your life?---------------------------------------------

          public function en_app73(){

                      MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[72]['app_title']);
                      MetaTag::set('description',$this->app_store_info[72]['app_meta_desc']);

                      return  view('english.app_view_home',array('app_no'=>"73",'app_title'=>$this->app_store_info[72]['app_title'],'app_img_orignal_url'=>$this->app_store_info[72]['app_img_orignal_url'],'app_description'=>$this->app_store_info[72]['app_description']));
          }

          public function en_app73_createimg(){
            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);


              $dir = "images/english/app73/bg-sample/";
              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);
              $ext = pathinfo($img_path);
              $overtxt = $ext['filename'];


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(420, 420, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',-25, 0);
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
            $image_name = 'en_app73_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
           // $img->save('images/fb1.jpg');

             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
           //return  $img->response('jpg');
           //return view('/share',array('app_no'=>"1",'img'=>$img));

           $app_description = "<p class='subtext'>Most of the time, it's the journey that teaches you a lot about your destination. It seems like you're heading somewhere beautiful!</p>";
           $app_sub_description = "<p class='subtext'>Share with your family and friends!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"73",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[72]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app73--

//app74----What are your 3 qualities and 1 flaw?--------------------------------------------

          public function en_app74(){

                      MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[73]['app_title']);
                      MetaTag::set('description',$this->app_store_info[73]['app_meta_desc']);

                      return  view('english.app_view_home',array('app_no'=>"74",'app_title'=>$this->app_store_info[73]['app_title'],'app_img_orignal_url'=>$this->app_store_info[73]['app_img_orignal_url'],'app_description'=>$this->app_store_info[73]['app_description']));
          }

          public function en_app74_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app74/bg-sample/Product_bg.png");

            $uname = $posts->first_name;

            $img->text($uname, 145, 363, function($font) {
                $font->file('fonts/en/Audiowide/Audiowide-Regular.ttf');
                $font->size(38);
                $font->color('#000');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

                  $qualities = [ "Sincere",
                    "Honest",
                    "Understanding",
                    "Loyal",
                    "Truthful",
                    "Trustworthy",
                    "Intelligent",
                    "Dependable",
                    "Open-Minded",
                    "Thoughtful",
                    "Wise",
                    "Considerate",
                    "Good-Natured",
                    "Reliable",
                    "Mature",
                    "Warm",
                    "Earnest",
                    "Kind",
                    "Friendly",
                    "Kind-Hearted",
                    "Happy",
                    "Clean",
                    "Interesting",
                    "Unselfish",
                    "Good-Humored",
                    "Honorable",
                    "Humorous",
                    "Responsible",
                    "Cheerful",
                    "Trustful",
                    "Warm-Hearted",
                    "Broad-Minded",
                    "Gentle",
                    "Well-Spoken",
                    "Educated",
                    "Reasonable",
                     "Companionable",
                    "Likable",
                    "Trusting",
                    "Clever",
                    "Pleasant",
                    "Courteous",
                    "Quick-Witted",
                    "Tactful",
                    "Helpful",
                    "Appreciative",
                    "Imaginative",
                    "Outstanding",
                    "Self-Disciplined",
                    "Brilliant",
                    "Enthusiastic",
                    "Level-Headed",
                    "Polite",
                    "Original",
                    "Smart",
                    "Forgiving",
                    "Sharp-Witted",
                    "Well-Read",
                    "Ambitious",
                    "Bright",
                    "Respectful",
                    "Efficient",
                    "Good-Tempered",
                    "Grateful",
                    "Conscientious",
                    "Resourceful",
                    "Alert",
                    "Good",
                    "Witty",
                    "Clear-Headed",
                    "Kindly",
                    "Admirable",
                    "Patient",
                    "Talented",
                    "Perceptive",
                    "Spirited",
                    "Sportsmanlike",
                    "Well-Mannered",
                    "Cooperative",
                    "Ethical",
                    "Intellectual",
                    "Versatile",
                    "Capable",
                    "Courageous",
                    "Constructive",
                    "Productive",
                    "Progressive",
                    "Individualistic",
                    "Observant",
                     "Ingenious",
                     "Lively",
                    "Neat",
                    "Punctual",
                    "Logical",
                    "Prompt",
                    "Accurate",
                    "Sensible",
                    "Creative",
                    "Self-Reliant",
                    "Tolerant",
                    "Amusing",
                    "Clean-Cut",
                    "Generous",
                    "Sympathetic",
                    "Energetic",
                    "High-Spirited",
                    "Self-Controlled",
                    "Tender",
                    "Active",
                    "Independent",
                    "Respectable",
                    "Inventive",
                    "Wholesome",
                    "Congenial",
                    "Cordial",
                    "Experienced",
                    "Attentive",
                    "Cultured",
                    "Frank",
                    "Purposeful",
                    "Decent",
                    "Diligent",
                    "Realist",
                    "Eager",
                    "Poised",
                    "Competent",
                    "Realistic",
                    "Amiable",
                    "Optimistic",
                    "Vigorous",
                    "Entertaining",
                    "Adventurous",
                    "Vivacious",
                    "Composed",
                    "Relaxed",
                    "Romantic",
                    "Proficient",
                    "Rational",
                    "Skillful",
                    "Enterprising",
                    "Gracious",
                    "Able",
                    "Nice",
                    "Agreeable",
                    "Skilled",
                    "Curious",
                    "Modern",
                    "Charming",
                    "Sociable",
                    "Modest",
                    "Decisive",
                    "Humble",
                    "Tidy",
                    "Popular",
                    "Upright",
                    "Literary",
                    "Practical",
                    "Light-Hearted",
                     "Well-Bred",
                    "Refined",
                    "Self-Confident",
                    "Cool-Headed",
                    "Studious",
                    "Adventuresome",
                    "Discreet",
                    "Informal",
                    "Thorough",
                    "Exuberant",
                    "Inquisitive",
                    "Easygoing",
                    "Outgoing"];

                    $random_keys=array_rand($qualities,3);
                    $overtxt1 = $qualities[$random_keys[0]];
                    $overtxt2 = $qualities[$random_keys[1]];
                    $overtxt3 = $qualities[$random_keys[2]];

                    $img->text($overtxt1,400,115, function($font) {
                  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                    $font->size(34);
                    $font->color('#fff');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $img->text($overtxt2,400, 195, function($font) {
                    $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                    $font->size(34);
                    $font->color('#fff');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $img->text($overtxt3,400,275, function($font) {
                  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                    $font->size(34);
                    $font->color('#fff');
                    $font->align('left');
                    $font->valign('middle');
                    });

                  $flaw=array( "Absent-minded",
                   "Abusive",
                   "Addict",
                   "Aimless",
                   "Alcoholic",
                   "Anxious",
                   "Arrogant",
                   "Audacious",
                   "Bad Habit",
                   "Bigmouth",
                   "Bigot",
                   "Blunt",
                   "Bold",
                   "Callous",
                   "Childish",
                   "Complex",
                   "Cruel",
                   "Cursed",
                   "Dependent",
                   "Deranged",
                   "Dishonest",
                   "Disloyal",
                   "Disorder",
                   "Disturbed",
                   "Dubious",
                   "Dyslexic",
                   "Egotistical",
                   "Envious",
                   "Erratic",
                   "Fanatical",
                   "Fickle",
                   "Fierce",
                   "Finicky",
                   "Fixated",
                   "Flirt",
                   "Gluttonous",
                   "Gruff",
                   "Gullible",
                   "Hard",
                   "Humourless",
                   "Hypocritical",
                   "Idealist",
                   "Zealous",
                   "Withdrawn",
                   "Vain",
                   "Unlucky");

                  $i = rand(0, count($flaw)-1); // generate random number size of the array
                  $overtxt4 = $flaw[$i];

                  $img->text($overtxt4,400,360, function($font) {
                $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                  $font->size(34);
                  $font->color('#fff');
                  $font->align('left');
                  $font->valign('middle');
                  });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(280,280, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,20,70);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app74_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>You attract the right things when you have a sense of who you are. Keep doing you!</p>";
            $app_sub_description = "<p class='subtext'>Don't forget to share this with your friends!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"74",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[73]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app74--

//app75---Can we guess your profession by just one look at your profile picture?-------------------------------------------

          public function en_app75(){

                      MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[74]['app_title']);
                      MetaTag::set('description',$this->app_store_info[74]['app_meta_desc']);

                      return  view('english.app_view_home',array('app_no'=>"75",'app_title'=>$this->app_store_info[74]['app_title'],'app_img_orignal_url'=>$this->app_store_info[74]['app_img_orignal_url'],'app_description'=>$this->app_store_info[74]['app_description']));
          }

          public function en_app75_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app75/bg-sample/Product_bg.png");



            $txtarry1 = array(
                                "Accountant",
                                "Actuary",
                                "Aircraft Mechanic",
                                "Airline Pilot",
                                "Animal Groomer",
                                "Architect",
                                "Auto Mechanic",
                                "Bank Teller",
                                "Bartender",
                                "Bookkeeping",
                                "Accounting",
                                "Auditing Clerks",
                                "Brick Mason",
                                "Budget Analyst",
                                "Cashier",
                                "Chef",
                                "Chemist",
                                "Claims Adjuster",
                                "Appraiser",
                                "Examiner",
                                "Investigator",
                                "Computer Programmer",
                                "Consultant",
                                "Correctional Officer",
                                "Court Reporter",
                                "Curator",
                                "Database Administrator",
                                "Dental Hygienist",
                                "Dentist",
                                "Dietitian/Nutritionist",
                                "Doctor",
                                "Editor",
                                "Electrician",
                                "EMTs and Paramedics",
                                "Environmental Engineer",
                                "Epidemiologist",
                                "Event/Meeting Planner",
                                "Fashion Designer",
                                "Financial Advisor",
                                "Firefighter",
                                "Fitness Trainer",
                                "Flight Attendant",
                                "Funeral Director",
                                "Fundraiser",
                                "Judge",
                                "Glazier",
                                "Graphic Designer",
                                "Guidance Counselor",
                                "Health Educator",
                                "Home Health Aide",
                                "Hydrologist",
                                "Insurance Underwriter",
                                "Interior Designer",
                                "Janitor",
                                "Lawyer",
                                "Librarian",
                                "Loan Officer",
                                "Manicurist",
                                "Mechanical Engineer",
                                "Medical Assistant",
                                "Nursing Assistant",
                                "Occupational Therapist",
                                "Pharmacist",
                                "Pharmacy Technician",
                                "Physician Assistant",
                                "Photographer",
                                "Physical Therapist",
                                "Plumber",
                                "Police Officer",
                                "Purchasing Manager",
                                "Receptionist",
                                "Registered Nurse",
                                "Retail Salesperson",
                                "Retail Supervisor",
                                "Security Guard",
                                "Social Media Manager",
                                "Social Worker",
                                "Software Developer",
                                "Teacher",
                                "Teacher Assistant",
                                "Veterinarian",
                                "Waiter/Waitress",
                                "Web Developer",
                                "Writer and Editor",
                            );
                            $random_keys=array_rand($txtarry1,2);
                            $overtxt = $txtarry1[$random_keys[0]];
                            $overtxt1 = $txtarry1[$random_keys[1]];
            $img->text($overtxt, 550,150, function($font) {
              $font->file('fonts/en/Source_Sans_Pro/SourceSansPro-Bold.ttf');
                $font->size(40);
                $font->color('#0BAE64');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });


                          $img->text($overtxt1,550,325, function($font) {
                          $font->file('fonts/en/Source_Sans_Pro/SourceSansPro-Bold.ttf');
                          $font->size(40);
                          $font->color('#ec0f0d');
                          $font->align('center');
                          $font->valign('middle');
                          });


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(400,400, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,-25,15);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app75_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>It just goes to show that you can't judge a person by their profile photo! There are so many sides of you that your photo can't capture.</p>";
            $app_sub_description = "<p class='subtext'>SHARE this result with your friends and family!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"75",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[74]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app75--

//app76---See your life in 2018!---------------------------------------------

          public function en_app76(){


                      MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[75]['app_title']);
                      MetaTag::set('description',$this->app_store_info[75]['app_meta_desc']);
                      return  view('english.app_view_home',array('app_no'=>"76",'app_title'=>$this->app_store_info[75]['app_title'],'app_img_orignal_url'=>$this->app_store_info[75]['app_img_orignal_url'],'app_description'=>$this->app_store_info[75]['app_description']));
          }

          public function en_app76_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app76/bg-sample/Product_bg.png");

            $txtarry1 = [  "Single",
                            "In a relationship",
                            "Engaged",
                            "Married"
                        ];

            $random_keys=array_rand($txtarry1,2);
            $overtxt1 = $txtarry1[$random_keys[0]];

            $txtarry2 = [    "New car",
                              "New Work",
                              "New Friends",
                              "Business",
                              "Baby",
                              "New house",
                              "Travel",
                              "Promotion",
                              "Happy family",
                              "Healthy lifestyle",
                              "Engagement",
                        ];

            $random_keys1=array_rand($txtarry2,2);
            $overtxt3 = $txtarry2[$random_keys1[0]];
            $overtxt4 = $txtarry2[$random_keys1[1]];

           $overtxt2 = "$".number_format(rand(100,100000),2,",",",");

                    $img->text($overtxt1,400,80, function($font) {
                    $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                    $font->size(24);
                    $font->color('#fff');
                    $font->align('left');
                    $font->valign('middle');
                    });

                    $img->text($overtxt2,400, 195, function($font) {
                    $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                    $font->size(24);
                    $font->color('#fff');
                    $font->align('left');
                    $font->valign('middle');
                    });

                  $img->text($overtxt3,400,320, function($font) {
                  $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                  $font->size(32);
                  $font->color('#fff');
                  $font->align('left');
                  $font->valign('middle');
                  });

                  $img->text($overtxt4,400,360, function($font) {
                  $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                  $font->size(32);
                  $font->color('#fff');
                  $font->align('left');
                  $font->valign('middle');
                  });

                  $markimg = $posts->picture;
                  $watermark = Image::make($markimg);
                  $watermark->resize(400,400, function ($constraint){
                      $constraint->aspectRatio();
                  });

                  $canvas = Image::canvas(800, 420);
                  $canvas->insert($watermark, 'top-left' ,-35,15);
                  $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app76_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);


            $app_description = "<p class='subtext'>It looks like 2018 is going to be an amazing year for you, <b>".$posts->first_name."</b>! 2018 can't come soon enough!</p>";
            $app_sub_description = "<p class='subtext'>Share this prediction with your family and friends!</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"76",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[75]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
             return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app76--

//app77----Can we tell your income based on your face?--------------------------------------

          public function en_app77(){

                      MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[76]['app_title']);
                      MetaTag::set('description',$this->app_store_info[76]['app_meta_desc']);

                      return  view('english.app_view_home',array('app_no'=>"77",'app_title'=>$this->app_store_info[76]['app_title'],'app_img_orignal_url'=>$this->app_store_info[76]['app_img_orignal_url'],'app_description'=>$this->app_store_info[76]['app_description']));
          }

          public function en_app77_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app77/bg-sample/Product_bg.png");

            $txtarry1 = [ "The Rich","The Elite","The Capitalist" ];
            $random_keys=array_rand($txtarry1,2);
            $overtxt1 = $txtarry1[$random_keys[0]];

            $txtarry2 = [     "Account Collectors",
                             "Accountants",
                             "Accounting Clerks",
                             "Actors",
                             "Actuaries",
                             "Announcers",
                             "Architects",
                             "Art Directors",
                             "Assemblers",
                             "Astronomers",
                             "Auditors",
                             "Authors",
                             "Bakers",
                             "Bill Collectors",
                             "Biologist",
                             "Chefs",
                             "Chemists",
                             "Computer Programmers",
                             "Computer Repairers",
                             "Computer Scientists",
                             "Cooks",
                             "Carpenter",
                             "Dancers",
                             "Dentists",
                             "Doctors",
                             "Editors",
                             "Economist",
                             "Electricians",
                             "Farmers",
                             "Fashion Designers",
                             "Financial Managers",
                             "Fine Artists",
                             "Fitness Trainer",
                             "Judges",
                             "Jewelers",
                             "Journalist",
                             "Machinists",
                             "Models",
                             "Manager",
                             "Nurses",
                             "Office Clerks",
                             "Pharmacists",
                             "Photographer",
                             "Physicist",
                             "Plumbers",
                             "Police",
                             "Reporters",
                             "Roofers",
                             "Sales Engineers",
                             "Sales Managers",
                             "Singers",
                             "Solderers",
                             "Social Workers",
                             "Sociologists",
                             "Tellers",
                             "Travel Agents",
                             "Travel Clerks",
                             "Travel Guides",
                             "Video Editors",
                             "Web Developers",
                             "Writers",
                             "Welder",
                             "Cashier",
                             "Woodworkers",
                             "Zoologists",
                             "Loan Officer",
                             "Teller",
                             "Security Guard",
                        ];

            $random_keys1=array_rand($txtarry2,2);
            $overtxt3 = $txtarry2[$random_keys1[0]];


           $overtxt2 = "$".number_format(rand(10,10000000),2,",",",");

                    $img->text($overtxt1,550,50, function($font) {
                    $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                    $font->size(60);
                    $font->color('#000');
                    $font->align('center');
                    $font->valign('middle');
                    });

                    $img->text($overtxt2,550, 185, function($font) {
                    $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                    $font->size(40);
                    $font->color('#159712');
                    $font->align('center');
                    $font->valign('middle');
                    });

                  $img->text($overtxt3,550,315, function($font) {
                  $font->file('fonts/en/ArchivoBlack/ArchivoBlack-Regular.ttf');
                  $font->size(40);
                  $font->color('#159712');
                  $font->align('center');
                  $font->valign('middle');
                  });



                  $markimg = $posts->picture;
                  $watermark = Image::make($markimg);
                  $watermark->resize(420,420, function ($constraint){
                      $constraint->aspectRatio();
                  });

                  $canvas = Image::canvas(800, 420);
                  $canvas->insert($watermark, 'top-left' ,-35,0);
                  $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app77_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>It seems fortune goes smoothly for you, <b>".$posts->first_name."</b> </p>";
            $app_sub_description = "<p class='subtext'>Share with your family and friends!</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"77",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[76]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
             return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app77--


//app78---Who is the love of your life?------------------------------------------

          public function en_app78(){

                      MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[77]['app_title']);
                      MetaTag::set('description',$this->app_store_info[77]['app_meta_desc']);

                      return  view('english.app_view_home',array('app_no'=>"78",'app_title'=>$this->app_store_info[77]['app_title'],'app_img_orignal_url'=>$this->app_store_info[77]['app_img_orignal_url'],'app_description'=>$this->app_store_info[77]['app_description']));
          }

          public function en_app78_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app78/bg-sample/Product_bg.png");

            $uname = $posts->first_name;

            $img->text($uname, 535, 360, function($font) {
                $font->file('fonts/en/Audiowide/Audiowide-Regular.ttf');
                $font->size(38);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $txtarry2 = array(
                                    "Let her go.You will be fine",
                                    "You don't need one",
                                    "You're with her already",
                                    "Your mom is the love of your life.",
                                    "You've met her already,but you chose to stay friends.",
                                    "You is already with someone else.",
                                    "You don't need anybody,except your family and friends.",
                                    "You thought you love her,but there's someone better.",
                                    "You look fine,but deep inside,you still love your ex.",
                                    "You've met her already,but you chose to stay friends.",
                                    "Your dad is the love of your life",
                             );

            $i = rand(0, count($txtarry2)-1); // generate random number size of the array
            $overtxt = $txtarry2[$i]; // set variable equal to which random filename was chosen
            $string2 = wordwrap($overtxt,15,"|");
            //create array of lines
            $strings2 = explode("|",$string2);
            $i=100; //top position of string
            //for each line added
            foreach($strings2 as $string){
            $img->text($string, 535, $i, function($font) {
            //$font->file('fonts/en/Lobster/Lobster-Regular.ttf');
            //  $font->file('fonts/en/ConcertOne/ConcertOne-Regular.ttf');
            //  $font->file('fonts/en/IM_Fell_English/IMFeENrm28P.ttf');
            $font->file('fonts/en/Kameron/Kameron-Regular.ttf');
            $font->size(45);
            $font->color('#fff');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+45; //shift top postition down 42
            }


            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(420,420, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,-30,0);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app78_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>Someone out there is bound to be your forever person. We've helped you narrow down the search!</p>";
            $app_sub_description = "<p class='subtext'>Share with your family and friends!</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"78",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[77]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app78--

//app79----How dirty is your mind?-------------------------------------------

          public function en_app79(){

                      MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[78]['app_title']);
                      MetaTag::set('description',$this->app_store_info[78]['app_meta_desc']);

                      return  view('english.app_view_home',array('app_no'=>"79",'app_title'=>$this->app_store_info[78]['app_title'],'app_img_orignal_url'=>$this->app_store_info[78]['app_img_orignal_url'],'app_description'=>$this->app_store_info[78]['app_description']));
          }

          public function en_app79_createimg(){
            if (Auth::check()){

            // paste another image
            $posts  = User::find(Auth::user()->id);

            $img = Image::make("images/english/app79/bg-sample/Product_bg.png");


            $overtxt1 = $posts->first_name;
            $img->text($overtxt1, 140, 365, function($font) {
                $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                $font->size(35);
                $font->color('#000');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $overtxt2 = rand(0,40)."%";
            $img->text($overtxt2,535,125, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(45);
            $font->color('#FF0000');
            $font->align('center');
            $font->valign('middle');
            });

            $img->text("dirty",535,180, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(45);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });


            $txtarry3 = array(
                                "You're as pure as it gets",
                                "Impure thoughts plague your mind.",
                                "An angel on the outside,but a devil on the inside.",
                                "Santa Claus blushes at the thoughts on your mind.",
                                "You're a very naughty, naughty boy",
                                "You have the right touch of innocence and naughtiness",
                             );

            $i = rand(0, count($txtarry3)-1); // generate random number size of the array
            $overtxt3 = $txtarry3[$i];


            if($overtxt3=="You're a very naughty, naughty boy"){

                if($posts->Gender=='female'){
                  $overtxt3 = "You're a very naughty, naughty girl";
                }else{
                  $overtxt3 = "You're a very naughty, naughty boy";
                }
            }

            $string3 = wordwrap($overtxt3,20,"|");
            //create array of lines
            $strings3 = explode("|",$string3);
            $i=250; //top position of string
            //for each line added
            foreach($strings3 as $string){
            $img->text($string, 550, $i, function($font) {
            $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
            $font->size(30);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
            });
            $i=$i+40; //shift top postition down 42
            }



            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(300,300, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,0,80);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $posts['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app79_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>The angels shy away when they read your mind.</p>";
            $app_sub_description = "<p class='subtext'>Share to see how your friends will react!</p>";

           $html = view('english.Result_Share_fb_page',array('app_no'=>"79",'img_url'=>$fullimage_path,'app_result'=>$overtxt2,'app_title'=>$this->app_store_info[78]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
           return response()->json(compact('html'));
            }
           else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app79--

//app80----What will your daughter look like?---------------------------------------------

          public function en_app80(){

                    MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[79]['app_title']);
                    MetaTag::set('description',$this->app_store_info[79]['app_meta_desc']);
                    MetaTag::set('image',$this->app_store_info[79]['app_img_orignal_url']);



                   return  view('english.app_view_home',array('app_no'=>"80",'app_title'=>$this->app_store_info[79]['app_title'],'app_img_orignal_url'=>$this->app_store_info[79]['app_img_orignal_url'],'app_description'=>$this->app_store_info[79]['app_description']));
                    // $view = View::make('english.app_view_home', array('app_no'=>"80",'app_title'=>$this->app_store_info[79]['app_title'],'app_img_orignal_url'=>$this->app_store_info[79]['app_img_orignal_url'],'app_description'=>$this->app_store_info[79]['app_description']));
                    // return $view;
          }

          public function en_app80_createimg(){

            if (Auth::check()){

            // paste another image
              $posts  = User::find(Auth::user()->id);

              $dir = "images/english/app80/bg-sample/";
              $pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
              $img_path = $pictures[mt_rand(0,count($pictures)-1)];

              $img = Image::make($img_path);
              $ext = pathinfo($img_path);
              $overtxt = $ext['filename'];

            $overtxt2 = $posts->first_name;
            $img->text($overtxt2, 200,370, function($font) {
              //  $font->file('fonts/en/Roboto/Roboto-bold.ttf');
              //  $font->file('fonts/en/Righteous/Righteous-Regular.ttf');
                $font->file('fonts/en/Roboto/Roboto-Bold.ttf');
                $font->size(36);
                $font->color('#fff');
                $font->align('center');   //left, right and center
                $font->valign('middle');  //top, bottom , middle
                $font->angle(0);       //0,45,90,180
            });

            $markimg = $posts->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(420, 420, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left',0,0);
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
            $image_name = 'en_app80_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);
            // $img->save('images/fb1.jpg');


             //save to images
             //  $img->save('images/dd.jpg', 60); //save to set image quality
            //return  $img->response('jpg');
            //return view('/share',array('app_no'=>"1",'img'=>$img));

            $app_description = "<p class='subtext'>We love her already!</p>";
            $app_sub_description = "<p class='subtext'>Share with your family and friends!</p>";



            //   dd($this->img_url);


            // DB::table('application_meta_tag')->insert(
            //   [
            //      'mt_user_id' => Auth::user()->Fb_uid,
            //      'mt_img'=>asset($fullimage_path),
            //   ]
            //     );

            //
            // MetaTag::set('title', 'wittyfunyfeeds | 1111111111111111111111111111');
            // MetaTag::set('description','ssssssssssssssssssssssssss');
            // MetaTag::set('image',asset($fullimage_path));
            //
            // // MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[79]['app_title']);
            // MetaTag::set('description',$this->app_store_info[79]['app_meta_desc']);
        //  return view('english.Result_Share_fb_page_fb',array('app_no'=>"80",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[79]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'));



        $html =   View::make('english.Result_Share_fb_page',array('app_no'=>"80",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[79]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
        //  return $html;
          return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app80--

//app81----Which friend will influence your year the most?-------------------------------------------

          public function en_app81(){

              MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[80]['app_title']);
              MetaTag::set('description',$this->app_store_info[80]['app_meta_desc']);

              return  view('english.app_view_home',array('app_no'=>"81",'app_title'=>$this->app_store_info[80]['app_title'],'app_img_orignal_url'=>$this->app_store_info[80]['app_img_orignal_url'],'app_description'=>$this->app_store_info[80]['app_description']));
          }

          public function en_app81_createimg(){
            if (Auth::check()){

            $img = Image::make("images/english/app81/bg-sample/Product_bg.png");

            $user  = User::find(Auth::user()->id);
            $uname = $user->first_name;
            $user_id = $user['id'];

            $user_friends = DB::table('user_friends')->orderBy(DB::raw('RAND()'))->where('user_id', $user_id)->get()->first();

             if($user_friends){
               $user_friends_pic = $user_friends->picture;
               $user_friends_fname = $user_friends->first_name;
             }else{
               $user_friends_pic = $user->picture;
               $user_friends_fname = $uname;
             }

             $img->text($user_friends_fname, 400, 180, function($font) {
                 $font->file('fonts/en/Audiowide/Audiowide-Regular.ttf');
                 $font->size(30);
                 $font->color('#fff');
                 $font->align('center');   //left, right and center
                 $font->valign('middle');  //top, bottom , middle
                 $font->angle(0);       //0,45,90,180
             });

            $markimg = $user->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(300,300, function ($constraint){
                $constraint->aspectRatio();
            });

            $markimg1 = $user_friends_pic;
            $watermark1 = Image::make($markimg1);
            $watermark1->resize(300,300, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,60,90);
            $canvas->insert($watermark1, 'top-right' ,60,90);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $user['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app81_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>A lot is going to happen this year, and one major factor of change in your life will be brought on by <b>".$user_friends_fname."</b>. But don't worry! As long as you have each other, you're going to have a good time!</p>";
            $app_sub_description = "<p class='subtext'>SHARE this with your best pals today, and tag your ride-or-die!</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"81",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[80]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app81--

//app82----------Which friend will hold your hand forever?------------------------------------

          public function en_app82(){
            MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[81]['app_title']);
            MetaTag::set('description',$this->app_store_info[81]['app_meta_desc']);

            return  view('english.app_view_home',array('app_no'=>"82",'app_title'=>$this->app_store_info[81]['app_title'],'app_img_orignal_url'=>$this->app_store_info[81]['app_img_orignal_url'],'app_description'=>$this->app_store_info[81]['app_description']));
          }

          public function en_app82_createimg(){
            if (Auth::check()){

            $img = Image::make("images/english/app82/bg-sample/Product_bg.png");

            $user  = User::find(Auth::user()->id);
            $uname = $user->first_name;
            $user_id = $user['id'];

            $user_friends = DB::table('user_friends')->orderBy(DB::raw('RAND()'))->where('user_id', $user_id)->get()->first();

             if($user_friends){
               $user_friends_pic = $user_friends->picture;
               $user_friends_fname = $user_friends->first_name;
             }else{
               $user_friends_pic = $user->picture;
               $user_friends_fname = $uname;
             }

             $img->text($uname, 100, 310, function($font) {
                 $font->file('fonts/en/Audiowide/Audiowide-Regular.ttf');
                 $font->size(30);
                 $font->color('#fff');
                 $font->align('center');   //left, right and center
                 $font->valign('middle');  //top, bottom , middle
                 $font->angle(0);       //0,45,90,180
             });
             $img->text($user_friends_fname, 680, 315, function($font) {
                 $font->file('fonts/en/Audiowide/Audiowide-Regular.ttf');
                 $font->size(30);
                 $font->color('#fff');
                 $font->align('center');   //left, right and center
                 $font->valign('middle');  //top, bottom , middle
                 $font->angle(0);       //0,45,90,180
             });
            $markimg = $user->picture;
            $watermark = Image::make($markimg);
            $watermark->resize(220,220, function ($constraint){
                $constraint->aspectRatio();
            });

            $markimg1 = $user_friends_pic;
            $watermark1 = Image::make($markimg1);
            $watermark1->resize(220,220, function ($constraint){
                $constraint->aspectRatio();
            });

            $canvas = Image::canvas(800, 420);
            $canvas->insert($watermark, 'top-left' ,200,190);
            $canvas->insert($watermark1, 'top-right' ,200,190);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $user['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app82_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'> You can never go wrong with <b>".$user_friends_fname."</b>! You're inseparable, and no one can ever break your bond. Some people may even think of you as siblings!</p>";
            $app_sub_description = "<p class='subtext'>Spread the news! Why not SHARE this with your friends and family?</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"82",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[81]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app82--

//app83-----------Who is the person that will always be by your side?-------------------------------------

          public function en_app83(){

            MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[82]['app_title']);
            MetaTag::set('description',$this->app_store_info[82]['app_meta_desc']);

            return  view('english.app_view_home',array('app_no'=>"83",'app_title'=>$this->app_store_info[82]['app_title'],'app_img_orignal_url'=>$this->app_store_info[82]['app_img_orignal_url'],'app_description'=>$this->app_store_info[82]['app_description']));

          }

          public function en_app83_createimg(){
            if (Auth::check()){

            $img = Image::make("images/english/app83/bg-sample/Product_bg.jpg");

            $user  = User::find(Auth::user()->id);
            $uname = $user->first_name;
            $user_id = $user['id'];

            $user_friends = DB::table('user_friends')->orderBy(DB::raw('RAND()'))->where('user_id', $user_id)->get()->first();

             if($user_friends){
               $user_friends_fname = $user_friends->first_name;
             }else{
               $user_friends_fname = $uname;
             }

             $img->text($user_friends_fname, 400, 200, function($font) {
                 //$font->file('fonts/en/Audiowide/Audiowide-Regular.ttf');
                 $font->file('fonts/en/Noto_Sans/NotoSans-Bold.ttf');
                 $font->size(70);
                 $font->color('#000');
                 $font->align('center');   //left, right and center
                 $font->valign('middle');  //top, bottom , middle
                 $font->angle(0);       //0,45,90,180
             });



            $canvas = Image::canvas(800, 420);
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $user['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app83_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'><b>".$user_friends_fname."</b>, people who truly love you will always choose to stay.</p>";
            $app_sub_description = "<p class='subtext'>Don't forget to share this result with your family and friends!</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"83",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[82]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app83--

//app84---See Your Photo Wall Of Wonderful Memories!-------------------------------------------

          public function en_app84(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[83]['app_title']);
                          MetaTag::set('description',$this->app_store_info[83]['app_meta_desc']);

                        return  view('english.app_view_home',array('app_no'=>"84",'app_title'=>$this->app_store_info[83]['app_title'],'app_img_orignal_url'=>$this->app_store_info[83]['app_img_orignal_url'],'app_description'=>$this->app_store_info[83]['app_description']));

          }

          public function en_app84_createimg(){
            if (Auth::check()){

            $img = Image::make("images/english/app84/bg-sample/Product_bg.png");

            $user  = User::find(Auth::user()->id);
            $uname = $user->first_name;
            $user_id = $user['id'];
            $user_pic = $user->picture;
            $user_photos = DB::table('user_photos')->orderBy(DB::raw('RAND()'))->where('user_id', $user_id)->get();
            $canvas = Image::canvas(800, 420);
             if($user_photos){
               $photos_data_length = count($user_photos);
               if($photos_data_length>=1){
                    $user_pic1 = $user_photos[0]->photo_link;
                    $markimg1 = $user_pic1;
                    $watermark1 = Image::make($markimg1);
                    $watermark1->resize(160,160, function ($constraint){
                        $constraint->aspectRatio();
                    });
                       $canvas->insert($watermark1, 'top-left' ,135,25);
               }else {
                 $markimg1 = $user_pic;
                 $watermark1 = Image::make($markimg1);
                 $watermark1->resize(160,160, function ($constraint){
                     $constraint->aspectRatio();
                 });
                    $canvas->insert($watermark1, 'top-left' ,135,25);
               }


                if($photos_data_length>=2){
                  $user_pic2 = $user_photos[1]->photo_link;
                  $markimg2 = $user_pic2;
                  $watermark2 = Image::make($markimg2);
                  $watermark2->resize(200,200, function ($constraint){
                      $constraint->aspectRatio();
                  });
                   $canvas->insert($watermark2, 'top-left' ,300,80);
                }else{

                  $markimg2 = $user_pic;
                  $watermark2 = Image::make($markimg2);
                  $watermark2->resize(200,200, function ($constraint){
                      $constraint->aspectRatio();
                  });
                   $canvas->insert($watermark2, 'top-left' ,300,80);

                   $markimg3 = $user_pic;
                   $watermark3 = Image::make($markimg3);
                   $watermark3->resize(160,180, function ($constraint){
                       $constraint->aspectRatio();
                   });
                    $canvas->insert($watermark3, 'top-left' ,497,25);

                }

               if($photos_data_length>=3){
                   $user_pic3 = $user_photos[2]->photo_link;
                   $markimg3 = $user_pic3;
                   $watermark3 = Image::make($markimg3);
                   $watermark3->resize(160,180, function ($constraint){
                       $constraint->aspectRatio();
                   });
                    $canvas->insert($watermark3, 'top-left' ,497,25);
                 }else{
                   $markimg3 = $user_pic;
                   $watermark3 = Image::make($markimg3);
                   $watermark3->resize(160,180, function ($constraint){
                       $constraint->aspectRatio();
                   });
                    $canvas->insert($watermark3, 'top-left' ,497,25);

                 }

             }else{

               $markimg1 = $user_pic;
               $watermark1 = Image::make($markimg1);
               $watermark1->resize(160,160, function ($constraint){
                   $constraint->aspectRatio();
               });
                  $canvas->insert($watermark1, 'top-left' ,135,25);

              $markimg2 = $user_pic;
              $watermark2 = Image::make($markimg2);
              $watermark2->resize(200,200, function ($constraint){
                  $constraint->aspectRatio();
              });
               $canvas->insert($watermark2, 'top-left' ,300,80);

               $markimg3 = $user_pic;
               $watermark3 = Image::make($markimg3);
               $watermark3->resize(160,180, function ($constraint){
                   $constraint->aspectRatio();
               });
                $canvas->insert($watermark3, 'top-left' ,497,25);
                }
             // $markimg =  $user->picture;
             // $watermark = Image::make($markimg);
             // $watermark->resize(150,150, function ($constraint){
             //     $constraint->aspectRatio();
             // });
             //     $canvas->insert($watermark, 'top-left' ,100,20);
                 $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $user['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app84_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>These are the most popular and inspiring pics, you should print these out and hang them up...or better yet share this now so your friends and family can see them!</p>";
            $app_sub_description = "<p class='subtext'>Don't forget to share this result with your family and friends!</p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"84",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[83]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app84--

//app85----Who's In Your Family Tree?--------------------------------------------

          public function en_app85(){
                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[84]['app_title']);
                          MetaTag::set('description',$this->app_store_info[84]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"85",'app_title'=>$this->app_store_info[84]['app_title'],'app_img_orignal_url'=>$this->app_store_info[84]['app_img_orignal_url'],'app_description'=>$this->app_store_info[84]['app_description']));
          }

          public function en_app85_createimg(){
            if (Auth::check()){

            $img = Image::make("images/english/app85/bg-sample/Product_bg.png");

            $user  = User::find(Auth::user()->id);
            $uname = $user->first_name;
            $user_id = $user['id'];
            $user_pic = $user->picture;
            $user_photos = DB::table('user_photos')->orderBy(DB::raw('RAND()'))->where('user_id', $user_id)->get();
            $canvas = Image::canvas(800, 420);
            if($user_photos){
              $photos_data_length = count($user_photos);
              if($photos_data_length>=1){
                   $user_pic1 = $user_photos[0]->photo_link;
                   $markimg1 = $user_pic1;
                   $watermark1 = Image::make($markimg1);
                   $watermark1->resize(160,160, function ($constraint){
                       $constraint->aspectRatio();
                   });
                      $canvas->insert($watermark1, 'top-left' ,125,28);
              }else{

                $markimg1 = $user_pic;
                $watermark1 = Image::make($markimg1);
                $watermark1->resize(160,160, function ($constraint){
                    $constraint->aspectRatio();
                });
                   $canvas->insert($watermark1, 'top-left' ,125,28);
              }


               if($photos_data_length>=2){
                 $user_pic2 = $user_photos[1]->photo_link;
                 $markimg2 = $user_pic2;
                 $watermark2 = Image::make($markimg2);
                 $watermark2->resize(200,200, function ($constraint){
                     $constraint->aspectRatio();
                 });
                  $canvas->insert($watermark2, 'top-left' ,300,88);
               }else{

                 $markimg2 = $user_pic;
                 $watermark2 = Image::make($markimg2);
                 $watermark2->resize(200,200, function ($constraint){
                     $constraint->aspectRatio();
                 });
                  $canvas->insert($watermark2, 'top-left' ,300,88);

                  $markimg3 = $user_pic;
                  $watermark3 = Image::make($markimg3);
                  $watermark3->resize(180,180, function ($constraint){
                      $constraint->aspectRatio();
                  });
                   $canvas->insert($watermark3, 'top-left' ,500,15);

               }

              if($photos_data_length>=3){
                  $user_pic3 = $user_photos[2]->photo_link;
                  $markimg3 = $user_pic3;
                  $watermark3 = Image::make($markimg3);
                  $watermark3->resize(160,180, function ($constraint){
                      $constraint->aspectRatio();
                  });
                   $canvas->insert($watermark3, 'top-left' ,500,15);
                }else{
                  $markimg3 = $user_pic;
                  $watermark3 = Image::make($markimg3);
                  $watermark3->resize(180,180, function ($constraint){
                      $constraint->aspectRatio();
                  });
                   $canvas->insert($watermark3, 'top-left' ,500,15);

                }

            }else{

              $markimg1 = $user_pic;
              $watermark1 = Image::make($markimg1);
              $watermark1->resize(160,160, function ($constraint){
                  $constraint->aspectRatio();
              });
                 $canvas->insert($watermark1, 'top-left' ,125,28);

             $markimg2 = $user_pic;
             $watermark2 = Image::make($markimg2);
             $watermark2->resize(200,200, function ($constraint){
                 $constraint->aspectRatio();
             });
              $canvas->insert($watermark2, 'top-left' ,300,88);

              $markimg3 = $user_pic;
              $watermark3 = Image::make($markimg3);
              $watermark3->resize(180,180, function ($constraint){
                  $constraint->aspectRatio();
              });
               $canvas->insert($watermark3, 'top-left' ,500,15);
               }
            $canvas->insert($img);

            $ldate = date('d-m-Y');
            $t=time();
            $fb_id = $user['Fb_uid'];
            $image_dirctory_path = 'uploads/'.$ldate;
            File::isDirectory($image_dirctory_path) or File::makeDirectory($image_dirctory_path, 0777, true, true);
            $image_name = 'en_app85_'.$ldate.'_'.$t.'_'.$fb_id.'.png';
            $fullimage_path = $image_dirctory_path.'/'.$image_name;
            $canvas->save($fullimage_path);

            $app_description = "<p class='subtext'>You are one fun friend to have, <b>".$uname."</b>, and these four in particular know what a blessing it is to have you in their life, they consider you a part of their close family tree! , , , & , love and appreciate you so much, and even if they're NOT related to you, remember: blood makes you related, love makes you family! </p>";
            $app_sub_description = "<p class='subtext'>Share this now, tag your friends, and let them know that you LOVE them too! </p>";

            $html = view('english.Result_Share_fb_page',array('app_no'=>"85",'img_url'=>$fullimage_path,'app_title'=>$this->app_store_info[84]['app_title'],"app_description"=>$app_description,"app_sub_description"=>$app_sub_description), compact('view'))->render();
            return response()->json(compact('html'));
            }
            else{
                 return Redirect::route('redirect');
                }
          }

//--------------------------------------------------------------------end app85--


//app86----Which one word describes you--------------------------------------------

          public function en_app86(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[85]['app_title']);
                          MetaTag::set('description',$this->app_store_info[85]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"86",'app_title'=>$this->app_store_info[85]['app_title'],'app_img_orignal_url'=>$this->app_store_info[85]['app_img_orignal_url']));
          }

          public function en_app86_createimg(){

          }

//--------------------------------------------------------------------end app86--

//app87----------------Whom do you look like?-----------------------------------------

          public function en_app87(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[86]['app_title']);
                          MetaTag::set('description',$this->app_store_info[86]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"87",'app_title'=>$this->app_store_info[86]['app_title'],'app_img_orignal_url'=>$this->app_store_info[86]['app_img_orignal_url']));
          }

          public function en_app87_createimg(){

          }

//--------------------------------------------------------------------end app87--

//app88----What award should you get this year?------------------------------------------

          public function en_app88(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[87]['app_title']);
                          MetaTag::set('description',$this->app_store_info[87]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"88",'app_title'=>$this->app_store_info[87]['app_title'],'app_img_orignal_url'=>$this->app_store_info[87]['app_img_orignal_url']));
          }

          public function en_app88_createimg(){

          }

//--------------------------------------------------------------------end app88--

//app89----Where will you travel in January?------------------------------------------

          public function en_app89(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[88]['app_title']);
                          MetaTag::set('description',$this->app_store_info[88]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"89",'app_title'=>$this->app_store_info[88]['app_title'],'app_img_orignal_url'=>$this->app_store_info[88]['app_img_orignal_url']));
          }

          public function en_app89_createimg(){

          }

//--------------------------------------------------------------------end app89--

//app90----How will you start 2018 based on your name?-----------------------------------------

          public function en_app90(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[89]['app_title']);
                          MetaTag::set('description',$this->app_store_info[89]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"90",'app_title'=>$this->app_store_info[89]['app_title'],'app_img_orignal_url'=>$this->app_store_info[89]['app_img_orignal_url']));
          }

          public function en_app90_createimg(){

          }

//--------------------------------------------------------------------end app90--

//app91----Are you more like your father or your mother?--------------------------------------------

          public function en_app91(){

                            MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[90]['app_title']);
                            MetaTag::set('description',$this->app_store_info[90]['app_meta_desc']);

                            return  view('english.app_view_home',array('app_no'=>"91",'app_title'=>$this->app_store_info[90]['app_title'],'app_img_orignal_url'=>$this->app_store_info[90]['app_img_orignal_url']));
             }

          public function en_app91_createimg(){

          }

//--------------------------------------------------------------------end app91--

//app92---What is your word for 2018?--------------------------------------------

          public function en_app92(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[91]['app_title']);
                          MetaTag::set('description',$this->app_store_info[91]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"92",'app_title'=>$this->app_store_info[91]['app_title'],'app_img_orignal_url'=>$this->app_store_info[91]['app_img_orignal_url']));
          }

          public function en_app92_createimg(){

          }

//--------------------------------------------------------------------end app92--


//app93----What is the best thing about you?------------------------------------------

          public function en_app93(){

                      MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[92]['app_title']);
                      MetaTag::set('description',$this->app_store_info[92]['app_meta_desc']);

                      return  view('english.app_view_home',array('app_no'=>"93",'app_title'=>$this->app_store_info[92]['app_title'],'app_img_orignal_url'=>$this->app_store_info[92]['app_img_orignal_url']));
          }

          public function en_app93_createimg(){

          }

//--------------------------------------------------------------------end app93--

//app94----What are the 5 things that will make you happy?--------------------------------------------

          public function en_app94(){

              MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[93]['app_title']);
              MetaTag::set('description',$this->app_store_info[93]['app_meta_desc']);

              return  view('english.app_view_home',array('app_no'=>"94",'app_title'=>$this->app_store_info[93]['app_title'],'app_img_orignal_url'=>$this->app_store_info[93]['app_img_orignal_url']));
                          }

          public function en_app94_createimg(){

          }

//--------------------------------------------------------------------end app94--

//app95----Are you more like a cat or a dog?--------------------------------------------

          public function en_app95(){

                  MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[94]['app_title']);
                  MetaTag::set('description',$this->app_store_info[94]['app_meta_desc']);

                  return  view('english.app_view_home',array('app_no'=>"95",'app_title'=>$this->app_store_info[94]['app_title'],'app_img_orignal_url'=>$this->app_store_info[94]['app_img_orignal_url']));
              }

          public function en_app95_createimg(){

          }

//--------------------------------------------------------------------end app95--

//app96----See how your life will change in 2018!---------------------------------------------

          public function en_app96(){

              MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[95]['app_title']);
              MetaTag::set('description',$this->app_store_info[95]['app_meta_desc']);

              return  view('english.app_view_home',array('app_no'=>"96",'app_title'=>$this->app_store_info[95]['app_title'],'app_img_orignal_url'=>$this->app_store_info[95]['app_img_orignal_url']));
           }

          public function en_app96_createimg(){

          }

//--------------------------------------------------------------------end app96--

//app97----What animal is in your heart?---------------------------------------------

          public function en_app97(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[96]['app_title']);
                          MetaTag::set('description',$this->app_store_info[96]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"97",'app_title'=>$this->app_store_info[96]['app_title'],'app_img_orignal_url'=>$this->app_store_info[96]['app_img_orignal_url']));
          }

          public function en_app97_createimg(){

          }

//--------------------------------------------------------------------end app97--

//app98----Which drink is a match for you?----------------------------------------------

          public function en_app98(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[97]['app_title']);
                          MetaTag::set('description',$this->app_store_info[97]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"98",'app_title'=>$this->app_store_info[97]['app_title'],'app_img_orignal_url'=>$this->app_store_info[97]['app_img_orignal_url']));
          }

          public function en_app98_createimg(){

          }

//--------------------------------------------------------------------end app98--

//app99---How old does your face look like?-----------------------------------------

          public function en_app99(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[98]['app_title']);
                          MetaTag::set('description',$this->app_store_info[98]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"99",'app_title'=>$this->app_store_info[98]['app_title'],'app_img_orignal_url'=>$this->app_store_info[98]['app_img_orignal_url']));
          }

          public function en_app99_createimg(){

          }

//--------------------------------------------------------------------end app99--

//app100----Can we guess what you want in 2018?---------------------------------------------

          public function en_app100(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[99]['app_title']);
                          MetaTag::set('description',$this->app_store_info[99]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"100",'app_title'=>$this->app_store_info[99]['app_title'],'app_img_orignal_url'=>$this->app_store_info[99]['app_img_orignal_url']));
          }

          public function en_app100_createimg(){

          }

//--------------------------------------------------------------------end app100--

//app101----What profession matches your name best?---------------------------------------------

          public function en_app101(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[100]['app_title']);
                          MetaTag::set('description',$this->app_store_info[100]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"101",'app_title'=>$this->app_store_info[100]['app_title'],'app_img_orignal_url'=>$this->app_store_info[100]['app_img_orignal_url']));
          }

          public function en_app101_createimg(){

          }

//--------------------------------------------------------------------end app101--

//app102----Click here to find out why you've gone missing!---------------------------------------------

          public function en_app102(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[101]['app_title']);
                          MetaTag::set('description',$this->app_store_info[101]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"102",'app_title'=>$this->app_store_info[101]['app_title'],'app_img_orignal_url'=>$this->app_store_info[101]['app_img_orignal_url']));
          }

          public function en_app102_createimg(){

          }

//--------------------------------------------------------------------end app102--


//app103----Can we guess who you really are?---------------------------------------------

          public function en_app103(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[102]['app_title']);
                          MetaTag::set('description',$this->app_store_info[102]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"103",'app_title'=>$this->app_store_info[102]['app_title'],'app_img_orignal_url'=>$this->app_store_info[102]['app_img_orignal_url']));
          }

          public function en_app103_createimg(){

          }

//--------------------------------------------------------------------end app103--


//app104----What is the origin of your last name?---------------------------------------------

          public function en_app104(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[103]['app_title']);
                          MetaTag::set('description',$this->app_store_info[103]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"104",'app_title'=>$this->app_store_info[103]['app_title'],'app_img_orignal_url'=>$this->app_store_info[103]['app_img_orignal_url']));
          }

          public function en_app104_createimg(){

          }

//--------------------------------------------------------------------end app104--


//app105----What is your mission for this year?---------------------------------------------

          public function en_app105(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[104]['app_title']);
                          MetaTag::set('description',$this->app_store_info[104]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"105",'app_title'=>$this->app_store_info[104]['app_title'],'app_img_orignal_url'=>$this->app_store_info[104]['app_img_orignal_url']));
          }

          public function en_app105_createimg(){

          }

//--------------------------------------------------------------------end app105--


//app106---How has God written about the rest of your Life?--------------------------------------------

          public function en_app106(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[105]['app_title']);
                          MetaTag::set('description',$this->app_store_info[105]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"106",'app_title'=>$this->app_store_info[105]['app_title'],'app_img_orignal_url'=>$this->app_store_info[105]['app_img_orignal_url']));
          }

          public function en_app106_createimg(){

          }

//--------------------------------------------------------------------end app106--


//app107----How dangerous are you?---------------------------------------------

          public function en_app107(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[106]['app_title']);
                          MetaTag::set('description',$this->app_store_info[106]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"107",'app_title'=>$this->app_store_info[106]['app_title'],'app_img_orignal_url'=>$this->app_store_info[106]['app_img_orignal_url']));
          }

          public function en_app107_createimg(){

          }

//--------------------------------------------------------------------end app107--


//app108----What beautiful traits did your children inherit from You?-------------------------------------------

          public function en_app108(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[107]['app_title']);
                          MetaTag::set('description',$this->app_store_info[107]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"108",'app_title'=>$this->app_store_info[107]['app_title'],'app_img_orignal_url'=>$this->app_store_info[107]['app_img_orignal_url']));
          }

          public function en_app108_createimg(){

          }

//--------------------------------------------------------------------end app108--


//app109-----What is your Motto?--------------------------------------------

          public function en_app109(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[108]['app_title']);
                          MetaTag::set('description',$this->app_store_info[108]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"109",'app_title'=>$this->app_store_info[108]['app_title'],'app_img_orignal_url'=>$this->app_store_info[108]['app_img_orignal_url']));
          }

          public function en_app109_createimg(){

          }

//--------------------------------------------------------------------end app109--


//app110----What are 5 reasons people are jealous of You?---------------------------------------------

          public function en_app110(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[109]['app_title']);
                          MetaTag::set('description',$this->app_store_info[109]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"110",'app_title'=>$this->app_store_info[109]['app_title'],'app_img_orignal_url'=>$this->app_store_info[109]['app_img_orignal_url']));
          }

          public function en_app110_createimg(){

          }

//--------------------------------------------------------------------end app110--


//app111---- What does your face say about your body and soul?---------------------------------------------

          public function en_app111(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[11]['app_title']);
                          MetaTag::set('description',$this->app_store_info[110]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"111",'app_title'=>$this->app_store_info[110]['app_title'],'app_img_orignal_url'=>$this->app_store_info[110]['app_img_orignal_url']));
          }

          public function en_app111_createimg(){



          }

//--------------------------------------------------------------------end app111--

//app112---- Which mixed-race are you based on your photo?--------------------------------------------

          public function en_app112(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[111]['app_title']);
                          MetaTag::set('description',$this->app_store_info[111]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"112",'app_title'=>$this->app_store_info[111]['app_title'],'app_img_orignal_url'=>$this->app_store_info[111]['app_img_orignal_url']));
          }

          public function en_app112_createimg(){

          }

//--------------------------------------------------------------------end app112--

//app113-------What does 2018 have in store for you?-----------------------------------------

          public function en_app113(){

                        MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[112]['app_title']);
                        MetaTag::set('description',$this->app_store_info[112]['app_meta_desc']);

                        return  view('english.app_view_home',array('app_no'=>"113",'app_title'=>$this->app_store_info[112]['app_title'],'app_img_orignal_url'=>$this->app_store_info[112]['app_img_orignal_url']));
}

          public function en_app113_createimg(){

          }

//--------------------------------------------------------------------end app113--

//app114----What is your best asset?----------------------------------------------

          public function en_app114(){

                        MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[113]['app_title']);
                        MetaTag::set('description',$this->app_store_info[113]['app_meta_desc']);

                        return  view('english.app_view_home',array('app_no'=>"114",'app_title'=>$this->app_store_info[113]['app_title'],'app_img_orignal_url'=>$this->app_store_info[113]['app_img_orignal_url']));
                     }

          public function en_app114_createimg(){

          }

//--------------------------------------------------------------------end app114--

//app115----What describes you best?---------------------------------------------

          public function en_app115(){

                    MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[114]['app_title']);
                    MetaTag::set('description',$this->app_store_info[114]['app_meta_desc']);

                    return  view('english.app_view_home',array('app_no'=>"115",'app_title'=>$this->app_store_info[114]['app_title'],'app_img_orignal_url'=>$this->app_store_info[114]['app_img_orignal_url']));
                 }

          public function en_app115_createimg(){

          }

//--------------------------------------------------------------------end app115--

//app116----What are 5 reasons people are jealous of You?---------------------------------------------

          public function en_app116(){

            MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[115]['app_title']);
            MetaTag::set('description',$this->app_store_info[115]['app_meta_desc']);

            return  view('english.app_view_home',array('app_no'=>"116",'app_title'=>$this->app_store_info[115]['app_title'],'app_img_orignal_url'=>$this->app_store_info[115]['app_img_orignal_url']));
        }

          public function en_app116_createimg(){

          }

//--------------------------------------------------------------------end app116--

//app117----What are 5 reasons people are jealous of You?---------------------------------------------

          public function en_app117(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[116]['app_title']);
                          MetaTag::set('description',$this->app_store_info[116]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"117",'app_title'=>$this->app_store_info[116]['app_title'],'app_img_orignal_url'=>$this->app_store_info[116]['app_img_orignal_url']));
                   }

          public function en_app117_createimg(){

          }

//--------------------------------------------------------------------end app117--

//app118----What are 5 reasons people are jealous of You?---------------------------------------------

          public function en_app118(){

                        MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[117]['app_title']);
                        MetaTag::set('description',$this->app_store_info[117]['app_meta_desc']);

                        return  view('english.app_view_home',array('app_no'=>"118",'app_title'=>$this->app_store_info[117]['app_title'],'app_img_orignal_url'=>$this->app_store_info[117]['app_img_orignal_url']));
                 }

          public function en_app118_createimg(){

          }

//--------------------------------------------------------------------end app118--

//app119----What are 5 reasons people are jealous of You?---------------------------------------------

          public function en_app119(){

                          MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[118]['app_title']);
                          MetaTag::set('description',$this->app_store_info[118]['app_meta_desc']);

                          return  view('english.app_view_home',array('app_no'=>"119",'app_title'=>$this->app_store_info[118]['app_title'],'app_img_orignal_url'=>$this->app_store_info[118]['app_img_orignal_url']));
                   }

          public function en_app119_createimg(){

          }

//--------------------------------------------------------------------end app119--

//app120----What are 5 reasons people are jealous of You?---------------------------------------------

          public function en_app120(){

                  MetaTag::set('title', 'wittyfunyfeeds | '.$this->app_store_info[119]['app_title']);
                  MetaTag::set('description',$this->app_store_info[119]['app_meta_desc']);

                  return  view('english.app_view_home',array('app_no'=>"120",'app_title'=>$this->app_store_info[119]['app_title'],'app_img_orignal_url'=>$this->app_store_info[119]['app_img_orignal_url']));
          }

          public function en_app120_createimg(){

          }

//--------------------------------------------------------------------end app120--


public function user_friends(){
    if (Auth::check()){
    // paste another image
    $user  = User::find(Auth::user()->id);
    $uname = $user->first_name;
    $user_id = $user->Fb_uid;

    $user_friends = DB::table('user_friends')->where('user_id', $user_id)->get()->first();

     if($user_friends){
       $user_friends_pic = $user_friends->picture;
       $user_friends_fname = $user_friends->first_name;
     }else{
       $user_friends_pic = $posts->picture;
       $user_friends_fname = $uname;
     }
     dd($user_friends_fname);
  }
    else{
         return Redirect::route('redirect');
        }
}

public function user_photos(){
    if (Auth::check()){
    // paste another image
    $user  = User::find(Auth::user()->id);

    $user_id = $user->Fb_uid;

  $user_photos = DB::table('user_photos')->orderBy(DB::raw('RAND()'))->where('user_id', $user_id)->get();

     if($user_photos){
       dd($user_photos);

     }else{
        dd("errrr");
     }

  }
    else{
         return Redirect::route('redirect');
        }
}
















}
