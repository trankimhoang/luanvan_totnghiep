<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $listCategory = Category::all();
        $listProduct = Product::with(['Category'])->where('parent_id', '=', null)->where('status', '=', 1)->paginate(8);
        $listBanner = Banner::where('status', 1)->get();
        return view('web.home.index', compact('listCategory', 'listProduct', 'listBanner'));
    }

    public function search(Request $request){
        $search = $request->get('search');
        $listCategory = Category::all();

        $listProduct = Product::where('name', 'like', '%' . $search . '%');

        $listProductIdsByAttrSearch = getListProductIdsByAttrSearch();

        if (is_array($listProductIdsByAttrSearch)) {
            $listProduct->whereIn('id', $listProductIdsByAttrSearch);
        }

        $listProductId = $listProduct->pluck('id')->toArray();

        $listProduct = $listProduct->paginate(10);

        $listBanner = Banner::where('status', 1)->get();

        return view('web.search.index', compact('search', 'listProduct', 'listCategory', 'listBanner', 'listProductId'));
    }

    public function about() {
        return view('web.about.index');
    }

    public function contact() {
        return view('web.contact.index');
    }
}
