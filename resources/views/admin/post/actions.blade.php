
<td class="text-center">
    <a class="btn btn-sm btn-primary mr-1" href="{{route('front.post.index', ['post'=>$post->id, 'slug'=>$post->slug])}}">
        {{$post->published == 1 ? "Show live" : "Preview"}}
    </a>
    <a href="{{route('admin.post.edit', ['post'=>$post->id, 'slug' => $post->slug])}}" type="button" class="btn btn-sm btn-warning mr-2" id="btnEditTag">
        Edit
    </a>
    <button type="button" class="btn btn-sm {{$post->published ? "btn-danger" : "btn-success"}} mr-1" id="btnChangePostStatus" data-toggle="modal" data-target="#editPostStatusModal" data-id="{{$post->id}}" data-banUnban="{{$post->published ? 0 : 1}}" data-name="{{$post->name}}" data-slug="{{$post->slug}}">
        {{$post->published ? "Ban" : "Unban"}}
    </button>
    <button class="btn btn-sm btn-danger" id="btnDeletePost" data-toggle="modal" data-target="#deletePostModal" data-id="{{$post->id}}" data-name="{{$post->heading}}">
        Delete
    </button>
</td>
