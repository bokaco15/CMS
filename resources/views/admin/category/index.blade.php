@extends('admin._layout._layout')

@push('header_scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('title', 'Categories')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <h2 class="h4 mb-0">Categories</h2>

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#addCategoryModal">
                                        Add category
                                    </button>
                                    <button class="btn-primary btn" id="btn-change-priority">Change priority</button>
                                    <button class="btn-success btn" id="btn-update-priority" style="display: none">Update priority</button>


                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="category-table" class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px; display: none" id="priority-row">Priority</th>
                                    <th style="width: 20px">ID</th>
                                    <th>Slug</th>
                                    <th>Name</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                            @include('admin.category.table')
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

    {{-- Add category modal  --}}
    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!---Modal body-->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="show_on_index" class="form-label">Show on index</label>
                        <input type="checkbox" class="btn-check" id="btn-show_on_index" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnSubmitAddCategory">Add category</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    {{-- Edit category modal  --}}
    <div class="modal fade" id="editCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
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
                    <button type="button" class="btn btn-success" id="btnSubmitEditCategory">Edit category</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    {{-- Delete category modal  --}}
    <div class="modal fade" id="deleteCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete category <span class="d-none" id="span-category-id"></span> <span id="span-categoryName"></span>?</p>
                    <strong></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="confirmDeleteCategory" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Ban category modal -->
    <div class="modal fade" id="banCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ban-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to ban category?</p>
                    <strong></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="btnBanCategory">
                        <i class="fas fa-check"></i>
                        Ban
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- UnBan category modal -->
    <div class="modal fade" id="unbanCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Enable Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to enable category?</p>
                    <strong></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="btnUnbanCategory">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.14.2/jquery-ui.js"></script>
    <script>
        $( document ).ready(function()
        {
            // sortPriority
            var categoryPriority;

            $("#btn-change-priority").on("click", function () {
                $(this).hide();
                $("#btn-update-priority").show();
                $("#priority-row").show();
                $(".handle").show();
            })

            $( "#sortable" ).sortable({
                handle: ".handle",
                update: function() {
                    categoryPriority = $(this).sortable("toArray").join(',');
                }
            });

            $("#btn-update-priority").on("click", function () {
                $(this).hide();
                $("#btn-change-priority").show();
                $("#priority-row").hide();
                $(".handle").hide();

                if(!categoryPriority) {
                    toastr.error('Nothing to update.');
                    return;
                }

                $.ajax({
                    url: "{{route('admin.category.resort')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        resort: categoryPriority
                    }
                }).done(function (response) {
                    if(response.success) {
                        toastr.success(response.message);
                    }
                }).fail(function (xhr) {
                    toastr.error(xhr.responseJSON.message);

                });
            })

            //endSortPriority

            //AddCategory
            $("#name").on('keyup', function () {
                let text = $(this).val().toLowerCase();
                text = text.replace(/ /g,'-');

                $("#slug").val(text);
            })

            $("#btnSubmitAddCategory").on("click", function () {
                $.ajax({
                    url: "{{route('admin.category.add')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        name: $("#name").val(),
                        slug: $("#slug").val(),
                        show_on_index: $("#btn-show_on_index").is(":checked") ? 1 : 0
                    }
                }).done(function (response) {
                    $("#sortable").replaceWith(response.html);

                    $("#sortable").sortable({
                        handle: ".handle",
                        update: function() {
                            categoryPriority = $(this).sortable("toArray").join(',');
                        }
                    });

                    if ($("#btn-update-priority").is(":visible")) {
                        $("#priority-row").show();
                        $(".handle").show();
                    }

                    toastr.success(response.message);
                    $("#addCategoryModal").modal('hide');

                    $("#name").val('');
                    $("#slug").val('');
                    $("#btn-show_on_index").prop("checked", false);
                }).fail(function (xhr) {
                    toastr.error(xhr.responseJSON.message);
                })
            })

            //delete category
            $(document).on("click", "#btnDeleteCategory", function () {
                let categoryId = $(this).data('id');
                let categoryName = $(this).data('name');

                $("#span-categoryName").text(categoryName);
                $("#span-category-id").text(categoryId);
            })

            $(document).on("click", "#confirmDeleteCategory", function (){
               let id = $("#span-category-id").text();

               $.ajax({
                  url: "{{route('admin.category.delete')}}",
                  method: "POST",
                  data: {
                      _token: "{{csrf_token()}}",
                      id: id
                  }
               }).done(function (response) {
                   $("#sortable").replaceWith(response.html);
                   $("#sortable").sortable({
                       handle: ".handle",
                       update: function() {
                           categoryPriority = $(this).sortable("toArray").join(',');
                       }
                   });

                   if ($("#btn-update-priority").is(":visible")) {
                       $("#priority-row").show();
                       $(".handle").show();
                   }

                   toastr.success(response.message);
                   $("#deleteCategoryModal").modal('hide');


               }).fail(function (xhr) {
                   toastr.error(xhr.responseJSON.message);
               });
            });

            //end add category

            //Ban - unban category
            var statusId;
            var newStatus;
            $(document).on('click', '#unbanCategoryBtn', function () {
                $("#ban-status").text('unban');
               statusId = $(this).data('id');
               newStatus = $(this).data('newstatus');
            });

            $("#unbanCategoryModal").on("click", "#btnUnbanCategory", function () {
                $.ajax({
                    url: "{{route('admin.category.changeStatus')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: statusId,
                        show_on_index: newStatus
                    }
                }).done(function (response) {
                    $("#sortable").replaceWith(response.html);
                    $("#sortable").sortable({
                        handle: ".handle",
                        update: function() {
                            categoryPriority = $(this).sortable("toArray").join(',');
                        }
                    });

                    if ($("#btn-update-priority").is(":visible")) {
                        $("#priority-row").show();
                        $(".handle").show();
                    }

                    toastr.success(response.message);
                    $("#unbanCategoryModal").modal('hide');
                });
            })


            $(document).on('click', '#banCategoryBtn', function () {
                statusId = $(this).data('id');
                console.log(statusId)
                $("#ban-status").text('ban');
                newStatus = $(this).data('newstatus');
            });

            $("#banCategoryModal").on("click", "#btnBanCategory", function () {
                $.ajax({
                    url: "{{route('admin.category.changeStatus')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: statusId,
                        show_on_index: newStatus
                    }
                }).done(function (response) {
                    $("#sortable").replaceWith(response.html);
                    $("#sortable").sortable({
                        handle: ".handle",
                        update: function() {
                            categoryPriority = $(this).sortable("toArray").join(',');
                        }
                    });

                    if ($("#btn-update-priority").is(":visible")) {
                        $("#priority-row").show();
                        $(".handle").show();
                    }

                    toastr.success(response.message);
                    $("#banCategoryModal").modal('hide');
                });


        });

            //edit category
            var editId;
            var editName;
            var editSlug
            $(document).on("click", "#btnEditCategory", function () {
                editId = $(this).data('id');
                editName = $(this).data('name');
                editSlug = $(this).data('slug');

                $("#editInputName").val(editName);
                $("#editInputSlug").val(editSlug)
            })

            $("#editInputName").on('keyup', function () {
                let text = $(this).val().toLowerCase();
                text = text.replace(/ /g,'-');

                $("#editInputSlug").val(text);
            })

            $("#editCategoryModal").on("click", "#btnSubmitEditCategory", function() {
                editName = $("#editInputName").val();
                editSlug = $("#editInputSlug").val();

                $.ajax({
                    url: "{{route('admin.category.edit')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: editId,
                        name: editName,
                        slug: editSlug,
                    }
                }).done(function (response) {
                    $("#sortable").replaceWith(response.html);

                    $("#sortable").sortable({
                        handle: ".handle",
                        update: function() {
                            categoryPriority = $(this).sortable("toArray").join(',');
                        }
                    });

                    if ($("#btn-update-priority").is(":visible")) {
                        $("#priority-row").show();
                        $(".handle").show();
                    }

                    toastr.success(response.message);
                    $("#editCategoryModal").modal('hide');

                    $("#name").val('');
                    $("#slug").val('');
                    $("#btn-show_on_index").prop("checked", false);
                }).fail(function (xhr) {
                    console.log(xhr.responseJSON.message);
                })
            })


        })
    </script>
@endpush
