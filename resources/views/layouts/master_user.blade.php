<!doctype html>
<html class="no-js" lang="zxx">

<!-- index-231:32-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    @hasSection('title')
        <title>@yield('title') - {{ env('APP_NAME') }}</title>
    @else
        <title>{{ env('APP_NAME') }}</title>
    @endif

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/user/images/favicon.png') }}">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/material-design-iconic-font.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/font-awesome.min.css') }}">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="{{ asset('theme/user/css/fontawesome-stars.css') }}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/meanmenu.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/owl.carousel.min.css') }}">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/slick.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/animate.css') }}">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/jquery-ui.min.css') }}">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/venobox.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/nice-select.css') }}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/magnific-popup.css') }}">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/bootstrap.min.css') }}">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/helper.css') }}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/responsive.css') }}">
    <!-- Modernizr js -->
    <script src="{{ asset('theme/user/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('lib/fontawesome/css/all.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet">

    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }
    </style>

</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Begin Body Wrapper -->
<div class="body-wrapper">
    <!-- Begin Header Area -->
    <header>
        <!-- Begin Header Top Area -->
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Top Left Area -->
                    <div class="col-lg-3 col-md-4">
                        <div class="header-top-left">
                            <ul class="phone-wrap">
                                <li><span>Điện thoại:</span><a href="#">(+84) 584246834</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top Left Area End Here -->
                    <!-- Begin Header Top Right Area -->
                    <div class="col-lg-9 col-md-8">
                        <div class="header-top-right">
                            <ul class="ht-menu">
                                <!-- Begin Setting Area -->
                                <li>
                                    @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
                                        <div class="ht-setting-trigger"><span>{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->name }}</span></div>
                                        <div class="setting ht-setting">
                                            <ul class="ht-setting-list">
                                                <li><a href="{{ route('web.profile') }}">Tài khoản</a></li>
                                                <li><a href="{{ route('web.list_order_of_user') }}">Danh sách đơn đặt hàng</a></li>
                                                <li><a href="{{ route('web.logout') }}">Đăng xuất</a></li>
                                            </ul>
                                        </div>
                                    @else
                                        <div class="ht-setting-trigger"><span>Đăng nhập để mua hàng</span></div>
                                        <div class="setting ht-setting">
                                            <ul class="ht-setting-list">
                                                <li><a href="{{ route('web.register') }}">Đăng kí</a></li>
                                                <li><a href="{{ route('web.login') }}">Đăng nhập</a></li>
                                            </ul>
                                        </div>
                                    @endif

                                </li>
                                <!-- Setting Area End Here -->
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top Right Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Top Area End Here -->
        <!-- Begin Header Middle Area -->
        <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Logo Area -->
                    <div class="col-lg-3">
                        <div class="logo pb-sm-30 pb-xs-30">
                            <a href="{{ route('web.index') }}">
                                <img src="{{ asset('theme/user/images/menu/logo/1.jpg') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- Header Logo Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                        <!-- Begin Header Middle Searchbox Area -->
                        <form action="{{ route('web.search') }}" class="hm-searchbox">
                            <input type="text" placeholder="Bạn cần tìm gì?" name="search" value="{{ request()->get('search') ?? '' }}">
                            <button class="li-btn"><i class="fa fa-search"></i></button>
                        </form>
                        <!-- Header Middle Searchbox Area End Here -->
                        <!-- Begin Header Middle Right Area -->
                        <div class="header-middle-right">
                            <ul class="hm-menu" id="cart-icon">
                                <!-- Begin Header Mini Cart Area -->
                                <li class="hm-minicart">
                                    <div class="hm-minicart-trigger">
                                        <span class="item-icon"></span>
                                        <span class="item-text">Giỏ hàng<span class="cart-item-count">
                                                @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
                                                    {{ \Illuminate\Support\Facades\Auth::guard('web')->user()->countListProductInCart() }}
                                                @else
                                                    0
                                                @endif
                                            </span>
                                        </span>
                                    </div>
                                </li>
                                <!-- Header Mini Cart Area End Here -->
                            </ul>
                        </div>
                        <!-- Header Middle Right Area End Here -->
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Middle Area End Here -->
        <!-- Begin Header Bottom Area -->
        <div class="header-bottom header-sticky d-none d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Header Bottom Menu Area -->
                        <div class="hb-menu hb-menu-2 d-xl-block">
                            <nav>
                                <ul>
                                    <li><a href="#">Trang chủ</a></li>
                                    <li><a href="{{ route('web.about') }}">Về chúng tôi</a></li>
                                    <li><a href="{{ route('web.contact') }}">Liên hệ</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Header Bottom Menu Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Bottom Area End Here -->
        <!-- Begin Mobile Menu Area -->
        <div class="mobile-menu-area d-lg-none d-xl-none col-12">
            <div class="container">
                <div class="row">
                    <div class="mobile-menu">
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu Area End Here -->
    </header>
    <!-- Header Area End Here -->

    <div class="mb-5">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        @yield('content')
    </div>

    <!-- Begin Footer Area -->
    <div class="footer">
        <!-- Begin Footer Static Top Area -->
        <div class="footer-static-top">
            <div class="container">
                <!-- Begin Footer Shipping Area -->
                <div class="footer-shipping pt-60 pb-55 pb-xs-25">
                    <div class="row">
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{ asset('theme/user/images/shipping-icon/1.png') }}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>Free Delivery</h2>
                                    <p>And free returns. See checkout for delivery dates.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{ asset('theme/user/images/shipping-icon/2.png') }}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>Safe Payment</h2>
                                    <p>Pay with the world's most popular and secure payment methods.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{ asset('theme/user/images/shipping-icon/3.png') }}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>Shop with Confidence</h2>
                                    <p>Our Buyer Protection covers your purchasefrom click to delivery.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{ asset('theme/user/images/shipping-icon/4.png') }}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>24/7 Help Center</h2>
                                    <p>Have a question? Call a Specialist or chat online.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                    </div>
                </div>
                <!-- Footer Shipping Area End Here -->
            </div>
        </div>
        <!-- Footer Static Top Area End Here -->
        <!-- Begin Footer Static Middle Area -->
        <div class="footer-static-middle">
            <div class="container">
                <div class="footer-logo-wrap pt-50 pb-35">
                    <div class="row">
                        <!-- Begin Footer Logo Area -->
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-logo">
                                <img src="{{ asset('theme/user/images/menu/logo/1.jpg') }}" alt="Footer Logo">
                            </div>
                            <ul class="des">
                                <li>
                                    <span>Địa chỉ: </span>
                                    180 Cao Lỗ, phường 14 quận 8, TPHCM
                                </li>
                                <li>
                                    <span>Số điện thoại: </span>
                                    <a href="#">(+84) 584246834</a>
                                </li>
                                <li>
                                    <span>Email: </span>
                                    <a href="mailto://info@yourdomain.com">trankimhoang11052000@gmail.com</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Footer Logo Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-2 col-md-3 col-sm-6">
                            <div class="footer-block">
                                <h4 class="footer-block-title">Thông tin và chính sách</h4>
                                <ul>
                                    <li><a href="#">Mua hàng và thanh toán Online</a></li>
                                    <li><a href="#">Tra thông tin đơn hàng</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Block Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-2 col-md-3 col-sm-6">
                            <div class="footer-block">
                                <h4 class="footer-block-title">Dịch vụ và thông tin khác</h4>
                                <ul>
                                    <li><a href="#">Tuyển dụng</a></li>
                                    <li><a href="#">Quy chế hoạt động</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Block Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-4">
                            <div class="footer-block">
                                <h4 class="footer-block-title">Kết nối với chúng tôi</h4>
                                <ul class="social-link">
                                    <li class="facebook">
                                        <a href="https://www.facebook.com/" data-toggle="tooltip" target="_blank" title="Facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="google-plus">
                                        <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google +">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li class="instagram">
                                        <a href="https://www.instagram.com/" data-toggle="tooltip" target="_blank" title="Instagram">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Block Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Static Middle Area End Here -->
        <!-- Begin Footer Static Bottom Area -->
        <div class="footer-static-bottom pt-55 pb-55">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Copyright Area -->
                        <div class="copyright text-center pt-25">
                            &copy; Copyright <strong><span>Tran Kim Hoang</span></strong>. All Rights Reserved
                        </div>
                        <!-- Copyright Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Static Bottom Area End Here -->
    </div>
    <!-- Footer Area End Here -->
