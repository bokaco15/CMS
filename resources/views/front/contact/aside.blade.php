<aside class="col-lg-4">
    <!-- Widget [Contact Widget]-->
    <div class="widget categories">
        <header>
            <h3 class="h6">Contact Info</h3>
            <div class="item d-flex justify-content-between">
                <span>15 Yemen Road, Yemen</span>
                <span><i class="fa fa-map-marker"></i></span>
            </div>
            <div class="item d-flex justify-content-between">
                <span>(020) 123 456 789</span>
                <span><i class="fa fa-phone"></i></span>
            </div>
            <div class="item d-flex justify-content-between">
                <span>info@company.com</span>
                <span><i class="fa fa-envelope"></i></span>
            </div>
        </header>

    </div>
    <div class="widget latest-posts">
        <header>
            <h3 class="h6">Latest Posts</h3>
        </header>
        <div class="blog-posts">
                @foreach($latestFooterPosts as $latestPost)
                <a href="{{route('front.post.index', ['post'=>$latestPost->id, 'slug'=>$latestPost->slug])}}">
                    <div class="item d-flex align-items-center">
                    <div class="image"><img src="{{$latestPost->image}}" alt="..." class="img-fluid"></div>
                    <div class="title"><strong>{{$latestPost->heading}}</strong>
                        <div class="d-flex align-items-center">
                            <div class="views"><i class="icon-eye"></i> {{$latestPost->views}}</div>
                            <div class="comments"><i class="icon-comment"></i>{{$latestPost->comments->count()}}</div>
                        </div>
                    </div>
                </div></a>
                @endforeach
    </div>
</aside>
