@extends('admin.master')

@section('title', 'Chi Tiết Coupon')

@section('content')
@include('admin.layouts.messages')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card shadow-lg">
                        <div class="card-header d-flex justify-content-between align-items-center text-white">
                            <h4 class="card-title mb-3 text-secondary">Chi Tiết Phiếu Giảm Giá</h4>
                            <a href="{{ route('admin.coupon.index') }}" class="btn btn-sm btn-light  mb-3">Quay Lại</a>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="text-primary">Thông Tin Phiếu Giảm Giá</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Mã Giảm Giá:</strong> {{ $coupon->code }}</li>
                                        <li class="list-group-item"><strong>Mô Tả:</strong> {{ $coupon->description }}</li>
                                        <li class="list-group-item"><strong>Số Lần Sử Dụng Tối Đa:</strong>
                                            {{ $coupon->max_uses }}</li>
                                    </ul>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="text-primary">Chi Tiết Thời Gian</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Thời Gian Bắt Đầu:</strong>
                                            {{ $coupon->start_time }}</li>
                                        <li class="list-group-item"><strong>Thời Gian Kết Thúc:</strong>
                                            {{ $coupon->end_time }}</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="text-primary">Chi Tiết Giảm Giá</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Loại Giảm Giá:</strong>
                                            {{ $coupon->discount_type }}</li>
                                        <li class="list-group-item"><strong>Số Tiền Giảm Giá:</strong>
                                            {{ number_format($coupon->discount_amount, 0, ',', '.') }} VND</li>
                                    </ul>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="text-primary">Trạng Thái</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Trạng Thái:</strong> {{ $coupon->status }}</li>
                                    </ul>
                                </div>
                            </div>

                            <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary mt-3">Quay Lại Danh Sách</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content wrapper end -->
    </div>

@endsection
