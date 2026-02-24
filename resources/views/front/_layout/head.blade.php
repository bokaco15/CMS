<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>@yield('title')</title>
<meta name="description" content="@yield('meta_description')">
<meta name="keywords" content="@yield('keywords')">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="all,follow">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ url('themes/front/vendor/bootstrap/css/bootstrap.min.css') }}">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="{{ url('themes/front/vendor/font-awesome/css/font-awesome.min.css') }}">

<!-- Custom icon font -->
<link rel="stylesheet" href="{{ url('themes/front/css/fontastic.css') }}">

<!-- Google fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">

<!-- Fancybox -->
<link rel="stylesheet" href="{{ url('themes/front/vendor/@fancyapps/fancybox/jquery.fancybox.min.css') }}">

<!-- Theme stylesheet -->
<link rel="stylesheet" href="{{ url('themes/front/css/style.default.css') }}" id="theme-stylesheet">

<!-- Custom stylesheet -->
<link rel="stylesheet" href="{{ url('themes/front/css/custom.css') }}">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ url('themes/front/favicon.png') }}">

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

@stack('header_scripts')
