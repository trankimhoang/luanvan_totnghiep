<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function listProduct() {
        $listProduct = Product::query()->where('parent_id', '=', null)->get();
        return view('admin.product.list', compact('listProduct'));
    }
}
