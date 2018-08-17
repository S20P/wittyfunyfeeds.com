
  @foreach($student as $task)
  <div class="col-md-4 col-sm-6 col-xs-6" id="app-list-grid">
      <a href="{{asset($task->lang.'/'.$task->app_controller_uri)}}">
        @if($task->label !== null)
        <span class="tag simple new">{{$task->label}}</span>
        @endif
  			<div class="thumbnail card">
  								<img width="360px" height="189px" src="{{asset('images/project_home_img/en/thumb-resize/'.$task->app_img_url)}}">
  				<div class="caption">

  					<h4 class="flex-text">{{$task->app_name}}</h4>

  				</div>
  				<!-- /.caption -->
  			</div>
  			<!-- /.thumbnail -->
  		</div>
    </a>

@endforeach

<!-- </div> -->
