<button type="button"
        class="btn btn-sm btn-success mr-2"
        id="btnAcceptComment"
        data-toggle="modal"
        data-target="#acceptCommentModal"
        data-id="{{$comment->id}}"
        data-name="{{$comment->name}}"
        data-newstatus="{{$comment->status == 0 ? 1 : 0}}"
        data-useremail="{{$comment->email}}">    Accept
</button>
<button class="btn btn-sm btn-danger" id="btnDeleteComment" data-toggle="modal" data-target="#deleteCommentModal" data-id="{{$comment->id}}">
    Delete
</button>
