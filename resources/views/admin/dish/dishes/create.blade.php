@extends('admin.master')

@section('title', 'Thêm Mới Món Ăn')

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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Thêm Mới Món Ăn</div>
                            <a href="{{ route('admin.dishes.index') }}" class="btn btn-sm btn-secondary">Quay lại</a>
                        </div>
                        <div class="card-body">

                            <form id="addDishForm" method="POST" action="{{ route('admin.dishes.store') }}" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="dish-name" class="form-label">Tên Món Ăn</label>
                                    <input type="text" id="dish-name" name="name" class="form-control" placeholder="Nhập tên món ăn" required>
                                    <div class="invalid-feedback">Vui lòng nhập tên món ăn.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-category" class="form-label">Loại Món Ăn</label>
                                    <select id="dish-category" name="category_id" class="form-select" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn loại món ăn.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-price" class="form-label">Giá</label>
                                    <input type="number" id="dish-price" name="price" class="form-control" placeholder="Nhập giá món ăn" required>
                                    <div class="invalid-feedback">Vui lòng nhập giá món ăn.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-quantity" class="form-label">Số Lượng</label>
                                    <input type="number" id="dish-quantity" name="quantity" class="form-control" placeholder="Nhập số lượng món ăn" required>
                                    <div class="invalid-feedback">Vui lòng nhập số lượng món ăn.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-description" class="form-label">Mô tả Món Ăn</label>
                                    <textarea id="dish-description" name="description" class="form-control" placeholder="Nhập mô tả món ăn"></textarea>
                                    <div class="invalid-feedback">Vui lòng nhập mô tả món ăn.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-status" class="form-label">Trạng Thái</label>
                                    <select id="dish-status" name="status" class="form-select" required>
                                        <option value="available">Có sẵn</option>
                                        <option value="out_of_stock">Hết hàng</option>
                                        <option value="reserved">Đã đặt trước</option>
                                        <option value="in_use">Đang sử dụng</option>
                                        <option value="completed">Hoàn thành</option>
                                        <option value="cancelled">Đã hủy</option>
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn trạng thái món ăn.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-image" class="form-label">Hình Ảnh</label>
                                    <input type="file" id="dish-image" name="image" class="form-control" accept="image/*" required>
                                    <div class="invalid-feedback">Vui lòng chọn ảnh món ăn.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary">Thêm Mới</button>
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('addDishForm');
            const inputs = form.querySelectorAll('input, select, textarea');

            // Kiểm tra tính hợp lệ khi có sự kiện 'input' hoặc 'change'
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    validateInput(input);
                });
                input.addEventListener('change', function() {
                    validateInput(input);
                });
            });

            // Kiểm tra tính hợp lệ của toàn bộ form khi submit
            form.addEventListener('submit', function(event) {
                inputs.forEach(input => {
                    validateInput(input);
                });

                if (!form.checkValidity()) {
                    event.preventDefault(); // Ngăn chặn việc gửi form nếu có lỗi
                    event.stopPropagation();
                }
            });

            // Hàm kiểm tra tính hợp lệ của từng trường
            function validateInput(input) {
                if (input.checkValidity()) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                }
            }
        });
    </script>
@endsection
