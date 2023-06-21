@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Chỉnh sửa thuộc tính</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Chỉnh sửa</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.attributes.index') }}">Danh sách</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.attributes.update', $attribute->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('admin.attribute._list_field')
    </form>
@endsection

