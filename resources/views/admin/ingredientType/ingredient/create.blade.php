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
                                    <input type="text" name="name" class="form-control" placeholder="Nhập tên nguyên liệu" required>
                                    <div class="invalid-feedback">Vui lòng nhập tên nguyên liệu.</div>
                                </div>

                                <!-- Giá -->
                                <div class="mb-3">
                                    <label for="price" class="form-label">Giá</label>
                                    <input type="number" step="0.01" name="price" class="form-control" placeholder="Nhập giá" required>
                                    <div class="invalid-feedback">Vui lòng nhập giá.</div>
                                </div>

                                <!-- Đơn Vị -->
                                <div class="mb-3">
                                    <label for="unit" class="form-label">Đơn Vị</label>
                                    <input type="text" name="unit" class="form-control" placeholder="Nhập đơn vị" required>
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
                                <a href="{{ route('admin.ingredient.index') }}" class="btn btn-sm btn-secondary">Quay lại</a>
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
@endsection
