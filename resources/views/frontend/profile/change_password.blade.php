@extends('frontend.frontend_master')
@section('content')


<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ (!empty($user->profile_photo_path) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.JPG')) }}" class="card-img-top" style="border-radius:50%; height:100%; width:100%;" alt="">
                <ul class="list-group list-group-flush">
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{ route('profile.user') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="" class="btn btn-primary btn-sm btn-block">Change password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </ul>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center">
                        <span><strong>Change Password</strong>

                    </h3>
                    <div class="card-body">
                        <form action="{{ route('user.password.changing') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <h5>Current password <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="password" name="oldpassword" id="oldpassword" class="form-control">
                                </div>
                                @error('oldpassword')
                                <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>New password <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                @error('password')
                                <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Confirm password <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                </div>
                                @error('password_confirmation')
                                <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-primary btn-block mb-5" type="submit">Change Password</button>
                        </form>
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
</div>

@endsection