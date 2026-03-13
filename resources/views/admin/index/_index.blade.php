@extends('admin._layout._layout')
@section('content')
    <div class="container-fluid p-4">

        <h2 class="mb-4">Dashboard</h2>

        <div class="row g-4 mb-4">

            <!-- Posts -->
            <div class="col-md-4 bg-pr">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Posts</h6>
                        <h2 class="fw-bold">{{$postsCount}}</h2>
                        <small class="text-success">+{{$postThisWeek}} this week</small>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Categories</h6>
                        <h2 class="fw-bold">{{$activeCategories}}</h2>
                        <small class="text-muted">Active categories</small>
                    </div>
                </div>
            </div>

            <!-- Unread Comments -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Unread Comments</h6>
                        <h2 class="fw-bold text-danger">{{$unreadComments}}</h2>
                        <small class="text-danger">Needs moderation</small>
                    </div>
                </div>
            </div>

        </div>


        <!-- Latest Posts Table -->
        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">
                <h5 class="mb-0">Latest Posts</h5>
            </div>

            <div class="card-body p-0">

                <table class="table table-hover mb-0">

                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Heading</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Published Date</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($latestFivePosts as $post)

                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="w-50"><a href="{{route('front.post.index', ['post'=>$post->id, 'slug'=>$post->slug])}}">{{$post->heading}}</a></td>
                            <td>{{$post->category->name}}</td>
                            {!!$post->published ? "<td class='text-success'>Published</td>" : "<td class='text-danger'>Not Published</td>"!!}
                            <td>{{$post->created_at}}</td>
                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
