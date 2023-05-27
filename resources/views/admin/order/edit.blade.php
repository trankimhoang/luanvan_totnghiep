@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Chỉnh sửa đơn đặt hàng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Chỉnh sửa</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card p-3 mb-3">
        <table class="table table-bordered border border-primary">
            <tr>
                <th>Mã đơn hàng</th>
                <td>{{ $order->id }}</td>
            </tr>

            <tr>
                <th>Người đặt hàng</th>
                <td>{{ $order->User->name }}</td>
            </tr>

            <tr>
                <th>Số điện thoại</th>
                <td>{{ $order->phone }}</td>
            </tr>

            <tr>
                <th>Địa chỉ</th>
                <td>{{ $order->address }}</td>
            </tr>

            <tr>
                <th>Phương thức thanh toán</th>
                <td>{{ $order->payment_type }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $order->email }}</td>
            </tr>

            <tr>
                <th>Trạng thái đơn hàng</th>
                <td>{{ mapOrderStatus($order->status) }}</td>
            </tr>

            <tr>
                <th>Thanh toán</th>
                <td>{{ mapStringIsPaid($order->payment_status) }}</td>
            </tr>

            @if(!empty($order->payment_response))
                <tr>
                    <th>Thông tin thanh toán</th>
                    <td>
                        @foreach(json_decode($order->payment_response, true) as $key => $value)
                            <p>{{ $key }}: {{ $value }}</p>
                        @endforeach
                    </td>
                </tr>
            @endif

            <tr>
                <th>Ngày tạo đơn</th>
                <td>{{ $order->created_at }}</td>
            </tr>

            <tr>
                <th>Ngày chỉnh sửa</th>
                <td>{{ $order->updated_at }}</td>
            </tr>

            <tr>
                <th>Người mua ghi chú</th>
                <td>{{ $order->note }}</td>
            </tr>

            <tr>
                <th>Tổng tiền thanh toán</th>
                <td>{{ formatVnd($order->total()) }}</td>
            </tr>
        </table>
    </div>

    <div class="card p-3">
        <h4>Sản phẩm</h4>
        <table class="table table-bordered border border-primary">
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh đại diện</th>
                <th>Giá bán</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>
            @foreach($order->Products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->getName() }}</td>
                    <td>
                        <img src="{{ $product->getImage() }}" alt="" width="128px" style="text-align: center">
                    </td>
                    <td>{{ formatVnd($product->pivot->price) }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ formatVnd($product->pivot->price * $product->pivot->quantity) }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="card p-3">
        <div class="form-group pt-3">
            <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                @csrf
                @method('put')
                <label for="admin_note">Ghi chú</label>
                <textarea name="admin_note" id="" cols="30" class="form-control" rows="10">{{ $order->admin_note ?? '' }}</textarea>
                <button type="submit" class="btn btn-primary mt-2">Cập nhật</button>
            </form>

        </div>
    </div>

    @if($order->status == 'PENDING')
        <div class="card p-3">
            <div class="form-group pt-3">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-primary" name="status" value="CONFIRMED">Xác nhận</button>
                </form>

                <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-danger" name="status" value="CANCEL">Hủy</button>
                </form>

            </div>
        </div>
    @elseif($order->status == 'CONFIRMED')
        <div class="card p-3">
            <div class="form-group pt-3">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-primary" name="status" value="DELIVERY">Giao hàng</button>
                </form>

                <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-danger" name="status" value="CANCEL">Hủy</button>
                </form>

            </div>
        </div>
    @elseif($order->status == 'DELIVERY')
        <div class="card p-3">
            <div class="form-group pt-3">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-primary" name="status" value="SUCCESS">Thành công</button>
                </form>

                <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-danger" name="status" value="CANCEL">Hủy</button>
                </form>

            </div>
        </div>
    @elseif($order->status == 'SUCCESS')
        <div class="card p-3">
            <div class="form-group pt-3">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-primary" name="status" value="REFUND">Trả hàng</button>
                </form>
            </div>
        </div>
    @elseif($order->status == 'REFUND')

    @endif


    @if($order->payment_status == 'PAID')
        <div class="card p-3">
            <div class="form-group pt-3">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-primary" name="payment_status" value="REFUND">Hoàn tiền
                    </button>
                </form>
            </div>
        </div>
    @endif
@endsection

