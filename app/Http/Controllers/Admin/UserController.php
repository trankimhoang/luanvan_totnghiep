<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request){
        $listUser = User::where(function ($query) use($request){
            if (!empty($request->get('search'))){
                $query->where('name', 'like', "%" . $request->get('search') . "%");
            }
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('admin.user.index', compact('listUser'));
    }

    public function edit($id){
        $user = User::find($id);

        if (empty($user)) {
            abort(404);
        }

        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id){
        try {
            $user = User::find($id);
            $data = $request->all();

            $user->fill($data);

            $user->save();

            return redirect()->route('admin.users.edit', $user->id)->with('success', 'Cập nhật thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
