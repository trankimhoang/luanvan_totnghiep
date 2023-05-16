<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeRequest;
use App\Models\Admin;
use App\Models\Attribute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $listAttribute = Attribute::all();
        return view('admin.attribute.index', compact('listAttribute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(AttributeRequest $request): RedirectResponse
    {
        try {
            $attribute = new Attribute();
            $attribute->setAttribute('name', $request->get('name'));
            $attribute->setAttribute('is_private', !empty($request->get('is_private')) ? $request->get('is_private') : 0);
            $attribute->save();

            return redirect()->route('admin.attributes.edit', $attribute->id)->with('success', 'Thêm thành công');
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
        $attribute = Attribute::find($id);

        if (empty($attribute)) {
            abort(404);
        }
        return view('admin.attribute.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(AttributeRequest $request, $id): RedirectResponse
    {
        try {
            $attribute = Attribute::find($id);
            $data = $request->all();

            if (empty($data['is_private'])) {
                $data['is_private'] = 0;
            }

            $attribute->fill($data);

            $attribute->save();

            return redirect()->route('admin.attributes.edit', $attribute->id)->with('success', 'Sửa thành công');
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
            $attribute = Attribute::find($id);
            $attribute->delete();

            return redirect()->back()->with('success', 'Xóa thành công');
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
