@if(!empty($listAttribute))
    @foreach($listAttribute as $attribute)
        <div class="form-group row">
            <div class="col-5">
                <label for="name">{{ $attribute->name }} @include('admin.include.required_icon')</label>
            </div>
            <div class="col-7">
                <input type="text" name="[list_attr][{{ $attribute->id }}]" value="" class="form-control">
            </div>
        </div>
    @endforeach
@endif

