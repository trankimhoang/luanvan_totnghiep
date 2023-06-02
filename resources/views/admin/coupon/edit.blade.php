@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Sửa khuyến mãi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Sửa</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Tổng quan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.coupon._list_field')
        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary">
                Lưu
            </button>
        </div>
    </form>
@endsection

