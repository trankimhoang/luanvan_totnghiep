@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Thêm chuyên mục</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Thêm</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Tổng quan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group pt-3">
            <label for="name">Tên chuyên mục @include('admin.include.required_icon')</label>
            <input type="text" name="name" class="form-control">
            @error('name')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
@endsection

