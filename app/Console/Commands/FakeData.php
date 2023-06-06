<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
                'name' => 'Asus zenbook v1',
                'price' => 24000000,
                'quantity' => 789,
                'parent_id' => null,
                'image' => '',
                'status' => 1,
                'description' => 'zenbook',
                'type' => 'simple',
                'category_id' => 2
            ],
            [
                'id' => 5,
                'name' => 'Asus vivobook',
                'price' => 25000000,
                'quantity' => 789,
                'parent_id' => null,
                'image' => '',
                'status' => 1,
                'description' => 'vivobook',
                'type' => 'simple',
                'category_id' => 2
            ],
            [
                'id' => 6,
                'name' => 'Ốp lưng iphone 11',
                'price' => 100000,
                'quantity' => 789,
                'parent_id' => null,
                'image' => '',
                'status' => 1,
                'description' => 'Ốp lưng iphone 11',
                'type' => 'simple',
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

        return 1;
    }
}
