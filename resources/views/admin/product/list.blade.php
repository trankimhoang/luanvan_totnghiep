@extends('layouts.master_admin')
@section('content')
    <div class="pagetitle">
        <h1>List Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <table class="table table-bordered border border-primary">
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh đại diện</th>
            <th>Gia</th>
            <th>Số lượng</th>
            <th>Action</th>
        </tr>
        @foreach($listProduct as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>
                    <img src="{{ $product->getImage() }}" alt="" width="128px" style="text-align: center">
                </td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-success btn-sm rounded-0"><i class="bi bi-pencil"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <form action="" method="post">
                                @csrf
                                @method('')
                                <button type="submit" class="btn btn-danger btn-sm rounded-0"><i class="bi bi-trash"></i></button>
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
