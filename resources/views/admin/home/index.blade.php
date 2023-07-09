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
