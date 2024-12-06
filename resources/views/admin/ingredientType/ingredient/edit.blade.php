@extends('admin.master')

@section('title', 'Chỉnh Sửa Nguyên Liệu')

@section('content')
    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <style>
        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .swal2-timer-progress-bar {
            background: linear-gradient(90deg, #34eb4f, #00bcd4, #ffa726, #ffeb3b, #f44336);
            /* Gradient màu */
            background-size: 300% 300%;
            /* Kích thước gradient lớn để tạo hiệu ứng động */
            animation: gradientMove 2s ease infinite;
            /* Hiệu ứng lăn tăn */
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hiển thị thông báo lỗi
            @if ($errors->any())
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    toast: true,
                    title: "{{ $errors->first() }}",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                });
            @endif

            // Hiển thị thông báo thành công
            @if (session('success'))
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    toast: true,
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                });
            @endif
        });
    </script>
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title text-primary">Chỉnh Sửa Nguyên Liệu</div>
                        </div>
                        <div class="card-body">
                            <form id="ingredientEditForm" action="{{ route('admin.ingredient.update', $ingredient->id) }}"
                                method="POST" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Tên Nguyên Liệu -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên Nguyên Liệu</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-primary text-white"><i
                                                        class="bi bi-apple text-white"></i></span>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name', $ingredient->name) }}" required>
                                            </div>
                                            <div class="invalid-feedback">Vui lòng nhập tên nguyên liệu.</div>
                                        </div>
                                    </div>

                                    <!-- Giá -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Giá</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-success text-white">₫</span>
                                                <input type="number" step="0.01" name="price" class="form-control"
                                                    placeholder="Nhập giá" min="1" max="5000000"
                                                    value="{{ old('price', $ingredient->price) }}" required>
                                            </div>
                                            <div class="invalid-feedback">Giá phải nằm trong khoảng từ 1 đến 5.000.000 VNĐ
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Đơn Vị -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unit" class="form-label">Đơn Vị</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning"><i
                                                        class="bi bi-modem text-white"></i></span>
                                                <input type="text" name="unit" class="form-control"
                                                    value="{{ old('unit', $ingredient->unit) }}" required>
                                            </div>
                                            <div class="invalid-feedback">Vui lòng nhập đơn vị.</div>
                                        </div>
                                    </div>

                                    <!-- Phân Loại -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phân Loại</label>
                                            <div class="d-flex">
                                                <div class="form-check me-4">
                                                    <input class="form-check-input" type="radio" name="category"
                                                        id="categoryFresh" value="Đồ tươi"
                                                        {{ old('category', $ingredient->category) == 'Đồ tươi' ? 'checked' : '' }}
                                                        required>
                                                    <label class="form-check-label" for="categoryFresh">
                                                        Đồ tươi
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="category"
                                                        id="categoryCanned" value="Đồ đóng hộp"
                                                        {{ old('category', $ingredient->category) == 'Đồ đóng hộp' ? 'checked' : '' }}
                                                        required>
                                                    <label class="form-check-label" for="categoryCanned">
                                                        Đồ đóng hộp
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">Vui lòng chọn phân loại.</div>
                                        </div>
                                    </div>

                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                    <a href="{{ route('admin.ingredient.index') }}" class="btn btn-sm btn-secondary">Quay
                                        Lại</a>
                                </div>
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
            const form = document.getElementById('ingredientEditForm');
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
                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        input.classList.add('is-invalid');
                    }
                });

                if (!form.checkValidity()) {
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
