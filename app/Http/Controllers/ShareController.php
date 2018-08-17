<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use URL;
class ShareController extends Controller
{
  public function __construct()
 {
  $this->middleware('preventBackHistory')->except('logout');
 }


  public function welcome(){
          return view('welcome');
  }

  public function redirect()
    {

      Session::put('url.intended',URL::previous());
       $permission = [
       'public_profile',
       // 'email',
       // 'manage_pages',
       // 'publish_actions',
       // 'publish_pages',
       // 'user_birthday',
       // 'user_events',
       'user_friends',
       // 'user_hometown',
       // 'user_likes',
       // 'user_location',
       'user_photos',
       // 'user_posts',
       // 'user_status',
       // 'user_tagged_places',
     ];






       return Socialite::driver('facebook')->scopes($permission)->with(['auth_type' => 'rerequest'])->redirect();
    }

    public function callback(Request $request)
       {
                //  $providerUser =  Socialite::driver('facebook')->stateless()->user();

       $providerUser = Socialite::driver('facebook')->fields([
                        'name',
                        'first_name',
                        'last_name',
                        'email',
                        'gender',
                        'locale',
                        'link',
                        'birthday',
                        'age_range',
                        'verified',
                        'work',
                        'friends.limit(10){first_name,age_range,picture{url},link,id,name}',
                        // 'friends.limit(10){photos{images},id,first_name,name}',
                        // 'photos{images}'
                        // 'albums{photos{images}}'
                        'albums.limit(10){photos.limit(10){images}}'
                          ])->user();

            // return Response()->json($providerUser);


    // Session::put('fb_data', $providerUser);
    //  dd($providerUser->user['work'][0]['position']['name']); //Get Profession
      $token =  $providerUser->token;
      Session::put('token', $token);
      $Fb_Uid = $providerUser->id;
      Session::put('fb_uid', $Fb_Uid);

        //Get fb Likes //


 // 'image' => 'https://graph.facebook.com/me/picture?width=720&height=720&access_token='.$token->access_token;

        //return Response()->json($frendlist->user);

          //$frends = $providerUser->user;


        //  return Response()->json($frends['friendlists']['data']);
           // $frendsdata = $frends['friendlists']['data'];
           // $pagein = $frends['friendlists']['paging'];

          // return Response()->json($pagein);

           //echo "<a href=".$pagein['next'].">next Frends</a>";



          // return view('home',array('likes'=>$userlike,'like_next'=>$like_next));

        //   return view('home',array('data' => $frendsdata,'pagein'=>$pagein));

         //return Response()->json($providerUser->paging);

            // $token =  $providerUser->token;
             //$this->$token = "World";
      //  return $providerUser->getAvatar();
      //return  $providerUser->getId();

     //https://graph.facebook.com/'.$fid.'/picture?type=large

       $account = SocialFacebookAccount::whereProvider('facebook')
           ->whereProviderUserId($providerUser->getId())
           ->first();

           if ($account) {
                    $user = $account->user;
                    $result  = Auth::login($user, true);

                    $posts  = User::find(Auth::user()->id);

                    $user = User::where('id',$posts->id)
                                 ->update([
                                     'fb_token' => $token,
                                 ]);
                  if($user){
                    $user_friends_get = DB::table('user_friends')->where('user_id', $posts->id)->delete();
                    if($user_friends_get){
                      if($providerUser->user){
                        $user_data = $providerUser->user;
                        $user_id = $user_data['id'];

                         if(isset($user_data['friends'])){
                          $friends_data = $user_data['friends'];

                         if(isset($user_data['friends'])){
                           $friends_data = $user_data['friends'];
                            if(count($friends_data['data'])>=1){
                              $friends_item = $friends_data['data'];

                              for($i=0;$i<count($friends_item);$i++){
                                   $first_name = $friends_item[$i]['first_name'];
                                   $id = $friends_item[$i]['id'];
                                   $name = $friends_item[$i]['name'];
                                   $picture = 'https://graph.facebook.com/'.$id.'/picture?width=720&height=720';

                                 $savefriends =  DB::table('user_friends')->insert(
                                     [
                                       'user_id'=>$posts->id,
                                       'first_name'=>$first_name,
                                       'name'=>$name,
                                       'picture'=>$picture
                                     ]
                                       );
                              }
                            }
                            else{
                              $first_name = $user_data['first_name'];
                              $name = $user_data['name'];
                              $picture = 'https://graph.facebook.com/'.$user_id.'/picture?width=720&height=720';
                              $savefriends = DB::table('user_friends')->insert(
                                [
                                  'user_id'=>$posts->id,
                                  'first_name'=>$first_name,
                                  'name'=>$name,
                                  'picture'=>$picture
                                ]
                                  );
                              }
                          }
                            else{
                              $first_name = $user_data['first_name'];
                              $name = $user_data['name'];
                              $picture = 'https://graph.facebook.com/'.$user_id.'/picture?width=720&height=720';
                              $savefriends = DB::table('user_friends')->insert(
                                [
                                  'user_id'=>$posts->id,
                                  'first_name'=>$first_name,
                                  'name'=>$name,
                                  'picture'=>$picture
                                ]
                                  );
                              }
                       }


                     }
                    }
                    $user_photos_get = DB::table('user_photos')->where('user_id', $posts->id)->delete();
                    if($user_photos_get){
                      if($providerUser->user){
                        $user_data = $providerUser->user;
                        $user_id = $user_data['id'];

                    if(isset($user_data['albums'])){
                      $user_photos = $user_data['albums'];
                      if(count($user_photos['data'])>=1){
                        $user_photos_item = $user_photos['data'];

                        for($i=0;$i<count($user_photos_item);$i++){
                          if($user_photos_item[$i]['photos']){
                             $photo = $user_photos_item[$i]['photos'];
                             $photo_data = $photo['data'];

                             for($j=0;$j<count($photo_data);$j++){
                                $img_result = $photo_data[$j]['images'];
                                $photo_source = $img_result[$i]['source'];

                               $save_user_photos =  DB::table('user_photos')->insert(
                                   [
                                     'user_id'=>$posts->id,
                                     'photo_link'=>$photo_source,
                                   ]
                                     );
                             }


                           }
                        }
                      }
                    }
                    else{

                      $picture = 'https://graph.facebook.com/'.$user_id.'/picture?width=720&height=720';

                      $save_user_photos =  DB::table('user_photos')->insert(
                          [
                            'user_id'=>$posts->id,
                            'photo_link'=>$picture,
                          ]
                            );
                      }
                   }
              }




                    //return view('home',array('posts' => $posts,'student' => $student));
                //    return view ( '/home',array('posts' => $posts));
                if ($request->is('/') or $request->is('home')) {
                    return redirect()->route("home");
                }
                else{
              //  return redirect()->back();
                // return redirect()->intended();
                  return Redirect::to(Session::get('url.intended'));
                //  return redirect()->route("home");
                }
                //  return redirect()->route("home");
}
                 } else {

           $account = new SocialFacebookAccount([
               'provider_user_id' => $Fb_Uid,
               'provider' => 'facebook'
           ]);

           $user = User::where('Fb_uid', $providerUser->getId())->first();

           if (!$user) {

              $email = $providerUser->getEmail();

              $fid = $providerUser->getId();
            //  $picture = "https://graph.facebook.com/$fid/picture?type=large";

            $picture = 'https://graph.facebook.com/'.$fid.'/picture?width=720&height=720';
               $user = User::create([
                   'Fb_uid' => $fid,
                   'email' =>$email,
                   'first_name'=> $providerUser['first_name'],
                   'name' => $providerUser->getName(),
                   'link'=>$providerUser['link'],
                   'Gender'=>$providerUser['gender'],
                  // 'birthdate'=>$providerUser['birthday'],
                   'age'=>$providerUser['age_range']['min'],
                   'locale'=>$providerUser['locale'],
                   'picture'=>$picture,
                   'password' => md5(rand(1,10000)),
                   'fb_token' => $token,
               ]);

             $InsertedUserID = $user->id;

              //Save user Friends
               if($providerUser->user){
                 $user_data = $providerUser->user;
                 $user_id = $user_data['id'];

              if(isset($user_data['friends'])){
                $friends_data = $user_data['friends'];
                 if(count($friends_data['data'])>=1){
                   $friends_item = $friends_data['data'];

                   for($i=0;$i<count($friends_item);$i++){
                        $first_name = $friends_item[$i]['first_name'];
                        $id = $friends_item[$i]['id'];
                        $name = $friends_item[$i]['name'];
                        $picture = 'https://graph.facebook.com/'.$id.'/picture?width=720&height=720';

                      $savefriends =  DB::table('user_friends')->insert(
                          [
                            'user_id'=>$InsertedUserID,
                            'first_name'=>$first_name,
                            'name'=>$name,
                            'picture'=>$picture
                          ]
                            );
                   }
                 }
                 else{
                   $first_name = $user_data['first_name'];
                   $name = $user_data['name'];
                   $picture = 'https://graph.facebook.com/'.$user_id.'/picture?width=720&height=720';
                   $savefriends = DB::table('user_friends')->insert(
                     [
                       'user_id'=>$InsertedUserID,
                       'first_name'=>$first_name,
                       'name'=>$name,
                       'picture'=>$picture
                     ]
                       );
                   }
               }
                 else{
                   $first_name = $user_data['first_name'];
                   $name = $user_data['name'];
                   $picture = 'https://graph.facebook.com/'.$user_id.'/picture?width=720&height=720';
                   $savefriends = DB::table('user_friends')->insert(
                     [
                       'user_id'=>$InsertedUserID,
                       'first_name'=>$first_name,
                       'name'=>$name,
                       'picture'=>$picture
                     ]
                       );
                   }

                //save user photo
                   if(isset($user_data['albums'])){
                     $user_photos = $user_data['albums'];
                     if(count($user_photos['data'])>=1){
                       $user_photos_item = $user_photos['data'];

                       for($i=0;$i<count($user_photos_item);$i++){

                          if($user_photos_item[$i]['photos']){

                            $photo = $user_photos_item[$i]['photos'];

                            $photo_data = $photo['data'];

                            for($j=0;$j<count($photo_data);$j++){
                               $img_result = $photo_data[$j]['images'];
                               $photo_source = $img_result[$i]['source'];

                              $save_user_photos =  DB::table('user_photos')->insert(
                                  [
                                    'user_id'=>$InsertedUserID,
                                    'photo_link'=>$photo_source,
                                  ]
                                    );
                            }


                          }
                       }
                     }
                   }
                   else{

                     $picture = 'https://graph.facebook.com/'.$user_id.'/picture?width=720&height=720';

                     $save_user_photos =  DB::table('user_photos')->insert(
                         [
                           'user_id'=>$InsertedUserID,
                           'photo_link'=>$picture,
                         ]
                           );
                     }
               }
           }

           $account->user()->associate($user);
           $account->save();
           Auth::login($user, true);
           $posts  = User::find(Auth::user()->id);

      //     return view('home',array('posts' => $posts,'student' => $student));
          //  return redirect()->back();
          if ($request->is('/') or $request->is('home')) {
              return redirect()->route("home");
          }
          else{
            //   return redirect()->back();
            //   return redirect()->intended();
                 return Redirect::to(Session::get('url.intended'));
            // return redirect($request->session()->get('url.intended'));
          //  return redirect()->route("home");
          }


          // return view ( '/home',array('posts' => $posts));
     }
   }



