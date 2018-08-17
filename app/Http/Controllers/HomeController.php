<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\SocialFacebookAccount;
use DB;
use Schema;
use Response;
use View;
use File;
use MetaTag;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
      {
        //its just a dummy data object.
      //  $user = User::all();

        // Sharing is caring
        //View::share('user', $user);
  $this->middleware('preventBackHistory')->except('logout');
      }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $posts  = User::find(Auth::user()->id);
        //
        if(Schema::hasTable('application_store')){
         $student = DB::table('application_store')->Paginate(6);
         return view('home',array('student' => $student));
       }

    }
    public function defult(){
      if(Schema::hasTable('application_store')){
       $student = DB::table('application_store')->Paginate(6);
       $html = view('service',array('student' => $student), compact('view'))->render();
       return response()->json(compact('html'));
      // return  Response::json($student);
     }
    }
    public function getallapps(Request $req)
    {
      $take =  $req->take;
      $skip = $req->offset;
        //  $data   = array('value' => $val,'src'=>'images/project/1.png');
       	// return a JSON response
        //	return  Response::json($data);
      if(Schema::hasTable('application_store')){
    //  $student = DB::table('application_store')->Paginate($take);

       $student = DB::table('application_store')->skip($skip)->take($take)->get();
    //   return  Response::json($student);
      // return view('home',compact('student'));
      $html = view('service',array('student' => $student), compact('view'))->render();
      return response()->json(compact('html'));
      // return  Response::json($student);
    }
   }



      public function privacy_and_policy()
      {
        MetaTag::set('title', 'wittyfunyfeeds |  Privacy and Policy');
        MetaTag::set('description', '');

         return  view('privacy_and_policy');
      }
      public function Terms_of_Service()
      {
        MetaTag::set('title', 'wittyfunyfeeds |  Terms of Service');
        MetaTag::set('description', '');

         return  view('Terms_of_Service');
      }
      public function faq()
      {
        MetaTag::set('title', 'wittyfunyfeeds |  Faq');
        MetaTag::set('description', '');

         return  view('faq');
      }
      public function About_us()
      {

        MetaTag::set('title', 'wittyfunyfeeds |  About us');
        MetaTag::set('description', '');

        return  view('About_us');
      }

    }
