<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        table, th, td {border:1px solid #CACFD2 !important;}
    </style>
</head>
<body>

<table style="width:100%;border:0;border-spacing:0;">
        <tr>
            <th>Mã đơn hàng</th>
            <td>{{ $order->id }}</td>
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
            <td>
                {{ mapStringIsPaid($order->payment_status) }}
                @if($order->payment_type == 'MOMO' && $order->payment_status == 'UNPAID')
                    <a href="{{ createPayUrlMomo($order->id, $order->total(), true) }}">Thanh toán lại</a>
                @endif
            </td>
        </tr>

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
            <th>Người bán ghi chú</th>
            <td>{{ $order->admin_note }}</td>
        </tr>

        <tr>
            <th>Tổng tiền sản phẩm</th>
            <td>{{ formatVnd($order->total(false) - $order->shipping_fee) }}</td>
        </tr>

        @if(!empty($order->Coupon->name))
            <tr>
                <th>Mã khuyến mãi</th>
                <td>
                    {{ $order->Coupon->name ?? '' }} : {{formatVnd(-$order->discount)}}
                </td>
            </tr>
       @endif

        <tr>
            <th>Phí vận chuyển</th>
            <td>{{ formatVnd(+$order->shipping_fee) }}</td>
        </tr>


        <tr>
            <th>Tổng tiền cần thanh toán</th>
            <td>{{ formatVnd($order->total()) }}</td>
        </tr>
    </table>

<h2>Sản phẩm</h2>
<table style="width:100%;border:0;border-spacing:0;text-align: center;">
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

</body>
</html>