        public function fb_like(){

          $token = Session::get('token');
          include('plugin/Facebook/autoload.php');
         //  include(asset('plugin/Facebook/autoload.php'));
         $fb = new \Facebook\Facebook([
          'app_id' => '1361360707308056',
          'app_secret' => '0d2dda56f37756784caf4f83e311bd24',
          'default_graph_version' => 'v2.10',
          'default_access_token' => $token, // optional
         ]);



         // post to Facebook
         // see: https://developers.facebook.com/docs/reference/php/facebook-api/





      //$requestFriends = $fb->get('/me/?fields=work');


  //    dd($requestFriends);



      //   $requestFriends = $fb->get('/me?fields=friends.limit(10){first_name,age_range,picture{url},link,id,name}');
          $requestFriends = $fb->get('/me?fields=context.fields(all_mutual_friends.limit(100))');
         dd($requestFriends);

         $friends = $requestFriends->getGraphEdge();

         $graphNode = $requestFriends->getGraphList();

         $allFriends = $graphNode->asArray();
         $frends_details = array();
        foreach ($allFriends as $key)
         {
          $frends_first_name=$key['first_name'];
          $frends_picture_url=$key['picture']['url'];
            array_push($frends_details,["frends_first_name"=>$frends_first_name,"frends_picture_url"=>$frends_picture_url]);
         }
        $i = rand(0, count($frends_details)-1); // generate random number size of the array
        $friends = $frends_details[$i]; // set variable equal to which random filename was chosen


         echo "<img src=".$friends['frends_picture_url']." width='150' height='150'><br>";
         echo $friends['frends_first_name'];


          if ($fb->next($friends)) {
              $allFriends = array();
              $friendsArray = $friends->asArray();
              $allFriends = array_merge($friendsArray, $allFriends);
              while ($friends = $fb->next($friends)) {
                $friendsArray = $friends->asArray();
                $allFriends = array_merge($friendsArray, $allFriends);
              }
                $frends_details = array();
              foreach ($allFriends as $key) {
                $frends_first_name=$key['first_name'];
                $frends_picture_url=$key['picture']['url'];
                  array_push($frends_details,["frends_first_name"=>$frends_first_name,"frends_picture_url"=>$frends_picture_url]);
              }
              $i = rand(0, count($frends_details)-1); // generate random number size of the array
              $friends = $frends_details[$i]; // set variable equal to which random filename was chosen

               print_r($friends['frends_first_name']);
               print_r($friends['frends_picture_url']);

            }

        //  return Response()->json($token);
         //return view('like',array('token' => $token));

          // $Data = Socialite::with('facebook')->user();
          // return $Data->id;

          //return $token;

          //$url = 'https://graph.facebook.com//me/taggable_friends?fields=name,picture,id,first_name,last_name&access_token='.$token;
        //  $userlike = json_decode(file_get_contents($url));
        //  $likes_data = $userlike->data;
        // return Response()->json($userlike);

      //    return view('like',array('likes'=>$userlike,'like_next'=>$like_next));

          // return Socialite::driver('facebook')
          //  ->scopes(['user_likes', 'user_friends'])->redirect("/home");

          // $providerData = Socialite::driver('facebook')->fields([
           //         'name','first_name', 'last_name', 'email','gender','locale','link','birthday','age_range'
           //        ])->user();
           //return $providerData;
          // return   Socialite::driver('facebook')->fields(['first_name', 'email', 'gender', 'verified', 'friends'])->user();
        }

