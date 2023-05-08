@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Chỉnh sửa loại</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Chỉnh sửa</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Tên loại @include('admin.include.required_icon')</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}">
            @error('name')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
@endsection

