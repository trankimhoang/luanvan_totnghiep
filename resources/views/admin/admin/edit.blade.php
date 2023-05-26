@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Chỉnh sửa tài khoản quản trị viên</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Chỉnh sửa</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.admins.update', $admin->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <input type="hidden" name="id" value="{{ $admin->id }}">

        <div class="form-group">
            <label for="name">Tên quản trị viên @include('admin.include.required_icon')</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}">
            @error('name')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="email">Email @include('admin.include.required_icon')</label>
            <input type="text" name="email" class="form-control" value="{{ old('email', $admin->email) }}">
            @error('email')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <img src="{{ $admin->getImage() }}" width="256px" class="img-preview">
            <label for="image">{{ __('Image') }}</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}" autocomplete="off">
        </div>

        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#image').change(function (event) {
                $(".img-preview").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
            });
        });
    </script>
@endsection
