@extends('admin._layout._layout')
@section('title', "Edit {$user->name}")
@push('header_scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')

    <section class="content mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card card-primary col-12 pt-3">
                        <div class="card-header">
                            <h3 class="card-title">Edit user: {{$user->name}}</h3>
                        </div>

                        <!-- form start -->
                        <form action="{{route('admin.updateUser', $user->id)}}" method="POST" role="form" id="add-user-form" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">

                                        <div class="form-group">
                                            <label>Email</label>
                                            <div class="input-group">
                                                <input
                                                    type="email"
                                                    name="email"
                                                    readonly
                                                    value="{{ old('email', $user->email)}}"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Enter email"
                                                >
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                      @
                                                    </span>
                                                </div>
                                            </div>
                                            @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Name</label>
                                            <input
                                                type="text"
                                                name="name"
                                                value="{{ old('name', $user->name) }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter name"
                                            >
                                            @error('name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input
                                                type="text"
                                                name="slug"
                                                readonly
                                                value="{{ old('slug', $user->slug) }}"
                                                class="form-control @error('slug') is-invalid @enderror"
                                                placeholder="Slug"
                                            >
                                            @error('slug')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <div class="input-group">
                                                <input
                                                    type="text"
                                                    name="phone"
                                                    value="{{ old('phone', $user->phone) }}"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    placeholder="Enter phone"
                                                >
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                      <i class="fas fa-phone"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            @error('phone')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Choose New Photo</label>
                                            <input
                                                type="file"
                                                name="avatar"
                                                class="form-control @error('avatar') is-invalid @enderror"
                                            >
                                            @error('avatar')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                <div class="offset-md-3 col-md-3">
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
                                                        <img width="100px" src="{{$user->avatar}}" alt="" class="img-fluid" id="editLogo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{route('admin.indexUsers')}}" class="btn btn-outline-secondary">Cancel</a>
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
            $("input[name='name']").on('keyup', function () {
                let text = $(this).val().toLowerCase();
                text = text.replace(/ /g,'-');

                $("input[name='slug']").val(text);
            })

            $("#btnDeletePhoto").on("click", function () {
                let src = $("#editLogo").attr('src');
                let userAvatarSrc = "{{$user->avatar}}";

                if(src == userAvatarSrc) {
                    $.ajax({
                        url: "{{route('admin.userDeleteAvatar')}}",
                        method: "POST",
                        data: {
                            _token: "{{csrf_token()}}",
                            id: "{{$user->id}}"
                        }
                        }).done(function (response) {
                            $("#editLogo").attr('src', '');
                            toastr.success(response.message, {
                                showDuration: 300,
                                hideDuration: 1000
                            });
                        }).fail(function (xhr) {
                            let message = xhr.responseJSON.message ?? 'Unknown error';
                            toastr.error(message,'Error', {
                                showDuration: 300,
                                hideDuration: 1000
                            });
                         })
                }
            })

            @if(session('success'))
                toastr.success("{!! session('success') !!}", {
                    showDuration: 300,
                    hideDuration: 1000
                });
            @endif
        })
    </script>

@endpush
