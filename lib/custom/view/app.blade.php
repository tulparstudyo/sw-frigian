<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('aimeos_header')
<title>{{ frigian_option('store_name') }}</title>
<!-- Vendor CSS Files --> 
<!-- Main Style CSS File -->
<link rel="stylesheet" href="{{ frigian_url('assets/css/vendor/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ frigian_url('assets/css/main.css') }}">
<script src="{{ frigian_url('assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
<link rel="stylesheet" href="{{ frigian_url('assets/css/vendor/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ frigian_url('assets/css/vendor/fontawesome.css') }}">
<link rel="stylesheet" href="{{ frigian_url('assets/css/vendor/plaza-icon.css') }}">

<!-- Plugin CSS Files -->
<link rel="stylesheet" href="{{ frigian_url('assets/css/plugin/slick.css') }}">
<link rel="stylesheet" href="{{ frigian_url('assets/css/plugin/material-scrolltop.css') }}">
<link rel="stylesheet" href="{{ frigian_url('assets/css/plugin/price_range_style.css') }}">
<link rel="stylesheet" href="{{ frigian_url('assets/css/plugin/in-number.css') }}">
<link rel="stylesheet" href="{{ frigian_url('assets/css/plugin/venobox.min.css') }}">
<link rel="stylesheet" href="{{ frigian_url('assets/css/plugin/jquery.lineProgressbar.css') }}">

<link rel="stylesheet" href="{{ frigian_url('theme.css') }}">
</head>
<body>
<!-- ::::::  Start Header Section  ::::::  -->
<header>
    <?php  echo frigian_header(); ?>
    @yield('aimeos_head')
    <div class="offcanvas-overlay"></div>
</header>
<!-- :::::: End Header Section ::::::  --> 
@yield('content')
@yield('aimeos_body')
<?php  echo frigian_footer(); ?>
<!-- Vendor JS Files --> 


<script src="{{ frigian_url('assets/js/vendor/modernizr-3.7.1.min.js') }}"></script> 
<script src="{{ frigian_url('assets/js/vendor/jquery-ui.min.js') }}"></script> 
<script src="{{ frigian_url('assets/js/vendor/bootstrap.bundle.min.js') }}"></script> 
<!-- Plugins JS Files --> 
<script src="{{ frigian_url('assets/js/plugin/slick.min.js') }}"></script> 
<script src="{{ frigian_url('assets/js/plugin/jquery.countdown.min.js') }}"></script> 
<script src="{{ frigian_url('assets/js/plugin/material-scrolltop.js') }}"></script> 
<script src="{{ frigian_url('assets/js/plugin/price_range_script.js') }}"></script> 
<script src="{{ frigian_url('assets/js/plugin/in-number.js') }}"></script> 
<script src="{{ frigian_url('assets/js/plugin/jquery.elevateZoom-3.0.8.min.js') }}"></script> 
<script src="{{ frigian_url('assets/js/plugin/venobox.min.js') }}"></script> 
<script src="{{ frigian_url('assets/js/plugin/jquery.waypoints.js') }}"></script> 
<script src="{{ frigian_url('assets/js/plugin/jquery.lineProgressbar.js') }}"></script> 


<script src="{{ frigian_url('assets/js/main.js') }}"></script> 

@yield('aimeos_scripts')

<script type="text/javascript" src="/public/js/swordbros.js"></script>
<script src="{{ frigian_url('theme.js') }}"></script> 



    <div class="menu-overlay"></div>
    



</body>
</html>
