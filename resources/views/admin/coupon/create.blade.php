@extends('admin.master')

@section('title', 'Thêm Mới Coupon')

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
                            <div class="card-title">Thêm Mới Coupon</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.coupon.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="code" class="form-label">Mã Coupon</label>
                                    <input type="text" class="form-control" id="code" name="code" required>
                                    @error('code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô Tả</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="max_uses" class="form-label">Số Lượt Sử Dụng Tối Đa</label>
                                    <input type="number" class="form-control" id="max_uses" name="max_uses" min="1"
                                        max="100" value="1" required>
                                    <div class="invalid-feedback">Số lượt sử dụng phải nằm trong khoảng từ 1 đến 100 và
                                        không được âm.</div>
                                    @error('max_uses')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="start_time" class="form-label">Thời Gian Bắt Đầu</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time">
                                    @error('start_time')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="end_time" class="form-label">Thời Gian Kết Thúc</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time">
                                    @error('end_time')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="discount_type" class="form-label">Loại Giảm Giá</label>
                                    <select class="form-control" id="discount_type" name="discount_type" required>
                                        <option value="Percentage">Phần Trăm</option>
                                        <option value="Fixed">Cố Định</option>
                                    </select>
                                    @error('discount_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="discount_amount" class="form-label">Số Tiền Giảm Giá</label>
                                    <input type="number" class="form-control" id="discount_amount" name="discount_amount"
                                        step="0.01">
                                    @error('discount_amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="active">Hoạt Động</option>
                                        <option value="inactive">Ngừng Hoạt Động</option>
                                        <option value="expired">Hết Hạn</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Thêm Coupon</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const maxUsesInput = document.getElementById('max_uses');

            // Đảm bảo giá trị bắt đầu từ 1
            if (maxUsesInput.value < 1) {
                maxUsesInput.value = 1;
            }

            maxUsesInput.addEventListener('input', function() {
                let value = parseInt(maxUsesInput.value, 10);

                // Nếu giá trị âm, giá trị nhỏ hơn 1 hoặc lớn hơn 100 thì sửa lại giá trị
                if (value < 1) {
                    maxUsesInput.value = 1;
                    maxUsesInput.setCustomValidity('Số lượt sử dụng không được nhỏ hơn 1.');
                } else if (value > 100) {
                    maxUsesInput.value = 100;
                    maxUsesInput.setCustomValidity('Số lượt sử dụng không được lớn hơn 100.');
                } else {
                    maxUsesInput.setCustomValidity('');
                }
                maxUsesInput.classList.toggle('is-invalid', !maxUsesInput.checkValidity());
            });
        });
    </script>
@endsection
