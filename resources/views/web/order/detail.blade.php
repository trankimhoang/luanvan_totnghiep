@extends('layouts.master_user')

@section('content')
    <div class="container">
        <div class="card p-3 mb-3">
            <table class="table table-bordered border border-primary">
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
                    <td>{!! mapOrderStatus($order->status) !!}</td>
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

        <div class="mt-3">
            @if($order->status == 'PENDING')
                <div class="card p-3">
                    <div class="form-group pt-3">
                        <form action="{{ route('web.order_update_status', $order->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="status" value="CANCEL">
                            <button type="submit" class="btn btn-danger" id="btn-cancel">Hủy</button>
                        </form>
                    </div>
                </div>
            @elseif($order->status == 'CONFIRMED')

            @elseif($order->status == 'DELIVERY')

            @elseif($order->status == 'SUCCESS')
                @if(!empty($order->success_at) && getDayFromDateToDate($order->success_at, \Carbon\Carbon::now()) <= 7)
                    <div class="card p-3">
                        <div class="form-group pt-3">
                            <form action="{{ route('web.order_update_status', $order->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary" name="status" value="REFUND">Trả hàng/Hoàn tiền</button>
                            </form>
                        </div>
                    </div>
                @endif
            @elseif($order->status == 'REFUND')

            @endif
        </div>
    </div>
    <div class="container text-right p-3">
        <h4><a href="{{ route('web.index') }}">Tiếp tục mua hàng</a></h4>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#btn-cancel').click(function () {
                Swal.fire({
                    title: 'Bạn có muốn hủy đơn hàng ?',
                    showCancelButton: true,
                    confirmButtonText: 'Hủy',
                    cancelButtonText: 'Không'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $(this).parents('form').submit();
                    }
                });

                return false;
            });
        });
    </script>
@endsection
