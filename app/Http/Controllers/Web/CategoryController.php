<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryDetail(Request $request, $id){
        $listCategory = Category::all();
        $category = Category::find($id);
        $listProduct = Product::with(['Category'])->where('category_id', $id);
        $listProductIdsByAttrSearch = getListProductIdsByAttrSearch();

        if (!empty($listProductIdsByAttrSearch)) {
            $listProduct->whereIn('id', $listProductIdsByAttrSearch);
        }
        $listProductId = $listProduct->pluck('id')->toArray();
        $listProduct = $listProduct->paginate(10);
        $listBanner = Banner::where('status', 1)->get();

        return view('web.category.detail', compact('category', 'listProduct', 'listCategory', 'listBanner', 'listProductId'));
    }
}
