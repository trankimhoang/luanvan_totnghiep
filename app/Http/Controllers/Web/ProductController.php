<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($id){
        $product = Product::with(['listProductChild', 'listImage'])->find($id);
        $listImage = $product->listImage;

        return view('web.product.detail', compact('product', 'listImage'));
    }
}
