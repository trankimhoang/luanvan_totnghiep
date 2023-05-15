@foreach($listAttribute as $attribute)
    <div class="form-group pt-3">
        <label for="name">{{ $attribute->name }} @include('admin.include.required_icon')</label>
        <input type="text" name="name" class="form-control">
{{--        <p class="alert alert-danger tag-error" id="name-error"></p>--}}
    </div>
@endforeach
