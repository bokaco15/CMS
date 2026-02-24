@extends('front._layout._layout')
@section('title', $post->heading)
@section('meta_description', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English.')
@section('keywords', 'Blog, Blog page, Bloggy blog page')
@push('header_scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <main class="post blog-post col-lg-8">
                <div class="container">
                    <div class="post-single">
                        <div class="post-thumbnail"><img src="{{$post->image}}" alt="..." class="img-fluid"></div>
                        <div class="post-details">
                            <div class="post-meta d-flex justify-content-between">
                                <div class="category"><a href="{{$post->category->show_on_index == 0 ? "" : route('front.category.index', ['category' => $post->category->id, 'slug' => $post->category->slug])}}">{{$post->category->show_on_index == 0 ? "Undefined Category" : $post->category->name}}</a></div>
                            </div>
                            <h1>{{$post->heading}}<a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
                            <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="{{route('front.user.post', ['user' => $post->user->id, 'slug' => $post->user->slug])}}" class="author d-flex align-items-center flex-wrap">
                                    <div class="avatar"><img src="/storage/images/avatars/{{$post->user->id}}.webp" class="img-fluid"></div>
                                    <div class="title"><span>{{$post->user->name}}</span></div></a>
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="date"><i class="icon-clock"></i> {{$post->created_at->diffForHumans()}}</div>
                                    <div class="views"><i class="icon-eye"></i> {{$post->views}}</div>
                                    <div class="comments meta-last"><a href="#post-comments"><i class="icon-comment"></i>{{$comments->count()}}</a></div>
                                </div>
                            </div>
                            <div class="post-body">
                                <p class="lead">{{$post->preheading}}</p>
                                <div>
                                    {!!$post->text!!}
                                </div>
                            </div>
                            <div class="post-tags">
                                @foreach($post->tags as $tag)
                                    <a href="{{route('front.tags.index', ['tag'=>$tag->id, 'slug' => $tag->slug])}}" class="tag">{{$tag->name}}</a>
                                @endforeach
                            </div>
                            <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">
                                @if($prevPost)
                                <a href="{{route('front.post.index',['post'=>$prevPost->id, 'slug'=>$prevPost->slug])}}" class="prev-post text-left d-flex align-items-center">
                                    <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                                    <div class="text"><strong class="text-primary">Previous Post </strong>
                                        <h6>{{$prevPost->heading}}</h6>
                                    </div>
                                </a>
                                @endif
                                @if($nextPost)
                                <a href="{{route('front.post.index',['post'=>$nextPost->id, 'slug'=>$nextPost->slug])}}" class="next-post text-right d-flex align-items-center justify-content-end">
                                    <div class="text"><strong class="text-primary">Next Post </strong>
                                        <h6>{{$nextPost->heading}}</h6>
                                    </div>
                                    <div class="icon next"><i class="fa fa-angle-right"></i>
                                    </div>
                                </a>
                                @endif
                            </div>
                            <div class="post-comments" id="post-comments">
                                <header>
                                    <h3 class="h6">Post Comments<span class="no-of-comments">({{$comments->count()}})</span></h3>
                                </header>
                                @if($comments->isNotEmpty())
                                    @foreach($comments as $comment)
                                        <div class="comment">
                                            <div class="comment-header d-flex justify-content-between">
                                                <div class="user d-flex align-items-center">
                                                    <div class="image"><img src="{{url('/themes/front/img/user.svg')}}" alt="..." class="img-fluid rounded-circle"></div>
                                                    <div class="title"><strong>{{$comment->name}}</strong><span class="date">{{$comment->created_at->diffForHumans()}}</span></div>
                                                </div>
                                            </div>
                                            <div class="comment-body">
                                                <p>{{$comment->text}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="add-comment">
                                <header>
                                    <h3 class="h6">Leave a reply</h3>
                                </header>
                                <div id="commentMessage" class="mt-3"></div>
                                <form id="commenting-form" action="{{ route('front.post.comment', ['post' => $post->id]) }}" method="POST" class="commenting-form">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="text" name="username" id="username" placeholder="Name" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" name="email" id="email" placeholder="Email Address (will not be published)" class="form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea name="text" id="text" placeholder="Type your comment" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="g-recaptcha" data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"></div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-secondary">Submit Comment</button>
                                        </div>
                                    </div>
                                </form>

                                <div id="commentLoader" style="display:none; text-align:center; margin-top:15px;">
                                    <img src="https://i.gifer.com/ZZ5H.gif" alt="Loading..." style="width:60px;">
                                    <p style="margin-top:10px;">Šaljem komentar...</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>

            @include('front.blog.aside')
        </div>
    </div>

@endsection

@push('footer_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        $(document).ready(function () {

            $("#commenting-form").on("submit", function (e) {
                e.preventDefault();

                let token = grecaptcha.getResponse();
                if (!token) {
                    $("#commentMessage").html('<div class="alert alert-danger">Potvrdi reCAPTCHA.</div>');
                    return;
                }

                $.ajax({
                    method: "POST",
                    url: "{{route('front.post.comment')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: '{{$post->id}}',
                        url: '{{url()->full()}}',
                        name: $("#username").val(),
                        email: $("#email").val(),
                        text: $("#text").val(),
                        "g-recaptcha-response": token
                    },
                    beforeSend: function () {
                        $("#commentLoader").fadeIn(150);
                        $("#commenting-form button[type='submit']").prop("disabled", true);
                    }
                }).done(function (response) {
                    console.log(response);
                    toastr.success(response.message, {
                        showDuration: 300,
                        hideDuration: 1000
                    });
                    $("#commenting-form")[0].reset();
                    grecaptcha.reset();
                }).fail(function (xhr) {
                    let message = xhr.responseJSON.message ?? "Greska!"
                    console.log(message);

                    toastr.error(message, {
                        showDuration: 300,
                        hideDuration: 1000
                    });
                }).always(function () {
                    $("#commentLoader").fadeOut(150);
                    $("#commenting-form button[type='submit']").prop("disabled", false);
                });

            })


        })
    </script>
@endpush

