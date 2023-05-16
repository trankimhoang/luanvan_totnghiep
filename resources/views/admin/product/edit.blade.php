@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Sửa sản phẩm</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Chỉnh sửa</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.products.update', $product->id) }}"
          id="form-main"
          method="post"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.product._list_field')



        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary" form="form-main">Lưu</button>
        </div>
    </form>
    <style>
        .tag-error {
            margin-top: 10px;
        }
    </style>
@endsection

@section('js')
    @include('admin.product._js')
@endsection
