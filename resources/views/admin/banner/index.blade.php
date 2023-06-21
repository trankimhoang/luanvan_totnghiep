@extends('layouts.master_admin')
@section('content')
    <div class="pagetitle">
        <h1>Danh sách banner</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Danh sách</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Tổng quan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary mb-2">Thêm banner</a>
    <table class="table table-bordered border border-primary" style="text-align: center">
        <tr>
            <th>ID</th>
            <th>Banner</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        @foreach($listBanner as $banner)
            <tr>
                <td>{{ $banner->id }}</td>
                <td>
                    <img src="{{ $banner->getImage() }}" alt="" width="128px" style="text-align: center">
                </td>
                <td>
                    {{ mapStatusBanner($banner->status) }}
                </td>
                <td>
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-success btn-sm rounded-0"><i class="bi bi-pencil"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm rounded-0 btn-delete-index" data-id="{{ $banner->id }}"><i class="bi bi-trash"></i></button>
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
