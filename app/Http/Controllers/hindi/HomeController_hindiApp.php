<?php

namespace App\Http\Controllers\hindi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\SocialFacebookAccount;
use DB;
use Schema;
use Response;
use View;
class HomeController_hindiApp extends Controller
{


  public function __construct()
   {
     //its just a dummy data object.

     // Sharing is caring

     if(Schema::hasTable('application_store')){
          $student = DB::table('application_store')->where('lang','hi')->orderBy('id', 'desc')->take('12')->get();
          View::share('student', $student);
        }

   }



  public function index(Request $request){
    //return "hi, This app is HINDI language";
    return view('hindi.hindiHome');
     //dd($request->route()->getPrefix());
  }
  // public function defult_app_hi(Request $request){
  // $lang =  $request->lang;
  //   if(Schema::hasTable('application_store')){
  //    $student = DB::table('application_store')->where('lang',$lang)->Paginate(6);
  //    $html = view('service',array('student' => $student), compact('view'))->render();
  //    return response()->json(compact('html'));
  //   // return  Response::json($student);
  //  }
  // }
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

     $student = DB::table('application_store')->where('lang',$lang)->orderBy('id', 'desc')->skip($skip)->take($take)->get();
  //   return  Response::json($student);
    // return view('home',compact('student'));
    $html = view('service',array('student' => $student), compact('view'))->render();
    return response()->json(compact('html'));
    // return  Response::json($student);
  }
 }
}
