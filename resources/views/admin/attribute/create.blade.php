@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Thêm thuộc tính</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Thêm</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.attributes.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group pt-3">
            <label for="name">Tên thuộc tính @include('admin.include.required_icon')</label>
            <input type="text" name="name" class="form-control">
            @error('name')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
@endsection
