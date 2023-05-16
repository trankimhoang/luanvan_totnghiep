@if(!empty($listAttribute))
    @foreach($listAttribute as $attribute)
        <div class="form-group pt-3">
            <label for="name">{{ $attribute->name }} @include('admin.include.required_icon')</label>
            <input type="text" name="list_attr_value[{{ $attribute->id }}]" value="{{ $listAttributeValue[$attribute->id] ?? '' }}" class="form-control">
        </div>
    @endforeach
@endif

