@extends('layouts.master_admin')
@section('content')
    <form action="{{ route('admin.banners.store') }}" method="post" enctype="multipart/form-data" id="form-main">
        @csrf
        <div class="form-group pt-3">
            <img src="" width="256px" class="img-preview">
            <label for="image">Banner</label>
            <input type="file" name="image" id="image" class="form-control">
                <img src="" alt="" width="128px">
        </div>

        <div class="form-group pt-3">
            <label for="status">Trạng thái:</label>
            <select class="form-group p-lg-2" name="status">
                <option value="1">On</option>
                <option value="0">Off</option>
            </select>
        </div>

        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
@endsection
