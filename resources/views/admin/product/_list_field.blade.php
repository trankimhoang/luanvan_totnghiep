<input type="hidden" id="id" name="id" value="{{ $product->id ?? '' }}">

<div class="form-group pt-3">
    <label for="name">Tên sản phẩm @include('admin.include.required_icon')</label>
    <input type="text" name="name" class="form-control" value="{{ $product->name ?? '' }}">
    <p class="alert alert-danger tag-error" id="name-error"></p>
</div>

<div class="form-group pt-3">
    <label for="category_id">Chuyên mục @include('admin.include.required_icon')</label>
    <select name="category_id" class="form-control form-select">
        <option value="">---</option>
        @foreach($listCategory as $category)
            @if(!empty($product->category_id) && $category->id == $product->category_id)
                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
            @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
        @endforeach
    </select>
    <p class="alert alert-danger tag-error" id="category_id-error"></p>
</div>

<div class="form-group pt-3">
    <label for="category_id">Thuộc tính @include('admin.include.required_icon')</label>
    <select class="js-example-basic-multiple form-control form-select" name="list_attr[]" multiple="multiple" id="list_attribute">
        @foreach($listAttr as $attr)
            @if(!empty($listAttributeIdSelected) && in_array($attr->id, $listAttributeIdSelected) !== false)
                <option value="{{ $attr->id }}" selected>{{ $attr->name }} [@if($attr->is_private) Riêng @else Chung @endif]</option>
            @else
                <option value="{{ $attr->id }}">{{ $attr->name }} [@if($attr->is_private) Riêng @else Chung @endif]</option>
            @endif
        @endforeach
    </select>
</div>

<h4 class="mb-0 mt-4">Danh sách thuộc tính chung</h4>
<div id="div_list_attribute" class="mt-0 mb-5 border p-2 pb-4">
</div>

<h4 class="mb-0 mt-2">Danh sách thuộc tính riêng</h4>
<div class="mt-0 border p-2">
    <table class="table table-bordered border border-primary mt-2" id="table-product-child">
        <tr class="text-center">
            <th>STT</th>
            <th>ID</th>
            <th>Thuộc tính @include('admin.include.required_icon')</th>
            <th>Giá bán @include('admin.include.required_icon')</th>
            <th>Số lượng @include('admin.include.required_icon')</th>
            <th>Hành động</th>
        </tr>

        @php
            if ($listAttr) {
                $listAttr = $listAttr->toArray();
            } else {
                $listAttr = [];
            }
        @endphp


        @if(!empty($product))
            @foreach($product->listProductChild as $productChild)
                @include('admin.product._product_child_new', ['productIdNew' => $productChild->id, 'productChild' => $productChild])
            @endforeach
        @endif
    </table>

    <div id="div-error-product-child-attr">

    </div>

    <div style="text-align: right;">
        <button type="button" class="btn btn-primary" id="btn-add-product-child-new">
            <i class="bi bi-plus"></i>
        </button>
    </div>
</div>



<div class="form-group pt-3">
    <label for="content">Mô tả</label>
    <textarea name="description" cols="30" rows="10" class="form-control">{{ $product->description ?? '' }}</textarea>
    <p class="alert alert-danger tag-error" id="description-error"></p>
</div>

<div class="form-group pt-3">
    <label for="email">Giá bán @include('admin.include.required_icon')</label>
    <input type="text" name="price" class="form-control" value="{{ $product->price ?? '' }}">
    <p class="alert alert-danger tag-error" id="price-error"></p>
</div>

<div class="form-group pt-3">
    <label for="password">Số lượng @include('admin.include.required_icon')</label>
    <input type="text" name="quantity" class="form-control" value="{{ $product->quantity ?? '' }}">
    <p class="alert alert-danger tag-error" id="quantity-error"></p>
</div>

<div class="form-group pt-3">
    <img src="" width="256px" class="img-preview">
    <label for="image">Ảnh sản phẩm</label>
    <input type="file" name="image" id="image" class="form-control">
    @if(!empty($product) && !empty($product->getImage()))
        <img src="{{ $product->getImage() }}" alt="" width="128px">
    @endif
    <p class="alert alert-danger tag-error" id="image-error"></p>
</div>

<div class="form-group pt-3">
    <label for="status">Trạng thái: @include('admin.include.required_icon')</label>
    <select class="form-group p-lg-2" name="status">
        <option value="1" @if(!empty($product) && $product->status == 1) selected @endif>On</option>
        <option value="0" @if(!empty($product) && $product->status == 0) selected @endif>Off</option>
    </select>
    <p class="alert alert-danger tag-error" id="status-error"></p>
</div>