@extends('layouts.app')

@section('title', $title)

@section('customCss')
<link rel="stylesheet" href="{{url('public/assets/customs/css/login.css')}}">
@endsection

@section('content')
<div class="loginPage">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header loginHeader text-center">
                        <img src="{{asset('public/storage/organizations/logo.png')}}" class="logo">
                    </div>
                    <div class="card-body loginBody">
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="text-center">
                                @error('credentials')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label usernameLabel">Username:</label>
                                <div class="input-div">
                                    <i class="fa-solid fa-user loginUser"></i>
                                    <input type="username"
                                        class="form-control inputs @error('username') is-invalid @enderror"
                                        id="username" placeholder="Enter username" name="username">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <div class="input-div">
                                    <i class="fa-solid fa-unlock loginLock"></i>
                                    <input type="password"
                                        class="form-control inputs @error('password') is-invalid @enderror"
                                        id="password" placeholder="Enter password" name="password">
                                    <i class="fa-solid fa-eye loginEye" id="loginEye"></i>
                                </div>
                            </div>

                            <button type="submit" class="btn loginBtn form-control">Login Securely</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customJs')
<script src="{{url('public/assets/customs/js/login.js')}}"></script>
@endsection