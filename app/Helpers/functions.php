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
    $orderInfo = "Thanh toán qua MoMo đơn hàng [$orderId]";
    $redirectUrl = route('web.momo_return');
    $ipnUrl = route('web.momo_return');
    $requestId = time() . "";
    $requestType = "captureWallet";
    $extraData = "";
    //before sign HMAC SHA256 signature
    $orderId = $orderId . '_' . time() + rand(111, 8888);
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

