@extends('admin.master')

@section('title', 'Thêm Nguyên Liệu Mới')

@section('content')
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">Thêm Nguyên Liệu Mới</div>
                        <div class="card-body">
                            <form id="ingredientForm" action="{{ route('admin.ingredient.store') }}" method="POST" novalidate>
                                @csrf

                                <!-- Tên Nguyên Liệu -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên Nguyên Liệu</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Nhập tên nguyên liệu" required>
                                    <div class="invalid-feedback">Vui lòng nhập tên nguyên liệu.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Giá</label>
                                    <input type="number" step="0.01" name="price" class="form-control"
                                        placeholder="Nhập giá" min="1" max="5000000" required>
                                    <div class="invalid-feedback">Giá phải nằm trong khoảng từ 1 đến 1.000.000 VNĐ</div>
                                </div>

                                <!-- Đơn Vị -->
                                <div class="mb-3">
                                    <label for="unit" class="form-label">Đơn Vị</label>
                                    <input type="text" name="unit" class="form-control" placeholder="Nhập đơn vị"
                                        required>
                                    <div class="invalid-feedback">Vui lòng nhập đơn vị.</div>
                                </div>

                                <!-- Phân Loại -->
                                <div class="mb-3">
                                    <label for="category" class="form-label">Phân Loại</label>
                                    <select name="category" class="form-select" required>
                                        <option value="" disabled selected>Chọn phân loại</option>
                                        <option value="Đồ tươi">Đồ tươi</option>
                                        <option value="Đồ đóng hộp">Đồ đóng hộp</option>
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn phân loại.</div>
                                </div>

                                <button type="submit" class="btn btn-success">Lưu</button>
                                <a href="{{ route('admin.ingredient.index') }}" class="btn btn-sm btn-secondary">Quay
                                    lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('ingredientForm');
            const inputs = form.querySelectorAll('input, select');

            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (input.checkValidity()) {
                        input.classList.remove('is-invalid');
                        input.classList.add('is-valid');
                    } else {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                    }
                });
            });

            form.addEventListener('submit', function(event) {
                let isValid = true;
                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    }
                });

                if (!isValid) {
                    event.preventDefault(); // Ngăn biểu mẫu gửi nếu không hợp lệ
                    event.stopPropagation();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceInput = document.querySelector('input[name="price"]');

            priceInput.addEventListener('input', function() {
                let value = parseFloat(priceInput.value);

                // Kiểm tra nếu giá trị nhỏ hơn 1 hoặc lớn hơn 100.000.000
                if (value < 1 || value > 1000000 || isNaN(value)) {
                    priceInput.setCustomValidity('Giá phải nằm trong khoảng từ 1 đến 100.000.000.');
                    priceInput.classList.add('is-invalid');
                } else {
                    priceInput.setCustomValidity('');
                    priceInput.classList.remove('is-invalid');
                }

                // Đảm bảo rằng giá trị không âm và bắt đầu từ 1
                if (value < 1) {
                    priceInput.value = 1; // Đặt lại giá trị về 1 nếu nhỏ hơn 1
                }

                // Giới hạn không cho phép nhập giá trị lớn hơn 100.000.000
                if (value > 1000000) {
                    priceInput.value = 1000000; // Đặt lại giá trị về 100.000.000 nếu lớn hơn 100.000.000
                }
            });
        });
    </script>
@endsection
