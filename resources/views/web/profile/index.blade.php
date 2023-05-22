@extends('layouts.master_user')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('web.index') }}">Trang chủ</a></li>
                    <li class="active">Tài khoản</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-section mb-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- Login Form s-->
                    <form action="{{ route('web.profile.post', $profileUser->id) }}" method="post" >
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Tài khoản</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Tên @include('admin.include.required_icon')</label>
                                    <input class="mb-0" name="name" type="text" placeholder="Tên" value="{{ old('name', $profileUser->name) }}">
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email @include('admin.include.required_icon')</label>
                                    <input class="mb-0" name="email" type="email" placeholder="Email Address" value="{{ old('name', $profileUser->email) }}">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Mật khẩu @include('admin.include.required_icon')</label>
                                    <input class="mb-0" name="password" type="password" placeholder="Password" value="{{ old('password') }}" autocomplete="off">
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" name="submit" class="btn btn-outline-dark w-100" style="background-color: #434e5b"  value="Cập nhật">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
