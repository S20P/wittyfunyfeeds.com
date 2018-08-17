@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
      <div id="app">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> <h1>Facebook</h1></div>
                <div class="panel-body">




                 <?php

                   $url = "http://api.giphy.com/v1/gifs/search?q=perfect&api_key=oMrCV6gvyxDeQwqs51s6yMPGwrCOEpxE&limit=1";
                   $content = file_get_contents($url);
                   $json = json_decode($content);
                   $src = $json->data[0]->images->fixed_height->url;
                   // $osrc = $json->data[0]->images->original->url;
                   // echo "<img  src='$osrc'>";
                   // $ossrc = $json->data[0]->images->original_still->url;
                   // echo "<img  src='$ossrc'>";
                 ?>
              <img  src="{{$src}}">;
           </div>
            </div>
        </div>
          </div>
    </div>
</div>
@endsection
