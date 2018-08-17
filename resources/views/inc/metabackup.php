<?php
$bg = array();
$dirname =  asset('images');
$files = glob("images/*.*");
for ($i = 0; $i < count($files); $i++) {
    $image = $files[$i];
    $supported_file = array(
        'gif',
        'jpg',
        'jpeg',
        'png'
    );
    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    if (in_array($ext, $supported_file)) {
        //echo basename($image);
        $img =  basename($image);
        array_push($bg,$img);
    } else {
     continue;
      }
    }
  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = $bg[$i]; // set variable equal to which random filename was chosen
  $url =  asset('images');
  $fullpath =  $url."/".$selectedBg;
  ?>
<meta property="og:url" content="{{ Request::url() }}" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta property="og:type" content="website" />
<meta property="og:image" content="{{$fullpath}}" />
<meta name="author" content="Set Kyar Wa Lar21" />
<meta name="twitter:creator" content="Set Kyar Wa Lar23" />
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:title" content="Hello Hi,how are you" />
<meta property="og:description" content="Welcome from Hello World1323" />
<meta name="fb:app_id" content="292286661272435" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@setkyarwalar" />
<meta name="twitter:title" content="Hello World123" />
<meta name="twitter:description" content="Welcome from Hello World123" />
<meta name="twitter:image" content="{{$fullpath}}" />
<meta itemprop="og:headline" content="{{$fullpath}}" />
<meta property="og:title" content="Lorem Ipsum is simply Example Test"/>
<meta property="og:image" content="{{$fullpath}}"/>
<meta property="og:site_name" content="David Walsh Blog"/>
<meta property="og:description" content="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, "/>
