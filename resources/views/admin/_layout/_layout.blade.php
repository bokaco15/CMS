<!DOCTYPE html>
<html>
@include('admin._layout.head')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin._layout.navbar')
        @include('admin._layout.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

        @include('admin._layout.footer')
    </div>
</body>
@include('admin._layout.scripts')
</html>
