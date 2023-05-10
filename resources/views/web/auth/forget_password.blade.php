@extends('layouts.master_user')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('web.index') }}">Trang chủ</a></li>
                    <li class="active">Quên mật khẩu</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-section mb-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- Login Form s-->
                    <form action="{{ route('web.forget.password.post') }}" method="post" >
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Quên mật khẩu</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email @include('admin.include.required_icon')</label>
                                    <input class="mb-0" name="email" type="email" placeholder="Email">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-dark">Lấy lại mật khẩu</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
