<div class="blog-content">

    <!-- <div class="index-content"> -->
     <div class="flex-row row">

    @foreach($app_btm_list as $task)
   <div class="col-md-4 col-sm-6 col-xs-6" id="app-list-grid">
       <a href="{{asset($task->lang.'/'.$task->app_controller_uri)}}">
   			<div class="thumbnail card">
   								<img src="{{asset('images/project_home_img/en/thumb-resize/'.$task->app_img_url)}}">
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
