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
                'name' => 'Phụ kiện điện thoại'
            ],
            [
                'id' => 4,
                'name' => 'Phụ kiện máy tính/laptop'
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
                'category_id' => 3
            ],
            [
                'id' => 8,
                'name' => 'Ốp macbook air m1',
                'price' => 150000,
                'quantity' => 789,
                'parent_id' => null,
                'image' => '',
                'status' => 1,
                'description' => 'Ốp macbook air m1',
                'type' => 'simple',
                'category_id' => 4
            ]
        ];

        $listProductChild = [];

        foreach ($listProductParent as $item) {
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
                        'quantity' => 1000,
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

        for ($i = 1; $i <= 5000; ++$i) {
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
