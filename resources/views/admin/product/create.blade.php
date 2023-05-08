@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Thêm sản phẩm</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Thêm</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group pt-3">
            <label for="name">Tên sản phẩm @include('admin.include.required_icon')</label>
            <input type="text" name="name" class="form-control">
            @error('name')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="category_id">Loai @include('admin.include.required_icon')</label>
            <select name="category_id" class="form-control form-select">
                <option value="">---</option>
                @foreach($listCategory as $category)
                    @if($category->id == $product->category_id)
                        <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
            @error('category_id')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="description">Mô tả</label>
            <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
            @error('description')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="email">Giá gốc @include('admin.include.required_icon')</label>
            <input type="text" name="price" class="form-control">
            @error('price')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="email">Giá sau KM</label>
            <input type="text" name="price_new" class="form-control">
            @error('price_new')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="password">Số lượng @include('admin.include.required_icon')</label>
            <input type="text" name="quantity" class="form-control">
            @error('quantity')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <img src="" width="256px" class="img-preview">
            <label for="image">Avatar</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="status">Trạng thái: @include('admin.include.required_icon')</label>
            <select class="form-group p-lg-2" name="status">
                <option value="1" selected>On</option>
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
