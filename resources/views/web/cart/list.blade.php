@extends('layouts.master_user')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('web.index') }}">Trang chủ</a></li>
                    <li class="active">Giỏ hàng</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Shopping Cart Area Strat-->
    <div class="Shopping-cart-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="li-product-thumbnail"></th>
                                    <th class="li-product-thumbnail">Hình ảnh</th>
                                    <th class="cart-product-name">Sản phẩm</th>
                                    <th class="li-product-price">Đơn giá</th>
                                    <th class="li-product-quantity">Số lượng</th>
                                    <th class="li-product-subtotal">Tổng tiền</th>
                                    <th class="li-product-remove">Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listProduct as $product)
                                    <tr>
                                        <td>
                                            <input type="checkbox" data-product-id="{{ $product->id }}" class="ckb-product" name="list_product[{{ $product->id }}][id]" value="{{ $product->id }}" form="form-main">
                                        </td>
                                        <td class="li-product-thumbnail"><a href="#"><img src="{{ $product->getImage() }}" width="100px" alt="Li's Product Image"></a></td>
                                        <td class="li-product-name" width="30%"><a href="{{ route('web.detail', $product->id) }}" target="_blank">{{ $product->getName() }}</a></td>
                                        <td class="li-product-price"><span class="amount">{{ formatVnd($product->price) }}</span></td>
                                        <td class="quantity">
                                            <label>Số lượng</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box quantity-product-row" data-product-id="{{ $product->id }}"
                                                       name="list_product[{{ $product->id }}][quantity]"
                                                       form="form-main"
                                                       value="{{ $product->pivot->quantity }}" type="text">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><span class="amount" data-total="{{ $product->price * $product->pivot->quantity }}" data-product-id="{{ $product->id }}">{{ formatVnd($product->price * $product->pivot->quantity) }}</span></td>
                                        <td class="li-product-remove remove-product-cart" data-product-id="{{ $product->id }}">
                                            <i class="fa fa-trash" style="cursor: pointer;"></i>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
{{--                        <div class="row">--}}
{{--                            <div class="col-12">--}}
{{--                                <div class="coupon-all">--}}
{{--                                    <div class="coupon">--}}
{{--                                        <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Mã giảm giá" type="text">--}}
{{--                                        <input class="button" name="apply_coupon" value="Áp dụng" type="submit">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Tổng tiền thanh toán</h2>
                                    <ul>
                                        <li>Tổng <span id="total-cart">0</span></li>
                                    </ul>
                                    <button type="submit" class="btn btn-dark mt-2" form="form-main">Mua ngay</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('web.checkout.order') }}" method="get" id="form-main">
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            function rfTotal() {
                let total = 0;

                $('.ckb-product:checked').each(function () {
                    const productId = $(this).attr('data-product-id');
                    total += parseFloat($(`.amount[data-product-id='${productId}']`).attr('data-total'));
                });

                $('#total-cart').text(formatVnd(total));
            }

            $('.ckb-product').change(function () {
                rfTotal();
            });

            $('#form-main').submit(function (event) {
                if ($('.ckb-product:checked').length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi...',
                        text: 'Bạn chưa chọn sản phẩm'
                    });
                    event.preventDefault();
                }
            });

            $('.remove-product-cart').click(function () {
                const thisElement = $(this);
                let productId = thisElement.attr('data-product-id');
                $.LoadingOverlay('show');

                $.ajax({
                    url: @json(route('web.delete.product.cart')),
                    method: 'get',
                    data: {
                        product_id: productId
                    },
                    success: function (data){
                        $.LoadingOverlay('hide');

                        if (data.hasOwnProperty('success') && data.success) {
                            $('.cart-item-count').text(data.data.qty);
                            thisElement.parents('tr').remove();
                            rfTotal();
                        } else {
                            // error
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi...',
                                text: data.data.message ?? ''
                            });
                        }
                    }
                })
            });

            $('.quantity-product-row').change(function () {
                const productId = $(this).attr('data-product-id');
               const quantity_new = $(this).val();
               $.LoadingOverlay('show');

               $.ajax({
                   data: {
                       product_id: productId,
                       quantity_new: quantity_new,
                   },
                    method: 'get',
                   url: @json(route('web.cart.add')),
                   success: function (data){
                       $.LoadingOverlay('hide');

                       if (data.hasOwnProperty('success') && data.success) {
                           $('.cart-item-count').text(data.data.qty);
                           $('#total-cart').text(data.data.total);
                           $(`.amount[data-product-id='${productId}']`).text(formatVnd(data.data.total_row));
                           $(`.amount[data-product-id='${productId}']`).attr('data-total', data.data.total_row);
                           rfTotal();
                       } else {
                           // error
                           $(`.quantity-product-row[data-product-id='${productId}']`).val(quantity_new - 1);
                           Swal.fire({
                               icon: 'error',
                               title: 'Lỗi...',
                               text: data.data.message ?? ''
                           });
                       }
                   }
               });
            });
        });
    </script>
@endsection


