<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    @hasSection('title')
        <title>@yield('title') - Admin - {{ env('APP_NAME') }}</title>
    @else
        <title>Admin - {{ env('APP_NAME') }}</title>
    @endif

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('theme/admin/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('theme/admin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="{{ asset('theme/admin/assets/font/font.css') }}" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('theme/admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('theme/admin/assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('admin.index') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('theme/admin/assets/img/logo.png') }}" alt="">
            <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    @yield('search')

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->getImage() }}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->name }}</h6>
                        <span>Quản trị viên</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.admins.edit', \Illuminate\Support\Facades\Auth::guard('admin')->user()->id) }}">
                            <i class="bi bi-gear"></i>
                            <span>Chỉnh sửa thông tin</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Đăng xuất</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @php
            $listMenu = config('custom.admin_menu');
        @endphp

        @foreach($listMenu as $keyMenu => $menu)
            @if(empty($menu['list_child']))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route($menu['route']) }}" @if($menu['route'] != \Request::route()->getName()) style="background: none;" @endif>
                        {!! $menu['icon'] !!}
                        <span @if($menu['route'] != \Request::route()->getName()) style="color: #012970;" @endif>{{ __($menu['title'] ?? '') }}</span>
                    </a>
                </li>
            @else
                @php
                    $isCurrentRoute = false;
                    foreach ($menu['list_child'] as $menuChild) {
                        if ($menuChild['route'] == \Request::route()->getName()) {
                            $isCurrentRoute = true;
                        }
                    }
                @endphp

                <li class="nav-item @if($isCurrentRoute) active @endif">
                    <a class="nav-link @if(!$isCurrentRoute) collapsed @endif" data-bs-target="#components-{{ $keyMenu }}" data-bs-toggle="collapse" href="#">
                        {!! $menu['icon'] !!}
                        <span>{{ __($menu['title'] ?? '') }}</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-{{ $keyMenu }}" class="nav-content collapse @if($isCurrentRoute) show @endif" data-bs-parent="#sidebar-nav">
                        @foreach($menu['list_child'] as $menuChild)
                            <li>
                                <a href="{{ route($menuChild['route'], $menuChild['array_param'] ?? []) }}" class="@if($menuChild['route'] == \Request::route()->getName() && implode('_', $menuChild['array_param'] ?? []) == implode('_', request()->toArray())) active @endif">
                                    <i class="bi bi-circle"></i><span>{{ __($menuChild['title'] ?? '') }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach

    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @yield('content')

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>Tran Kim Hoang</span></strong>. All Rights Reserved
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('theme/admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/php-email-form/validate.js') }}"></script>


<!-- Template Main JS File -->
<script src="{{ asset('theme/admin/assets/js/main.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('js/loadingoverlay.min.js') }}"></script>

<script src="{{ asset('lib/select2/js/select2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('lib/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lib/sweetalert2/sweetalert2.min.css') }}">
<script src="{{ asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>


@yield('js')
<script>
    $(document).ready(function () {
        $('.btn-delete-index').click(function () {
            Swal.fire({
                title: 'Bạn có muốn xóa #' + $(this).attr('data-id') + '?',
                showCancelButton: true,
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy bỏ'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $(this).parents('form').submit();
                }
            });

            return false;
        });
    });
</script>

</body>

</html>
