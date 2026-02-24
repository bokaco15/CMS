@extends('admin._layout._layout')

@push('header_scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('title', 'User list')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h2 class="h4 mb-0">All Users</h2>
                        <a href="{{route('admin.addUser')}}" class="btn btn-success ml-auto">Add user</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="users-table" class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 20px">Status</th>
                                <th class="text-center">Photo</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<div class="modal fade" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete user <span class="d-none" id="span-user-id"></span> <span id="span-username"></span>?</p>
                <strong></strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button id="confirmDeleteUser" type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="disable-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ban-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to <span id="ban-status"></span> user <span id="ban-username"></span> ?</p>
                <strong></strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn" id="banUserModalBtn">
                    <i class="fas fa-minus-circle"></i>
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="enable-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Enable User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to enable user?</p>
                <strong></strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success">
                    <i class="fas fa-check"></i>
                    Enable
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


@endsection

@push('footer_scripts')
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $( document ).ready(function() {
            //users table -> datatable
            let table = new DataTable('#users-table', {
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{route('admin.datatableUsers')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}"
                    }
                },
                columns: [
                    { name: 'id', data: "id"},
                    { name: 'is_banned' , data: "is_banned"},
                    { name: 'avatar', searchable: false, orderable: false, data: "avatar"},
                    { name: 'email' , data: "email"},
                    { name: 'name' , data: "name"},
                    { name: 'phone', data: "phone" },
                    { name: 'created_at', searchable: false , data: "created_at"},
                    { name: 'actions', searchable: false, orderable: false , data: "actions" }
                ],
                order: [6, 'desc'],
                lengthMenu: [5,10, 25, 50, 75, 100],
                pageLength: 5,
            });

            //delete user modal
            $("#users-table").on('click', '#deleteUserModal', function () {
                let id = $(this).data('id');
                let tr = $(this).closest('tr');
                let name = table.row(tr).data().name;

                $("#span-username").text(name);
                $("#span-user-id").text(id);
            });

            $("#delete-modal").on('click', '#confirmDeleteUser', function (e) {
                $.ajax({
                    url: "{{route('admin.deleteUser')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: $("#span-user-id").text(),
                    }
                }).done(function (response) {
                    toastr.success(response.message, {
                        showDuration: 300,
                        hideDuration: 1000
                    });
                    $("#delete-modal").modal('hide');
                    table.ajax.reload();
                }).fail(function () {
                    let message = xhr.responseJSON.message ?? 'Unknown error';
                    toastr.error(message,'Error', {
                        showDuration: 300,
                        hideDuration: 1000
                    });
                    $("#disable-modal").modal('hide');
                })
            });
            ////////////////////////////////////////

            //ban user modal
            var is_banned;
            var idBan;

            $("#users-table").on('click', '#banUserModal', function () {
                let tr = $(this).closest('tr');
                let name = table.row(tr).data().name;

                $("#ban-title").text(($(this).data('status') + " User").toUpperCase());
                $("#ban-username").text(name);
                $("#ban-status").text($(this).data('status'));

                idBan = $(this).data('id');
                is_banned = $(this).data('status') == 'unban' ? 0 : 1;
                if(is_banned == 0) {
                    $("#banUserModalBtn").removeClass('btn-danger').addClass('btn-success').text('Unban')
                } else {
                    $("#banUserModalBtn").removeClass('btn-success').addClass('btn-danger').text('Ban')
                }
                // console.log(is_banned);
            });

            $("#disable-modal").on('click', '#banUserModalBtn', function () {
                //ajax ban - unban
                $.ajax({
                   url: "{{route('admin.updateUserStatus')}}",
                   method: "POST",
                   data: {
                       _token: "{{csrf_token()}}",
                       id: idBan,
                       is_banned: is_banned
                   }
                }).done(function (response) {
                    toastr.success(response.message, {
                        showDuration: 300,
                        hideDuration: 1000
                    });
                    $("#disable-modal").modal('hide');
                    table.ajax.reload();
                }).fail(function (xhr) {
                    let message = xhr.responseJSON.message ?? 'Unknown error';
                    toastr.error(message,'Error', {
                        showDuration: 300,
                        hideDuration: 1000
                    });
                    $("#disable-modal").modal('hide');
                });
            });

        });
    </script>
@endpush