        public function profile(){
          $token = Session::get('token');
          return view('profile',array('token' => $token,'user'=>Auth::user()));
        }

        public function CreateFolderDirectory(){

        // $fb_uid = Session::get('fb_uid');

            $posts  = User::find(Auth::user()->id);
            $fb_id = $posts['Fb_uid'];
        //    return $fb_id;
  //       $date = date_create();
  //     $f = date_timestamp_get($date);
  // echo(date("Y-m-d:H:m:s",$f));
      //  $t=time();
      //  echo($t . "<br>");
      //  echo(date("Y-m-d:H:m:s",$t));
        return;
            $ldate = date('d-m-Y h:m:s');
              return $ldate;
              //return $ldate;
              $path = 'images/'.$ldate;
              File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
              return;
        }

 public function multilinetext_img(){
   $textToBeShown ="The man, the dwarf and the girlguardian";
$img2 = Image::canvas(300,250);
// inserts character where string is to be split into new line (after 15 characters, keeping words intact)
$string = wordwrap($textToBeShown,15,"|");
//create array of lines
$strings = explode("|",$string);
$i=3; //top position of string
//for each line added
foreach($strings as $string){
$img2->text($string, 150, $i, function($font) {
$font->file('fonts/MotionPicture_PersonalUseOnly.ttf');
$font->size(40);
$font->color('#826c61');
$font->align('center');
$font->valign('top');
});
$i=$i+42; //shift top postition down 42
}
$img2->save('images/multi.jpg');
 }
public function randum(){
$dir = "images/"; // The relative path to the image directory
$pictures = glob("$dir/{*.jpg,*.jpeg,*.gif,*.png}",GLOB_BRACE);
$img = $pictures[mt_rand(0,count($pictures)-1)];


echo '<img src="' . $img . '">';

$ext = pathinfo($img);

echo $ext['dirname'] . '<br/>';   // Returns folder/directory
echo $ext['basename'] . '<br/>';  // Returns file.html
echo $ext['extension'] . '<br/>'; // Returns .html
echo $ext['filename'] . '<br/>';  // Returns file
}




