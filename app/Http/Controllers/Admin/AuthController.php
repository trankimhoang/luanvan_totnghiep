<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showFormLogin() {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request){
        $email = $request->get('email');
        $password = $request->get('password');
        $data = [
            'email' => $email,
            'password' => $password
        ];
        $isLogin = Auth::guard('admin')->attempt($data, $request->get('remember'));

        if ($isLogin) {
            return redirect()->route('admin.index');
        }

        return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng!');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
