@extends('layouts.app')
@section('content')
<div class="container main-content">
  <!-- Content here -->
  <div class="content-collection-region">
    <div class="list-content clearfix">
    <div class="list row1">
      <div id="app_box">
      </div>
    </div>
    </div>
  </div>
</div>
<div class="container">
                <div class="box well"></div>
                <div id="total">0</div>
                <div id="app-length"></div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="next-app-btn">
                        <a id="loadMore" class="disabled" onclick="getPage_englishApp()">View More</a>
                    </div>
                  </div>
                </div>
 </div>
@endsection