  public function radius(){
    $cover = Image::make('images/app5/main.png');
  //  $cover = Image::make('images/main.png');
    $r1 = Image::make('images/img.jpg');


    $r1->resize(220, 220, function ($constraint){
        $constraint->aspectRatio();
    });

    $canvas = Image::canvas(800, 420);
    $canvas->insert($r1, 'top-left', 45, 105);
    $canvas->insert($cover);

    $canvas->save('images/final.png');
  }


public function compress_and_resize(){


  $dir    = 'images/img-compress/test';

  // $cover = Image::make('images/test/test.jpg');
  //
  // $cover->resize(360, 189, function ($constraint){
  //     $constraint->aspectRatio();
  // });
  //
  // $cover->save('images/test/thumb/final1.jpg');

  $ffs = scandir($dir);

  unset($ffs[array_search('.', $ffs, true)]);
  unset($ffs[array_search('..', $ffs, true)]);

  // prevent empty ordered elements
  if (count($ffs) < 1)
      return;


  foreach($ffs as $ff){


    $string1 = $ff;

            // echo $dir;
            // echo "<br>";
            // echo $ff;

            $url = $dir."/".$ff;

            $cover = Image::make($url);

            $cover->resize(360, 189);

            $savedurl = "images/img-compress/thumb/".$ff;
            $cover->save($savedurl);

      if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);

  }
}

}
