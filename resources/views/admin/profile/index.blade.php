@extends('admin._layout._layout')
@push('header_scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Your Profile</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Change your profile info</h3>
                            <div class="card-tools">
                                <a href="{{route('admin.editPassword')}}" class="btn btn-outline-warning">
                                    <i class="fas fa-lock-open"></i>
                                    Change Password
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form"
                              id="updateProfile"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Email</label>
                                            <div><strong>{{auth()->user()->email}}</strong></div>
                                        </div>

                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text"
                                                   name="name"
                                                   class="form-control"
                                                   placeholder="Enter name"
                                                   value="{{ old('name', auth()->user()->name) }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <div class="input-group">
                                                <input type="text"
                                                       name="phone"
                                                       class="form-control"
                                                       placeholder="Enter phone"
                                                       value="{{ old('phone', auth()->user()->phone) }}">
                                                <div class="input-group-append">
                            <span class="input-group-text">
                              <i class="fas fa-phone"></i>
                            </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Choose New Photo</label>
                                            <input type="file"
                                                   name="avatar"
                                                   class="form-control">
                                        </div>

                                    </div>

                                        <div class="offset-md-3 col-md-3" id="deletePhotoDiv">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Photo</label>

                                                        <div class="text-right">
                                                            <button type="button" class="btn btn-sm btn-outline-danger" id="btnDeletePhoto">
                                                                <i class="fas fa-remove"></i>
                                                                Delete Photo
                                                            </button>
                                                        </div>
                                                        <div class="text-center">
                                                            <img width="100px" src="{{auth()->user()->avatar}}" alt="" id="avatarImage" class="img-fluid js-avatar-image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{route('admin.index')}}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@push('footer_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        $(document).ready(function () {
            //delete photo
            $("#btnDeletePhoto").on("click", function () {
                let wconfirm = confirm('are you sure to delete photo?')
                if(wconfirm) {
                    $.ajax({
                        url: "{{route('admin.profile.deleteAvatar')}}",
                        method: "POST",
                        data: {
                            _token: "{{csrf_token()}}",
                            id: "{{auth()->user()->id}}",
                            avatar: "{{auth()->user()->avatar}}"
                        }
                    }).done(function (response) {
                        toastr.success(response.message, {
                            showDuration: 300,
                            hideDuration: 1000
                        });
                        $("#deletePhotoDiv").hide();
                        $(".image").hide();
                    }).fail(function (xhr) {
                        let message = xhr.responseJSON.message ?? 'Unknown error';
                        toastr.error(message,'Error', {
                            showDuration: 300,
                            hideDuration: 1000
                        });
                    })
                }
            })

            //profile update
            $("#updateProfile").on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData();

                formData.append('_token', "{{ csrf_token() }}");
                formData.append('id', "{{ auth()->user()->id }}");
                formData.append('name', $("input[name='name']").val());
                formData.append('phone', $("input[name='phone']").val());

                let fileInput = document.querySelector("input[name='avatar']");
                if (fileInput.files.length > 0) {
                    formData.append('avatar', fileInput.files[0]);
                }

                $.ajax({
                    url: "{{ route('admin.profile.update') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                }).done(function (response) {
                    console.log(response);
                    toastr.success(response.message, {
                        showDuration: 300,
                        hideDuration: 1000
                    });
                    $("#user-name").html(response.userName);
                    if (response.avatar_url) {
                        let newSrc = response.avatar_url + '?changePhotoCache=' + new Date().getTime();
                        $(".js-avatar-image").attr('src', newSrc);
                        $(".image").show();
                        $("#deletePhotoDiv").show();
                    }
                }).fail(function (xhr) {
                    let message = xhr.responseJSON.message ?? 'Unknown error';
                    toastr.error(message,'Error', {
                        showDuration: 300,
                        hideDuration: 1000
                    });
                });
            });

        })

    </script>
@endpush
