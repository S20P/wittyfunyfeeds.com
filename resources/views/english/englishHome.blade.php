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
      <div class="col-md-4 col-sm-6 col-xs-6" id="app-list-grid">
          <a href="{{asset($task->lang.'/'.$task->app_controller_uri)}}">
      			<div class="thumbnail card">
      								<img src="{{asset('images/project_home_img/en/thumb-resize/'.$task->app_img_url)}}">
             @if($task->label !== null)
             <span class="tag simple new">{{$task->label}}</span>
             @endif
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
                <div id="total">36</div>
                <div id="app-length"></div>
                <div id="app-length2"></div>
                <div class="row">
                  <div class="col-md-12">
                    <a id="loadMore" class="disabled" onclick="getPage_englishApp()">
                    <div class="next-app-btn">
                        View More
                    </div>
                    </a>
                  </div>
                </div>

 </div>


@endsection
