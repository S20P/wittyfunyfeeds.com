<?php

namespace App\Http\Controllers\admin\application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Image;
use File;
use Schema;
use App;
use View;

class ApplicationController extends Controller
{



  public function __construct(request $request)
  {

        $this->middleware('preventBackHistory')->except('logout');

        $label_app = ["New","Latest","Hot","sexy","Love"];
        View::share('label_app', $label_app);

  }



      public function open_new_app_form(){
           return view('admin.page.add_new_application');
        }

      public function create_new_app(Request $request){


        $this->validate($request,[
            'app_name'=>'required',
            'app_img_src'=>'required',
            'app_controller_uri'=>'required',
            'app_lang'=>'required',
              ]);


              $app_name = $request->input('app_name');
              $app_sub_description = $request->app_sub_description;
              $image = $request->app_img_src;
              $app_controller_uri = $request->app_controller_uri;
              $app_lang = $request->app_lang;
              $app_label = $request->app_label;
              $app_meta_description = $request->app_meta_description;

              $route_api = $app_controller_uri;





        // $destinationPath = 'images/'.$app_lang.'/project_home_img';
        // $path =  $image->move($destinationPath,$image->getClientOriginalName());


        $destinationPath = 'images/project_home_img/'.$app_lang."/orignal";
        File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
        $path =  $image->move($destinationPath,$image->getClientOriginalName());

        $destinationPath2 = 'images/project_home_img/'.$app_lang."/thumb-resize";
        File::isDirectory($destinationPath2) or File::makeDirectory($destinationPath2, 0777, true, true);

          $cover = Image::make($path);

          $cover->resize(360, 189, function ($constraint){
              $constraint->aspectRatio();
          });

          $fullurl = $destinationPath2."/".$image->getClientOriginalName();
          $cover->save($fullurl);


        DB::table('application_store')->insert(
          [
             'app_name' => $app_name,
             'app_description'=>trim(preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ',$app_sub_description )),
             'app_img_url' => $image->getClientOriginalName(),
             'app_controller_uri' =>$route_api,
             'lang'=>$app_lang,
             'label'=>$app_label,
             'app_meta_description'=>trim(preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ',$app_meta_description )),

          ]
            );

   return redirect('admin/home')->with('status', 'Record inserted successfully!');

      }


      public function edit_application_stock($task)
      {
                  $application_stock_edit = DB::table('application_store')->where('id', $task)->get();
                  return view('admin.page.edit_application_stock',compact('application_stock_edit'));
      }
      public function update_application_stock(Request $request,$task)
      {
        if(isset($_POST['delete']))
         {
        //  DB::table('student')->delete(); // it used to delete all rescord
          DB::table('application_store')->where('id','=',$task)->delete();
           return redirect('admin/home')->with('status', 'Record Deleted successfully!');
         }
        else
        {
          $id = $request->id;

          $this->validate($request,[
              'app_name'=>'required',
              'app_img_src'=>'required',
              'app_controller_uri'=>'required',
              'app_lang'=>'required',
                ]);

                $app_name = $request->input('app_name');
                $app_img_url = $request->app_img_src;
                $app_controller_uri = $request->app_controller_uri;
                $app_lang = $request->app_lang;
                $app_label_edit = $request->app_label;
                $app_meta_description =$request->app_meta_description;
                $app_sub_description =$request->app_sub_description;

         DB::table('application_store')
              ->where('id',$id)
              ->update(['app_name' => $app_name,
                        'app_description'=>trim(preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ',$app_sub_description )),
                        'app_img_url' => $app_img_url,
                        'app_controller_uri' =>$app_controller_uri,
                        'lang'=>$app_lang,
                        'label'=>$app_label_edit,
                        'app_meta_description'=>trim(preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ',$app_meta_description )),
                      ]);

             //return redirect()->back()->with('status', 'Record Updated successfully!');

            return redirect('admin/home')->with('status', 'Record Updated successfully!');
        }
      }


      public function delete_uploaded_image_page(){
         return view('admin.page.delete-upladed-folder');
        }

        public function delete_uploaded_image_action(Request $request,$dir){

                   // echo $task;
                   // echo "<br>";
                   // echo $request->path;

                 $path = $request->path;

            //     echo  $path."/".$dir;


                 if(file_exists( $path."/".$dir )){
                   File::deleteDirectory($path."/".$dir);
                   return redirect()->back()->with('status', 'Folder Deleted successfully!');
                 }

            }



}
