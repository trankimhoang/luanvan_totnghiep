<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Admin;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $listProduct = Product::query()->where('parent_id', '=', null)->get();
        return view('admin.product.index', compact('listProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        try {
            $product = new Product();
            $product->setAttribute('name', $request->get('name'));
            $product->setAttribute('description', $request->get('description'));
            $product->setAttribute('status', $request->get('status'));
            $product->setAttribute('price', $request->get('price'));
            $product->setAttribute('price_new', $request->get('price_new'));
            $product->setAttribute('quantity', $request->get('quantity'));

            $product->save();

            if ($request->has('image')) {
                $imagePath = 'product_images/' . $product->getAttribute('id');
                $imageUrl = updateImage($request->file('image'), 'avatar', $imagePath);
                $product->setAttribute('image', $imageUrl);
                $product->save();
            }


            return redirect()->route('admin.products.index')->with('success', 'Thêm thành công');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $product = Product::with(['listProductChild', 'listAttribute'])->find($id);
        $listAttr = Attribute::all()->toArray();

        return view ('admin.product.edit', compact('product', 'listAttr'));

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
            $data = $request->all();
            $product = Product::with(['listProductChild', 'listAttribute'])->find($id);
            $product->fill($data);

            $product->save();
            return redirect()->route('admin.products.index')->with('success', 'Sua thanh cong product ' . $product->id);
        }catch (\Exception $exception) {
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
            $admin = Product::find($id);
            $admin->delete();

            return redirect()->back()->with('success', 'Xóa thành công');
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
