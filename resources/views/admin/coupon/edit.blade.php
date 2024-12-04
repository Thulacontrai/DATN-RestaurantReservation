@extends('admin.master')

@section('title', 'Chỉnh Sửa Phiếu Giảm Giá')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header text-primary">
                            <h5><i class="bi bi-pencil-square"></i> Chỉnh Sửa Phiếu giảm giá</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="code" class="form-label"><i class="bi bi-upc-scan"></i> Mã Coupon</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                           value="{{ old('code', $coupon->code) }}" required>
                                    @error('code')
                                        <div class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="form-label"><i class="bi bi-chat-text"></i> Mô Tả</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $coupon->description) }}</textarea>
                                    @error('description')
                                        <div class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="max_uses" class="form-label"><i class="bi bi-123"></i> Số Lần Sử Dụng Tối Đa</label>
                                        <input type="number" class="form-control" id="max_uses" name="max_uses"
                                               value="{{ old('max_uses', $coupon->max_uses) }}" min="1" max="100" required>
                                        @error('max_uses')
                                            <div class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="discount_amount" class="form-label"><i class="bi bi-currency-dollar"></i> Số Tiền Giảm Giá</label>
                                        <input type="number" class="form-control" id="discount_amount" name="discount_amount"
                                               step="0.01" value="{{ old('discount_amount', $coupon->discount_amount) }}" required>
                                        @error('discount_amount')
                                            <div class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="start_time" class="form-label"><i class="bi bi-calendar-event"></i> Thời Gian Bắt Đầu</label>
                                        <input type="datetime-local" class="form-control" id="start_time" name="start_time"
                                               value="{{ old('start_time', $coupon->start_time ? \Carbon\Carbon::parse($coupon->start_time)->format('Y-m-d\TH:i') : '') }}">
                                        @error('start_time')
                                            <div class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="end_time" class="form-label"><i class="bi bi-calendar-x"></i> Thời Gian Kết Thúc</label>
                                        <input type="datetime-local" class="form-control" id="end_time" name="end_time"
                                               value="{{ old('end_time', $coupon->end_time ? \Carbon\Carbon::parse($coupon->end_time)->format('Y-m-d\TH:i') : '') }}">
                                        @error('end_time')
                                            <div class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="discount_type" class="form-label"><i class="bi bi-tag"></i> Loại Giảm Giá</label>
                                    <select class="form-control" id="discount_type" name="discount_type" required>
                                        <option value="Percentage" {{ old('discount_type', $coupon->discount_type) == 'Percentage' ? 'selected' : '' }}>Phần Trăm</option>
                                        <option value="Fixed" {{ old('discount_type', $coupon->discount_type) == 'Fixed' ? 'selected' : '' }}>Cố Định</option>
                                    </select>
                                    @error('discount_type')
                                        <div class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="status" class="form-label"><i class="bi bi-toggle-on"></i> Trạng Thái</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="active" {{ old('status', $coupon->status) == 'active' ? 'selected' : '' }}>Hoạt Động</option>
                                        <option value="inactive" {{ old('status', $coupon->status) == 'inactive' ? 'selected' : '' }}>Ngừng Hoạt Động</option>
                                        <option value="expired" {{ old('status', $coupon->status) == 'expired' ? 'selected' : '' }}>Hết Hạn</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Cập Nhật</button>
                                    <a href="{{ route('admin.coupon.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Quay lại</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const maxUsesInput = document.getElementById('max_uses');
            maxUsesInput.addEventListener('input', function() {
                let value = parseInt(maxUsesInput.value, 10);
                if (value < 1) {
                    maxUsesInput.value = 1;
                } else if (value > 100) {
                    maxUsesInput.value = 100;
                }
            });
        });
    </script>
@endsection
