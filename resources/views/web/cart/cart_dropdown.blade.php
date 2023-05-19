<div class="cart-list">
    @php
        $totalCart = 0;
    @endphp

    @foreach(\Illuminate\Support\Facades\Auth::guard('web')->user()->Carts as $cart)
        @php
            $totalCart += $cart->quantity * $cart->Product->price;
        @endphp

{{--        <div class="product-widget">--}}
{{--            <div class="product-img">--}}
{{--                <img src="{{ $cart->Product->getImage() }}" alt="">--}}
{{--            </div>--}}
{{--            <div class="product-body">--}}
{{--                <h3 class="product-name"><a href="#">{{ $cart->Product->name }}</a></h3>--}}
{{--                <h4 class="product-price"><span class="qty">{{ $cart->quantity }}x</span>{{ $cart->Product->getPriceWithFormat() }}</h4>--}}
{{--            </div>--}}
{{--            <button class="delete delete-item-cart" data-id="{{ $cart->id }}"><i class="fa fa-close"></i></button>--}}
{{--        </div>--}}

        <div class="minicart">
            <ul class="minicart-product-list">
                <li>
                    <a href="#" class="minicart-product-image">
                        <img src="{{ $cart->Product->getImage() }}" alt="#">
                    </a>
                    <div class="minicart-product-details">
                        <h6 class="product-name"><a href="#">{{ $cart->Product->name }}</a></h6>
                        <h4 class="product-price"><span class="qty">{{ $cart->quantity }} </span></h4>
                    </div>
                    <button class="delete delete-item-cart" data-id="{{ $cart->id }}">
                        <i class="fa fa-close"></i>
                    </button>
                </li>
            </ul>
            <p class="minicart-total">SUBTOTAL: <span>{{ $totalCart }}</span></p>
            <div class="minicart-button">
                <a href="#" class="li-button li-button-dark li-button-fullwidth li-button-sm">
                    <span>View Full Cart</span>
                </a>
                <a href="#" class="li-button li-button-fullwidth li-button-sm">
                    <span>Checkout</span>
                </a>
            </div>
        </div>
    @endforeach
</div>

