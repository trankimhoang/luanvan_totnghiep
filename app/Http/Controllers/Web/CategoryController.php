<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryDetail(Request $request, $id){
        $listCategory = Category::all();
        $category = Category::find($id);
        $listProduct = $category->products;
        return view('web.category.detail', compact('category', 'listProduct', 'listCategory'));
    }
}
