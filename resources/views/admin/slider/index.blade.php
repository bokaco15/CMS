@extends('admin._layout._layout')

@push('header_scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('title', 'Sliders')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <h2 class="h4 mb-0">Sliders</h2>

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#addSliderModal">
                                        Add slider
                                    </button>
                                    <button class="btn-primary btn" id="btn-change-priority">Change priority</button>
                                    <button class="btn-success btn" id="btn-update-priority" style="display: none">Update priority</button>


                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="slider-table" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px; display: none" id="priority-row">Priority</th>
                                    <th style="width: 20px">ID</th>
                                    <th>Heading</th>
                                    <th>Button Text</th>
                                    <th>Button Link</th>
                                    <th>Image</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                @include('admin.slider.table')
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

    {{-- Add slider modal  --}}
    <div class="modal fade" id="addSliderModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="sliderForm" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="heading" class="form-label">Heading</label>
                            <input type="text" class="form-control" id="heading" name="heading" placeholder="Enter heading">
                        </div>

                        <div class="mb-3">
                            <label for="btnText" class="form-label">Button text</label>
                            <input type="text" class="form-control" id="btnText" name="button_text" placeholder="Checkout more">
                        </div>

                        <div class="mb-3">
                            <label for="btnLink" class="form-label">Button Link</label>
                            <input type="text" class="form-control" id="btnLink" name="button_url" placeholder="https://...">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Slider Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <small class="text-muted">Recommended: 1920x900 (WebP/JPG/PNG)</small>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="show_on_index" name="show_on_index" value="1">
                            <label class="form-check-label" for="show_on_index">Show on index</label>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btnSubmitAddSlider">Add slider</button>
                    </div>
                </form>
        </div>
    </div>
    </div>

    {{-- Delete slider modal  --}}
    <div class="modal fade" id="deleteSliderModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Slider</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete slider?</p>
                    <strong></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="confirmDeleteSlider" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Ban slider modal -->
    <div class="modal fade" id="banSliderModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ban-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to ban slider?</p>
                    <strong></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="btnBanSlider">
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

    <!-- UnBan slider modal -->
    <div class="modal fade" id="unbanSliderModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Enable Slider</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to enable slider?</p>
                    <strong></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="btnUnbanSlider">
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
            var sliderPriority;
            var id;
            var updateStatus;

            $("#btn-change-priority").on("click", function () {
                $(this).hide();
                $("#btn-update-priority").show();
                $("#priority-row").show();
                $(".handle").show();
            })

            $( "#sortable" ).sortable({
                handle: ".handle",
                update: function() {
                    sliderPriority = $(this).sortable("toArray").join(',');
                }
            });

            $("#btn-update-priority").on("click", function () {
                $(this).hide();
                $("#btn-change-priority").show();
                $("#priority-row").hide();
                $(".handle").hide();

                if(!sliderPriority) {
                    toastr.error('Nothing to update.');
                    return;
                }

                $.ajax({
                    url: "{{route('admin.slider.resort')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        resort: sliderPriority
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

            //AddSlider

            $("#btnSubmitAddSlider").on("click", function () {

                let formData = new FormData();

                formData.append('_token', "{{ csrf_token() }}");
                formData.append('heading', $('#heading').val());
                formData.append('btnText', $('#btnText').val());
                formData.append('btnLink', $('#btnLink').val());
                formData.append('show_on_index', $('#show_on_index').is(':checked') ? 1 : 0);

                let file = $('#image')[0].files[0];
                if (file) {
                    formData.append('image', file);
                }

                $.ajax({
                    url: "{{route('admin.slider.add')}}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                }).done(function (response) {
                    $("#sortable").replaceWith(response.html);

                    $("#sortable").sortable({
                        handle: ".handle",
                        update: function() {
                            sliderPriority = $(this).sortable("toArray").join(',');
                        }
                    });

                    if ($("#btn-update-priority").is(":visible")) {
                        $("#priority-row").show();
                        $(".handle").show();
                    }

                    toastr.success(response.message);
                    $("#addSliderModal").modal('hide');

                    $('#sliderForm')[0].reset();

                }).fail(function (xhr) {
                    toastr.error(xhr.responseJSON?.message);
                });
            });

            $(document).on("click", "#btnDeleteSlider", function () {
                id = $(this).data('id');
            })

            $("#deleteSliderModal").on('click', '#confirmDeleteSlider', function () {
                $.ajax({
                    url: "{{route('admin.slider.delete')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        id:id,
                    }
                }).done(function (response) {
                    $("#sortable").replaceWith(response.html);

                    $("#sortable").sortable({
                        handle: ".handle",
                        update: function() {
                            sliderPriority = $(this).sortable("toArray").join(',');
                        }
                    });

                    if ($("#btn-update-priority").is(":visible")) {
                        $("#priority-row").show();
                        $(".handle").show();
                    }
                    toastr.success(response.message);
                    $("#deleteSliderModal").modal('hide');
                }).fail(function (xhr) {
                    toastr.fail(xhr.responseJSON.message);
                })
            })


            //ban - unban slider

            $(document).on("click", "#banSliderBtn", function () {
                id = $(this).data('id');
                updateStatus = $(this).data('newstatus');
            })

            $(document).on("click", "#unbanSliderBtn", function () {
                id = $(this).data('id');
                updateStatus = $(this).data('newstatus');
            })

            function changeSliderStatus(modal, id, newStatus) {
                $.ajax({
                    url: "{{ route('admin.slider.changeStatus') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        show_on_index: newStatus
                    }
                })
                    .done(function (response) {
                        $("#sortable").replaceWith(response.html);

                        $("#sortable").sortable({
                            handle: ".handle",
                            update: function () {
                                sliderPriority = $(this).sortable("toArray").join(',');
                            }
                        });

                        if ($("#btn-update-priority").is(":visible")) {
                            $("#priority-row").show();
                            $(".handle").show();
                        }

                        toastr.success(response.message);
                        $(modal).modal('hide');
                    })
                    .fail(function (xhr) {
                        toastr.error(xhr.responseJSON?.message || "Request failed");
                    });
            }


            $("#banSliderModal").on("click", "#btnBanSlider", function () {
                const modal = "#banSliderModal";

                changeSliderStatus(modal, id, updateStatus);
            });

            $("#unbanSliderModal").on("click", "#btnUnbanSlider", function () {
                const modal = "#unbanSliderModal";

                changeSliderStatus(modal, id, updateStatus);
            });




        })
    </script>
@endpush

