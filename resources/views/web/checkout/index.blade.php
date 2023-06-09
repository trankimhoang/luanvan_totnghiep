@extends('layouts.master_user')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('web.index') }}">Trang chủ</a></li>
                    <li class="active">Đặt hàng</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <div class="checkout-area pt-60 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <form action="{{ route('web.create.order') }}" method="post" id="form-main">
                        @csrf
                        <input type="hidden" name="coupon_id" id="coupon_id">
                        <div class="checkbox-form">
                            <h3>Thông tin</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Họ tên:@include('admin.include.required_icon')</label>
                                        <input placeholder="" type="text" name="name"
                                               value="{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->name }}">
                                        @error('name')
                                        <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Tỉnh thành @include('admin.include.required_icon')</label>
                                        <select name="city_id" id="city_id">
                                            <option value="">---</option>
                                            @foreach($listCity as $city)
                                                <option data-shipping-fee="{{ $city->shipping_fee }}" value="{{ $city->id }}" @if(old('city_id') == $city->id) selected @endif>{{ $city->name }} - Phí vận chuyển: {{formatVnd($city->shipping_fee)}}</option>
                                            @endforeach
                                        </select>
                                        @error('address')
                                        <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Địa chỉ @include('admin.include.required_icon')</label>
                                        <input placeholder="Địa chỉ" type="text" name="address"
                                               value="{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->address }}">
                                        @error('address')
                                        <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Email:@include('admin.include.required_icon')</label>
                                        <input placeholder="" type="email" name="email"
                                               value="{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->email }}">
                                        @error('email')
                                        <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Số điện thoại:@include('admin.include.required_icon')</label>
                                        <input type="text" name="phone"
                                               value="{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->phone }}">
                                        @error('phone')
                                        <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Ghi chú:</label>
                                        <textarea name="note" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="your-order">
                        <h3>Đơn đặt hàng</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="cart-product-name">Sản phẩm</th>
                                    <th class="cart-product-total">Tổng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listProduct as $product)
                                    @if(!empty($listProductRequest[$product->id]['quantity']))
                                        <tr class="cart_item">
                                            <td class="cart-product-name">{{ $product->getName() }}<strong
                                                    class="product-quantity">
                                                    × {{ $listProductRequest[$product->id]['quantity'] }}</strong></td>
                                            <td class="cart-product-total"><span
                                                    class="amount">{{ formatVnd($product->price * $listProductRequest[$product->id]['quantity']) }}</span>
                                            </td>
                                        </tr>
                                        <input type="hidden" name="list_product[{{ $product->id }}][id]"
                                               form="form-main" value="{{ $product->id }}">
                                        <input type="hidden" name="list_product[{{ $product->id }}][quantity]"
                                               form="form-main"
                                               value="{{ $listProductRequest[$product->id]['quantity'] }}">
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Tổng tiền</th>
                                    <td><span class="amount">{{ formatVnd($total) }}</span></td>
                                </tr>
                                <tr class="cart-subtotal shipping_fee">
                                    <th>Phí vận chuyển</th>
                                    <td><span></span></td>
                                </tr>
                                <tr class="cart-subtotal coupon_discount">
                                    <th>Khuyến mãi</th>
                                    <td><span></span></td>
                                </tr>
                                <tr class="order-total total">
                                    <th>Tổng tiền thanh toán</th>
                                    <td><strong><span data-total-base="{{ $total }}">{{ formatVnd($total) }}</span></strong></td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion">
                                    <div class="row">
                                        @foreach($listCoupon as $coupon)
                                            <div class="col-4 p-3">
                                                <div class="badge badge-info coupon-select"
                                                     data-id="{{ $coupon->id }}"
                                                     data-discount-max="{{ $coupon->discount_max }}"
                                                     @if($coupon->type == 'price')
                                                         data-discount="{{ $coupon->discount }}"
                                                     @elseif($coupon->type == 'percent')
                                                         data-discount="{{ $total * $coupon->discount / 100 }}"
                                                     @endif
                                                     style="cursor: pointer;">
                                                    <h4>{{ $coupon->name }}</h4>
                                                    @if($coupon->type == 'price')
                                                        <h6 style="white-space: break-spaces;">Giảm {{ formatVnd($coupon->discount) }} tối đa {{ formatVnd($coupon->discount_max) }}</h6>
                                                    @elseif($coupon->type == 'percent')
                                                        <h6 style="white-space: break-spaces;">Giảm {{ $coupon->discount }}% tối đa {{ formatVnd($coupon->discount_max) }}</h6>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_type">Phương thức thanh toán</label>
                                        <select class="form-control" name="payment_type" form="form-main">
                                            <option value="COD">COD</option>
                                            <option value="MOMO">MOMO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="order-button-payment">
                                    <input value="Đặt hàng" type="submit" form="form-main">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            var shipping_fee_temp = 0;
            var discount_temp = 0;

            $('.coupon_discount').hide();
            $('.shipping_fee').hide();

            $('.coupon-select').click(function () {
                if ($(this).hasClass('badge-danger')) {
                    $(this).removeClass('badge-danger');
                    const totalBase = parseFloat($('.total span').attr('data-total-base'));
                    $('.total span').text(formatVnd(totalBase + shipping_fee_temp));
                    $('.coupon_discount').hide();
                } else {
                    $('.coupon-select').removeClass('badge-danger');
                    $(this).addClass('badge-danger');
                    let discount = $(this).attr('data-discount');
                    const discountMax = $(this).attr('data-discount-max');
                    const id = $(this).attr('data-id');

                    if (discount > discountMax) {
                        discount = discountMax;
                    }

                    if (discount > 0) {
                        discount_temp = discount;
                        $('.coupon_discount').show();
                        $('.coupon_discount span').text(formatVnd(-discount));
                        const totalBase = parseFloat($('.total span').attr('data-total-base'));
                        $('.total span').text(formatVnd(totalBase - discount + shipping_fee_temp));
                        $('#coupon_id').val(id);
                    }
                }
            });

            $('#city_id').change(function () {
                let shippingFee = $(this).find('option:selected').attr('data-shipping-fee');

                if (shippingFee !== '') {
                    $('.shipping_fee').show();
                    shippingFee = parseFloat(shippingFee);
                    shipping_fee_temp = shippingFee;
                    $('.shipping_fee span').text(formatVnd(shippingFee));
                    const totalBase = parseFloat($('.total span').attr('data-total-base'));
                    $('.total span').text(formatVnd(totalBase - discount_temp + shippingFee));
                } else {
                    $('.shipping_fee').hide();
                }
            });
        });
    </script>
@endsection
