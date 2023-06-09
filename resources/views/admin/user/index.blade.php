@extends('layouts.master_admin')

@section('search')
    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="GET" action="{{ route('admin.users.index') }}">
            <input type="text" name="search" placeholder="Tìm kiếm" value="{{ request()->get('search') ?? '' }}">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Danh sách khách hàng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Danh sách</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Tổng quan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <table class="table table-bordered border border-primary" style="text-align: center">
        <tr>
            <th>ID</th>
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        @foreach($listUser as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ mapStatusUser($user->status) }}</td>
                <td>
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-success btn-sm rounded-0"><i class="bi bi-pencil"></i></a>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
    <div>{{ $listUser->appends(request()->input())->links() }}</div>
@endsection
