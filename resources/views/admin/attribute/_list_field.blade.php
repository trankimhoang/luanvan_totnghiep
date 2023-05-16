<div class="form-group">
    <label for="name">Tên thuộc tính @include('admin.include.required_icon')</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $attribute->name ?? '') }}">
    @error('name')
    <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="name">Là thuộc tính riêng</label>
    <input type="checkbox" name="is_private" value="1" @if(!empty($attribute) && !empty($attribute->is_private)) checked @endif>
    @error('is_private')
    <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group pt-3">
    <button type="submit" class="btn btn-primary">Lưu</button>
</div>
