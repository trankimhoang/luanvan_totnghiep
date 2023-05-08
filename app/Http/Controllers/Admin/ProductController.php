<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View {
        $listProduct = Product::query()->where('parent_id', '=', null)->get();
        return view('admin.product.index', compact('listProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View {
        $listCategory = Category::all();
        return view('admin.product.create', compact('listCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ProductStoreRequest $request): RedirectResponse {
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View {
        $product = Product::with(['listProductChild', 'listAttribute'])->find($id);
        $listAttr = Attribute::all()->toArray();
        $listCategory = Category::all();

        return view('admin.product.edit', compact('product', 'listAttr', 'listCategory'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ProductUpdateRequest $request, int $id): JsonResponse {
        try {
            $data = $request->all();
            $product = Product::with(['listProductChild', 'listAttribute'])->find($id);
            $product->fill($data);
            $product->save();

            // update product child
            if (!empty($data['product_child_id_delete'])) {
                DB::table('products')
                    ->whereIn('id', $data['product_child_id_delete'])
                    ->delete();
            }

            DB::beginTransaction();
            if (!empty($data['list_product_child'])) {
                $listProductChild = $data['list_product_child'];

                DB::table('values')
                    ->whereIn('product_id', array_keys($listProductChild))
                    ->delete();

                foreach ($listProductChild as $productChildId => $productChild) {
                    $listAttr = $productChild['list_attr'] ?? [];
                    $productUpdateData = [];

                    if (!empty($productChild['price'])) {
                        $productUpdateData['price'] = $productChild['price'];
                    }

                    if (!empty($productChild['price_new'])) {
                        $productUpdateData['price_new'] = $productChild['price_new'];
                    }

                    if (!empty($productChild['quantity'])) {
                        $productUpdateData['quantity'] = $productChild['quantity'];
                    }

                    DB::table('products')
                        ->where('id', '=', $productChildId)
                        ->update($productUpdateData);

                    if (!empty($listAttr)) {
                        foreach ($listAttr as $attrId => $attrValue) {
                            DB::table('values')
                                ->insert([
                                    'product_id' => $productChildId,
                                    'attribute_id' => $attrId,
                                    'text_value' => $attrValue
                                ]);
                        }
                    }
                }
            }
            DB::commit();

            $listProductChildNew = $data['list_product_child_new'] ?? [];

            if (!empty($listProductChildNew)) {
                $listProductChildNewInsertAttr = [];

                foreach ($listProductChildNew as $productChildNew) {
                    $listAttr = $productChildNew['list_attr'] ?? [];
                    unset($productChildNew['list_attr']);
                    $productChildNew['parent_id'] = $id;
                    $productChildNewId = DB::table('products')
                        ->insertGetId($productChildNew);

                    if (!empty($listAttr)) {
                        foreach ($listAttr as $attrId => $attrValue) {
                            $listProductChildNewInsertAttr[] = [
                                'product_id' => $productChildNewId,
                                'attribute_id' => $attrId,
                                'text_value' => $attrValue
                            ];
                        }
                    }
                }

                if (!empty($listProductChildNewInsertAttr)) {
                    DB::table('values')->insert($listProductChildNewInsertAttr);
                }
            }

            // end product child

            Session::flash('success', 'Cap nhat thanh cong');
            return response()->json([
                'success' => true,
                'url' => route('admin.products.edit', $id)
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
            return response()->json([
                'success' => false,
                'mgs' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse {
        try {
            $admin = Product::find($id);
            $admin->delete();

            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function renderProductChildNewRow() {
        $productIdNew = time() * rand(11111, 9999999) * rand(22222, 999999);
        $listAttr = Attribute::all()->toArray();

        return view('admin.product._product_child_new', compact('productIdNew', 'listAttr'));
    }
}
