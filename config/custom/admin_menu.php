<?php
return [
    [
        'title' => 'Tổng quan',
        'route' => 'admin.index',
        'icon' => '<i class="bi bi-grid"></i>'
    ],
    [
        'title' => 'Quản lý sản phẩm',
        'icon' => '<i class="bi bi-menu-button-wide"></i>',
        'list_child' => [
            [
                'title' => 'Danh sách',
                'route' => 'admin.products.index'
            ],
            [
                'title' => 'Thêm mới (đơn)',
                'route' => 'admin.products.create'
            ],
            [
                'title' => 'Thêm mới (nhiều phiên bản)',
                'route' => 'admin.products.create',
                'array_param' => [
                    'type' => 'configurable'
                ]
            ],
        ]
    ],
    [
        'title' => 'Quản lý thuộc tính',
        'icon' => '<i class="bi bi-menu-button-wide"></i>',
        'list_child' => [
            [
                'title' => 'Danh sách',
                'route' => 'admin.attributes.index'
            ],
            [
                'title' => 'Thêm mới',
                'route' => 'admin.attributes.create'
            ],
        ]
    ],
    [
        'title' => 'Quản lý loại sản phẩm',
        'icon' => '<i class="bi bi-menu-button-wide"></i>',
        'list_child' => [
            [
                'title' => 'Danh sách',
                'route' => 'admin.categories.index'
            ],
            [
                'title' => 'Thêm mới',
                'route' => 'admin.categories.create'
            ],
        ]
    ],
    [
        'title' => 'Quản lý banner',
        'icon' => '<i class="bi bi-menu-button-wide"></i>',
        'list_child' => [
            [
                'title' => 'Danh sách',
                'route' => 'admin.banners.index'
            ],
            [
                'title' => 'Thêm mới',
                'route' => 'admin.banners.create'
            ],
        ]
    ],
    [
        'title' => 'Quản lý đơn đặt hàng',
        'icon' => '<i class="bi bi-menu-button-wide"></i>',
        'list_child' => [
            [
                'title' => 'Danh sách',
                'route' => 'admin.orders.index'
            ],
        ]
    ],
    [
        'title' => 'Quản lý khách hàng',
        'icon' => '<i class="bi bi-menu-button-wide"></i>',
        'list_child' => [
            [
                'title' => 'Danh sách',
                'route' => 'admin.users.index'
            ],
        ]
    ],
    [
        'title' => 'Quản lý mã khuyến mãi',
        'icon' => '<i class="bi bi-menu-button-wide"></i>',
        'list_child' => [
            [
                'title' => 'Danh sách',
                'route' => 'admin.coupons.index'
            ],
            [
                'title' => 'Thêm mới',
                'route' => 'admin.coupons.create'
            ],
        ]
    ],
    [
        'title' => 'Quản lý phí vận chuyển',
        'icon' => '<i class="bi bi-menu-button-wide"></i>',
        'list_child' => [
            [
                'title' => 'Danh sách',
                'route' => 'admin.cities.index'
            ],
        ]
    ],
    [
        'title' => 'Quản lý quản trị viên',
        'icon' => '<i class="bi bi-menu-button-wide"></i>',
        'list_child' => [
            [
                'title' => 'Danh sách',
                'route' => 'admin.admins.index'
            ],
            [
                'title' => 'Thêm mới',
                'route' => 'admin.admins.create'
            ],
        ]
    ],
];
