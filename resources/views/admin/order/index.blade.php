@extends('layouts.master_admin')

@section('search')
    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="GET" action="{{ route('admin.orders.index') }}">
            <select class="form-control form-select" style="width: fit-content" name="payment_type_search">
                <option value="">--Phương thức thanh toán--</option>
                <option value="COD" @if(request()->get('payment_type_search') == 'COD') selected @endif>COD</option>
                <option value="MOMO" @if(request()->get('payment_type_search') == 'MOMO') selected @endif>MOMO</option>
            </select>
            <select class="form-control form-select" style="width: fit-content" name="order_status_search">
                <option value="">--Trạng thái đơn hàng--</option>
                @foreach(getOrderStatus() as $status => $statusTitle)
                    <option value="{{ $status }}" @if(request()->get('order_status_search') == $status) selected @endif>{{ $statusTitle }}</option>
                @endforeach
            </select>
            <input type="text" name="search" placeholder="Mã đơn hàng" value="{{ request()->get('search') ?? '' }}">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Danh sách đơn đặt hàng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Danh sách</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Tổng quan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <table class="table table-bordered border border-primary" style="text-align: center">
        <tr>
            <th>Mã đơn hàng</th>
            <th>Người đặt hàng</th>
            <th>Phương thức thanh toán</th>
            <th>Trạng thái đơn hàng</th>
            <th>Ngày tạo đơn</th>
            <th>Ngày chỉnh sửa</th>
            <th>Hành động</th>
        </tr>
        @foreach($listOrder as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->User->name }}</td>
                <th>{{ $order->payment_type }}</th>
                <td>{!! mapOrderStatus($order->status) !!}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->updated_at }}</td>
                <td>
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-success btn-sm rounded-0"><i class="bi bi-pencil"></i></a>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
    <div>{{ $listOrder->appends(request()->input())->links() }}</div>
@endsection
