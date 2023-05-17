@if(!empty($listAttribute))
    @foreach($listAttribute as $attribute)
        <div class="form-group row mb-2 align-items-center">
            <div class="col-2">
                <label for="name">{{ $attribute->name }} @include('admin.include.required_icon')</label>
            </div>
            <div class="col-10">
                <input type="text" name="[list_attr][{{ $attribute->id }}]" data-id="{{ $attribute->id }}"
                       class="form-control input-attr-product-child">
            </div>
        </div>
    @endforeach
@endif

