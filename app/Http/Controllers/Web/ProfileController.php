<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function showFormProfile(){
        $profileUser = Auth::guard('web')->user();

        if (empty($profileUser)) {
            abort(404);
        }

        return view('web.profile.index', compact('profileUser'));
    }

    public function profile(ProfileRequest $request, $id) {
        try {
            $profileUser = User::find($id);
            $data = $request->all();

            if (!empty($data['password'])){
                $data['password'] = Hash::make($request->get('password'));
            } else {
                unset($data['password']);
            }

            $profileUser->fill($data);

            $profileUser->save();

            return redirect()->route('web.profile')->with('success', 'Cập nhật thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
