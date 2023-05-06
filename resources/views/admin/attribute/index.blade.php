@extends('layouts.master_admin')
@section('content')
    <div class="pagetitle">
        <h1>Danh sách thuộc tính</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Danh sách</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <a href="{{ route('admin.attributes.create') }}" class="btn btn-primary mb-2">Thêm thuộc tính</a>
    <table class="table table-bordered border border-primary">
        <tr>
            <th>ID</th>
            <th>Tên thuộc tính</th>
            <th>Action</th>
        </tr>
        @foreach($listAttribute as $attribute)
            <tr>
                <td>{{ $attribute->id }}</td>
                <td>{{ $attribute->name }}</td>
                <td>
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="{{ route('admin.attributes.edit', $attribute->id) }}" class="btn btn-success btn-sm rounded-0"><i class="bi bi-pencil"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <form action="{{ route('admin.attributes.destroy', $attribute->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm rounded-0"><i class="bi bi-trash"></i></button>
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
