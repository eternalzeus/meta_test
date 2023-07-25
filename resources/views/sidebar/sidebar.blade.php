<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{asset('assets/css/font.css')}}" >
        <link rel="stylesheet" href="{{url('css/sidebar.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap_sidebar.css')}}">
        

    </head>
    <body>
        <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Web Page</div>
        <div class="list-group list-group-flush">
            <a href="/home" class="list-group-item list-group-item-action bg-light">Post</a>
            <a href="/all_address" class="list-group-item list-group-item-action bg-light">Address</a>
            <a href="/all_country" class="list-group-item list-group-item-action bg-light">Country</a>
            <a href="/all_city" class="list-group-item list-group-item-action bg-light">City</a>
            <a href="/all_district" class="list-group-item list-group-item-action bg-light">District</a>
        </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle">Menu</button>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            User
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">User</a>
                            <a class="dropdown-item" href="#">Setting</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout">Logout</a>
                        </div>
                        </li>
                    </ul>
                </div>
            </nav>
        @yield('content')
        </div>
        <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
    </body>
</html>
<script src="{{url('js/sidebar.js')}}"></script>
<script src="{{asset('assets/js/jquerry.js')}}"></script>
<script src="{{asset('assets/js/bootstrap_sidebar.js')}}"></script>