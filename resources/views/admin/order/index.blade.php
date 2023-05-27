@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Danh sách đơn đặt hàng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Danh sách</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <table class="table table-bordered border border-primary">
        <tr>
            <th>Mã đơn hàng</th>
            <th>Người đặt hàng</th>
            <th>Phương thức thanh toán</th>
            <th>Trạng thái đơn hàng</th>
            <th>Ngày tạo đơn</th>
            <th>Ngày chỉnh sửa</th>
            <th>Action</th>
        </tr>
        @foreach($listOrder as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->User->name }}</td>
                <th>{{ $order->payment_type }}</th>
                <td>{{ mapOrderStatus($order->status) }}</td>
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
    <div>{{ $listOrder->render() }}</div>
@endsection
