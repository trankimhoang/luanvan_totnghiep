@extends('layouts.master_user')
@section('content')
    <div class="slider-with-banner">
        <div class="container">
            <div class="row">
                <!-- Begin Category Menu Area -->
                <div class="col-lg-3">
                    <!--Category Menu Start-->
                    <div class="category-menu">
                        <div class="category-heading">
                            <h2 class="categories-toggle"><span>categories</span></h2>
                        </div>
                        <div id="cate-toggle" class="category-menu-list" style="display: block;">
                            <ul>
                                @foreach($listCategory as $category)
                                    <li><a href="#">{{ $category->name }}</a></li>
                                @endforeach

                                <li class="rx-parent">
                                    <a class="rx-default">More Categories</a>
                                    <a class="rx-show">Less Categories</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--Category Menu End-->
                </div>
                <!-- Category Menu Area End Here -->
                <!-- Begin Slider Area -->
                <div class="col-lg-9">
                    <div class="slider-area pt-sm-30 pt-xs-30">
                        <div class="slider-active owl-carousel owl-loaded owl-drag">
                            <!-- Begin Single Slide Area -->

                            <!-- Single Slide Area End Here -->
                            <!-- Begin Single Slide Area -->

                            <!-- Single Slide Area End Here -->
                            <!-- Begin Single Slide Area -->

                            <!-- Single Slide Area End Here -->
                            <div class="owl-stage-outer owl-height" style="height: 475px;">
                                <div class="owl-stage"
                                     style="transform: translate3d(-2912px, 0px, 0px); transition: all 0.25s ease 0s; width: 5096px;">
                                    <div class="owl-item cloned" style="width: 728px;">
                                        <div class="single-slide align-center-left animation-style-01 bg-5">
                                            <div class="slider-progress"></div>
                                            <div class="slider-content">
                                                <h5>Sale Offer <span>Black Friday</span> This Week</h5>
                                                <h2>Work Desk Surface Studio 2018</h2>
                                                <h3>Starting at <span>$1599.00</span></h3>
                                                <div class="default-btn slide-btn">
                                                    <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 728px;">
                                        <div class="single-slide align-center-left animation-style-02 bg-6">
                                            <div class="slider-progress"></div>
                                            <div class="slider-content">
                                                <h5>Sale Offer <span>-10% Off</span> This Week</h5>
                                                <h2>Phantom 4 Pro+ Obsidian</h2>
                                                <h3>Starting at <span>$809.00</span></h3>
                                                <div class="default-btn slide-btn">
                                                    <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 728px;">
                                        <div class="single-slide align-center-left animation-style-02 bg-4">
                                            <div class="slider-progress"></div>
                                            <div class="slider-content">
                                                <h5>Sale Offer <span>-20% Off</span> This Week</h5>
                                                <h2>Chamcham Galaxy S9 | S9+</h2>
                                                <h3>Starting at <span>$589.00</span></h3>
                                                <div class="default-btn slide-btn">
                                                    <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 728px;">
                                        <div class="single-slide align-center-left animation-style-01 bg-5">
                                            <div class="slider-progress"></div>
                                            <div class="slider-content">
                                                <h5>Sale Offer <span>Black Friday</span> This Week</h5>
                                                <h2>Work Desk Surface Studio 2018</h2>
                                                <h3>Starting at <span>$1599.00</span></h3>
                                                <div class="default-btn slide-btn">
                                                    <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item active" style="width: 728px;">
                                        <div class="single-slide align-center-left animation-style-02 bg-6">
                                            <div class="slider-progress"></div>
                                            <div class="slider-content">
                                                <h5>Sale Offer <span>-10% Off</span> This Week</h5>
                                                <h2>Phantom 4 Pro+ Obsidian</h2>
                                                <h3>Starting at <span>$809.00</span></h3>
                                                <div class="default-btn slide-btn">
                                                    <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 728px;">
                                        <div class="single-slide align-center-left animation-style-02 bg-4">
                                            <div class="slider-progress"></div>
                                            <div class="slider-content">
                                                <h5>Sale Offer <span>-20% Off</span> This Week</h5>
                                                <h2>Chamcham Galaxy S9 | S9+</h2>
                                                <h3>Starting at <span>$589.00</span></h3>
                                                <div class="default-btn slide-btn">
                                                    <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 728px;">
                                        <div class="single-slide align-center-left animation-style-01 bg-5">
                                            <div class="slider-progress"></div>
                                            <div class="slider-content">
                                                <h5>Sale Offer <span>Black Friday</span> This Week</h5>
                                                <h2>Work Desk Surface Studio 2018</h2>
                                                <h3>Starting at <span>$1599.00</span></h3>
                                                <div class="default-btn slide-btn">
                                                    <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-nav">
                                <div class="owl-prev"><i class="fa fa-angle-left"></i></div>
                                <div class="owl-next"><i class="fa fa-angle-right"></i></div>
                            </div>
                            <div class="owl-dots">
                                <div class="owl-dot"><span></span></div>
                                <div class="owl-dot"><span></span></div>
                                <div class="owl-dot active"><span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider Area End Here -->
            </div>
        </div>
    </div>
@endsection
