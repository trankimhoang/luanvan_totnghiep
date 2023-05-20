<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isLoginWebAjax
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        return response()->json([
           'success' => false,
           'message' => 'Vui lòng đăng nhập để sử dụng chức năng'
        ]);
    }
}
