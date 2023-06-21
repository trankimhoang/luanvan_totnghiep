@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Thêm sản phẩm</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Thêm</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Danh sách</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data" id="form-main">
        @csrf
        @include('admin.product._list_field')
        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary">
                Lưu
            </button>
        </div>
    </form>
@endsection

@section('js')
    @include('admin.product._js')
@endsection
