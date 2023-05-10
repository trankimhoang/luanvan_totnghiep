@extends('layouts.master_user')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('web.index') }}">Trang chủ</a></li>
                    <li class="active">Lấy lại mật khẩu</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-section mb-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- Login Form s-->
                    <form action="{{ route('web.reset.password.post') }}" method="post" >
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="login-form">
                            <h4 class="login-title">Lấy lại mật khẩu</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email @include('admin.include.required_icon')</label>
                                    <input class="mb-0" name="email" type="email" value="{{ $email }}" readonly>
                                    @error('email')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-12 mb-20">
                                    <label>Mật khẩu @include('admin.include.required_icon')</label>
                                    <input class="mb-0" name="password" type="password" placeholder="Password">
                                    @error('password')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-12 mb-20">
                                    <label>Nhập lại mật khẩu @include('admin.include.required_icon')</label>
                                    <input class="mb-0" name="password_confirm" type="password" placeholder="Password">
                                    @error('password')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <input type="submit" name="submit" class="btn btn-outline-dark w-100" style="background-color: #434e5b"  value="Đăng nhập">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
