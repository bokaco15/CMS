@extends('admin._layout._layout')

@push('header_scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('title', 'Posts')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <h2 class="h4 mb-0">Tags</h2>

                                <div class="d-flex gap-2">
                                    <a href="{{route('admin.post.add')}}" class="btn btn-success mr-2">
                                        Add post
                                    </a>


                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="post-table" class="stripe">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Heading</th>
                                    <th>Preheading</th>
                                    <th>Thumbnail</th>
                                    <th>Category</th>
                                    <th>Important</th>
                                    <th>Published</th>
                                    <th>Views</th>
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

    {{-- Edit post status modal  --}}
    <div class="modal fade" id="editPostStatusModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Do you want really to change status?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnSubmitPostStatus">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    {{-- Delete tag modal  --}}
    <div class="modal fade" id="deletePostModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Post</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete post: <b id="spanPostName"></b><b>?</b></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="confirmDeletePost" type="button" class="btn btn-danger">Delete</button>
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
        $( document ).ready(function()
        {

            let table = new DataTable('#post-table', {
                serverSide:true,
                processing: true,
                responsive: true,

                ajax: {
                    url: "{{route('admin.post.datatable')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}"
                    },
                },

                columns: [
                    { data: 'id',          name: 'id',           searchable: false },
                    { data: 'heading',     name: 'heading',     },
                    { data: 'preheading',  name: 'preheading',   orderable: false, searchable: false },
                    { data: 'image',       name: 'image',        orderable: false, searchable: false },
                    { data: 'category_id', name: 'category_id',     searchable: false },
                    { data: 'important',   name: 'important',    searchable: false },
                    { data: 'published',   name: 'published',    searchable: false },
                    { data: 'views',       name: 'views',        searchable: false },
                    { data: 'created_at',  name: 'created_at',   searchable: false },
                    { data: 'actions',     name: 'actions',     orderable: false, searchable: false, className: 'dt-center' },
                ],

                order: [8, 'desc']

            });


            var btnNewStatus;
            var id;
            $(document).on("click", "#btnChangePostStatus", function () {
                btnNewStatus = $(this).data('banunban');
                id = $(this).data('id');
            });
            $("#editPostStatusModal").on('click', '#btnSubmitPostStatus', function () {
               $.ajax({
                   url: "{{route('admin.post.changeStatus')}}",
                   method: "POST",
                   data: {
                       _token: "{{csrf_token()}}",
                       id: id,
                       published: btnNewStatus
                   }
               }).done(function (response) {
                   toastr.success(response.message);
                   $("#editPostStatusModal").modal('hide');
                   table.ajax.reload();
               }).fail(function(xhr) {
                   toastr.error(xhr.responseJSON.message);
               });
            });

            //delete post
            $(document).on("click", "#btnDeletePost", function () {
                id = $(this).data('id');
                $("#spanPostName").text($(this).data('name'));
            });

            $("#deletePostModal").on("click", "#confirmDeletePost", function () {
               $.ajax({
                    url: "{{route('admin.post.delete')}}",
                   method: "POST",
                   data: {
                        _token: "{{csrf_token()}}",
                       id: id
                   }
               }).done(function (response) {
                   toastr.success(response.message);
                   $("#deletePostModal").modal('hide');
                   table.ajax.reload();
               }).fail(function (xhr) {
                   toastr.error(xhr.responseJSON.message);
               });
            });

        })
    </script>
@endpush
