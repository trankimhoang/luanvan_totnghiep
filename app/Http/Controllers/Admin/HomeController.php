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

        $listOrder = Order::with(['Products'])->where('status', '=', 'SUCCESS')->get();
        foreach ($listOrder as $order){
            $total += $order->total();
        }

        $totalUser = User::all()->count();

        $totalProductActive = Product::where('status', '=', 1)->count();

        $totalCategory = Category::all()->count();


        $listOrderOfMonthData = [];
        $listOrderMoneyOfMonthData = [];
        $listOrderOfMonth = Order::with(['Products'])
            ->whereYear('created_at', '=', Carbon::now()->year)
            ->get();

        foreach ($listOrderOfMonth as $item) {
            if (empty($listOrderOfMonthData[Carbon::parse($item->created_at)->format('m')])) {
                $listOrderOfMonthData[Carbon::parse($item->created_at)->format('m')] = 1;
            } else {
                $listOrderOfMonthData[Carbon::parse($item->created_at)->format('m')]++;
            }

            if ($item->status == 'SUCCESS') {
                if (empty($listOrderMoneyOfMonthData[Carbon::parse($item->created_at)->format('m')])) {
                    $listOrderMoneyOfMonthData[Carbon::parse($item->created_at)->format('m')] = $item->total();
                } else {
                    $listOrderMoneyOfMonthData[Carbon::parse($item->created_at)->format('m')] += $item->total();
                }
            }
        }

        return view('admin.home.index', compact('sumOrderSuccess', 'total', 'totalUser', 'totalProductActive', 'totalCategory', 'listOrderOfMonthData', 'listOrderMoneyOfMonthData'));
    }
}
