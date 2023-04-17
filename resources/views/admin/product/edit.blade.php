@extends('layouts.master_admin')

@section('content')
    <form action="{{ route('admin.products.update', $product->id) }}" method="post">
        @csrf
        @method('put')
        @foreach($product->listProductChild as $productChild)
            <div class="border-bottom border-primary mb-5">
                <div class="form-group">
                    <label for="">{{ __('Name') }}</label>
                    <input type="text" name="list_product_child[{{ $productChild->id }}][name]" class="form-control" value="{{ $productChild->name }}">
                </div>
                <div class="form-group">
                    <label for="">{{ __('Quantity') }}</label>
                    <input type="text" name="list_product_child[{{ $productChild->id }}][quantity]" class="form-control" value="{{ $productChild->quantity }}">
                </div>
                <div class="form-group">
                    <label for="">{{ __('Price') }}</label>
                    <input type="text" name="list_product_child[{{ $productChild->id }}][price]" class="form-control" value="{{ $productChild->price }}">
                </div>

                @foreach($productChild->listAttribute as $attr)
                    <div class="form-group">
                        <label for="">{{ $attr->name }}</label>
                        <input type="text" name="list_product_child[{{ $productChild->id }}][list_attr][{{ $attr->id }}]" class="form-control" value="{{ $attr->pivot->text_value }}">
                    </div>
                @endforeach
            </div>

        @endforeach
        <div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
@endsection
