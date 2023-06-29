<?php
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

function updateImage($imageFile, $imageName, $imagePath) {
    if (!empty($imageFile) && $imageFile instanceof UploadedFile) {
        $file = $imageFile;
        $ext = $file->extension();
        $fileName =  $imageName . '.' . $ext;
        $file->move(public_path($imagePath), $fileName);

        return $imagePath . '/' . $fileName;
    }

    return '';
}

function mapStatusProduct($status){
    $array = [
       0 => 'Off',
       1 => 'On'
    ];

    return $array[$status] ?? '';
}
function mapStatusBanner($status){
    $array = [
        0 => 'Off',
        1 => 'On'
    ];

    return $array[$status] ?? '';
}

function mapStatusUser($status){
    $array = [
        0 => 'Đã khóa tài khoản',
        1 => 'Tài khoản đang kích hoạt'
    ];
    return $array[$status] ?? '';
}

function execPostRequest($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}

function createPayUrlMomo($orderId, $amount, $randomOrderId = false) {
    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    $orderInfo = "Thanh toán qua MoMo cho shop " . env('APP_NAME') . " đơn hàng [$orderId]";
    $redirectUrl = route('web.momo_return');
    $ipnUrl = route('web.momo_return');
    $requestId = time() . "";
    $requestType = "captureWallet";
    $extraData = "";
    //before sign HMAC SHA256 signature

    if ($randomOrderId) {
        $orderId .= "_repay" . time() + rand(1111, 999999);
    }

    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);
    $data = array('partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);

    return $jsonResult['payUrl'] ?? '';
}

function productTypeString($type) {
    $array = [
        'simple' => 'Đơn',
        'configurable' => 'Nhiều phiên bản'
    ];

    return $array[$type] ?? null;
}


function getListProductIdsByAttrSearch(): array|null {
    $listAttrSearch = request()->list_attr_search ?? [];
    $listAttrSearch = array_filter($listAttrSearch);

    if (!empty($listAttrSearch)) {
        $listProductIdSearchByAttr = DB::table('values');
        $listProductIdSearchByAttr->whereIn('attribute_id', array_keys($listAttrSearch));
        $listAttrSearchTextValue = [];

        foreach ($listAttrSearch as $item) {
            $listAttrSearchTextValue = array_merge($listAttrSearchTextValue, array_values($item));
        }

        $listProductIdSearchByAttr->whereIn('text_value', $listAttrSearchTextValue);

        $listProductIdSearchByAttr = $listProductIdSearchByAttr->pluck('product_id')->toArray();
    } else {
        return null;
    }

    $listProductIdSearchByAttrParent = DB::table('products')
        ->whereIn('id', $listProductIdSearchByAttr)
        ->pluck('parent_id')
        ->toArray();

    return array_merge($listProductIdSearchByAttr, $listProductIdSearchByAttrParent);
}

function getListAttrSearch($listProductId = []): array {
    $listAttrData = [];

    $listProductIdChild = DB::table('products')
        ->whereIn('parent_id', $listProductId)
        ->pluck('id')
        ->toArray();

    $listProductId = array_merge($listProductId, $listProductIdChild);

    $listAttr = DB::table('values')
        ->where('text_value', '!=', '')
        ->where('text_value', '!=', null)
        ->whereIn('product_id', $listProductId)
        ->join('attributes', 'values.attribute_id', '=', 'attributes.id')
        ->get();

    foreach ($listAttr as $item) {
        if (!empty($listAttrData[$item->attribute_id])) {
            $listAttrData[$item->attribute_id]['list_search'][] = $item->text_value;
        } else {
            $listAttrData[$item->attribute_id] = [
                'list_search' => [$item->text_value],
                'title' => $item->name
            ];
        }
    }

    return $listAttrData;
}


function getStatusPayment() {
    return [
        'UNPAID' => 'Chưa thanh toán',
        'PAID' => 'Đã thanh toán',
        'REFUND' => 'Đã hoàn tiền'
    ];
}

function mapStringIsPaid($paymentStatus = 'UNPAID') {
    $array = getStatusPayment();

    return $array[$paymentStatus] ?? '';
}

