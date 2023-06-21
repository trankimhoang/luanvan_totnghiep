@extends('layouts.master_admin')
@section('content')
    <div class="pagetitle">
        <h1>Thêm sản phẩm</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Thêm</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Danh sách</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.users.update', $user->id) }}" method="post">
        @csrf
        @method('put')

        <input type="hidden" name="id" value="{{ $user->id }}">

        <div class="form-group">
            <label for="name">Tên khách hàng</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" readonly>
        </div>

        <div class="form-group pt-3">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" value="{{ old('email', $user->email) }}" readonly>
        </div>

        <div class="form-group pt-3">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}" readonly>
        </div>

        <div class="form-group pt-3">
            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" readonly>
        </div>

        <div class="form-group pt-3">
            <label for="status">Trạng thái:</label>
            <select class="form-group p-lg-2" name="status">
                <option value="1" @if(!empty($user) && $user->status == 1) selected @endif>Kích hoạt tài khoản</option>
                <option value="0" @if(!empty($user) && $user->status == 0) selected @endif>Khóa tài khoản</option>
            </select>
        </div>

        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>

@endsection
