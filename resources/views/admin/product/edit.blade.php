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
        @method('PUT')
        <div class="form-group pt-3">
            <label for="name">Tên sản phẩm @include('admin.include.required_icon')</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
            <p class="alert alert-danger tag-error" id="name-error"></p>
        </div>

        <div class="form-group pt-3">
            <label for="category_id">Loai @include('admin.include.required_icon')</label>
            <select name="category_id" class="form-control form-select">
                <option value="">---</option>
                @foreach($listCategory as $category)
                    @if($category->id == $product->category_id)
                        <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
            <p class="alert alert-danger tag-error" id="category_id-error"></p>
        </div>

        <div class="form-group pt-3">
            <label for="content">Mô tả</label>
            <textarea name="description" cols="30" rows="10" class="form-control">{{ old('description', $product->description) }}</textarea>
            <p class="alert alert-danger tag-error" id="description-error"></p>
        </div>

        <div class="form-group pt-3">
            <label for="email">Giá gốc @include('admin.include.required_icon')</label>
            <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}">
            <p class="alert alert-danger tag-error" id="price-error"></p>
        </div>

        <div class="form-group pt-3">
            <label for="email">Giá sau KM</label>
            <input type="text" name="price_new" class="form-control" value="{{ old('price_new', $product->price_new) }}">
            <p class="alert alert-danger tag-error" id="price_new-error"></p>
        </div>

        <div class="form-group pt-3">
            <label for="password">Số lượng @include('admin.include.required_icon')</label>
            <input type="text" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}">
            <p class="alert alert-danger tag-error" id="quantity-error"></p>
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
            <p class="alert alert-danger tag-error" id="image-error"></p>
        </div>

        <div class="form-group pt-3">
            <label for="status">Trạng thái: @include('admin.include.required_icon')</label>
            <select class="form-group p-lg-2" name="status">
                <option value="1" @if($product->status == 1) selected @endif>On</option>
                <option value="0" @if($product->status == 0) selected @endif>Off</option>
            </select>
            <p class="alert alert-danger tag-error" id="status-error"></p>
        </div>

        <table class="table table-bordered border border-primary mt-2" id="table-product-child">
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
                                    <input type="text" class="form-control"
                                           name="list_product_child[{{ $productChild->id }}][list_attr][{{ $attr['id'] ?? '' }}]"
                                           value="{{ $attr['text_value'] ?? '' }}">
                                </div>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <input type="text" class="form-control"
                               name="list_product_child[{{ $productChild->id }}][price]"
                               value="{{ $productChild->price }}">
                    </td>
                    <td>
                        <input type="text" class="form-control"
                               name="list_product_child[{{ $productChild->id }}][price_new]"
                               value="{{ $productChild->price_new }}">
                    </td>
                    <td>
                        <input type="text" class="form-control"
                               name="list_product_child[{{ $productChild->id }}][quantity]"
                               value="{{ $productChild->quantity }}">
                    </td>
                    <td>
                        <button type="button"
                                data-id="{{ $productChild->id }}"
                                class="btn btn-danger btn-delete-product-child">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>

        <div style="text-align: right;">
            <button type="button" class="btn btn-primary" id="btn-add-product-child-new">
                <i class="bi bi-plus"></i>
            </button>
        </div>

        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary" form="form-main">Lưu</button>
        </div>
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#image').change(function (event) {
                $(".img-preview").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
            });

            $('body').on('click', '.btn-delete-product-child', function () {
                const id = $(this).attr('data-id');

                if (id !== '') {
                    $('#form-main').append(`<input type="hidden" value="${id}" name="product_child_id_delete[]">`);
                }

                $(this).parents('tr').remove();
            });

            $('#btn-add-product-child-new').click(function () {
                $.LoadingOverlay('show');

                $.ajax({
                    url: @json(route('admin.products.render-product-child-new-row')),
                    method: 'GET',
                    success: function (html) {
                        $.LoadingOverlay('hide');
                        $('#table-product-child').append(html);
                    }
                })
            });

            $('.tag-error').hide();

            $('#form-main').submit(function (event) {
                event.preventDefault();
                const data = $(this).serializeArray();
                $('.tag-error').hide();
                $.LoadingOverlay('show');
                console.log(data);

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: data,
                    success: function (data) {
                        $.LoadingOverlay('hide');
                        if (data.hasOwnProperty('success') && data.success && data.hasOwnProperty('url')) {
                            window.location.replace(data.url);
                        } else if (data.hasOwnProperty('mgs')) {
                            alert(data.mgs);
                        }
                    },
                    error: function (data) {
                        $.LoadingOverlay('hide');
                        if (data.hasOwnProperty('responseJSON')) {
                            const dataError = data.responseJSON.errors;

                            Object.entries(dataError).forEach(entry => {
                                const [key, value] = entry;
                                const elementError = $('#' + key + '-error');
                                elementError.show();
                                elementError.text(value[0] ?? '');
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
