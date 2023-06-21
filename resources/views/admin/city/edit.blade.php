@extends('layouts.master_admin')
@section('content')
    <div class="pagetitle">
        <h1>Chỉnh sửa phí vâận chuyển</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Chỉnh sửa</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.cities.index') }}">danh sách</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.cities.update', $city->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <input type="hidden" name="id" value="{{ $city->id }}">

        <div class="form-group pt-3">
            <label for="name">Tên tỉnh/thành phố:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $city->name) }}" disabled>
        </div>

        <div class="form-group pt-3">
            <label for="shipping_fee">Phí vận chuyển:</label>
            <input type="text" name="shipping_fee" class="form-control" value="{{ old('shipping_fee', formatVnd($city->shipping_fee)) }}">
        </div>

        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>

@endsection
