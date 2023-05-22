<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addCart(Request $request) {
        $productId = $request->get('product_id');
        $userId = Auth::guard('web')->user()->id;
        $quantity = $request->get('quantity') ?? 1;
        $quantityNew = $request->get('quantity_new') ?? null;
        $product = DB::table('products')->where('id', $productId);
        $productExists = $product->exists();

        if (!$productExists) {
            return response()->json([
                'success'=>false,
                'data'=>[
                    'message'=>'Sản phẩm không tồn tại',
                    'qty' => \Illuminate\Support\Facades\Auth::guard('web')->user()->countListProductInCart(),
                ]
            ]);
        }

        $productPrice = $product->get()->first()->price ?? null;

        if ($quantity < 1 || !is_numeric($quantity) || ($quantityNew != null && $quantityNew <= 0)){
            return response()->json([
                'success'=>false,
                'data'=>[
                    'message'=>'Số lượng không hợp lệ',
                    'qty' => \Illuminate\Support\Facades\Auth::guard('web')->user()->countListProductInCart(),
                ]
            ]);
        }

        $cart = DB::table('carts')
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();


        $quantityUpdate = 0;

        if (!empty($cart)){
            $quantityUpdate = $quantityNew ?? ($cart->quantity + $quantity);

            DB::table('carts')
                ->where('user_id', '=', $userId)
                ->where('product_id', '=', $productId)
                ->update([
                    'quantity' => $quantityUpdate
                ]);
        } else {
            DB::table('carts')->insert([
               'user_id' => $userId,
               'product_id' => $productId,
               'quantity' => $quantity
            ]);
        }

        return response()->json([
            'success'=>true,
            'data'=>[
                'message'=>'Them vao gio hang thanh cong',
                'qty' => \Illuminate\Support\Facades\Auth::guard('web')->user()->countListProductInCart(),
                'total' => \Illuminate\Support\Facades\Auth::guard('web')->user()->totalMoneyInCart(),
                'total_row' => $productPrice * $quantityUpdate
            ]
        ]);
    }

    public function deleteProductCart(Request $request){
        $productId = $request->get('product_id');
        $user = Auth::guard('web')->user();

        DB::table('carts')
            ->where('product_id', $productId)
            ->where('user_id', $user->id)
            ->delete();

        return response()->json([
            'success' => true,
            'data' => [
                'qty' => $user->countListProductInCart(),
                'total' => $user->totalMoneyInCart()
            ]
        ]);
    }

    public function listProductInCart() {
        $listProduct = Auth::guard('web')->user()->listProductInCart;
        $total = Auth::guard('web')->user()->totalMoneyInCart();
        return view('web.cart.list', compact('listProduct', 'total'));
    }

    public function checkout() {
        return view('web.checkout.index');
    }
}
