<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class FakeData extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command fake-data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int {
        Artisan::call('db:wipe');
        Artisan::call('migrate --seed');
        Artisan::call('import-city');
        File::cleanDirectory(public_path('product_images'));
        File::cleanDirectory(public_path('banner_images'));

        $listBanner = [];

        foreach (File::glob(storage_path('banner_fake/*')) as $key => $image) {
            $key++;

            if (!File::isDirectory(public_path('banner_images/' . $key))) {
                File::makeDirectory(public_path('banner_images/' . $key), 0777, true, true);
            }

            $imageName = explode('/', $image);
            $imageName = $imageName[array_key_last($imageName)];
            File::copy($image, public_path('banner_images/' . $key . '/' . $imageName));

            $listBanner[] = [
                'image' => 'banner_images/' . $key . '/' . $imageName,
                'status' => 1
            ];
        }

        DB::table('banners')
            ->insert($listBanner);

        $listCategory = [
            [
                'id' => 1,
                'name' => 'Điện thoại'
            ],
            [
                'id' => 2,
                'name' => 'Laptop'
            ],
            [
                'id' => 3,
                'name' => 'Máy tính bảng/Ipad'
            ],
            [
                'id' => 4,
                'name' => 'Phụ kiện'
            ],
        ];

        DB::table('categories')
            ->insert($listCategory);


        $listProductParent = [
            [
                'id' => 1,
                'name' => 'Iphone 11',
                'price' => 6000000,
                'quantity' => 1000,
                'parent_id' => null,
                'image' => '',
                'status' => 1,
                'description' => 'iPhone 11 với 6 phiên bản màu sắc, camera có khả năng chụp ảnh vượt trội, thời lượng pin cực dài và bộ vi xử lý mạnh nhất từ trước đến nay sẽ mang đến trải nghiệm tuyệt vời dành cho bạn',
                'type' => 'configurable',
                'category_id' => 1
            ],
            [
                'id' => 2,
                'name' => 'Iphone 12',
                'price' => 8000000,
                'quantity' => 789,
                'parent_id' => null,
                'image' => '',
                'status' => 1,
                'description' => 'iPhone 12 với 6 phiên bản màu sắc, camera có khả năng chụp ảnh vượt trội, thời lượng pin cực dài và bộ vi xử lý mạnh nhất từ trước đến nay sẽ mang đến trải nghiệm tuyệt vời dành cho bạn',
                'type' => 'simple',
                'category_id' => 1
            ],
            [
                'id' => 3,
                'name' => 'Macbook air m1',
                'price' => 20000000,
                'quantity' => 789,
                'parent_id' => null,
                'image' => '',
                'status' => 1,
                'description' => 'Macbook air m1',
                'type' => 'configurable',
                'category_id' => 2
            ],
            [
                'id' => 4,
                'name' => 'Laptop Asus Zenbook 14X UM5401QA KN209W',
                'price' => 18490000,
                'quantity' => 789,
                'parent_id' => null,
                'image' => '',
                'status' => 1,
                'description' => 'Asus Zenbook 14X UM5401QA KN209W sở hữu màn hình kích thước 14 inch nhỏ gọn. Nhờ trọng lượng nhẹ này mà người dùng có thể dễ dàng mang theo thiết bị bên mình đến nhiều nơi để học tập và làm việc.',
                'type' => 'simple',
                'category_id' => 2
            ],
            [
                'id' => 5,
                'name' => 'Laptop Lenovo Ideapad 5 Pro',
                'price' => 19990000,
                'quantity' => 100,
                'parent_id' => null,
                'image' => '',
                'status' => 1,
                'description' => 'vivobook',
                'type' => 'simple',
                'category_id' => 2
            ],
            [
                'id' => 6,
                'name' => 'Bàn phím cơ có dây Dareu EK87 TKL',
                'price' => 499000,
                'quantity' => 10,
                'parent_id' => null,
                'image' => '',
                'status' => 1,
                'description' => 'Thương hiệu bàn phím DAREU là bàn phím chuyên dùng chơi game hệ thống Stab phím dài được làm theo dạng Cherry cùng 2 switch phụ. Bàn phím DareU EK87 có thiết kế rất thân thiện với các game thủ. Lớp vỏ bàn phím được làm khá chắc chắn, classic. Keycap Double Shot bền bỉ. Có lớp vỏ dày, cao che kín chân switch.',
                'type' => 'configurable',
                'category_id' => 3
            ],
            [
                'id' => 7,
                'name' => 'Ốp lưng iphone 12',
                'price' => 150000,
                'quantity' => 789,
                'parent_id' => null,
                'image' => '',
                'status' => 1,
                'description' => 'Ốp lưng iphone 12',
                'type' => 'simple',
                'category_id' => 4
            ],
            [
                'id' => 9,
                'name' => 'Macbook Pro 16 inch 2021 16-core 512GB Gray MK183 - Chip M1',
                'price' => 63999000,
                'quantity' => 5250,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 10,
                'name' => 'Macbook Pro 14 inch 2021 16-core 1TSilver MKGT3-Chip M1',
                'price' => 63499000,
                'quantity' => 2914,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 11,
                'name' => 'Macbook Pro 14 inch 2021 16-core 1T Gray MKGQ3-Chip M1',
                'price' => 63499000,
                'quantity' => 2078,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 12,
                'name' => 'iMac Retina 24 inch 2021 1T Ram 16GB Chip M1 8 Core GPU',
                'price' => 51499000,
                'quantity' => 4488,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 4,
            ],
            [
                'id' => 13,
                'name' => 'iMac Retina 24 inch 2021 512GB Ram 16GB Chip M1 8 Core GPU',
                'price' => 46499000,
                'quantity' => 5129,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 4,
            ],
            [
                'id' => 14,
                'name' => 'Apple iPhone 13 Pro Max 1T VN/A',
                'price' => 42999000,
                'quantity' => 3005,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 15,
                'name' => 'iMac Retina 24 inch 2021 256GB Ram 16GB Chip M1 8 Core GPU',
                'price' => 41499000,
                'quantity' => 5300,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 4,
            ],
            [
                'id' => 16,
                'name' => 'Samsung Galaxy Z Fold3 5G F926 512GB Ram 12GB',
                'price' => 40599000,
                'quantity' => 2510,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 17,
                'name' => 'Apple iPhone 13 Pro 1T VN/A',
                'price' => 40199000,
                'quantity' => 4037,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 18,
                'name' => 'MacBook Pro 2020 13 inch 1T (I5-2.0GHz/16GB) MWP52 Gray',
                'price' => 39999000,
                'quantity' => 3697,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 19,
                'name' => 'Apple iPhone 13 Pro Max 1 sim 1T',
                'price' => 38499000,
                'quantity' => 3806,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 20,
                'name' => 'Apple iPhone 13 Pro 1 sim 1T',
                'price' => 37999000,
                'quantity' => 4279,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 21,
                'name' => 'Macbook Pro 13 inch 512GB Ram 16GB 2020 MWP42 Gray',
                'price' => 37999000,
                'quantity' => 4277,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 22,
                'name' => 'Samsung Galaxy Z Fold3 5G F926 256GB Ram 12GB',
                'price' => 37899000,
                'quantity' => 2515,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 23,
                'name' => 'Samsung Galaxy Z Fold2 F916 5G',
                'price' => 37499000,
                'quantity' => 4826,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 24,
                'name' => 'iMac Retina 24 inch 2021 256GB Ram 8GB Chip M1 8 Core GPU',
                'price' => 36999000,
                'quantity' => 4378,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 4,
            ],
            [
                'id' => 25,
                'name' => 'Samsung Galaxy Z Fold3 5G F926 512GB Ram 12GB (New - BH12T)',
                'price' => 38199000,
                'quantity' => 3789,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 26,
                'name' => 'Macbook Pro 13 inch Late 2020 512GB Ram 8GB Silver MYDC2 - Chip M1',
                'price' => 36599000,
                'quantity' => 4263,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 27,
                'name' => 'Macbook Pro 13 inch Late 2020 512GB Ram 8GB Gray MYD92 - Chip M1',
                'price' => 36599000,
                'quantity' => 3040,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 28,
                'name' => 'Macbook Pro 13 inch 2020 256GB Ram 16GB Gray Z11B000CT - Chip M1',
                'price' => 36499000,
                'quantity' => 4041,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 29,
                'name' => 'Macbook Pro 13 inch 2020 256GB Ram 16GB Silver Z11D000E5 - Chip M1',
                'price' => 36299000,
                'quantity' => 3401,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 30,
                'name' => 'Apple iPhone 13 Pro 512GB VN/A',
                'price' => 34999000,
                'quantity' => 5201,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 31,
                'name' => 'Samsung Galaxy Z Fold2 5G F916 (New - BH12T)',
                'price' => 33099000,
                'quantity' => 3390,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 32,
                'name' => 'Macbook Pro 13 inch Late 2020 512GB Gray MYD92 - Chip M1',
                'price' => 32999000,
                'quantity' => 3493,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 33,
                'name' => 'Apple iPhone 13 Pro 1 sim 1T cũ 99%',
                'price' => 32499000,
                'quantity' => 4226,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 34,
                'name' => 'Đồng Hồ Thông Minh Garmin Descent Mk2i (010-02132)',
                'price' => 32290000,
                'quantity' => 2763,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 4,
            ],
            [
                'id' => 35,
                'name' => 'Macbook Pro 13 inch Late 2020 256GB Ram 8GB Gray MYD82 - Chip M1',
                'price' => 31999000,
                'quantity' => 4762,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 36,
                'name' => 'Macbook Pro 13 inch Late 2020 256GB Ram 8GB Silver MYDA2 - Chip M1',
                'price' => 31999000,
                'quantity' => 4007,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 37,
                'name' => 'Macbook Pro 13 inch 512GB Ram 8GB 2020 MXK72 Silver',
                'price' => 31499000,
                'quantity' => 2301,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 38,
                'name' => 'Apple iPhone 13 Pro Max 1 sim 256GB cũ 99% KH',
                'price' => 30999000,
                'quantity' => 4403,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 39,
                'name' => 'Macbook Pro 13 inch 512GB Ram 16GB 2020 MWP42 Gray cũ 99%',
                'price' => 30999000,
                'quantity' => 2128,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 40,
                'name' => 'Samsung Galaxy Z Fold3 5G F926 256GB Ram 12GB',
                'price' => 30999000,
                'quantity' => 4461,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 41,
                'name' => 'Apple iPhone 13 Pro 1 sim 512GB cũ 99% KH',
                'price' => 30499000,
                'quantity' => 4810,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 42,
                'name' => 'Apple iPhone 13 Pro 256GB VN/A',
                'price' => 29999000,
                'quantity' => 5153,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 43,
                'name' => 'Apple iPhone 13 512GB VN/A',
                'price' => 29499000,
                'quantity' => 3903,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 44,
                'name' => 'MacBook Air 13 inch 2020 256GB Ram 16GB Gold Z12A0004Z- Chip M1',
                'price' => 29499000,
                'quantity' => 2024,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 45,
                'name' => 'MacBook Air 13 inch 2020 256GB Ram 16GB Gray Z124000DE - Chip M1',
                'price' => 29499000,
                'quantity' => 3628,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 46,
                'name' => 'MacBook Air 13 inch 2020 256GB Ram 16GB Silver Z127000DE - Chip M1',
                'price' => 29499000,
                'quantity' => 2494,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 47,
                'name' => 'Apple iPhone 13 Pro Max 1 sim 128GB',
                'price' => 29399000,
                'quantity' => 5190,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 48,
                'name' => 'Macbook Pro 13 inch Late 2020 256GB Silver MYDA2 - Chip M1',
                'price' => 28799000,
                'quantity' => 4207,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 49,
                'name' => 'Samsung Galaxy Z Fold3 256GB Ram 12GB Hàn Quốc cũ 99%',
                'price' => 28499000,
                'quantity' => 2370,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 50,
                'name' => 'Laptop Acer Swift X SFX14 41G R61A 2021',
                'price' => 28499000,
                'quantity' => 5243,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 51,
                'name' => 'Apple Mac mini M1 2021 512GB Ram 16GB Z12P000HK',
                'price' => 28499000,
                'quantity' => 2389,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 4,
            ],
            [
                'id' => 52,
                'name' => 'Apple iPhone 13 Pro 1 sim 256GB cũ 99% KH',
                'price' => 27499000,
                'quantity' => 4266,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 53,
                'name' => 'Samsung Galaxy Z Fold 2 F916',
                'price' => 26999000,
                'quantity' => 2338,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 54,
                'name' => 'Laptop Lenovo Gaming 3 15IHU6 82K100FBVN',
                'price' => 26990000,
                'quantity' => 3875,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 55,
                'name' => 'Apple iPhone 13 Pro 1 sim 128GB',
                'price' => 26999000,
                'quantity' => 4518,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 56,
                'name' => 'Laptop Lenovo Yoga Slim 7i 14ITL5 82A300A6VN',
                'price' => 26099000,
                'quantity' => 4108,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 57,
                'name' => 'Apple iPhone 13 Pro 1 sim 128GB cũ 99% KH',
                'price' => 25999000,
                'quantity' => 4543,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 58,
                'name' => 'MacBook Air 13 inch Late 2020 256GB Ram 8GB Gold MGND3 - Chip M1',
                'price' => 25499000,
                'quantity' => 5298,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 59,
                'name' => 'MacBook Air 13 inch Late 2020 256GB Silver MGN93 - Chip M1',
                'price' => 25299000,
                'quantity' => 3206,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 60,
                'name' => 'Apple iPhone 12 Pro Max 1 sim 256GB cũ 99% KH',
                'price' => 24799000,
                'quantity' => 5173,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 61,
                'name' => 'Samsung Galaxy S21 Ultra 5G G998 128GB',
                'price' => 24599000,
                'quantity' => 4166,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 62,
                'name' => 'Apple iPhone 13 256GB VN/A',
                'price' => 24499000,
                'quantity' => 4734,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 63,
                'name' => 'Laptop Acer Nitro 5 Eagle AN515 57 54MV 2021',
                'price' => 24399000,
                'quantity' => 3609,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 64,
                'name' => 'Samsung Galaxy Z Flip3 5G F711 256GB Ram 8GB',
                'price' => 24199000,
                'quantity' => 2179,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 65,
                'name' => 'Laptop Acer Nitro 5 AN515 57 51G6 2021',
                'price' => 24090000,
                'quantity' => 4556,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 66,
                'name' => 'Apple iPhone 13 1 sim 512GB',
                'price' => 23999000,
                'quantity' => 4503,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 67,
                'name' => 'Dell Vostro 3400 V4I7015W Black',
                'price' => 23990000,
                'quantity' => 3258,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 68,
                'name' => 'Laptop Lenovo Gaming 3 15IHU6 82K1004YVN',
                'price' => 23599000,
                'quantity' => 2106,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 69,
                'name' => 'Apple iPhone 13 1 sim 512GB cũ 99% KH',
                'price' => 22999000,
                'quantity' => 4111,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 70,
                'name' => 'Apple iPhone 12 Pro Max 1 sim 128GB 99% (89 Trần Quang Khải)',
                'price' => 22999000,
                'quantity' => 4513,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 71,
                'name' => 'Apple iPhone 13 1 sim 256GB',
                'price' => 22499000,
                'quantity' => 2604,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 72,
                'name' => 'Samsung Galaxy Z Fold 2 F916 cũ 99%',
                'price' => 22499000,
                'quantity' => 5005,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 73,
                'name' => 'Samsung Galaxy Z Flip3 5G F711 128GB Ram 8GB',
                'price' => 22399000,
                'quantity' => 3592,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 74,
                'name' => 'Laptop Acer Nitro 5 Eagle AN515-57-56S5',
                'price' => 22299000,
                'quantity' => 5099,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 75,
                'name' => 'Samsung Galaxy Z Flip3 5G F711 256GB Ram 8GB',
                'price' => 21999000,
                'quantity' => 2483,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 76,
                'name' => 'Samsung Galaxy Z Flip3 5G F711 256GB Ram 8GB (New - BH12T)',
                'price' => 21899000,
                'quantity' => 4728,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 77,
                'name' => 'Samsung Galaxy S21 Ultra 5G G998 128GB (New - BH12T)',
                'price' => 21649000,
                'quantity' => 3397,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 78,
                'name' => 'Laptop MSI GF63 10SC 020VN',
                'price' => 21490000,
                'quantity' => 3314,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 2,
            ],
            [
                'id' => 79,
                'name' => 'Apple iPhone 13 1 sim',
                'price' => 21299000,
                'quantity' => 4748,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 1,
            ],
            [
                'id' => 80,
                'name' => 'Apple iPhone 13 1 sim cũ 99% KH',
                'price' => 20999000,
                'quantity' => 2171,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 1,
            ],
            [
                'id' => 81,
                'name' => 'Apple iPhone 12 Pro 1 sim 512GB cũ 99% KH',
                'price' => 20999000,
                'quantity' => 4715,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 82,
                'name' => 'Laptop Dell Vostro 15 3510 7T2YC1',
                'price' => 20990000,
                'quantity' => 3541,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 2,
            ],
            [
                'id' => 83,
                'name' => 'Samsung Galaxy Z Flip3 5G F711 128GB Ram 8GB (New - BH12T)',
                'price' => 19999000,
                'quantity' => 2172,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 84,
                'name' => 'Apple iPad Pro 12.9 Wifi 128 GB 2020 LikeNew (114 Võ Văn Ngân)',
                'price' => 20799000,
                'quantity' => 3580,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 3,
            ],
            [
                'id' => 85,
                'name' => 'Laptop Dell Vostro 14 3400 YX51W2',
                'price' => 20699000,
                'quantity' => 3970,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 2,
            ],
            [
                'id' => 86,
                'name' => 'Laptop Acer Aspire 7 A715 42G R05G',
                'price' => 20499000,
                'quantity' => 2086,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 87,
                'name' => 'Apple Mac mini M1 2021 512GB Ram 8GB MGNT3SA/A',
                'price' => 20499000,
                'quantity' => 2801,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 4,
            ],
            [
                'id' => 88,
                'name' => 'Samsung Galaxy Note 20 Ultra 5G N986 (New - BH12T)',
                'price' => 20299000,
                'quantity' => 3105,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 1,
            ],
            [
                'id' => 89,
                'name' => 'Đồng hồ thông minh Garmin Fenix 6X Titanium Carbon Gray - Titanium Band',
                'price' => 20290000,
                'quantity' => 2041,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 4,
            ],
            [
                'id' => 90,
                'name' => 'Laptop Dell Inspiron 15 3505 Y1N1T5',
                'price' => 20190000,
                'quantity' => 5031,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 2,
            ],
            [
                'id' => 91,
                'name' => 'Laptop MSI GF63 10SC 468VN',
                'price' => 19999000,
                'quantity' => 4518,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 92,
                'name' => 'Samsung Galaxy S21 Plus 5G G996 128GB',
                'price' => 19899000,
                'quantity' => 2420,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 93,
                'name' => 'Apple iPhone 12 Pro 1 sim 256GB cũ 99% KH',
                'price' => 19799000,
                'quantity' => 5055,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 94,
                'name' => 'Samsung Galaxy Tab S7 Plus T975 (New - BH12T)',
                'price' => 19499000,
                'quantity' => 2124,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 95,
                'name' => 'Apple iPhone 12 Mini 256Gb VN/A',
                'price' => 18999000,
                'quantity' => 3182,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 96,
                'name' => 'Apple iPad mini 6 5G 64GB',
                'price' => 18999000,
                'quantity' => 3941,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 3,
            ],
            [
                'id' => 97,
                'name' => 'Apple iPhone 12 Pro 1 sim 128Gb cũ 99% KH',
                'price' => 18799000,
                'quantity' => 3738,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 98,
                'name' => 'Đồng hồ thông minh Garmin Fenix 6X Carbon Gray - Sapphire',
                'price' => 18690000,
                'quantity' => 2571,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 4,
            ],
            [
                'id' => 99,
                'name' => 'Máy tạo oxy 10 lít Dynmed DO2- 10A (chính hãng)',
                'price' => 18500000,
                'quantity' => 3719,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 4,
            ],
            [
                'id' => 100,
                'name' => 'Samsung Galaxy Z Flip3 256GB Ram 8GB Hàn Quốc 99%',
                'price' => 18499000,
                'quantity' => 2135,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 101,
                'name' => 'Macbook Air 13.3 inch 2018 256Gb MRE92 Gray cũ 99%',
                'price' => 18499000,
                'quantity' => 3269,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 2,
            ],
            [
                'id' => 102,
                'name' => 'Apple iPad Air 4 10.9 Cellular 64GB 2020',
                'price' => 18499000,
                'quantity' => 2795,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 3,
            ],
            [
                'id' => 103,
                'name' => 'Apple iPhone 12 1 Sim 256GB cũ 99% KH',
                'price' => 17499000,
                'quantity' => 2438,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 1,
            ],
            [
                'id' => 104,
                'name' => 'Apple iPad mini 6 Wifi 256GB',
                'price' => 17299000,
                'quantity' => 4589,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'simple',
                'category_id' => 3,
            ],
            [
                'id' => 105,
                'name' => 'Samsung Galaxy Z Flip3 5G F711 256GB Ram 8GB 99% (654 Lê Hồng Phong)',
                'price' => 17199000,
                'quantity' => 4370,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 1,
            ],
            [
                'id' => 106,
                'name' => 'Apple iPad mini 6 5G 64GB',
                'price' => 16999000,
                'quantity' => 3112,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 3,
            ],
            [
                'id' => 107,
                'name' => 'Samsung Galaxy S21 FE 5G G990 256GB Ram 8GB',
                'price' => 16599000,
                'quantity' => 4367,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 1,
            ],
            [
                'id' => 108,
                'name' => 'Laptop Dell Vostro 3405 V4R53500U003W Black',
                'price' => 16590000,
                'quantity' => 2022,
                'parent_id' => null,
                'image' => null,
                'status' => 1,
                'description' => null,
                'type' => 'configurable',
                'category_id' => 2,
            ],
        ];

        $listProductChild = [];

        foreach ($listProductParent as $key => $item) {
            $listProductParent[$key]['quantity'] *= 3000;
            if ($item['type'] == 'configurable') {
                $idMax = $listProductChild[array_key_last($listProductChild)]['id'] ?? 0;

                if (empty($idMax)) {
                    $idMax = $listProductParent[array_key_last($listProductParent)]['id'] ?? 0;
                }

                $idMax++;

                for ($i = 1; $i <= 2; ++$i) {
                    $listProductChild[] = [
                        'id' => $idMax++,
                        'name' => '',
                        'price' => $item['price'] + rand(-500000, 500000),
                        'quantity' => 1000 * 3000,
                        'parent_id' => $item['id'],
                        'image' => '',
                        'status' => 1,
                        'type' => 'simple'
                    ];
                }
            }
        }

        $listAttr = [
            1 => [
                'id' => 1,
                'name' => 'Màu',
                'list_random' => [
                    'Xanh',
                    'Đỏ',
                    'Trắng',
                    'Đen',
                    'Vàng'
                ],
                'is_private' => 1,
                'category_id' => []
            ],
            2 => [
                'id' => 2,
                'name' => 'Bộ nhớ trong',
                'list_random' => [
                    '64GB',
                    '32GB',
                    '16GB',
                    '128GB',
                    '256GB'
                ],
                'is_private' => 1,
                'category_id' => [1, 2]
            ],
            3 => [
                'id' => 3,
                'name' => 'Ram',
                'list_random' => [
                    '4GB',
                    '8GB',
                    '16GB',
                    '32GB',
                    '12GB'
                ],
                'is_private' => 1,
                'category_id' => [1, 2]
            ],
            4 => [
                'id' => 4,
                'name' => 'Dung lượng pin',
                'list_random' => [
                    '2000mAh',
                    '3000mAh',
                    '1500mAh',
                    '3300mAh',
                    '4500mAh'
                ],
                'is_private' => 0,
                'category_id' => [1, 2]
            ],
            5 => [
                'id' => 5,
                'name' => 'Camera trước',
                'list_random' => [
                    '12MP',
                    '24MP',
                    '50MP',
                    '128MP',
                    '100MP',
                ],
                'is_private' => 0,
                'category_id' => [1]
            ],
            6 => [
                'id' => 6,
                'name' => 'Camera sau',
                'list_random' => [
                    '12MP',
                    '24MP',
                    '50MP',
                    '128MP',
                    '100MP',
                ],
                'is_private' => 0,
                'category_id' => [1]
            ]
        ];

        $listProductAttrConfig = [];

        foreach ($listAttr as $attrId => $value) {
            foreach ($listProductParent as $product) {
                if (empty($value['category_id']) || in_array($product['category_id'], $value['category_id'])) {
                    $listProductAttrConfig[] = [
                        'product_id' => $product['id'],
                        'attribute_id' => $attrId,
                        'is_private' => $value['is_private']
                    ];
                }
            }
        }

        $listValues = [];


        foreach ($listProductAttrConfig as $item) {
            $listRandom = $listAttr[$item['attribute_id']]['list_random'] ?? [];

            if (!empty($item['is_private'])) {
                foreach ($listProductChild as $key => $itemProductChild) {
                    if ($itemProductChild['parent_id'] == $item['product_id']) {
                        $listRandom = array_values($listRandom);
                        $randomIndex = rand(0, count($listRandom) - 1);

                        if (!empty($listRandom[$randomIndex])) {
                            $listValues[] = [
                                'product_id' => $itemProductChild['id'],
                                'attribute_id' => $item['attribute_id'],
                                'text_value' => $listRandom[$randomIndex]
                            ];

                            unset($listRandom[$randomIndex]);
                        } else {
                            unset($listProductChild[$key]);
                        }
                    }
                }
            } else {
                if (!empty($listRandom)) {
                    $listValues[] = [
                        'product_id' => $item['product_id'],
                        'attribute_id' => $item['attribute_id'],
                        'text_value' => $listRandom[rand(0, count($listRandom) - 1)]
                    ];
                }
            }
        }


        DB::table('products')
            ->insert($listProductParent);

        DB::table('products')
            ->insert($listProductChild);

        foreach ($listAttr as $key => $value) {
            unset($listAttr[$key]['list_random']);
            unset($listAttr[$key]['is_private']);
            unset($listAttr[$key]['category_id']);
        }

        DB::table('attributes')
            ->insert($listAttr);

        DB::table('product_attr_config')
            ->insert($listProductAttrConfig);

        DB::table('values')
            ->insert($listValues);


        foreach (File::glob(storage_path('product_image_fake/*')) as $image) {
            $productId = explode('/', $image);
            $productId = $productId[array_key_last($productId)];

            $avatar = File::glob($image . '/avatar/*');
            $avatar = $avatar[0] ?? null;
            $avatarName = explode('/', $avatar);
            $avatarName = $avatarName[array_key_last($avatarName)];
            $avatarPathNew = 'product_images/' . $productId;

            if (!File::isDirectory(public_path($avatarPathNew))) {
                File::makeDirectory(public_path($avatarPathNew), 0777, true, true);
            }

            File::copy($avatar, public_path($avatarPathNew . '/' . $avatarName));
            DB::table('products')
                ->where('id', '=', $productId)
                ->update([
                    'image' => $avatarPathNew . '/' . $avatarName
                ]);

            $listImage =  File::glob($image . '/list_image/*');

            $arrayProductImage = [];

            foreach ($listImage as $itemImage) {
                $imageName = explode('/', $itemImage);
                $imageName = $imageName[array_key_last($imageName)];
                File::copy($itemImage, public_path($avatarPathNew . '/' . $imageName));

                $arrayProductImage[] = [
                    'product_id' => $productId,
                    'image' => $avatarPathNew . '/' . $imageName
                ];
            }

            DB::table('product_images')
                ->insert($arrayProductImage);
        }


        DB::table('users')
            ->insert([
                'id' => 1,
                'name' => 'Hoang',
                'email' => 'trankimhoang11052000@gmail.com',
                'password' => Hash::make(1234567),
                'address' => '123',
                'phone' => '0584246834',
                'status' => 1
            ]);

        $listOrderFake = [];


        $paymentType = [
            0 => 'MOMO',
            1 => 'COD'
        ];

        $statusOrder = array_keys([
            'PENDING' => 'Đang chờ xử lí',
            'CONFIRMED' => 'Đã xác nhận',
            'DELIVERY' => 'Đang giao hàng',
            'SUCCESS' => 'Thành công',
        ]);

        for ($i = 1; $i <= 500; ++$i) {
            $time = strtotime(rand(1, date('m')) . '/' . rand(1, 28) . '/' . 2023);
            $paymentTypeFake = $paymentType[rand(0, count($paymentType) - 1)];
            $statusFake = $statusOrder[rand(0, count($statusOrder) - 1)];

            $listOrderFake[] = [
                'id' => time() + $i,
                'note' => 'note ' . $i,
                'user_id' => 1,
                'address' => 'address ' . $i,
                'phone' => '0584246834',
                'payment_type' => $paymentTypeFake,
                'status' => $statusFake,
                'created_at' => date('Y-m-d',$time),
                'name' => 'Hoang',
                'email' => 'hoang@gmail.com',
                'payment_status' => ($paymentTypeFake == 'MOMO' || $statusFake == 'SUCCESS') ? 'PAID' : 'UNPAID',
                'payment_response' => 'test',
                'success_at' => Carbon::now(),
                'admin_note' => 'test ' . $i,
                'ship_code' => '12345test',
                'coupon_id' => null,
                'discount' => 0,
                'city_id' => 14,
                'shipping_fee' => 0
            ];
        }

        foreach (array_chunk($listOrderFake, 2000) as $listOrderFakeChuck) {
            DB::table('orders')
                ->insert($listOrderFakeChuck);
        }

        $listOrderProduct = [];

        $listProduct = DB::table('products')
            ->get()->mapWithKeys(function ($item) {
                return [$item->id => $item->price];
            })->toArray();


        foreach ($listOrderFake as $order) {
            foreach ($listProduct as $productId => $productPrice) {
                $isSelect = rand(0, 1);

                if (!empty($isSelect)) {
                    $listOrderProduct[] = [
                        'order_id' => $order['id'],
                        'product_id' => $productId,
                        'quantity' => rand(1, 3),
                        'price' => $productPrice
                    ];
                }
            }
        }

        foreach (array_chunk($listOrderProduct, 2000) as $listOrderProductChuck) {
            DB::table('order_products')
                ->insert($listOrderProductChuck);
        }






        return 1;
    }
}
