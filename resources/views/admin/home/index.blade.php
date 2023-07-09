@extends('layouts.master_admin')
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Tổng quan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Đơn thành công</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <p style="font-weight: bold;">{{ $sumOrderSuccess }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Tổng doanh thu</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <p style="font-weight: bold;">{{ formatVnd($total) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-3 col-xl-12">

                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Khách hàng đăng kí</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <p style="font-weight: bold;">{{ $totalUser }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Product Card -->
                    <div class="col-xxl-3 col-xl-12">
                        <div class="card info-card products-card">
                            <div class="card-body">
                                <h5 class="card-title">Sản phẩm hoạt động</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-book-3-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <p style="font-weight: bold;">{{ $totalProductActive }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Product Card -->

                </div>
            </div><!-- End Left side columns -->

            <div id="ajax-content" style="text-align: center;">
                <p>Đang tải đợi xíu...</p>
                <div class="spinner-border text-center" role="status"></div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $.ajax({
                method: 'GET',
                url: @json(route('admin.index.ajax')),
                success: function (data) {
                    $('#ajax-content').html(data);
                }
            });
        });
    </script>
@endsection
