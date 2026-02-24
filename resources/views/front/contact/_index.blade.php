@extends('front._layout._layout')

@section('title', 'Contact')
@section('meta_description', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English.')
@section('keywords', 'Contact, Bloggy contact, Contact us')
@push('header_scripts')
    <link rel="stylesheet" href="{{ url('themes/front/plugins/owl-carousel2/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('themes/front/plugins/owl-carousel2/assets/owl.theme.default.min.css') }}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush

@section('content')
    @include('front.contact.hero-section')
    <div class="container">
        <div class="row">
            @include('front.contact.form')
            @include('front.contact.aside')
        </div>
    </div>
@endsection
