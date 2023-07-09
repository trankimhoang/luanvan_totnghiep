<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $listCoupon = Coupon::where(function ($query) use($request){
            if (!empty($request->get('search'))){
                $query->where('name', 'like', "%" . $request->get('search') . "%");
            }
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('admin.coupon.index', compact('listCoupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CouponRequest  $request
     * @return RedirectResponse
     */
    public function store(CouponRequest $request): RedirectResponse
    {
        try {
            $coupon = new Coupon();
            $coupon->fill($request->all());
            $coupon->save();

            return redirect()->route('admin.coupons.edit', $coupon->id)->with('success', 'Thêm thành công');
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
        $coupon = Coupon::find($id);

        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CouponRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(CouponRequest $request, $id): RedirectResponse
    {
        try {
            $coupon = Coupon::find($id);
            $coupon->fill($request->all());
            $coupon->save();

            return redirect()->route('admin.coupons.edit', $coupon->id)->with('success', 'Sửa thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|void
     */
    public function destroy($id)
    {
        try {
            $coupon = Coupon::find($id);
            $coupon->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            if ($exception->getCode() == 23000) {
                return redirect()->back()->with('error', "Không thể xóa #$id vì đã được sử dụng trong đơn đặt hàng");
            }
        }
    }
}
