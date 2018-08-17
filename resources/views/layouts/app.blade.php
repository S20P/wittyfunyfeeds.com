
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

  <!-- Meta tags, description and Keywords -->

@include('inc.meta')


   <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Styles -->



          <!-- <meta property="og:image" content="http://wittyfunyfeeds.com/public/images/project_home_img/en/orignal/home_image_app80.jpg"/> -->



    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|Raleway:100,200,300,400,500,600,700,800,900|Roboto:100,300,400,500,900|Signika|Signika+Negative|Noto+Sans" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link href="{{ asset('css/jm.spinner.css') }}" rel="stylesheet" type="text/css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-114057184-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-114057184-1');
    </script>


    <!-- Google adsense -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-7657917286119680",
        enable_page_level_ads: true
      });
    </script>


</head>
<body>

        @include('inc.navbar')
        @include('inc.Admin-Right-Bar')
        @if(Request::is('home'))
           @yield('content')
        @elseif(Request::is('/'))
           @yield('content')
        @elseif(Request::is('admin/login'))
            @yield('content')
        @elseif(Request::is('register'))
            @yield('content')
        @elseif(Request::is('hi'))
            @yield('content')
        @elseif(Request::is('en'))
            @yield('content')
        @elseif(Request::is('profile'))
            @yield('content')
        @elseif(Request::is('privacy-policy'))
            @yield('content')
        @elseif(Request::is('terms-of-service'))
            @yield('content')
        @elseif(Request::is('About-us'))
            @yield('content')
        @elseif(Request::is('faq'))
            @yield('content')
        @else
        <div class="container main-content">
          <div class="row main-page">
             <div class="col-md-8">


                @yield('content')

                @if(!Request::is('login'))
                    @include('inc.bottom-service')
                @endif
             </div>
             <div class="col-md-4">

               @if(!Request::is('login'))

                   @include('inc.sidebar')

               @endif
             </div>
          </div>
       </div>
        @endif
       @include('inc.footer')
       @include('inc.model')
    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/progressbar.js') }}"></script>
    <script src="{{asset('js/jm.spinner.js')}}"></script>
    <script src="{{ asset('js/custome.js') }}"></script>

    @if(Request::route()->getPrefix()=="/hi")
    <script src="{{ asset('js/hi/api.js') }}"></script>
    @else
       <script src="{{ asset('js/en/api.js') }}"></script>
    @endif


</body>
</html>
