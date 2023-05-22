@extends('layouts.master_admin')
@section('content')
    <div class="pagetitle">
        <h1>Chỉnh sửa banner</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Chỉnh sửa</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.banners.update', $banner->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" name="id" class="form-control" value="{{ old('id', $banner->id) }}" readonly>
        </div>

        <div class="form-group pt-3">
            <img src="{{ $banner->getImage() }}" width="256px" class="img-preview">
            <label for="image">Banner</label>
            <input type="file" name="image" id="image" class="form-control">
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
