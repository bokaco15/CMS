<main class="posts-listing col-lg-8">
    <div class="container">
        <div class="row">
            @if(request('search'))
                <h2 class="mb-3">Search results for "{{request('search')}}"</h2> <hr class="w-100">
            @endif
            @foreach($posts as $post)
                <div class="post col-xl-6">
                    <div class="post-thumbnail"><a href="{{route('front.post.index', ['post'=>$post->id, 'slug'=>$post->slug])}}"><img src="{{$post->image}}" alt="..." class="img-fluid"></a></div>
                    <div class="post-details">
                        <div class="post-meta d-flex justify-content-between">
                            <div class="date meta-last">{{$post->created_at->format('d F | Y') }}</div>
                            <div class="category"><a href="{{$post->category->show_on_index == 0 ? "" : route('front.category.index', ['category' => $post->category->id, 'slug' => $post->category->slug])}}">{{$post->category->show_on_index == 0 ? "Undefined Category" : $post->category->name}}</a></div>
                        </div><a href="{{route('front.post.index', ['post'=>$post->id, 'slug'=>$post->slug])}}">
                            <h3 class="h4">{{$post->heading}}</h3></a>
                        <p class="text-muted">{{\Illuminate\Support\Str::words($post->preheading, 10, '....')}}</p>
                        <footer class="post-footer d-flex align-items-center"><a href="{{route('front.user.post', ['user' => $post->user->id, 'slug' => $post->user->slug])}}" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="/storage/images/avatars/{{$post->user->id}}.webp" class="img-fluid"></div>
                                <div class="title"><span>{{$post->user->name}}</span></div></a>
                            <div class="date"><i class="icon-clock"></i> {{$post->created_at->diffForHumans()}}</div>
                            <div class="comments meta-last"><i class="icon-comment"></i>
                                {{$post->comments()->published()->count()}}
                            </div>
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
