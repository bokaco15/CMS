@extends('front._layout._layout')
@section('title', $category->name)
@section('meta_description', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English.')
@section('keywords', 'Blog, Blog page, Bloggy blog page')

@section('content')

    <div class="container">
        <div class="row">
            <main class="posts-listing col-lg-8">
                <div class="container">
                    <h2>Category: "{{$category->name}}"</h2>

                    <div class="row">
                        @foreach($posts as $post)
                            <div class="post col-xl-6">
                                <div class="post-thumbnail"><a href="{{route('front.post.index', ['post'=>$post->id, 'slug'=>$post->slug])}}"><img src="{{$post->image}}" alt="..." class="img-fluid"></a></div>
                                <div class="post-details">
                                    <div class="post-meta d-flex justify-content-between">
                                        <div class="date meta-last">{{$post->created_at->format('d F | Y') }}</div>
                                        <div class="category"><a href="blog-category.html">{{$post->category->name}}</a></div>
                                    </div><a href="{{route('front.post.index', ['post'=>$post->id, 'slug'=>$post->slug])}}">
                                        <h3 class="h4">{{$post->heading}}</h3></a>
                                    <p class="text-muted">{{\Illuminate\Support\Str::words($post->preheading, 10, '....')}}</p>
                                    <footer class="post-footer d-flex align-items-center"><a href="blog-author.html" class="author d-flex align-items-center flex-wrap">
                                            <div class="avatar"><img src="/storage/images/avatars/{{$post->user->id}}.webp" alt="user logo" class="img-fluid"></div>
                                            <div class="title"><span>{{$post->user->name}}</span></div></a>
                                        <div class="date"><i class="icon-clock"></i> {{$post->created_at->diffForHumans()}}</div>
                                        <div class="comments meta-last"><i class="icon-comment"></i>{{count($post->comments)}}</div>
                                    </footer>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-template d-flex justify-content-center">
                            {{$posts->onEachSide(0)->links()}}
                        </ul>
                    </nav>
                </div>
            </main>

            @include('front.blog.aside')
        </div>
    </div>

@endsection

