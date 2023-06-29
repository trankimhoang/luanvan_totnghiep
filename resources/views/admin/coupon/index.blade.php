@extends('layouts.master_admin')

@section('search')
    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="GET" action="{{ route('admin.coupons.index') }}">
            <input type="text" name="search" placeholder="Tìm kiếm" value="{{ request()->get('search') ?? '' }}">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Danh sách mã khuyến mãi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Danh sách</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Tổng quan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary mb-2">Thêm mã khuyến mãi</a>
    <table class="table table-bordered border border-primary" style="text-align: center">
        <tr>
            <th>ID</th>
            <th>Tên mã khuyến mãi</th>
            <th>Số tiền/phần trăm khuyến mãi</th>
            <th>Loại khuyến mãi</th>
            <th>Số tiền giảm tối đa</th>
            <th>Số lần sử dụng</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Hành động</th>
        </tr>
        @foreach($listCoupon as $coupon)
            <tr>
                <td>{{ $coupon->id }}</td>
                <td>{{ $coupon->name }}</td>
                <td>{{ formatVnd($coupon->discount) }}</td>
                <td>{{ getListCouponType()[$coupon->type] ?? '' }}</td>
                <td>{{ formatVnd($coupon->discount_max) }}</td>
                <td>{{ $coupon->number_use }}</td>
                <td>{{ $coupon->start }}</td>
                <td>{{ $coupon->end }}</td>
                <td>
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-success btn-sm rounded-0"><i class="bi bi-pencil"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm rounded-0 btn-delete-index" data-id="{{ $coupon->id }}"><i class="bi bi-trash"></i></button>
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
