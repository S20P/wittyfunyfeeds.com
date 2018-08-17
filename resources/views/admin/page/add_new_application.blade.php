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
      <li class="breadcrumb-item active">Create new Application</li>
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
                <div class="panel-heading">Admin Add New Application</div>
                <div class="panel-body">

                  <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.addnewapp') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}

                      <div class="form-group{{ $errors->has('app_name') ? ' has-error' : '' }}">
                          <label for="app_name" class="col-md-4 control-label">Application Name</label>

                          <div class="col-md-6">
                              <input id="app_name" type="text" class="form-control" name="app_name" value="{{ old('app_name') }}" required autofocus>

                              @if ($errors->has('app_name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('app_name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('app_sub_description') ? ' has-error' : '' }}">
                          <label for="app_sub_description" class="col-md-4 control-label">Application  Description</label>

                          <div class="col-md-6">
                              <textarea id="app_sub_description"  class="form-control" name="app_sub_description"></textarea>

                              @if ($errors->has('app_sub_description'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('app_sub_description') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('app_img_src') ? ' has-error' : '' }}">
                          <label for="app_img_src" class="col-md-4 control-label">Application Image</label>

                          <div class="col-md-6">
                              <input id="app_img_src" type="file" class="form-control" name="app_img_src"  required>

                              @if ($errors->has('app_img_src'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('app_img_src') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('app_controller_uri') ? ' has-error' : '' }}">
                          <label for="app_controller_uri" class="col-md-4 control-label">Application RouteController</label>

                          <div class="col-md-6">
                              <input id="app_controller_uri" type="text" class="form-control" name="app_controller_uri" required>

                              @if ($errors->has('app_controller_uri'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('app_controller_uri') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('app_lang') ? ' has-error' : '' }}">
                          <label for="app_lang" class="col-md-4 control-label">Select App Language</label>

                          <div class="col-md-6">
                            <select class="form-control" id="app_lang" name="app_lang">
                              <option value="hi">हिंदी</option>
                              <option value="en">English</option>
                            </select>
                              @if ($errors->has('app_controller_uri'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('app_controller_uri') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('app_label') ? ' has-error' : '' }}">
                          <label for="app_lang" class="col-md-4 control-label">Select App Label</label>

                          <div class="col-md-6">
                            <select class="form-control" id="app_label" name="app_label">
                              <option  selected="true" disabled>select label</option>
                              @foreach($label_app as $value):
                                <option value="{{$value}}">{{$value}}</option>
                              @endforeach
                            </select>
                              @if ($errors->has('app_controller_uri'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('app_controller_uri') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>




                      <div class="form-group{{ $errors->has('app_meta_description') ? ' has-error' : '' }}">
                          <label for="app_meta_description" class="col-md-4 control-label">Application Meta Description</label>

                          <div class="col-md-6">
                              <textarea id="app_meta_description"  class="form-control" name="app_meta_description"></textarea>

                              @if ($errors->has('app_meta_description'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('app_meta_description') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Save
                              </button>
                          </div>
                      </div>

              <!-- onclick="this.disabled='disabled'" -->

                  </form>




                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection
