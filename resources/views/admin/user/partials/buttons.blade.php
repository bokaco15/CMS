<div class="btn-group d-flex justify-center">
    <a href="{{route('admin.editUser', ['user' => $row->id, 'slug' => $row->slug])}}" class="btn btn-primary">
        <i class="fas fa-edit"></i>
    </a>
    <button id="{{'banUserModal'}}" type="button" class="btn btn-warning" data-toggle="modal" data-target="#disable-modal" data-status="{{$row->is_banned ? 'unban' : 'ban'}}" data-id="{{$row->id}}">
        <i class="fas fa-minus-circle"></i>
    </button>
    <button id="deleteUserModal" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal" data-id="{{$row->id}}">
        <i class="fas fa-trash"></i>
    </button>
</div>
