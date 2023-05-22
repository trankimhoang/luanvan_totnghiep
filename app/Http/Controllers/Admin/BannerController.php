<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $listBanner = Banner::all();
        return view('admin.banner.index', compact('listBanner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.banner.create');
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
            $data = $request->all();

            $banner = new Banner();
            $banner->fill($data);

            $banner->save();

            if ($request->has('image')) {
                $imagePath = 'banner_images/' . $banner->getAttribute('id');
                $imageUrl = updateImage($request->file('image'), 'avatar', $imagePath);
                $banner->setAttribute('image', $imageUrl);
                $banner->save();
            }



            return redirect()->route('admin.banners.edit');
        } catch (\Exception $exception){
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $banner = Banner::find($id);

        if (empty($banner)) {
            abort(404);
        }

        return view('admin.banner.edit', compact('banner'));
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
            $banner = Banner::find($id);
            $data = $request->all();

            $banner->fill($data);

            if ($request->has('image')) {
                $imagePath = 'banner_images/' . $banner->getAttribute('id');
                $imageUrl = updateImage($request->file('image'), 'avatar', $imagePath);
                $banner->setAttribute('image', $imageUrl);
            }

            $banner->save();

            return redirect()->route('admin.banners.index')->with('success', 'Sửa thành công');
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
            $banner = Banner::find($id);
            $banner->delete();

            return redirect()->back()->with('success', 'Xóa thành công');
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
