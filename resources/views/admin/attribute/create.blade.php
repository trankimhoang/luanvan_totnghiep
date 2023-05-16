@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Thêm thuộc tính</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Thêm</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.attributes.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.attribute._list_field')
    </form>
@endsection

