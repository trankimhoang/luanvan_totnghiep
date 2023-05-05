@extends('layouts.master_admin_login')

@section('content')
    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Đăng nhập tài khoản</h5>
        <p class="text-center small">Nhập email và mật khẩu để đăng nhập</p>
    </div>



    <form class="row g-3 needs-validation" novalidate action="{{ route('admin.login.post') }}" method="post">
        @csrf
        <div class="col-12">
            <label for="yourEmail" class="form-label">Email</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" name="email" class="form-control" id="yourEmail" required value="{{ old('email') }}">
                @error('email')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <label for="yourPassword" class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control" id="yourPassword" required value="{{ old('password') }}">
            @error('password')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" value="1" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
            </div>
        </div>
        <div class="col-12">
            <a href="{{ route('admin.forget.password.get') }}">Quên mật khẩu?</a>
        </div>
        <div class="col-12">
            <input type="submit" name="submit" class="btn btn-primary w-100" value="Đăng nhập">

        </div>

    </form>
@endsection
