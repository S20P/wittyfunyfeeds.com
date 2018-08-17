
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

 <title>{{ MetaTag::get('title') }}</title>

{!! MetaTag::tag('title') !!}
{!! MetaTag::tag('description') !!}
{!! MetaTag::tag('image') !!}
<meta property="fb:app_id" content="1827442653951223"/>
{!! MetaTag::openGraph() !!}
<meta property="og:image:width" content="800">
<meta property="og:image:height" content="420">




  <!-- <meta name="Author" content="S.H.PARMAR">
  <meta property="fb:app_id" content="1827442653951223" />
  <meta property="og:type" content="article" />
  <meta property="og:site_name" content="wittyfunyfeeds" />
<meta property="fb:pages" content="1827442653951223"> -->
<!-- <?php

// if (Auth::check()) {
//   $id = Auth::id();
//   $url = 'meta-json/data.json';
//   $data = file_get_contents($url);
//   $characters = json_decode($data);
//   $newCollection = collect($characters);
//
//    $user = $newCollection->where('id',$id)
//                          ->where('og_title', $app_title)
//                          ->sortByDesc('og_img')
//                          ->take(1);
//
//
//          foreach ($user as  $value) {
//                   echo '<meta  name="image"  content="'.$value->og_img.'">';
//                   echo '<meta  property="og:title"  content="'.$value->og_title.'" />';
//                   echo '<meta  property="og:description"  content="'.$value->og_description.'">';
//                   echo '<meta  property="og:image"  content="'.$value->og_img.'" />';
//         }
// }
?>-->


        <!-- <meta property="fb:app_id" content="1827442653951223"/>
        <meta property="og:url" content="{{url()->current()}}" >
        <meta property="og:type" content="article">
        <meta property="og:title" content="Are you the real Star Trek geek?" >
        <meta property="og:description" content="Prove your Star Trek geekhood! Are you wise like Yoda or Jar Jar Binks?" >
        <meta property="og:image" content="http://drib.tech/fbsharetest/quiz_landing.jpg" >
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630"> -->
<!-- <meta property="og:url" content="{{url()->current()}}">
<meta property="og:image:width" content="800" />
<meta property="og:image:height" content="420" />-->

<!-- keywords -->
<meta name="keywords" content="funny apps, facebook apps, share, feeds, free apps">
