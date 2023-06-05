<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(){
        $listOrder = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.order.index', compact('listOrder'));
    }

    public function edit($id) {
        $order = Order::find($id);
        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request, $id){
        $order = Order::find($id);

        if (!empty($request->get('status'))){
            $order->status = $request->get('status');
        }

        if (!empty($request->get('payment_status'))){
            $order->payment_status = $request->get('payment_status');
        }

        if ($request->get('admin_note') !== null) {
            $order->admin_note = $request->get('admin_note');
        }

        if ($request->get('ship_code') !== null) {
            $order->ship_code = $request->get('ship_code');
        }

        if ($order->status == 'SUCCESS') {
            $order->success_at = Carbon::now();
            $order->payment_status = 'PAID';
        }

        $order->save();

        return redirect()->route('admin.orders.edit', $id)->with('success', 'Cập nhật thành công');
    }
}
