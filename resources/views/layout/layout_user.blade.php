<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Custom Auth Laravel')</title>
    <link href="{{asset('assets/css/bootstrap_user.css')}}" rel="stylesheet" >
    <link rel="stylesheet" href="{{url('css/styles.css')}}">

  </head>
  <body>
    @include('header.header_user')
    @yield('content')
    <script src="{{asset('assets/js/bootstrap_user.js')}}"></script>
  </body>
</html>