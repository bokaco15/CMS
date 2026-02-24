@extends('front._layout._layout')
@section('title', 'Blog')
@section('meta_description', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English.')
@section('keywords', 'Blog, Blog page, Bloggy blog page')

@section('content')

<div class="container">
    <div class="row">
        @include('front.blog.latest_news')
        @include('front.blog.aside')
    </div>
</div>

@endsection

