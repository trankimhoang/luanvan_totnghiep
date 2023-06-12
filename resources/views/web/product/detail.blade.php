@extends('layouts.master_user')

@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('web.index') }}">Home</a></li>
                    <li class="active">Chi tiết sản phẩm</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row single-product-area">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images slider-navigation-1">
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item"
                                   href="{{ $product->getImage() }}"
                                   data-gall="myGallery">
                                    <img src="{{ $product->getImage() }}"
                                         alt="product image">
                                </a>
                            </div>

                            @if(!empty($listImage))
                                @foreach($listImage as $image)
                                    <div class="lg-image">
                                        <a class="popup-img venobox vbox-item"
                                           href="{{ $image->getImage() }}"
                                           data-gall="myGallery">
                                            <img src="{{ $image->getImage() }}">
                                        </a>
                                    </div>
                                @endforeach
                            @endif

                            @if(!empty($product->listProductChild))
                                @foreach($product->listProductChild as $productChild)
                                    @if($productChild->getImage() != asset('images/not_found.jpg'))
                                        <div class="lg-image">
                                            <a class="popup-img venobox vbox-item"
                                               href="{{ $productChild->getImage() }}"
                                               data-gall="myGallery">
                                                <img src="{{ $productChild->getImage() }}">
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="product-details-thumbs slider-thumbs-1">
                            <div class="sm-image"><img src="{{ $product->getImage() }}"></div>
                            @if(!empty($listImage))
                                @foreach($listImage as $image)
                                    <div class="sm-image"><img src="{{ $image->getImage() }}"></div>
                                @endforeach
                            @endif

                            @if(!empty($product->listProductChild))
                                @foreach($product->listProductChild as $productChild)
                                    @if($productChild->getImage() != asset('images/not_found.jpg'))
                                        <div class="sm-image" data-id="{{ $productChild->id }}"><img src="{{ $productChild->getImage() }}"></div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content pt-60">
                        <div class="product-info">
                            <h2>{{ $product->name }}</h2>
                            <div class="price-box pt-20">
                                <span class="new-price new-price-2" id="product-price">{{ formatVnd($product->price) }}</span>
                            </div>
                            <div class="product-desc">
                                <p>
                                    <span>{{ $product->description }}.</span>
                                </p>
                            </div>

                            @if(!empty($product->listProductChild) && $product->listProductChild->count() > 0)
                                <div class="product-variants">
                                    <div class="produt-variants-size">
                                        <label>Chọn phiên bản</label>
                                        <select class="nice-select" id="product-child-select">
                                            @foreach($product->listProductChild as $productChild)
                                                <option value="{{ $productChild->id }}"
                                                        data-quantity="{{ $productChild->quantity }}"
                                                        data-price="{{ formatVnd($productChild->price) }}">
                                                    {{ $productChild->attributeTitle() }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="single-add-to-cart">
                                <form action="#" class="cart-quantity">
                                    <div class="quantity">
                                        <label>Số lượng</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" value="1" type="text" id="quantity">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </div>
                                    <button @if($product->getQuantityActive() <= 0) disabled @endif class="add-to-cart" type="button">Mua ngay</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
    <!-- Begin Product Area -->
    <section class="product-area li-laptop-product pt-30 pb-50">
        <div class="container">
            <table class="table table-bordered">
                <tr>
                    <th>Mô tả</th>
                    <td>{{ $product->description }}</td>
                </tr>

                @if(!empty($product->listAttribute))
                    @foreach($product->listAttribute as $attr)
                        @if(!empty($attr->pivot->text_value))
                            <tr>
                                <th>{{ $attr->name }}</th>
                                <td>{{ $attr->pivot->text_value }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endif

            </table>
        </div>
    </section>




    <!-- Product Area End Here -->
    <!-- Begin Li's Laptop Product Area -->
    <section class="product-area li-laptop-product pt-30 pb-50">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>Sản phẩm tương tự</span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach($product->getListProductSameCategory() as $productItem)
                                @include('web.include.item_product', ['product' => $productItem])
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Li's Laptop Product Area End Here -->
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#product-child-select').change(function () {
                const price = $(this).find('option:selected').attr('data-price');
                const value = $(this).val();
                const quantity = parseFloat($(this).find('option:selected').attr('data-quantity'));

                if (quantity <= 0) {
                    $('.add-to-cart').prop('disabled', true);
                } else {
                    $('.add-to-cart').prop('disabled', false);
                }

                $('#product-price').text(price);
                $(`.sm-image[data-id='${value}']`).click();
            });
            $('#product-child-select').trigger('change');

            $('.add-to-cart').click(function (){
                let productId = @json($product->id);

                if($('#product-child-select').val() !== undefined) {
                    productId = $('#product-child-select').val();
                }

                $.LoadingOverlay('show');

                $.ajax({
                    data: {
                        product_id: productId,
                        quantity: $('#quantity').val(),
                    },
                    method: 'get',
                    url: @json(route('web.cart.add')),
                    success: function(data){
                        $.LoadingOverlay('hide');

                        if (data.hasOwnProperty('success') && data.success) {
                            $('.cart-item-count').text(data.data.qty);
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công...',
                                text: data.data.message ?? ''
                            });
                        } else {
                            // error
                            if (data.message) {
                                Swal.fire({
                                    icon: 'error',
                                    text: data.message ?? ''
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi...',
                                    text: data.data.message ?? ''
                                });
                            }

                        }
                    }
                });
            });
        });
    </script>
@endsection
