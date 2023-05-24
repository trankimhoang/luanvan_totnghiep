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
                        <div class="checkbox-form">
                            <h3>Thông tin</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Họ tên:@include('admin.include.required_icon')</label>
                                        <input placeholder="" type="text" name="name" value="{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->name }}">
                                        @error('name')
                                        <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Địa chỉ @include('admin.include.required_icon')</label>
                                        <input placeholder="Địa chỉ" type="text" name="address" value="{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->address }}">
                                        @error('address')
                                        <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Email:@include('admin.include.required_icon')</label>
                                        <input placeholder="" type="email" name="email" value="{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->email }}">
                                        @error('email')
                                        <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Số điện thoại:@include('admin.include.required_icon')</label>
                                        <input type="text" name="phone" value="{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->phone }}">
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
                                            <td class="cart-product-name">{{ $product->name }}<strong class="product-quantity"> × {{ $listProductRequest[$product->id]['quantity'] }}</strong></td>
                                            <td class="cart-product-total"><span class="amount">{{ $product->price * $listProductRequest[$product->id]['quantity'] }}</span></td>
                                        </tr>
                                        <input type="hidden" name="list_product[{{ $product->id }}][id]" form="form-main" value="{{ $product->id }}">
                                        <input type="hidden" name="list_product[{{ $product->id }}][quantity]" form="form-main" value="{{ $listProductRequest[$product->id]['quantity'] }}">
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Tổng tiền</th>
                                    <td><span class="amount">{{ $total }}</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Tổng tiền thanh toán</th>
                                    <td><strong><span class="amount">{{ $total }}</span></strong></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion">
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
