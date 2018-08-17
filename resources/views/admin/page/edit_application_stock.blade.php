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
      <li class="breadcrumb-item active">Edit Current Application</li>
    </ul>
  </div>
</div>
<section class="dashboard-counts section-padding">
  <div class="container-fluid">
<div class="container">
    <div class="row">
      @if (count($errors) > 0)
     <div class = "alert alert-danger">
        <ul>
           @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
           @endforeach
        </ul>
      @if ($errors->has('app_name')) <!-- check if error message is or not-->
  <h2>{{ $errors->first('app_name') }}</h2> <!-- It retrive first error message for current field -->
      @endif
       </div>
  @endif
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Update  Application</div>
                <div class="panel-body">
               @foreach($application_stock_edit as $task)
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.updateapp',$task->id) }}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <input type="hidden" name="id" class="form-control" value="{{$task->id }}">
                      </div>
                      <div class="form-group">
                          <label for="app_name" class="col-md-4 control-label">Application Name</label>

                          <div class="col-md-6">
                              <input id="app_name" type="text" class="form-control" name="app_name" value="{{$task->app_name}}" required autofocus>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="app_meta_description" class="col-md-4 control-label">Application  Description</label>

                          <div class="col-md-6">
                              <textarea id="app_sub_description"  class="form-control"  name="app_sub_description"><?php echo $task->app_description; ?></textarea>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="app_img_url" class="col-md-4 control-label">Application Image</label>

                          <div class="col-md-6">
                              <input id="app_img_src" type="text" class="form-control" name="app_img_src"  value="{{$task->app_img_url}}">
                          </div>
                      </div>


                      <div class="form-group">
                          <label for="app_controller_uri" class="col-md-4 control-label">Application RouteController</label>

                          <div class="col-md-6">
                              <input id="app_controller_uri" type="text" class="form-control" value="{{$task->app_controller_uri}}" name="app_controller_uri" required>

                          </div>
                      </div>

                      <div class="form-group">
                          <label for="app_lang" class="col-md-4 control-label">Select App Language</label>

                          <div class="col-md-6">
                            <input id="app_lang" type="text" value="{{$task->lang}}" class="form-control" name="app_lang" required>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="app_lang" class="col-md-4 control-label">Select App Label</label>

                          <div class="col-md-6">
                            <select class="form-control" id="app_label" name="app_label">
                              <option value="null" selected="true" disabled>select label</option>
                              @foreach($label_app as $value):
                                 <option value="{{$value}}" @if($value == $task->label) {{ 'selected="selected"'}} @endif >{{$value}}</option>
                              @endforeach
                              <option value="">Reset or Remove label</option>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="app_meta_description" class="col-md-4 control-label">Application Meta Description</label>

                          <div class="col-md-6">
                              <textarea id="app_meta_description"  class="form-control"  name="app_meta_description"><?php echo $task->app_meta_description; ?></textarea>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Update
                              </button>
                          </div>
                      </div>

              <!-- onclick="this.disabled='disabled'" -->

                  </form>

                  @endforeach



                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection
