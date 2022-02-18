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
                    <a href="{{ route('change.password.user') }}" class="btn btn-primary btn-sm btn-block">Change password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </ul>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center">
                        <span>Hi...</span><strong>{{ Auth::user()->name }}</strong>
                        Welcome to Osung Online Shop
                    </h3>
                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
</div>

@endsection