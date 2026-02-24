<!doctype html>
<html lang="en">
<head>
    @include('front._layout.head')
</head>
<body>
    @include('front._layout.header')

    @yield('content')

    @include('front._layout.footer')
</body>
</html>
