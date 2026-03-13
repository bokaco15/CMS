<section class="featured-posts no-padding-top">
    <div class="container">

        @foreach($importantPosts as $importantPost)
            @php
                $imageFirst = $loop->iteration % 2 == 0;
            @endphp

            <div class="row d-flex align-items-stretch">
                @if($imageFirst)
                    <div class="image col-lg-5"><img src="{{$importantPost->image}}" alt="..."></div>
                @endif
                <div class="text col-lg-7">
                    <div class="text-inner d-flex align-items-center">
                        <div class="content">
                            <header class="post-header">
                                <div class="category"><a href="{{$importantPost->category->show_on_index == 0 ? "#" : route('front.category.index', ['category' => $importantPost->category->id, 'slug' => $importantPost->category->slug])}}">{{$importantPost->category->show_on_index == 0 ? "Undefined Category" : $importantPost->category->name}}</a></div><a href="{{route('front.post.index', ['post'=>$importantPost->id, 'slug'=>$importantPost->slug])}}">
                                    <h2 class="h4">{{$importantPost->heading}}</h2></a>
                            </header>
                            <p>{{\Illuminate\Support\Str::words($importantPost->preheading, 30, '...')}}</p>
                            <footer class="post-footer d-flex align-items-center"><a href="{{route('front.user.post', ['user' => $importantPost->user->id, 'slug' => $importantPost->user->slug])}}" class="author d-flex align-items-center flex-wrap">
                                    <div class="avatar"><img src="/storage/images/avatars/{{$importantPost->user->id}}.webp" class="img-fluid"></div>
                                    <div class="title"><span>{{$importantPost->user->name}}</span></div></a>
                                <div class="date"><i class="icon-clock"></i> {{ $importantPost->created_at->diffForHumans() }}</div>
                                <div class="comments"><i class="icon-comment"></i>{{$importantPost->comments()->published()->count()}}</div>
                            </footer>
                        </div>
                    </div>
                </div>
                    @if(!$imageFirst)
                        <div class="image col-lg-5"><img src="{{$importantPost->image}}" alt="..."></div>
                    @endif
            </div>
        @endforeach
    </div>
</section>
