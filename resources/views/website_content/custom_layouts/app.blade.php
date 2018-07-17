<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Home</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="{{ url('css/cover.css') }}" rel="stylesheet">
    @yield('css')
  </head>

  <body>
  	<div class="container-fluid">
	  @include('website_content.custom_layouts.header')
	  @yield('content')
	</div>
    @include('website_content.custom_layouts.footer')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="{{ url('jquery/jquery.js')}}"></script>
    <script src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>
    @yield('js')
  </body>
</html>
