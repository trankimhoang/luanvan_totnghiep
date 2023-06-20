<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $sumOrderSuccess = DB::table('orders')->where('status', '=', 'SUCCESS')->count();

        $total = 0;

        $listOrder = Order::where('status', '=', 'SUCCESS')->get();
        foreach ($listOrder as $order){
            $total += $order->total();
        }

        $totalUser = User::all()->count();

        $totalProductActive = Product::where('status', '=', 1)->count();

        $totalCategory = Category::all()->count();


        $listOrderOfMonthData = [];
        $listOrderOfMonth = DB::table('orders')
            ->whereYear('created_at', '=', Carbon::now()->year)
            ->get();

        foreach ($listOrderOfMonth as $item) {
            if (empty($listOrderOfMonthData[Carbon::parse($item->created_at)->format('m')])) {
                $listOrderOfMonthData[Carbon::parse($item->created_at)->format('m')] = 1;
            } else {
                $listOrderOfMonthData[Carbon::parse($item->created_at)->format('m')]++;
            }
        }


        return view('admin.home.index', compact('sumOrderSuccess', 'total', 'totalUser', 'totalProductActive', 'totalCategory', 'listOrderOfMonthData'));
    }
}
