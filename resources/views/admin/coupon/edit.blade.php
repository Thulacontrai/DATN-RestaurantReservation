@extends('admin.master')

@section('title', 'Chỉnh Sửa Coupon')

@section('content')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Chỉnh Sửa Coupon</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="code" class="form-label">Mã Coupon</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                        value="{{ old('code', $coupon->code) }}" required>
                                    @error('code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô Tả</label>
                                    <textarea class="form-control" id="description" name="description">{{ old('description', $coupon->description) }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="max_uses" class="form-label">Số Lần Sử Dụng Tối Đa</label>
                                    <input type="number" class="form-control" id="max_uses" name="max_uses"
                                        value="{{ old('max_uses', $coupon->max_uses) }}">
                                    @error('max_uses')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="start_time" class="form-label">Thời Gian Bắt Đầu</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time"
                                        value="{{ old('start_time', $coupon->start_time ? \Carbon\Carbon::parse($coupon->start_time)->format('Y-m-d\TH:i') : '') }}">
                                    @error('start_time')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="end_time" class="form-label">Thời Gian Kết Thúc</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time"
                                        value="{{ old('end_time', $coupon->end_time ? \Carbon\Carbon::parse($coupon->end_time)->format('Y-m-d\TH:i') : '') }}">
                                    @error('end_time')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="discount_type" class="form-label">Loại Giảm Giá</label>
                                    <select class="form-control" id="discount_type" name="discount_type" required>
                                        <option value="Percentage"
                                            {{ old('discount_type', $coupon->discount_type) == 'Percentage' ? 'selected' : '' }}>
                                            Phần Trăm</option>
                                        <option value="Fixed"
                                            {{ old('discount_type', $coupon->discount_type) == 'Fixed' ? 'selected' : '' }}>
                                            Cố Định</option>
                                    </select>
                                    @error('discount_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="discount_amount" class="form-label">Số Tiền Giảm Giá</label>
                                    <input type="number" class="form-control" id="discount_amount" name="discount_amount"
                                        step="0.01" value="{{ old('discount_amount', $coupon->discount_amount) }}">
                                    @error('discount_amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="active"
                                            {{ old('status', $coupon->status) == 'active' ? 'selected' : '' }}>Hoạt Động
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $coupon->status) == 'inactive' ? 'selected' : '' }}>Ngừng Hoạt
                                            Động</option>
                                        <option value="expired"
                                            {{ old('status', $coupon->status) == 'expired' ? 'selected' : '' }}>Hết Hạn
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Cập Nhật Coupon</button>
                                <a href="{{ route('admin.coupon.index') }}" class="btn btn-sm btn-secondary">Quay lại</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
        </div>
        <!-- Content wrapper end -->

    </div>
    <!-- Content wrapper scroll end -->

@endsection
