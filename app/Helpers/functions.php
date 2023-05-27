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

function createPayUrlMomo($orderId, $amount) {
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

function totalMoneyOrder($orderId) {
    $totalMoney = 0;
    $totalMoneyQuery = DB::table('order_products')
        ->where('order_id', '=', $orderId)
        ->get();

    foreach ($totalMoneyQuery as $item) {
        $totalMoney += $item->quantity * $item->price;
    }

    return $totalMoney;
}

function productTypeString($type) {
    $array = [
        'simple' => 'Đơn',
        'configurable' => 'Nhiều phiên bản'
    ];

    return $array[$type] ?? null;
}


function getListProductIdsByAttrSearch(): array {
    $listAttrSearch = request()->list_attr_search ?? [];
    $listAttrSearch = array_filter($listAttrSearch);
    $listProductIdSearchByAttr = [];

    if (!empty($listAttrSearch)) {
        $listProductIdSearchByAttr = DB::table('values');
        $listProductIdSearchByAttr->whereIn('attribute_id', array_keys($listAttrSearch));
        $listProductIdSearchByAttr->whereIn('text_value', array_values($listAttrSearch));

        $listProductIdSearchByAttr = $listProductIdSearchByAttr->pluck('product_id')->toArray();
    }

    $listProductIdSearchByAttrParent = DB::table('products')
        ->whereIn('id', $listProductIdSearchByAttr)
        ->pluck('parent_id')
        ->toArray();

    return array_merge($listProductIdSearchByAttr, $listProductIdSearchByAttrParent);
}

function getListAttrSearch(): array {
    $listAttrData = [];

    $listAttr = DB::table('values')
        ->where('text_value', '!=', '')
        ->where('text_value', '!=', null)
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

function mapStringIsPaid($paymentStatus = 'UNPAID') {
    $array = [
        'UNPAID' => 'Chưa thanh toán',
        'PAID' => 'Đã thanh toán',
        'REFUND' => 'Đã hoàn tiền'
    ];

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

function mapOrderStatus($status) {
    $array = [
        'PENDING' => 'Đang chờ xử lí',
        'CONFIRMED' => 'Đã xác nhận',
        'DELIVERY' => 'Đang giao hàng',
        'SUCCESS' => 'Thành công',
        'REFUND' => 'Đã trả lại',
        'CANCEL' => 'Đã hủy'
    ];

    return $array[$status] ?? '';
}

function formatVnd($number) {
    return number_format($number, 0, '', ',') . 'đ';
}

