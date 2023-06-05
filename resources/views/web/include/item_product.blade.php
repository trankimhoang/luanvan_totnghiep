<div class="col-lg-{{ $colNum ?? 12 }}">
    <!-- single-product-wrap start -->
    <div class="single-product-wrap">
        <div class="product-image">
            <a href="{{ route('web.detail', $product->id) }}">
                <img src="{{ $product->getImage() }}"
                     alt="Li's Product Image">
            </a>
            <span class="sticker">Mới</span>
        </div>
        <div class="product_desc">
            <div class="product_desc_info">
                <div class="product-review">
                    <h5 class="manufacturer">
                        <a href="{{ route('web.detail', $product->id) }}">{{ $product->Category->name ?? '' }}</a>
                    </h5>
                </div>
                <h4><a class="product_name"
                       href="{{ route('web.detail', $product->id) }}">{{ $product->name }}</a></h4>
                <div class="price-box">
                    <span class="new-price">{{ formatVnd($product->getPrice()) }}</span>
                </div>
            </div>
            <div class="add-actions">
                <ul class="add-actions-link">
                    <li class="add-cart active"><a href="{{ route('web.detail', $product->id) }}">Xem ngay</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- single-product-wrap end -->
</div>
