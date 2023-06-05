<tr>
    @php
        $nameInput = 'list_product_child_new';

        if (!empty($productChild)) {
            $nameInput = 'list_product_child';
        }
    @endphp
    <td class="text-center" valign="middle">
        <div class="form-group row mb-2 align-items-center">
            <div class="col-12">
                <span class="stt">1</span>
            </div>
        </div>
    </td>

    <td class="text-center" valign="middle">
        <div class="form-group row mb-2 align-items-center">
            <div class="col-12">
                @if(!empty($productChild))
                    <span class="text-success">Đã tồn tại</span>
                @else
                    <span class="text-danger">Thêm mới</span>
                @endif
            </div>
        </div>
    </td>
    <td valign="middle">
        <div class="product-child-list-attr" data-id="{{ $productIdNew }}" data-is-old="{{ !empty($productChild) ? 1 : 0 }}">
        </div>
    </td>
    <td valign="middle" class="text-center">
        <div class="row align-items-center">
            <div class="col-5">
                @if(!empty($productChild))
                    <img width="64" src="{{ $productChild->getImage() }}" alt="">
                @endif
            </div>
            <div class="col-7">
                @if(!empty($productChild))
                    <input type="hidden" class="form-control"
                           value="{{ $productChild->id }}"
                           name="{{ $nameInput }}[{{ $productIdNew }}][id]">
                @endif
                <input type="file" class="form-control"
                       name="{{ $nameInput }}[{{ $productIdNew }}][image]">
            </div>
        </div>
    </td>
    <td valign="middle">
        <input type="text" class="form-control product-child-price"
               name="{{ $nameInput }}[{{ $productIdNew }}][price]"
               value="{{ $productChild->price ?? '' }}">
    </td>
    <td valign="middle">
        <input type="text" class="form-control"
               name="{{ $nameInput }}[{{ $productIdNew }}][quantity]"
               value="{{ $productChild->quantity ?? '' }}">
        @if(!empty($productChild))
            <div class="form-group pt-3">
                <p>Số lượng còn lại: {{ $productChild->getQuantityActive() }}</p>
                <p>Số lượng đã bán: {{ $productChild->quantity - $productChild->getQuantityActive() }}</p>
            </div>
        @endif
    </td>
    <td class="text-center" valign="middle">
        <button type="button"
                @if(!empty($productChild))
                    data-id="{{ $productIdNew }}"
                @endif
                class="btn btn-danger btn-delete-product-child">
            <i class="bi bi-trash"></i>
        </button>
    </td>
</tr>
