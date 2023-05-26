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
                                @foreach($listCategory as $categoryItem)
                                    <li><a href="{{ route('web.detail.category', $categoryItem->id) }}">{{ $categoryItem->name }}</a></li>
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
                        <div id="demo" class="carousel slide" data-ride="carousel">

                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                @foreach($listBanner as $key => $banner)
                                    @if($key == 0)
                                        <li data-target="#demo" data-slide-to="{{ $key }}" class="active"></li>
                                    @else
                                        <li data-target="#demo" data-slide-to="{{ $key }}"></li>
                                    @endif
                                @endforeach

                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                @foreach($listBanner as $key => $banner)
                                    @if($key == 0)
                                        <div class="carousel-item active">
                                            <img src="{{ $banner->getImage() }}" alt="" width="1100" height="500">
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <img src="{{ $banner->getImage() }}" alt="" width="1100" height="500">
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Slider Area End Here -->
            </div>
        </div>
    </div>

    @include('web.include.attr_search')

    <section class="product-area li-laptop-product Special-product pt-60 pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>{{ $category->name }}</span>
                        </h2>
                    </div>
                    <div class="row">
                        @foreach($listProduct as $product)
                            @include('web.include.item_product_search')
                        @endforeach
                    </div>
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
@endsection
