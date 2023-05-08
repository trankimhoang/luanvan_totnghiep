<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $listCategory = Category::all();

        return view('web.home.index', compact('listCategory'));
    }
}
