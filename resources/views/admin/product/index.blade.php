@extends('layouts.master_admin')
@section('content')
    <div class="pagetitle">
        <h1>Danh sách sản phẩm</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Danh sách</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2">Thêm sản phẩm</a>
    <table class="table table-bordered border border-primary">
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh đại diện</th>
            <th>Chuyên mục</th>
            <th>Mô tả</th>
            <th>Giá bán</th>
            <th>Giá KM</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th>Action</th>
        </tr>
        @foreach($listProduct as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>
                    <img src="{{ $product->getImage() }}" alt="" width="128px" style="text-align: center">
                </td>
                <td>{{ $product->Category->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->price_new }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    {{ mapStatusProduct($product->status) }}
                </td>
                <td>
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-success btn-sm rounded-0"><i class="bi bi-pencil"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <form action="{{ route('admin.products.destroy', $product->id ) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm rounded-0"><i class="bi bi-trash"></i></button>
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
