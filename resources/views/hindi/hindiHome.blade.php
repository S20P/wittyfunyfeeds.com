@extends('layouts.app')
@section('content')
<div class="container main-content">
  <!-- Content here -->
  <div class="content-collection-region">
    <div class="list-content clearfix">
    <div class="list row1">
      <div id="app_box">
        <div class="flex-row row">
        @foreach($student as $task)
        <div class="col-md-4 col-sm-6">
            <a href="{{asset($task->app_controller_uri)}}">
              <div class="thumbnail card">
                        <img src="{{asset($task->app_img_url)}}">
                <div class="caption">

                  <h4 class="flex-text">{{$task->app_name}}</h4>

                </div>
                <!-- /.caption -->
              </div>
              <!-- /.thumbnail -->
            </div>
          </a>
      @endforeach
      </div>
      </div>
    </div>
    </div>
  </div>
</div>
<div class="container">
                <div class="box well"></div>
                <div id="total">6</div>
                <div id="app-length"></div>
                <div id="app-length2"></div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="next-app-btn">
                        <a id="loadMore" class="disabled" onclick="getPage_hindiApp()">View More</a>
                    </div>
                  </div>
                </div>
 </div>
@endsection
