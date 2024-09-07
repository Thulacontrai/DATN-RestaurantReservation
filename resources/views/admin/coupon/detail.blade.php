@extends('admin.master')

@section('title', 'Chi Tiết Coupon')

@section('content')

    <div class="content-wrapper-scroll">
        <div class="content-wrapper">

            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Chi Tiết Coupon</div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="code" class="form-label">Mã Coupon</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ $coupon->code }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Mô Tả</label>
                                <textarea class="form-control" id="description" name="description" readonly>{{ $coupon->description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="max_uses" class="form-label">Số Lần Sử Dụng Tối Đa</label>
                                <input type="text" class="form-control" id="max_uses" name="max_uses" value="{{ $coupon->max_uses }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="start_time" class="form-label">Thời Gian Bắt Đầu</label>
                                <input type="text" class="form-control" id="start_time" name="start_time" value="{{ $coupon->start_time }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="end_time" class="form-label">Thời Gian Kết Thúc</label>
                                <input type="text" class="form-control" id="end_time" name="end_time" value="{{ $coupon->end_time }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="discount_type" class="form-label">Loại Giảm Giá</label>
                                <input type="text" class="form-control" id="discount_type" name="discount_type" value="{{ $coupon->discount_type }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="discount_amount" class="form-label">Số Tiền Giảm Giá</label>
                                <input type="text" class="form-control" id="discount_amount" name="discount_amount" value="{{ $coupon->discount_amount }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng Thái</label>
                                <input type="text" class="form-control" id="status" name="status" value="{{ $coupon->status }}" readonly>
                            </div>

                            <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary">Quay Lại Danh Sách</a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
