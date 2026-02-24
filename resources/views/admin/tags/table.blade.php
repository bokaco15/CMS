
<td class="text-center">
    <button type="button" class="btn btn-sm btn-warning mr-2" id="btnEditTag" data-toggle="modal" data-target="#editTagModal" data-id="{{$tag->id}}" data-name="{{$tag->name}}" data-slug="{{$tag->slug}}">
        Edit
    </button>
    <button class="btn btn-sm btn-danger" id="btnDeleteTag" data-toggle="modal" data-target="#deleteTagModal" data-id="{{$tag->id}}" data-name="{{$tag->name}}" data-slug="{{$tag->slug}}">
        Delete
    </button>
</td>
