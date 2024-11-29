@extends('admin.master')

@section('title', 'Thêm Mới Bàn')

@section('content')

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Thêm Mới Bàn</div>
                        </div>
                        <div class="card-body">
                            <form id="tableForm" action="{{ route('admin.table.store') }}" method="POST" novalidate>
                                @csrf

                                <!-- Khu Vực -->
                                <div class="mb-3">
                                    <label for="area" class="form-label">Khu Vực</label>
                                    <select class="form-control" id="area" name="area" required>
                                        <option value="Tầng 1" {{ old('area') == 'Tầng 1' ? 'selected' : '' }}>Tầng 1
                                        </option>
                                        <option value="Tầng 2" {{ old('area') == 'Tầng 2' ? 'selected' : '' }}>Tầng 2
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn khu vực.</div>

                                </div>

                                <div class="mb-3">
                                    <label for="table_number" class="form-label">Số Bàn</label>
                                    <input type="number" class="form-control" id="table_number" name="table_number"
                                        value="{{ old('table_number') }}" required min="1" max="100" placeholder="Nhập số bàn">
                                    <div class="invalid-feedback">Vui lòng nhập số bàn từ 1 đến 100.</div>
                                </div>


                                <!-- Loại Bàn -->
                                <div class="mb-3">
                                    <label for="table_type" class="form-label">Loại Bàn</label>
                                    <select class="form-control" id="table_type" name="table_type" required>
                                        <option value="Thường" {{ old('table_type') == 'Thường' ? 'selected' : '' }}>Thường
                                        </option>
                                        <option value="VIP" {{ old('table_type') == 'VIP' ? 'selected' : '' }}>VIP
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn loại bàn.</div>

                                </div>

                                <!-- Trạng Thái -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Có
                                            sẵn</option>
                                        <option value="Reserved" {{ old('status') == 'Reserved' ? 'selected' : '' }}>Đã đặt
                                            trước</option>
                                        <option value="Occupied" {{ old('status') == 'Occupied' ? 'selected' : '' }}>Đang sử
                                            dụng</option>
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn trạng thái bàn.</div>

                                </div>

                                <button type="submit" class="btn btn-primary">Thêm Bàn</button>
                                <a href="{{ route('admin.table.index') }}" class="btn btn-sm btn-secondary">Quay lại</a>
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
            const form = document.getElementById('tableForm');
            const inputs = form.querySelectorAll('input, select');
            const tableNumberInput = document.getElementById('table_number');

            // Thêm sự kiện kiểm tra cho từng input
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    // Kiểm tra riêng cho trường "Số Bàn"
                    if (input.id === 'table_number') {
                        const value = parseInt(input.value);
                        if (value < 1 || value > 100 || isNaN(value)) {
                            input.setCustomValidity("Số bàn phải nằm trong khoảng từ 1 đến 100.");
                        } else {
                            input.setCustomValidity(""); // Xóa lỗi nếu hợp lệ
                        }
                    }

                    // Kiểm tra tính hợp lệ chung
                    if (input.checkValidity()) {
                        input.classList.remove('is-invalid');
                        input.classList.add('is-valid');
                    } else {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                    }
                });
            });

            // Kiểm tra khi submit form
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
        document.addEventListener('DOMContentLoaded', function () {
            const tableNumberInput = document.getElementById('table_number');

            // Giới hạn giá trị khi người dùng nhập
            tableNumberInput.addEventListener('input', function () {
                const value = parseInt(tableNumberInput.value);

                // Nếu giá trị nhỏ hơn 1 hoặc không hợp lệ
                if (isNaN(value) || value < 1) {
                    tableNumberInput.value = ''; // Reset giá trị
                    tableNumberInput.classList.add('is-invalid');
                }
                // Nếu giá trị vượt quá 100
                else if (value > 100) {
                    tableNumberInput.value = 100; // Giới hạn giá trị tối đa
                    tableNumberInput.classList.add('is-invalid');
                }
                // Nếu giá trị hợp lệ
                else {
                    tableNumberInput.classList.remove('is-invalid');
                }
            });
        });
    </script>

@endsection
