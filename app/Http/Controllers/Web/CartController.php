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

        $productExists = DB::table('products')->where('id', $productId)->exists();

        if (!$productExists) {
            return response()->json([
                'success'=>false,
                'data'=>[
                    'message'=>'Sản phẩm không tồn tại',
                    'qty' => \Illuminate\Support\Facades\Auth::guard('web')->user()->Carts->sum('quantity'),
                ]
            ]);
        }

        if ($quantity < 1 || !is_numeric($quantity)){
            return response()->json([
                'success'=>false,
                'data'=>[
                    'message'=>'Số lượng không hợp lệ',
                    'qty' => \Illuminate\Support\Facades\Auth::guard('web')->user()->Carts->sum('quantity'),
                ]
            ]);
        }

        $cart = DB::table('carts')
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if (!empty($cart)){
            DB::table('carts')
                ->where('user_id', '=', $userId)
                ->where('product_id', '=', $productId)
                ->update([
                    'quantity' => $cart->quantity + $quantity
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
                'qty' => \Illuminate\Support\Facades\Auth::guard('web')->user()->Carts->sum('quantity')
            ]
        ]);
    }

    public function deleteItemCart(Request $request){
        $id = $request->get('id');

        $cart = Cart::find($id);
        $cart->delete();

        return response()->json([
            'success' => true,
            'data' => [
                'qty' => \Illuminate\Support\Facades\Auth::guard('web')->user()->Carts->sum('quality'),
                'cart_dropdown' => view('cart.cart_dropdown')->render()
            ]
        ]);
    }
}
