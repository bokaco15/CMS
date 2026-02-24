@extends('admin._layout._layout')

@push('header_scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('title', 'Tags')

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
                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#addTagModal">
                                        Add Tag
                                    </button>


                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tag-table" class="stripe">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
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

    {{-- Add tag modal  --}}
    <div class="modal fade" id="addTagModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!---Modal body-->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="inputName">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="inputSlug" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnSubmitAddTag">Add tag</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    {{-- Edit tag modal  --}}
    <div class="modal fade" id="editTagModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!---Modal body-->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editInputName">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="editInputSlug" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnSubmitEditTag">Edit tag</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    {{-- Delete tag modal  --}}
    <div class="modal fade" id="deleteTagModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Tag</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete tag <span id="spanTagName">></span>?</p>
                    <strong></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="confirmDeleteTag" type="button" class="btn btn-danger">Delete</button>
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

            let table = new DataTable('#tag-table', {
                serverSide:true,
                processing: true,

                ajax: {
                    url: "{{route('admin.tag.datatable')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                    }
                },

                columns: [
                    {data: 'id', name: 'id', width: '5%' },
                    {data: 'name', name: 'name' },
                    {data: 'slug', name: 'slug', orderable: false, searchable: false },
                    {data: 'created_at', name: 'created_at', searchable: false, width: '15%' },
                    {data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'dt-center', width: '20%'},
                ]
            });


            $("#inputName").on('keyup', function () {
                let text = $(this).val().toLowerCase();
                text = text.replace(/ /g,'-');

                $("#inputSlug").val(text);

                console.log($("#inputSlug").val())
            })

            //add tag
            $("#btnSubmitAddTag").on("click", function () {
                $.ajax({
                    url: "{{route('admin.tag.add')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        name: $("#inputName").val(),
                        slug: $("#inputSlug").val(),
                    }
                }).done(function (response) {
                    toastr.success(response.message);
                    $("#addTagModal").modal('hide');
                    table.ajax.reload();
                    $("#inputName").val('');
                    $("#inputSlug").val('');

                }).fail(function (xhr) {
                    toastr.error(xhr.responseJSON.message);
                })
            })

            //delete tag

            var tagId;
            var tagName;
            var tagSlug;

            $(document).on("click", "#btnDeleteTag", function () {
                tagId = $(this).data('id');
                $("#spanTagName").text($(this).data('name'));
                console.log(tagId)
            });

            $("#deleteTagModal").on("click", "#confirmDeleteTag", function () {
                $.ajax({
                    url: "{{route('admin.tag.delete')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: tagId
                    }
                }).done(function (response) {
                    table.ajax.reload();
                    toastr.success(response.message);
                    $("#deleteTagModal").modal('hide');

                }).fail(function (xhr) {
                    toastr.fail(xhr.responseJSON.message);
                });
            })

            //editTag

            $(document).on("click", "#btnEditTag", function () {
                tagId = $(this).data('id');
                $("#editInputName").val($(this).data('name'));
                $("#editInputSlug").val($(this).data('slug'));
            });

            $("#editInputName").on('keyup', function () {
                let text = $(this).val().toLowerCase();
                text = text.replace(/ /g,'-');

                $("#editInputSlug").val(text);
            })

            $("#editTagModal").on('click', '#btnSubmitEditTag', function () {
                tagName = $("#editInputName").val();
                tagSlug = $("#editInputSlug").val();

                $.ajax({
                    url: "{{route('admin.tag.edit')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: tagId,
                        name: tagName,
                        slug: tagSlug
                    }
                }).done(function (response) {
                    table.ajax.reload();
                    toastr.success(response.message);
                    $("#editTagModal").modal('hide');
                }).fail(function (xhr) {
                    toastr.fail(xhr.responseJSON.message);
                });
            })

        })
    </script>
@endpush
