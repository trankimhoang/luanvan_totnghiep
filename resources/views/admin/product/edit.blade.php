@extends('layouts.master_admin')

@section('content')
    <div class="pagetitle">
        <h1>Sửa sản phẩm</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Chỉnh sửa</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="{{ route('admin.products.update', $product->id) }}"
          id="form-main"
          method="post"
          enctype="multipart/form-data">
        @csrf
        <div class="form-group pt-3">
            <label for="name">Tên sản phẩm @include('admin.include.required_icon')</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
            @error('name')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="content">Mô tả</label>
            <textarea name="description" cols="30" rows="10" class="form-control">{{ old('description', $product->description) }}</textarea>
            @error('description')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="email">Giá gốc @include('admin.include.required_icon')</label>
            <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}">
            @error('price')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="email">Giá sau KM</label>
            <input type="text" name="price_new" class="form-control" value="{{ old('price_new', $product->price_new) }}">
            @error('price_new')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="password">Số lượng @include('admin.include.required_icon')</label>
            <input type="text" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}">
            @error('quantity')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <img src="" width="256px" class="img-preview">
            <label for="image">Ảnh sản phẩm</label>
            <input type="file" name="image" id="image" class="form-control">
            @if(!empty($product->getImage()))
                <img src="{{ $product->getImage() }}" alt="" width="128px">
            @endif
            @error('image')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group pt-3">
            <label for="status">Trạng thái: @include('admin.include.required_icon')</label>
            <select class="form-group p-lg-2" name="status">
                <option value="1" @if($product->status == 1) selected @endif>On</option>
                <option value="0" @if($product->status == 0) selected @endif>Off</option>
            </select>
        </div>
    </form>

    <table class="table table-bordered border border-primary mt-2">
        <tr>
            <th>ID</th>
            <th>Thuộc tính @include('admin.include.required_icon')</th>
            <th>Giá gốc @include('admin.include.required_icon')</th>
            <th>Giá sau KM</th>
            <th>Số lượng @include('admin.include.required_icon')</th>
            <th>Action</th>
        </tr>

        @foreach($product->listProductChild as $productChild)
            <tr>
                <td>{{ $productChild->id }}</td>
                <td>
                    @php
                        if (!empty($listAttr) && !empty($productChild->listAttribute)) {
                            $productChildAttr = $productChild->listAttribute->mapWithKeys(function ($item){
                                return [$item->pivot->attribute_id => $item->pivot->text_value];
                            })->toArray();

                            foreach ($listAttr as &$attrChange) {
                                if (!empty($attrChange['id']) && !empty($productChildAttr[$attrChange['id']])) {
                                    $attrChange['text_value'] = $productChildAttr[$attrChange['id']];
                                } else {
                                    unset($attrChange['text_value']);
                                }
                            }
                        }
                    @endphp

                    @foreach($listAttr as $attr)
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="">{{ $attr['name'] ?? '' }}</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" value="{{ $attr['text_value'] ?? '' }}">
                            </div>
                        </div>
                    @endforeach
                </td>
                <td>
                    <input type="text" class="form-control" value="{{ $productChild->price }}">
                </td>
                <td>
                    <input type="text" class="form-control" value="{{ $productChild->price_new }}">
                </td>
                <td>
                    <input type="text" class="form-control" value="{{ $product->quantity }}">
                </td>
                <td>
                    <button type="button" class="btn btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </table>


    <div class="form-group pt-3">
        <button type="submit" class="btn btn-primary" form="#form-main">Lưu</button>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#image').change(function (event) {
                $(".img-preview").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
            });
        });
    </script>
@endsection
