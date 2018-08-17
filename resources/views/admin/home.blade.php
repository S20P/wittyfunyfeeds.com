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
      <li class="breadcrumb-item active">Application List</li>
    </ul>
  </div>
</div>
<section class="dashboard-counts section-padding">
  <div class="container-fluid">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header d-flex align-items-center">
                  <h2 class="h5 display">Application List</h2>
            </div>
          <div class="card-block">
            <div class="table-responsive">
              <div class="table-responsive">
              <table class="table">
                  <thead><tr>
                      <th>App Name</th>
                      <th>Route-uri</th>
                      <th>Language</th>
                      <th>Images</th>
                      <th>Action</th>
                      </tr>
              </thead>

              <tbody>

                @foreach($application_stock as $task)
                  <tr>
                       <td>
                        <p class="big">  {{$task->app_name}} </p>
                      </td>
                      <td>
                       <p class="big">  {{$task->app_controller_uri}} </p>
                     </td>
                      <td>
                      <p class="big">{{$task->lang}} </p>
                      </td>
                  <td>
                   <img id="admin-card-img" src="{{asset('images/project_home_img/en/thumb-resize/'.$task->app_img_url)}}"></img> </p>
                 </td>
                 <td>
                   <form action="{{ route('admin.updateapp',$task->id) }}">
                       <button type="submit" name="edit" formmethod="GET" class="btn btn-primary">Edit</button>
                       <!-- <button type="submit" name="delete" formmethod="POST" class="btn btn-danger">Delete</button> -->
                 {{ csrf_field() }}
                  </form>
                  <button class="btn btn-danger btn-theme" data-toggle="modal" data-target="#confirm-delete{{$task->id}}" >
                  <i class="fa fa-trash-o" aria-hidden="true"></i>   Delete
                  </button>
                  <!-- confirm-delete model -->
                             <div class="modal fade" id="confirm-delete{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     Confirm Delete
                                 </div>
                                 <div class="modal-body">
                                  Are you sure you want to delete this Application ?
                                 </div>
                                 <div class="modal-footer">

                                     <form  class="form-inline" role="form" method="POST" action="{{ route('admin.updateapp',$task->id) }}">
                                       {{ csrf_field() }}

                                     <div class="form-group">
                                       <button type="submit" name="delete" class="btn btn-danger btn-theme btn-ok">
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
                 </td>
                  </tr>

              @endforeach</tbody>
              </table>
              <div class="">

                  {{$application_stock->links()}}
              </div>
            </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@endsection
