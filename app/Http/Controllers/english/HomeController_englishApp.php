<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\SocialFacebookAccount;
use DB;
use Schema;
use Response;
use View;
use File;
use MetaTag;
class HomeController_englishApp extends Controller
{

  public function __construct()
   {

  $this->middleware('preventBackHistory')->except('logout');

     MetaTag::set('title', 'wittyfunyfeeds');
     MetaTag::set('description', 'This is my home. Enjoy!');

     //its just a dummy data object.

     if(Schema::hasTable('application_store')){
          $student = DB::table('application_store')->where('lang','en')->orderBy('label', 'desc')->orderBy('id', 'desc')->take('48')->get();
          View::share('student', $student);
        }

   }

  public function index(Request $request){
    //return "hi, This app is HINDI language";
    return view('english.englishHome');
     //dd($request->route()->getPrefix());
  }
  public function defult_app_en(Request $request){
  $lang =  $request->lang;
    if(Schema::hasTable('application_store')){
     $student = DB::table('application_store')->where('lang',$lang)->Paginate(6);
     $html = view('service',array('student' => $student), compact('view'))->render();
     return response()->json(compact('html'));
    // return  Response::json($student);
   }
  }
  public function getallapps(Request $req)
  {
    $take =  $req->take;
    $skip = $req->offset;
    $lang =  $req->lang;
      //  $data   = array('value' => $val,'src'=>'images/project/1.png');
      // return a JSON response
      //	return  Response::json($data);
    if(Schema::hasTable('application_store')){
  //  $student = DB::table('application_store')->Paginate($take);

     $student = DB::table('application_store')->where('lang',$lang)->orderBy('label', 'desc')->orderBy('id', 'desc')->skip($skip)->take($take)->get();
//  return  Response::json($student);
    // return view('home',compact('student'));
    $html = view('service',array('student' => $student), compact('view'))->render();
    return response()->json(compact('html'));
    // return  Response::json($student);
  }
 }
}
