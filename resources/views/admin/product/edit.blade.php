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

        @include('admin.product._list_field')

        <table class="table table-bordered border border-primary mt-2" id="table-product-child">
            <tr>
                <th>ID</th>
                <th>Thuộc tính @include('admin.include.required_icon')</th>
                <th>Giá bán @include('admin.include.required_icon')</th>
                <th>Giá KM</th>
                <th>Số lượng @include('admin.include.required_icon')</th>
                <th>Action</th>
            </tr>

            @php
                $listAttr = $listAttr->toArray();
            @endphp


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
    <style>
        .tag-error {
            margin-top: 10px;
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
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
        });
    </script>
    @include('admin.product._js')
@endsection
