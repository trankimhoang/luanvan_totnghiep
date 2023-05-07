<tr>
    <td></td>
    <td>
        @foreach($listAttr as $attr)
            <div class="row mb-2">
                <div class="col-4">
                    <label for="">{{ $attr['name'] ?? '' }}</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control"
                           name="list_product_child_new[{{ $productIdNew }}][list_attr][{{ $attr['id'] ?? '' }}]">
                </div>
            </div>
        @endforeach
    </td>
    <td>
        <input type="text" class="form-control"
               name="list_product_child_new[{{ $productIdNew }}][price]">
    </td>
    <td>
        <input type="text" class="form-control"
               name="list_product_child_new[{{ $productIdNew }}][price_new]">
    </td>
    <td>
        <input type="text" class="form-control"
               name="list_product_child_new[{{ $productIdNew }}][quantity]">
    </td>
    <td>
        <button type="button" class="btn btn-danger">
            <i class="bi bi-trash"></i>
        </button>
    </td>
</tr>
