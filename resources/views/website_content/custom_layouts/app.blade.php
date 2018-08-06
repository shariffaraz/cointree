<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Home</title>

    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="{{ url('assets/web/assets/mobirise-icons/mobirise-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/tether/tether.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/socicon/css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('assets/animatecss/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/mobirise/css/mbr-additional.css') }}" type="text/css">

    <!-- Custom styles for this template -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet"> -->
    <!-- <link href="{{ url('css/cover.css') }}" rel="stylesheet"> -->
    <link href="{{ url('css/custom_style.css') }}" rel="stylesheet">
    @yield('css')
  </head>

  <body>
    @include('website_content.custom_layouts.header')
    @yield('content')
    @include('website_content.custom_layouts.footer')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script type="text/javascript" src="{{ url('jquery/jquery.js')}}"></script>
    <script src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script> -->
    <script src="{{ url('assets/web/assets/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/popper/popper.min.js') }}"></script>
    <script src="{{ url('assets/tether/tether.min.js') }}"></script>
    <script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/smoothscroll/smooth-scroll.js') }}"></script>
    <script src="{{ url('assets/touchswipe/jquery.touch-swipe.min.js') }}"></script>
    <script src="{{ url('assets/viewportchecker/jquery.viewportchecker.js') }}"></script>
    <script src="{{ url('assets/parallax/jarallax.min.js') }}"></script>
    <script src="{{ url('assets/dropdown/js/script.min.js') }}"></script>
    <script src="{{ url('assets/theme/js/script.js') }}"></script>
    @yield('js')
  </body>
</html>