if (!function_exists('getDayFromDateToDate')) {
    function getDayFromDateToDate($fromDate, $toDate) {
        $datetime1 = new DateTime($fromDate);
        $datetime2 = new DateTime($toDate);
        $interval = $datetime1->diff($datetime2);

        if (strtotime($fromDate) > strtotime($toDate)) {
            return -$interval->format('%a');
        }

        return $interval->format('%a');
    }
}

function getOrderStatus(){
    return [
        'PENDING' => 'Đang chờ xử lí',
        'CONFIRMED' => 'Đã xác nhận',
        'DELIVERY' => 'Đang giao hàng',
        'SUCCESS' => 'Thành công',
        'REFUND' => 'Đã trả lại',
        'CANCEL' => 'Đã hủy'
    ];
}

function getOrderStatusShow(){
    return [
        'PENDING' => '<span class="badge rounded-pill bg-warning text-dark">Đang chờ xử lí</span>',
        'CONFIRMED' => '<span class="badge rounded-pill bg-info text-dark">Đã xác nhận</span>',
        'DELIVERY' => '<span class="badge rounded-pill bg-primary">Đang giao hàng</span>',
        'SUCCESS' => '<span class="badge rounded-pill bg-success">Thành công</span>',
        'REFUND' => '<span class="badge rounded-pill bg-secondary">Đã trả lại</span>',
        'CANCEL' => '<span class="badge rounded-pill bg-danger">Đã hủy</span>'
    ];
}
function mapOrderStatus($status) {
    $array = getOrderStatusShow();

    return $array[$status] ?? '';
}

function formatVnd($number) {
    return number_format($number, 0, '', ',');
}

function getListCouponType() {
    return [
        'price' => 'Khuyến mãi theo số tiền',
        'percent' => 'Khuyến mãi theo phần trăm'
    ];
}

function getListCouponForCheckOut($total) {
    $arrayCouponIdToNumberUser = DB::table('orders')
        ->select([
            'coupon_id',
            DB::raw('count(*) as total')
        ])
        ->where('coupon_id', '!=', null)
        ->groupBy('coupon_id')
        ->get()->mapWithKeys(function ($item) {
            return [$item->coupon_id => $item->total];
        })->toArray();

    $listCoupon = DB::table('coupons')
        ->where(function ($query) {
            $query->where('start', '=', null);
            $query->orWhere('start', '<=', \Carbon\Carbon::now()->format('Y-m-d'));
        })->where(function ($query) {
            $query->where('end', '=', null);
            $query->orWhere('end', '>=', \Carbon\Carbon::now()->format('Y-m-d'));
        })->get()->toArray();

    foreach ($listCoupon as $key => &$value) {
        if ($value->type == 'price') {
            if ($value->discount >= $total) {
                unset($listCoupon[$key]);
                continue;
            }
        } else if ($value->type == 'percent') {
            if ($total * $value->discount / 100 >= $total) {
                unset($listCoupon[$key]);
                continue;
            }
        }

        $value->number_use_free = $value->number_use;

        if (!empty($arrayCouponIdToNumberUser[$value->id])) {
            if ($arrayCouponIdToNumberUser[$value->id] >= $value->number_use) {
                unset($listCoupon[$key]);
                continue;
            } else {
                $value->number_use_free -= $arrayCouponIdToNumberUser[$value->id];
            }
        }

        if ($value->number_use_free <= 0) {
            unset($listCoupon[$key]);
        }
    }

    return $listCoupon;
}


function checkActiveCouponStartAndEnd($couponId) {
    return DB::table('coupons')
        ->where('id', '=', $couponId)
        ->where(function ($query) {
            $query->where('start', '=', null);
            $query->orWhere('start', '<=', \Carbon\Carbon::now()->format('Y-m-d'));
        })->where(function ($query) {
            $query->where('end', '=', null);
            $query->orWhere('end', '>=', \Carbon\Carbon::now()->format('Y-m-d'));
        })->exists();
}

function getNumberUseFreeCoupon($couponId) {
    $numberUse = \App\Models\Coupon::find($couponId)->number_use;
    $numberHaveUse = DB::table('orders')
        ->where('coupon_id', '=', $couponId)
        ->count();

    return $numberUse - $numberHaveUse;
}

if (!function_exists('checkUrlIsHttps')) {
    function checkUrlIsHttps($url): bool {
        $url = parse_url($url);

        if (!empty($url['scheme']) && $url['scheme'] == 'https') {
            return true;
        }

        return false;
    }
}

