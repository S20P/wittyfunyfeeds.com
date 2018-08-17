@extends('admin.layouts.app')

@section('content')
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li>
        <!-- <a href="{{ URL::previous() }}" class="btn btn-default">Back</a> -->
        <a href="javascript:history.back()" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
      </li>
      <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
      <li class="breadcrumb-item active">Folder Remove</li>
    </ul>
  </div>
</div>
<section class="dashboard-counts section-padding">
  <div class="container-fluid">
<div class="container main-content">
    <div class="row">
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif

      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Click to Delete Folder</div>
              <div class="panel-body">
<?php
                  $days = 30;
                  $files = glob("uploads/*");
                  $path = 'uploads';

                   foreach ($files as $file) {
                              //echo "file".$file;
                             // echo "<br>";
                              $old_date = (time() - ($days * 24 *  60 * 60));
                              $date1 = gmdate("d-m-Y", $old_date);
                              // echo "d1 ".$date1;
                              // echo "<br>";
                              $i = strtotime($date1);

                              $a = filemtime($file);
                              $date =  gmdate("d-m-Y", $a);
                              $j =  strtotime($date);

                               if($i>$j){
                                $dir  =  gmdate("d-m-Y", $j);
                                if(file_exists( $path."/".$dir )){

                           ///echo $path."/".$dir."<br>";
                                $dir = $dir;
                                  ?>

                                  <div class="row">
                                    <div class="col-md-3">
                                    <p>{{$dir}}</p>
                                    </div>
                                    <div class="col-md-4">
                                      <button class="btn btn-danger btn-theme" data-toggle="modal" data-target="#confirm-delete{{$dir}}" >
                                      <i class="fa fa-trash-o" aria-hidden="true"></i>   Delete
                                      </button>
                                    </div>
                                  </div>

                                  <br>

                                  <!-- confirm-delete model -->
                                             <div class="modal fade" id="confirm-delete{{$dir}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                             <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     Confirm Delete
                                                 </div>
                                                 <div class="modal-body">
                                                  Are you sure you want to delete this Folder ?
                                                 </div>
                                                 <div class="modal-footer">
                                                     <form  class="form-inline" role="form" method="POST" action="{{ route('admin.deletefolder',$dir) }}">
                                                       {{ csrf_field() }}

                                                       <div class="form-group">
                                                         <input type="hidden" name="path" class="form-control" value="{{$path}}">
                                                       </div>
                                                     <div class="form-group">
                                                       <button type="submit" class="btn btn-danger btn-theme btn-ok">
                                                           Delete
                                                       </button>
                                                         <button type="button" class="btn btn-default btn-theme" data-dismiss="modal">Cancel</button>
                                                     </div>
                                                     </form>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <!-- end Model -->
<?php
                                  //File::deleteDirectory($path."/".$dir);
                                }

                               }

                               else{
                               // echo "<br>";
                               // echo "today  ".$date1;
                               // echo "<br>";

                                 }

                     }



                     ?>

                   </div>
                 </div>
                 </div>
                 </div>
</div>
</div>
</section>
@endsection
