@extends('layouts.master_admin')
@section('content')
    <div class="pagetitle">
        <h1>Thêm banner</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Thêm</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Danh sách</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.banners.store') }}" method="post" enctype="multipart/form-data" id="form-main">
        @csrf
        <div class="form-group pt-3">
            <img src="" width="256px" class="img-preview">
            <label for="image">Banner</label>
            <input type="file" name="image" id="image" class="form-control">
                <img src="" alt="" width="128px">
        </div>

        <div class="form-group pt-3">
            <label for="status">Trạng thái:</label>
            <select class="form-group p-lg-2" name="status">
                <option value="1">On</option>
                <option value="0">Off</option>
            </select>
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
