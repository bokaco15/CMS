@extends('front._layout._layout')
@section('title', 'Home')
@section('meta_description', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English.')
@section('keywords', 'Blog, Bloggy, 2026 blogs, Cubes final work')
@push('header_scripts')
    <!-- Owl Carousel 2 -->
    <link rel="stylesheet" href="{{ url('themes/front/plugins/owl-carousel2/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('themes/front/plugins/owl-carousel2/assets/owl.theme.default.min.css') }}">
@endpush

    @section('content')

        @include('front.index.hero-slider')
        @include('front.index.second-section-text')
        @include('front.index.third-section-importantblogs')
        @include('front.index.fourth-section-text')
        @include('front.index.fifth-section-latestfromtheblog')
        @include('front.index.sixth-section-gallery')

    @endsection

@push('footer_scripts')
    <script>
        $("#index-slider").owlCarousel({
            "items": 1,
            "loop": true,
            "autoplay": true,
            "autoplayHoverPause": true
        });

        $("#latest-posts-slider").owlCarousel({
            "items": 1,
            "loop": true,
            "autoplay": true,
            "autoplayHoverPause": true
        });
    </script>
@endpush
