@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Thêm quản trị viên</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Thêm</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Tổng quan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.admins.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group pt-3">
            <label for="name">Tên quản trị viên @include('admin.include.required_icon')</label>
            <input type="text" name="name" class="form-control">
            @error('name')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="email">Email @include('admin.include.required_icon')</label>
            <input type="text" name="email" class="form-control">
            @error('email')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="password">Mật khẩu @include('admin.include.required_icon')</label>
            <input type="password" name="password" class="form-control">
            @error('password')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <img src="" width="256px" class="img-preview">
            <label for="image">Ảnh đại diện @include('admin.include.required_icon')</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
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
