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
                                <h5 class="card-title">Tổng đơn hàng thành công</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $sumOrderSuccess }}</h6>
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
                                        <h6>{{ formatVnd($total) }}</h6>
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
                                        <h6>{{ $totalUser }}</h6>
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
                                        <h6>{{ $totalProductActive }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Product Card -->

                    <!-- Category Card -->
                    <div class="col-xxl-3 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Danh mục</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-folder-4-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalCategory }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Category Card -->

                </div>
            </div><!-- End Left side columns -->

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Thống kê số đơn đặt hàng theo tháng</h5>

                        <!-- Bar Chart -->
                        <div id="chartCountNumberOrder"
                             style="min-height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"
                             class="echart" _echarts_instance_="ec_1687274276730">
                            <div
                                style="position: relative; width: 438px; height: 400px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                                <canvas data-zr-dom-id="zr_0" width="438" height="400"
                                        style="position: absolute; left: 0px; top: 0px; width: 438px; height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                let dataKey = [];
                                let dataValue = [];
                                let dataOrder = @json($listOrderOfMonthData);

                                for (let i = 1; i <= new Date().getMonth() + 1; ++i) {
                                    if (i < 10) {
                                        dataKey.push('0' + i);
                                        dataValue.push(dataOrder['0' + i] ?? 0);
                                    } else {
                                        dataKey.push(i);
                                        dataValue.push(dataOrder[i] ?? 0);
                                    }
                                }

                                console.log(dataValue);

                                echarts.init(document.querySelector("#chartCountNumberOrder")).setOption({
                                    xAxis: {
                                        type: 'category',
                                        data: dataKey,
                                        name: 'Tháng',
                                    },
                                    yAxis: {
                                        type: 'value',
                                        name: 'Số lượng đơn',
                                        splitNumber: 10,
                                        axisTick: {
                                            inside: true,
                                            alignWithLabel: true
                                        },
                                    },
                                    series: [{
                                        data: dataValue,
                                        type: 'bar',
                                        label: {
                                            normal: {
                                                show: true,
                                                position: 'top'
                                            }
                                        }
                                    }],
                                });
                            });
                        </script>
                        <!-- End Bar Chart -->
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Thống kê doanh thu theo tháng</h5>

                        <!-- Bar Chart -->
                        <div id="barChart"
                             style="min-height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"
                             class="echart" _echarts_instance_="ec_1687274276730">
                            <div
                                style="position: relative; width: 438px; height: 400px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                                <canvas data-zr-dom-id="zr_0" width="438" height="400"
                                        style="position: absolute; left: 0px; top: 0px; width: 438px; height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                let dataKey = [];
                                let dataValue = [];
                                let dataOrder = @json($listOrderMoneyOfMonthData);

                                for (let i = 1; i <= new Date().getMonth() + 1; ++i) {


                                    if (i < 10) {
                                        dataKey.push('0' + i);
                                        dataValue.push(dataOrder['0' + i] ?? 0);
                                    } else {
                                        dataKey.push(i);
                                        dataValue.push(dataOrder[i] ?? 0);
                                    }
                                }

                                echarts.init(document.querySelector("#barChart")).setOption({
                                    xAxis: {
                                        type: 'category',
                                        data: dataKey,
                                        name: 'Tháng',
                                    },
                                    yAxis: {
                                        type: 'value',
                                        name: 'Doanh thu (VND)',
                                        splitNumber: 10,
                                        axisTick: {
                                            inside: true,
                                            alignWithLabel: true
                                        },
                                    },
                                    series: [{
                                        data: dataValue,
                                        type: 'bar',
                                        label: {
                                            normal: {
                                                show: true,
                                                position: 'top',
                                                formatter: function (params) {
                                                    const value = params.value;
                                                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
                                                },
                                            },
                                        }
                                    }],

                                });
                            });
                        </script>
                        <!-- End Bar Chart -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
