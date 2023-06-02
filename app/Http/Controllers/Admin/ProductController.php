<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        $listProduct = Product::query()->where('parent_id', '=', null)->paginate(10);
        return view('admin.product.index', compact('listProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View {
        $listCategory = Category::all();
        $listAttr = Attribute::all();

        return view('admin.product.create', compact('listCategory', 'listAttr'));
    }

    private function validateListProductChild(): array {
        $data = request()->all();
        $listProductChild = [];

        if (!empty($data['list_product_child'])) {
            foreach ($data['list_product_child'] as $key => $value) {
                $listProductChild[$key] = $value;
            }
        }

        if (!empty($data['list_product_child_new'])) {
            foreach ($data['list_product_child_new'] as $key => $value) {
                $listProductChild[$key] = $value;
            }
        }

        if (!empty($listProductChild)) {
            $listProductChildDataAttr = [];

            foreach ($listProductChild as $productId => $productChild) {
                $listAttr = $productChild['list_attr'] ?? '';
                $listAttr = array_values($listAttr);
                $listAttr = implode('_', $listAttr);

                $listProductChildDataAttr[$listAttr][] = $productId;
            }

            if (!empty($listProductChildDataAttr)) {
                foreach ($listProductChildDataAttr as $listAttr => $listProductId) {
                    if (count($listProductId) == 1) {
                        unset($listProductChildDataAttr[$listAttr]);
                    }
                }
            }

            if (!empty($listProductChildDataAttr)) {
                return $listProductChildDataAttr;
            }
        }

        return [];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStoreRequest $request
     * @return JsonResponse
     */
    public function store(ProductStoreRequest $request): JsonResponse {
        try {
            if ($this->isEmptyProductChild()) {
                return response()->json([
                    'success' => false,
                    'error_product_child_empty_row' => 'Vui lòng nhập sản phẩm con'
                ]);
            }


            $listProductChildError =  $this->validateListProductChild();

            if (!empty($listProductChildError)) {
                return response()->json([
                    'success' => false,
                    'error_product_exists' => $listProductChildError
                ]);
            }

            if ($this->isErrorAttrConfig()) {
                return response()->json([
                    'success' => false,
                    'error_attr_config' => 'Thuộc tính chung và riêng không được trùng nhau'
                ]);
            }

            $listProductChildFieldEmptyError = $this->validateListProductChildField();

            if (!empty($listProductChildFieldEmptyError)) {
                return response()->json([
                    'success' => false,
                    'error_product_child_empty' => $listProductChildFieldEmptyError
                ]);
            }

            $product = new Product();
            $product->setAttribute('name', $request->get('name'));
            $product->setAttribute('description', $request->get('description'));
            $product->setAttribute('status', $request->get('status'));
            $product->setAttribute('price', $request->get('price'));
            $product->setAttribute('quantity', $request->get('quantity'));
            $product->setAttribute('category_id', $request->get('category_id'));
            $product->setAttribute('type', $request->get('type'));
            $product->save();

            $data = $request->toArray();

            $this->addImages($product->getAttribute('id'));
            $this->updateAttrConfig($product->getAttribute('id'), $data['list_attr'] ?? [], $data['list_attr_private'] ?? []);
            $this->updateAttributeNotPrivate($product->getAttribute('id'), $request->toArray());
            $this->addListProductChildNew($product->getAttribute('id'));

            if ($request->has('image')) {
                $imagePath = 'product_images/' . $product->getAttribute('id');
                $imageUrl = updateImage($request->file('image'), 'avatar', $imagePath);
                $product->setAttribute('image', $imageUrl);
                $product->save();
            }

            Session::flash('success', 'Them thanh cong');
            return response()->json([
                'success' => true,
                'url' => route('admin.products.edit', $product->getAttribute('id'))
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View {
        $product = Product::with(['listProductChild', 'listAttribute', 'listImage'])->find($id);
        $listAttr = Attribute::all();
        $listCategory = Category::all();
        $listAttributeIdSelected = $product->getArrayAttrIds(1);
        $listProductId = DB::table('products')
            ->where('parent_id', '=', $id)
            ->pluck('id')->toArray();

        $listAttrValueForListProductChild = DB::table('values')
            ->whereIn('product_id', $listProductId)
            ->whereIn('attribute_id', $listAttributeIdSelected)
            ->get()->mapWithKeys(function ($item) {
                return [$item->product_id . '_' . $item->attribute_id => $item->text_value];
            })->toArray();

        return view('admin.product.edit', compact('product', 'listAttr', 'listCategory', 'listAttributeIdSelected', 'listAttrValueForListProductChild'));
    }

    private function updateAttributeNotPrivate($id, $data) {
        $listValueInsert = [];

        if (!empty($data['list_attr_value']) && is_array($data['list_attr_value'])) {
            foreach ($data['list_attr_value'] as $attrId => $textValue) {
                $listValueInsert[] = [
                    'product_id' => $id,
                    'attribute_id' => $attrId,
                    'text_value' => $textValue
                ];
            }
        }

        DB::table('values')->where('product_id', '=', $id)->delete();

        if (!empty($listValueInsert)) {
            DB::table('values')->insert($listValueInsert);
        }
    }

    private function addListProductChildNew($id) {
        $data = request()->toArray();
        $listProductChildNew = $data['list_product_child_new'] ?? [];

        if (!empty($listProductChildNew)) {
            $listProductChildNewInsertAttr = [];

            foreach ($listProductChildNew as $productChildNew) {
                $listAttr = $productChildNew['list_attr'] ?? [];
                unset($productChildNew['list_attr']);
                $productChildNew['parent_id'] = $id;
                $productChildNewId = DB::table('products')
                    ->insertGetId($productChildNew);

                if (!empty($productChildNew['image'])) {
                    $imagePath = updateImage($productChildNew['image'], 'avatar', 'product_images/' . $productChildNewId);
                    DB::table('products')
                        ->where('id', '=', $productChildNewId)
                        ->update([
                            'image' =>  $imagePath
                        ]);
                }

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
    }

    private function addImages($id) {
        $request = request();

        if (!empty($request->file('image_news'))) {
            $arrayInsertImage = [];

            foreach ($request->file('image_news') as $image) {
                $imageUrl = updateImage($image, time() * rand(1111, 8888), 'product_images/' . $id);

                if (!empty($imageUrl)) {
                    $arrayInsertImage[] = [
                        'image' => $imageUrl,
                        'product_id' => $id,
                        'created_at' => Carbon::now()
                    ];
                }
            }

            DB::table('product_images')->insert($arrayInsertImage);
        }

        $dataImagesRemove = $request->get('remove_images');

        if (!empty($dataImagesRemove)) {
            $listImagePath = DB::table('product_images')
                ->whereIn('id', $dataImagesRemove)
                ->pluck('image');

            if (!empty($listImagePath)) {
                foreach ($listImagePath as $path) {
                    File::delete(public_path($path));
                }

                DB::table('product_images')
                    ->whereIn('id', $dataImagesRemove)
                    ->delete();
            }
        }
    }

    private function updateAttrConfig($id, $listAttr, $listAttrPrivate) {
        DB::table('product_attr_config')
            ->where('product_id', '=', $id)
            ->delete();
        $arrayInsert = [];

        if (!empty($listAttr)) {
            foreach ($listAttr as $item) {
                $arrayInsert[] = [
                    'product_id' => $id,
                    'attribute_id' => $item,
                    'is_private' => 0
                ];
            }
        }

        if (!empty($listAttrPrivate)) {
            foreach ($listAttrPrivate as $item) {
                $arrayInsert[] = [
                    'product_id' => $id,
                    'attribute_id' => $item,
                    'is_private' => 1
                ];
            }
        }

        if (!empty($arrayInsert)) {
            DB::table('product_attr_config')->insert($arrayInsert);
        }
    }

    private function isErrorAttrConfig(): bool {
        $data = request();
        $listAttr = $data['list_attr'] ?? [];
        $listAttrPrivate = $data['list_attr_private'] ?? [];
        $result = array_intersect($listAttr, $listAttrPrivate);

        return !empty($result);
    }

    private function validateListProductChildField(): array {
        $data = request();
        $listProductChild = [];

        if (!empty($data['list_product_child'])) {
            foreach ($data['list_product_child'] as $item) {
                $listProductChild[] = $item;
            }
        }

        if (!empty($data['list_product_child_new'])) {
            foreach ($data['list_product_child_new'] as $item) {
                $listProductChild[] = $item;
            }
        }

        $listProductChildEmptyRows = [];

        foreach ($listProductChild as $key => $item) {
            $isEmptyAttr = false;

            if (!empty($item['list_attr'])) {
                foreach ($item['list_attr'] as $attr) {
                    if (empty($attr)) {
                        $isEmptyAttr = true;
                        break;
                    }
                }
            } else {
                $isEmptyAttr = true;
            }

            if (empty($item['price']) || empty($item['quantity']) || $isEmptyAttr) {
                $listProductChildEmptyRows[] = $key + 1;
            }
        }

        return $listProductChildEmptyRows;
    }

    private function isEmptyProductChild(): bool {
        $data = request()->toArray();

        if (!empty($data['type']) && $data['type'] == 'configurable') {
            if (empty($data['list_product_child']) && empty($data['list_product_child_new'])) {
                return true;
            }
        }

        return false;
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
            if ($this->isEmptyProductChild()) {
                return response()->json([
                    'success' => false,
                    'error_product_child_empty_row' => 'Vui lòng nhập sản phẩm con'
                ]);
            }

            $data = $request->all();
            $listProductChildError =  $this->validateListProductChild();

            if (!empty($listProductChildError)) {
                return response()->json([
                    'success' => false,
                    'error_product_exists' => $listProductChildError
                ]);
            }

            if ($this->isErrorAttrConfig()) {
                return response()->json([
                    'success' => false,
                    'error_attr_config' => 'Thuộc tính chung và riêng không được trùng nhau'
                ]);
            }

            $listProductChildFieldEmptyError = $this->validateListProductChildField();

            if (!empty($listProductChildFieldEmptyError)) {
                return response()->json([
                    'success' => false,
                    'error_product_child_empty' => $listProductChildFieldEmptyError
                ]);
            }

            $this->addImages($id);
            $this->updateAttrConfig($id, $data['list_attr'] ?? [], $data['list_attr_private'] ?? []);
            $product = Product::with(['listProductChild', 'listAttribute'])->find($id);
            $product->fill($data);

            if ($request->has('image')) {
                $imagePath = 'product_images/' . $product->getAttribute('id');
                $imageUrl = updateImage($request->file('image'), 'avatar', $imagePath);
                $product->setAttribute('image', $imageUrl);
            }

            $product->save();
            $this->updateAttributeNotPrivate($id, $data);

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

                    if (!empty($productChild['image'])) {
                        $imagePath = updateImage($productChild['image'],'avatar', 'product_images/' . $productChildId);
                        $productUpdateData['image'] = $imagePath;
                    }

                    if (!empty($productChild['price'])) {
                        $productUpdateData['price'] = $productChild['price'];
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

            $this->addListProductChildNew($id);
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
    public function destroy(int $id): RedirectResponse {
        try {
            $admin = Product::find($id);
            $admin->delete();

            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            if ($exception->getCode() == 23000) {
                return redirect()->back()->with('error', "Không thể xóa #$id vì đã có đơn đặt hàng");
            }

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function renderProductChildNewRow(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application {
        $productIdNew = time() + rand(11111, 9999999) + rand(22222, 999999);
        $listAttr = Attribute::all()->toArray();

        return view('admin.product._product_child_new', compact('productIdNew', 'listAttr'));
    }

    public function renderAttribute(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|string|\Illuminate\Contracts\Foundation\Application {
        $listAttrId = $request->get('attribute_ids');

        if (empty($listAttrId)) {
            return '';
        }

        $productId = $request->get('product_id');
        $listAttribute = DB::table('attributes')
            ->whereIn('id', $listAttrId)
            ->get();

        $listAttributeValue = [];

        if (!empty($productId)) {
            $listAttributeValue = DB::table('values')
                ->where('product_id', '=', $productId)
                ->whereIn('attribute_id', $listAttribute->pluck('id')->toArray())
                ->get()->mapWithKeys(function ($item) {
                    return [$item->attribute_id => $item->text_value];
                })->toArray();
        }

        return view('admin.product._render_attribute', compact('listAttribute', 'listAttributeValue'));
    }

    public function renderAttributeListProductChild(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|string|\Illuminate\Contracts\Foundation\Application {
        $listAttrId = $request->get('attribute_ids');

        if (empty($listAttrId)) {
            return '';
        }

        $listAttribute = DB::table('attributes')
            ->whereIn('id', $listAttrId)
            ->get();

        return view('admin.product._render_attribute_list_product_child', compact('listAttribute'));
    }
    public function renderImageReview(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application {
        $imageUrl = $request->get('image_url');

        return view('admin.product.image_item', compact('imageUrl'));
    }
}
