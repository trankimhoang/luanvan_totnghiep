<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CheckoutRequest;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
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
        $dataOrder['created_at'] = Carbon::now();
        $dataOrder['id'] = time() + rand(1111, 9999999);
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

        // payment momo
        if (!empty($dataOrder['payment_type']) && strtoupper($dataOrder['payment_type']) == 'MOMO') {
            $payUrlMomo = createPayUrlMomo($orderId, totalMoneyOrder($orderId));

            if (!empty($payUrlMomo)) {
                return redirect()->to($payUrlMomo);
            }
        }

        return redirect()->route('web.order_detail', $orderId)->with('success', 'Đặt hàng thành công');
    }

    public function momoReturn(Request $request) {
        $orderId = $request->get('orderId');
        $orderId = explode('_', $orderId);
        $orderId = $orderId[0] ?? null;
        $payType = $request->get('payType');

        if (!empty($orderId)) {
            if (!empty($payType)) {
                DB::table('orders')
                    ->where('id', '=', $orderId)
                    ->update([
                        'payment_status' => 'PAID',
                        'payment_response' => json_encode($request->toArray())
                    ]);
                return redirect()->route('web.order_detail', $orderId)->with('success', 'Thanh toán thành công');
            }
        }

        DB::table('orders')
            ->where('id', '=', $orderId)
            ->update([
                'payment_response' => json_encode($request->toArray())
            ]);

        return redirect()->route('web.order_detail', $orderId)->with('error', $request->get('message') ?? '');
    }

    public function success() {
        return view('web.order.success');
    }

    public function error() {
        return view('web.order.error');
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

    public function listOrderOfUser() {
        $listOrder = Order::orderBy('created_at', 'desc')->where('user_id', Auth::guard('web')->user()->id)->paginate(10);

        return view('web.order.index', compact('listOrder'));
    }

    public function orderDetail(Request $request, int $id) {
        $order = Order::where('user_id', Auth::guard('web')->user()->id)->find($id);

        if (!$order) {
            abort(404);
        }

        return view('web.order.detail', compact('order'));
    }

    public function updateStatusOrder(Request $request, int $id) {
        $order = Order::where('user_id', Auth::guard('web')->user()->id)->find($id);

        if (!$order) {
            abort(404);
        }

        if (!empty($request->get('status'))) {
            if ($request->get('status') == 'REFUND' && $order->status == 'SUCCESS') {
                if (!empty($order->success_at) && getDayFromDateToDate($order->success_at, \Carbon\Carbon::now()) <= 7) {
                    $listProductIdToQuantityInOrder = DB::table('order_products')
                        ->where('order_id', $id)
                        ->get()
                        ->mapWithKeys(function ($item) {
                            return [$item->product_id => $item->quantity];
                        })->toArray();

                    foreach ($listProductIdToQuantityInOrder as $productId => $quantity) {
                        $productUpdate = Product::find($productId);
                        $productUpdate->quantity += $quantity;
                        $productUpdate->save();
                    }

                    $order->status = $request->get('status');
                    $order->save();
                }
            } else {
                $order->status = $request->get('status');
                $order->save();
            }
        }

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }
}
