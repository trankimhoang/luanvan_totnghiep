@extends('layouts.master_user')

@section('content')
    <div class="container">
        <table class="table table-bordered border border-primary">
            <tr>
                <th>Mã đơn hàng</th>
                <th>Phương thức thanh toán</th>
                <th>Trạng thái đơn hàng</th>
                <th>Ngày tạo đơn</th>
                <th>Ngày chỉnh sửa</th>
                <th>Hành động</th>
            </tr>
            @foreach($listOrder as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <th>{{ $order->payment_type }}</th>
                    <td>{!! mapOrderStatus($order->status) !!}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->updated_at }}</td>
                    <td>
                        <ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <a href="{{ route('web.order_detail', $order->id) }}" class="btn btn-success btn-sm rounded-0">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </table>
        <div>{{ $listOrder->appends(request()->input())->links() }}</div>
    </div>
@endsection
