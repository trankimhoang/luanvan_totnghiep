<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $listCategory = Category::all();
        $listProduct = Product::where('parent_id', '=', null)->where('status', '=', 1)->get();
        $listBanner = Banner::where('status', 1)->get();
        return view('web.home.index', compact('listCategory', 'listProduct', 'listBanner'));
    }

    public function search(Request $request){
        $search = $request->get('search');
        $listCategory = Category::all();
        $listProduct = Product::where('name', 'like', '%' . $search . '%')->get();

        return view('web.search.index', compact('search', 'listProduct', 'listCategory'));
    }

    public function about() {
        return view('web.about.index');
    }

    public function contact() {
        return view('web.contact.index');
    }
}
