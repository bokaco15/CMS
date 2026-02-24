<section class="latest-posts">
    <div class="container">
        <header>
            <h2>Latest from the blog</h2>
            <p class="text-big">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </header>
        <div class="owl-carousel" id="latest-posts-slider">
            @foreach($latestPosts as $latestPost)

                @if(in_array($loop->iteration, [1,4,7,10]))
                    <div class="row">
                @endif
                    <div class="post col-md-4">
                            <div class="post-thumbnail"><a href="{{route('front.post.index', ['post'=>$latestPost->id, 'slug'=>$latestPost->slug])}}"><img src="{{$latestPost->image}}" alt="..." class="img-fluid"></a></div>
                            <div class="post-details">
                                <div class="post-meta d-flex justify-content-between">
                                    <div class="date">{{ $latestPost->created_at->format('d M | Y') }}</div>
                                    <div class="category"><a href="{{$latestPost->category->show_on_index == 0 ? "#" : route('front.category.index', ['category' => $latestPost->category->id, 'slug' => $latestPost->category->slug])}}">{{$latestPost->category->show_on_index == 0 ? "Undefined Category" : $latestPost->category->name}}</a></div>
                                </div><a href="{{route('front.post.index', ['post'=>$latestPost->id, 'slug'=>$latestPost->slug])}}">
                                    <h3 class="h4">{{$latestPost->heading}}</h3></a>
                                <p class="text-muted">{{\Illuminate\Support\Str::words($latestPost->preheading, 10, '...')}}</p>
                            </div>
                        </div>
                @if(in_array($loop->iteration, [3,6,9,12]))
                    </div>
                @endif
            @endforeach

        </div>
    </div>
</section>
