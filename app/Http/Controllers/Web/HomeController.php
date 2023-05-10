<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $listCategory = Category::all();
        $listProduct = Product::where('parent_id', '=', null)->where('status', '=', 1)->all();

        return view('web.home.index', compact('listCategory', 'listProduct'));
    }
}
