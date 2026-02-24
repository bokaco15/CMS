@extends('auth._layout._layout')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Cubes</b>School</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Change your password.</p>

                <form action="{{route('admin.updatePassword', auth()->user()->id)}}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="current_password" placeholder="Old Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock-open"></span>
                            </div>
                        </div>
                        @error('current_password')
                            <span class="invalid-feedback d-block">
                                {{$message}}
                            </span>
                        @enderror

                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="New Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback d-block">
                                {{$message}}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm New Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password_confirmation')
                        <span class="invalid-feedback d-block">
                                {{$message}}
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Confirm Password Change</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="/password/reset/">I forgot my password</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
