<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CheckoutRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function createOrder(CheckoutRequest $request) {
        $user = Auth::guard('web')->user();
        $dataOrder = $request->except(['list_product', '_token']);
        $listProductRequest = $request->get('list_product');
        $listProduct = Product::whereIn('id', array_column($listProductRequest, 'id'))->get();
        $dataOrder['user_id'] = $user->id;
        $orderProductInsert = [];
        $orderId = DB::table('orders')->insertGetId($dataOrder);

        foreach ($listProduct as $product) {
            if (!empty($listProductRequest[$product->id]['quantity'])) {
                $orderProductInsert[] = [
                    'order_id' => $orderId,
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'quantity' => $listProductRequest[$product->id]['quantity']
                ];
            }
        }

        if (!empty($orderProductInsert)) {
            DB::table('order_products')->insert($orderProductInsert);
            DB::table('carts')->whereIn('product_id', array_column($listProductRequest, 'id'))
                ->where('user_id', '=', $user->id)
                ->delete();
        }

        return redirect()->route('web.success.order');
    }

    public function success() {
        return view('web.order.success');
    }

    public function checkOut(Request $request) {
        $listProductRequest = $request->get('list_product');
        $listProduct = Product::whereIn('id', array_column($listProductRequest, 'id'))->get();

        $total = 0;
        foreach ($listProduct as $product){
            if (!empty($listProductRequest[$product->id]['quantity'])){
                $total += $product->price * $listProductRequest[$product->id]['quantity'];
            }
        }

        return view('web.checkout.index', compact('listProductRequest', 'listProduct', 'total'));
    }
}
