@extends('admin._layout._layout')

@push('header_scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('title', 'Comments')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header mb-3">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <h2 class="h4 mb-0">Comments</h2>

                                <div class="d-flex gap-2 justify-content-center">
                                    <button type="button" class="btn btn-primary mr-2" id="btnShowUnaccepted">
                                        Unaccepted
                                    </button>

                                    <button type="button" class="btn btn-info mr-2" id="btnShowAccepted">
                                        Accepted
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="accepted-wrapper">
                                <h3 class="h5 text-success text-center">Accepted comments</h3>
                                <table id="accepted-comments" class="stripe">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Text
                                        <th>Post</th>
                                        <th>Status</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            </div>
                            <div id="unaccepted-wrapper">
                                <h3 class="h5 text-danger text-center">Unaccepted comments</h3>
                                <table id="unaccepted-comments" class="stripe">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Text
                                    <th>Post</th>
                                    <th>Status</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            </div>
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



    {{-- Delete comment modal  --}}
    <div class="modal fade" id="deleteCommentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete comment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete comment?</p>
                    <strong></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteComment">
                        <span class="btn-text">Delete</span>
                        <span class="btn-loader" style="margin-left:8px;">
                            <i class="fa fa-spinner fa-spin d-none"></i>
                        </span>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- accept comment modal  --}}
    <div class="modal fade" id="acceptCommentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Accept comment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to accept comment?</p>
                    <strong></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="confirmAcceptComment">
                        <span class="btn-text">Potvrdi</span>
                        <span class="btn-loader" style="margin-left:8px;">
                            <i class="fa fa-spinner fa-spin d-none"></i>
                        </span>
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
    <script src="https://code.jquery.com/ui/1.14.2/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function ()
        {
            $("#accepted-wrapper").hide();
            $("#unaccepted-wrapper").show();

            $("#btnShowUnaccepted").on("click", function () {
                $("#accepted-wrapper").hide();
                $("#unaccepted-wrapper").show();
            });

            $("#btnShowAccepted").on("click", function () {
                $("#unaccepted-wrapper").hide();
                $("#accepted-wrapper").show();
            });

            let columns = [
                {data: 'id', name: 'id',},
                {data: 'name', name: 'name' },
                {data: 'email', name: 'email',},
                {data: 'text', name: 'text', searchable: false, orderable: false},
                {data: 'post_id', name: 'post'},
                {data: 'status', name: 'status',},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', orderable: false, searchable: false,},
            ];

            let unacceptedTable = new DataTable('#unaccepted-comments', {
                serverSide: true,
                processing: true,

                ajax: {
                    url: "{{route('admin.comment.unaccepted')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                    }
                },
                columns: columns,
                order: [[0,'desc']],

            });

            let acceptedTable = new DataTable('#accepted-comments', {
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{route('admin.comment.accepted')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                    }
                },
                columns: columns,
                order: [[0,'desc']]
            });

            var id;
            var email;
            var updateStatus;
            var name;

            $(document).on("click", "#btnAcceptComment", function () {
                id = $(this).data('id');
                email = $(this).data('useremail');
                updateStatus = $(this).data('newstatus');
                name = $(this).data('name');
                console.log(id, email, updateStatus);
            });
            $(document).on("click", "#btnDeleteComment", function () {
                id = $(this).data('id');
                console.log(id)
            });

            $("#acceptCommentModal").on("click", "#confirmAcceptComment", function () {
                let $btn = $(this);
                let $spinner = $btn.find("i");
                let $text = $btn.find(".btn-text");

                $btn.prop("disabled", true);
                $spinner.removeClass("d-none");
                $text.text("Sending...");

                $.ajax({
                    url: "{{route('admin.comment.accept')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: id,
                        name: name,
                        email: email,
                        status: updateStatus
                    }
                }).done(function (response){
                    unacceptedTable.ajax.reload();
                    toastr.success(response.message);
                    $("#acceptCommentModal").modal('hide');
                    acceptedTable.ajax.reload();

                }).fail(function (xhr) {
                    toastr.error(xhr.responseJSON.message);
                }).always(function () {
                    $btn.prop("disabled", false);
                    $spinner.addClass("d-none");
                    $text.text("Potvrdi");
                })
            })
            $("#deleteCommentModal").on("click", "#confirmDeleteComment", function () {
                let $btn = $(this);
                let $spinner = $btn.find("i");
                let $text = $btn.find(".btn-text");

                $btn.prop("disabled", true);
                $spinner.removeClass("d-none");
                $text.text("Sending...");

                $.ajax({
                    url: "{{route('admin.comment.delete')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: id,
                    }
                }).done(function (response){
                    unacceptedTable.ajax.reload();
                    toastr.success(response.message);
                    $("#deleteCommentModal").modal('hide');
                    acceptedTable.ajax.reload();

                }).fail(function (xhr) {
                    toastr.error(xhr.responseJSON.message);
                }).always(function () {
                    $btn.prop("disabled", false);
                    $spinner.addClass("d-none");
                    $text.text("Potvrdi");
                })
            });
        })
    </script>
@endpush
