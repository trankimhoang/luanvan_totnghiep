@if(\Illuminate\Support\Facades\Auth::guard('web')->check())
    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-shopping-cart"></i>
        <span>Your Cart</span>
        <div class="qty" id="cart-qty">{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->Carts->sum('quality') }}</div>
    </a>
    <div class="cart-dropdown" id="cart-dropdown">
        @include('cart.cart_dropdown')
    </div>
@endif