</div>
<!-- Body Wrapper End Here -->
<!-- jQuery-V1.12.4 -->
<script src="{{ asset('theme/user/js/vendor/jquery-1.12.4.min.js') }}"></script>
<!-- Popper js -->
<script src="{{ asset('theme/user/js/vendor/popper.min.js') }}"></script>
<!-- Bootstrap V4.1.3 Fremwork js -->
<script src="{{ asset('theme/user/js/bootstrap.min.js') }}"></script>
<!-- Ajax Mail js -->
<script src="{{ asset('theme/user/js/ajax-mail.js') }}"></script>
<!-- Meanmenu js -->
<script src="{{ asset('theme/user/js/jquery.meanmenu.min.js') }}"></script>
<!-- Wow.min js -->
<script src="{{ asset('theme/user/js/wow.min.js') }}"></script>
<!-- Slick Carousel js -->
<script src="{{ asset('theme/user/js/slick.min.js') }}"></script>
<!-- Owl Carousel-2 js -->
<script src="{{ asset('theme/user/js/owl.carousel.min.js') }}"></script>
<!-- Magnific popup js -->
<script src="{{ asset('theme/user/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Isotope js -->
<script src="{{ asset('theme/user/js/isotope.pkgd.min.js') }}"></script>
<!-- Imagesloaded js -->
<script src="{{ asset('theme/user/js/imagesloaded.pkgd.min.js') }}"></script>
<!-- Mixitup js -->
<script src="{{ asset('theme/user/js/jquery.mixitup.min.js') }}"></script>
<!-- Countdown -->
<script src="{{ asset('theme/user/js/jquery.countdown.min.js') }}"></script>
<!-- Counterup -->
<script src="{{ asset('theme/user/js/jquery.counterup.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('theme/user/js/waypoints.min.js') }}"></script>
<!-- Barrating -->
<script src="{{ asset('theme/user/js/jquery.barrating.min.js') }}"></script>
<!-- Jquery-ui -->
<script src="{{ asset('theme/user/js/jquery-ui.min.js') }}"></script>
<!-- Venobox -->
<script src="{{ asset('theme/user/js/venobox.min.js') }}"></script>
<!-- Nice Select js -->
<script src="{{ asset('theme/user/js/jquery.nice-select.min.js') }}"></script>
<!-- ScrollUp js -->
<script src="{{ asset('theme/user/js/scrollUp.min.js') }}"></script>
<!-- Main/Activator js -->
<script src="{{ asset('theme/user/js/main.js') }}"></script>
<script src="{{ asset('js/loadingoverlay.min.js') }}"></script>


<script>
    $(document).ready(function () {
        $('#cart-icon').click(function () {
            window.location.replace(@json(route('web.list.product.cart')));
        });
    });

    function formatVnd(num) {
        return num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + 'đ';
    }
</script>

@yield('js')
</body>

<!-- index-231:38-->
</html>
