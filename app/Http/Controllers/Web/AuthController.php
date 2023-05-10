<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showFormLogin(){
        return view('web.auth.login');
    }

    public function login(UserLoginRequest $request) {
        try {
            $data = $request->only(['email', 'password']);

            if (Auth::guard('web')->attempt($data)) {
                return redirect()->route('web.index');
            }

            return redirect()->route('web.login')->withErrors(['error' => 'Email hoac mat khau khong chinh xac']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->withErrors(['server_error' => $exception->getMessage()]);
        }
    }
}
