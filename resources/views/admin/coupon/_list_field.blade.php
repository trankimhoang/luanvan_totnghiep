<div class="form-group pt-3">
    <label for="name">Tên mã khuyến mãi @include('admin.include.required_icon')</label>
    <input type="text" name="name" class="form-control" value="{{ $coupon->name ?? '' }}">
    @error('name')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>


<div class="form-group pt-3">
    <label for="name">Loại khuyến mãi @include('admin.include.required_icon')</label>

    <select name="type" class="form-control form-select" @if(!empty($coupon)) disabled @endif>
        @foreach(getListCouponType() as $key => $value)
            @if(!empty($coupon) && $coupon->type == $key)
                <option selected value="{{ $key }}">{{ $value }}</option>
            @else
                <option value="{{ $key }}">{{ $value }}</option>
            @endif
        @endforeach
    </select>

    @error('type')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group pt-3">
    <label for="name">Số tiền/phần trăm khuyến mãi @include('admin.include.required_icon')</label>
    <input type="text" name="discount" class="form-control" value="{{ $coupon->discount ?? '' }}">
    @error('discount')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group pt-3">
    <label for="name">Số tiền giảm tối đa</label>
    <input type="text" name="discount_max" class="form-control" value="{{ $coupon->discount_max ?? '' }}">
    @error('discount_max')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group pt-3">
    <label for="name">Số lần sử dụng</label>
    <input type="text" name="number_use" class="form-control" @if(!empty($coupon)) disabled @endif value="{{ $coupon->number_use ?? '' }}">
    @if(!empty($coupon))
        <p>Còn lại: {{ getNumberUseFreeCoupon($coupon->id) }} </p>
    @endif
    @error('number_use')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group pt-3">
    <label for="name">Ngày bắt đầu</label>
    <input type="date" name="start" class="form-control" value="{{ $coupon->start ?? '' }}">
    @error('start')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group pt-3">
    <label for="name">Ngày kết thúc</label>
    <input type="date" name="end" class="form-control" value="{{ $coupon->end ?? '' }}">
    @error('end')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>



