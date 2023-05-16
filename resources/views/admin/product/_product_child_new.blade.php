<tr>
    <td>
        @if(!empty($isOld))
            {{ $productIdNew }}
        @endif
    </td>
    <td>
        <div class="product-child-list-attr" data-id="{{ $productIdNew }}">
        </div>
    </td>
    <td>
        <input type="text" class="form-control"
               name="list_product_child_new[{{ $productIdNew }}][price]">
    </td>
    <td>
        <input type="text" class="form-control"
               name="list_product_child_new[{{ $productIdNew }}][quantity]">
    </td>
    <td>
        <button type="button"
                data-id=""
                class="btn btn-danger btn-delete-product-child">
            <i class="bi bi-trash"></i>
        </button>
    </td>
</tr>
