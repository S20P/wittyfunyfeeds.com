<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Response;

class ImageEditeController extends Controller
{
    public function index(){
       return view('image_editing');
    }

    public function resize(){
      $img = Image::make('images/a.jpg')->resize(500, 399);
      $img->insert('images/model.jpg');
    //  $img->fill('cccccc');
      return $img->response('jpg');
    }
    public function fill(){
      // ex :
           // color in array format
              //  $img->fill(array(255, 0, 0));
           // color in array format with alpha value
                //  $img->fill(array(255, 255, 255, 0.5));
          // rgb color value in integer range
                 //  $img->fill('rgb(255, 0, 0)');
          // rgba color value with alpha
               //$img->fill('rgba(255, 0, 0, 1)');
          // rgba color value with transparent alpha
               //  $img->fill('rgba(0, 0, 0, 0.5)');
      $img = Image::make('images/600x315.jpg')->resize(500, 399);
      $img->fill('0ff');
      return $img->response('jpg');
    }
    public function create_blank_img(){
      $img = Image::canvas(600, 315);
      //
    //  echo $img->response('jpg', 70);
      $response = Response::make($img->encode('png'));
   // set content-type
      $response->header('Content-Type', 'image/png');
  // output//
      $img->fill('#fff');
    //  $img->greyscale();
      $img->save('images/16x9.png');
      return $response;
  //   return $img->response('jpg');
    }

     public function backup(){

      //  // create empty canvas with black background
      //       $img = Image::canvas(120, 90, '#000000');
      //  // fill image with color
      //       $img->fill('#b53717');
      // // backup image with colored background
      //      $img->backup();
      // // fill image with tiled image
      //     $img->fill('images/f.jpg');
      // // return to colored background
      //     $img->reset();

     }

     public function blur(){
              //  $img = Image::make('images/a.jpg');
                 // apply slight blur filter
                // $img->blur();
                 // apply stronger blur
                 //$img->blur(80);
              //   $img->brightness(50);
              //   return $img->response('jpg');
                // $img = Image::make('public/foo.jpg');

              // paste another image
              $img = Image::make('images/6.jpg');
              //$img->insert('images/6.jpg');

              // create a new Image instance for inserting
              $watermark = Image::make('images/model.jpg');
              $watermark->resize(280, 360);
              //$img->insert($watermark, 'center');
              // insert watermark at bottom-right corner with 10px offset
              $img->insert($watermark, 'top-left', 10,10);       //top-left (default)
            //  $img->text('The quick brown fox jumps over the lazy dog.', 120, 100);
              $img->text('The quick brown fox jumps over the lazy dog', 450, 220, function($font) {
                  $font->file('fonts/MotionPicture_PersonalUseOnly.ttf');
                  $font->size(60);
                  $font->color('#00f');
                  $font->align('left');   //left, right and center
                  $font->valign('top');  //top, bottom , middle
                  $font->angle(0);       //0,45,90,180
              });
           //example at position

            //  $img->insert($watermark, 'top', 10,10);            //top
            //  $img->insert($watermark, 'top-right', 10,10);      //top-right
            //  $img->insert($watermark, 'left', 10,10);           //left
            //  $img->insert($watermark, 'center', 10,10);         //center
            //  $img->insert($watermark, 'right', 10,10);          //right
            //  $img->insert($watermark, 'bottom-left', 10,10);    //bottom-left
            //  $img->insert($watermark, 'bottom', 10,10);         //bottom
           //   $img->insert($watermark, 'bottom-right', 10,10);   //bottom-right

           // $img->line(10, 10, 195, 195, function ($draw) {
           //         $draw->color('#f00');
           //         $draw->width(5);
           //  });
              $img->resize(600, 315);
              $img->save('images/6x3.jpg'); //save to images
           //  $img->save('images/dd.jpg', 60); //save to set image quality
              return $img->response('jpg');

     }


       public function profileimage($id){
         return "hi".$id;
       }


}
