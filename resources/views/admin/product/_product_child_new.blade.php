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
                    {{ $productIdNew }}
                @else
                    <span class="text-danger">Mới</span>
                @endif
            </div>
        </div>
    </td>
    <td>
        <div class="product-child-list-attr" data-id="{{ $productIdNew }}" data-is-old="{{ !empty($productChild) ? 1 : 0 }}">
        </div>
    </td>
    <td>
        <input type="text" class="form-control"
               name="{{ $nameInput }}[{{ $productIdNew }}][price]"
               value="{{ $productChild->price ?? '' }}">
    </td>
    <td>
        <input type="text" class="form-control"
               name="{{ $nameInput }}[{{ $productIdNew }}][quantity]"
               value="{{ $productChild->quantity ?? '' }}">
    </td>
    <td class="text-center">
        <button type="button"
                @if(!empty($productChild))
                    data-id="{{ $productIdNew }}"
                @endif
                class="btn btn-danger btn-delete-product-child">
            <i class="bi bi-trash"></i>
        </button>
    </td>
</tr>
