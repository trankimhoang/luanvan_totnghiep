@extends('layouts.master_admin')
@section('content')
    <div class="pagetitle">
        <h1>Danh sách quản trị viên</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Danh sách</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary mb-2">Thêm quản trị viên</a>
    <table class="table table-bordered border border-primary">
        <tr>
            <th>ID</th>
            <th>Tên quản trị viên</th>
            <th>Email</th>
            <th>Ảnh đại diện</th>
            <th>Action</th>
        </tr>
        @foreach($listAdmin as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    <img src="{{ $admin->getImage() }}" alt="" width="128px" style="text-align: center">
                </td>
                <td>
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-success btn-sm rounded-0"><i class="bi bi-pencil"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="post">
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
