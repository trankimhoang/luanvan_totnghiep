@extends('layouts.master_user')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('web.index') }}">Trang chủ</a></li>
                    <li class="active">Đăng kí</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-section mb-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <form action="{{ route('web.register.post') }}" method="post">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Đăng kí</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Name @include('admin.include.required_icon')</label>
                                    <input class="mb-0" type="text" placeholder="First Name" name="name">
                                    @error('name')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>Email @include('admin.include.required_icon')</label>
                                    <input class="mb-0" type="email" placeholder="Email Address" name="email">
                                    @error('email')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Mật khẩu @include('admin.include.required_icon')</label>
                                    <input class="mb-0" type="password" placeholder="Password" name="password">
                                    @error('password')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Nhập lại mật khẩu @include('admin.include.required_icon')</label>
                                    <input class="mb-0" type="password" placeholder="Confirm Password" name="password_confirm">
                                    @error('password_confirm')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="register-button mt-0">Đăng kí</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
