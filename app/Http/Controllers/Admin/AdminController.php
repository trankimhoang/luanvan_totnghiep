<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $listAdmin = Admin::all();
        return view('admin.admin.index', compact('listAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $admin = new Admin();
            $admin->setAttribute('name', $request->get('name'));
            $admin->setAttribute('email', $request->get('email'));
            $admin->setAttribute('password', Hash::make($request->get('password')));
            $admin->save();

            return redirect()->route('admin.admin.index')->with('success', __('Add success'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id): View
    {
        $admin = Admin::find($id);

        if (empty($admin)) {
            abort(404);
        }

        return view('admin.admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $admin = Admin::find($id);
            $data = $request->all();

            if (!empty($data['password'])){
                $data['password'] = Hash::make($request->get('password'));
            } else {
                unset($data['password']);
            }

            $admin->fill($data);

            if ($request->has('image')) {
                $imagePath = 'admin_images/' . $admin->getAttribute('id');
                $imageUrl = updateImage($request->file('image'), 'avatar', $imagePath);
                $admin->setAttribute('image', $imageUrl);
            }

            $admin->save();

            return redirect()->route('admin.admin.index')->with('success', __('Edit success', ['id'=>$id]));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        try {
            $admin = Admin::find($id);
            $admin->delete();

            return redirect()->back()->with('success', __('Delete success', ['id' => $id]));
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
