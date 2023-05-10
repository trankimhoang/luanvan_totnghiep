<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\RegisterRequest;
use App\Http\Requests\Web\UserLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showFormLogin(){
        return view('web.auth.login');
    }

    public function login(UserLoginRequest $request) {
        $email = $request->get('email');
        $password = $request->get('password');
        $data = [
            'email' => $email,
            'password' => $password
        ];

        $isLogin = Auth::guard('web')->attempt($data, $request->get('remember'));

        if ($isLogin) {
            return redirect()->route('web.index');
        }

        return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng!');
    }

    public function logout() {
        Auth::guard('web')->logout();
        return redirect()->route('web.login');
    }

    public function showFormRegister() {
        return view('web.auth.register');
    }

    public function register(RegisterRequest $request) {
        try {
            $user = new User();
            $data = $request->only(['name', 'email', 'password']);
            $data['password'] = Hash::make($data['password']);
            $user->fill($data);

            $user->save();
            return redirect()->route('web.login')->with('success', 'Đăng kí thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


}
