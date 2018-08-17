<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use File;
use Schema;
use App;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('preventBackHistory')->except('logout');

        $this->middleware('admin.auth');




    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      if(Schema::hasTable('application_store')){
       $application_stock = DB::table('application_store')->where('lang','en')->Paginate(10);
       return view('admin.home',compact('application_stock'));
     }

      //  return view('admin.home');
    }
}
