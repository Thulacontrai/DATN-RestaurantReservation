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
                                        <option value="Tầng 1" {{ old('area') == 'Tầng 1' ? 'selected' : '' }}>Tầng 1</option>
                                        <option value="Tầng 2" {{ old('area') == 'Tầng 2' ? 'selected' : '' }}>Tầng 2</option>
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn khu vực.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <!-- Số Bàn -->
                                <div class="mb-3">
                                    <label for="table_number" class="form-label">Số Bàn</label>
                                    <input type="number" class="form-control" id="table_number" name="table_number" value="{{ old('table_number') }}" required>
                                    <div class="invalid-feedback">Vui lòng nhập số bàn.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <!-- Loại Bàn -->
                                <div class="mb-3">
                                    <label for="table_type" class="form-label">Loại Bàn</label>
                                    <select class="form-control" id="table_type" name="table_type" required>
                                        <option value="Thường" {{ old('table_type') == 'Thường' ? 'selected' : '' }}>Thường</option>
                                        <option value="VIP" {{ old('table_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn loại bàn.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <!-- Trạng Thái -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Có sẵn</option>
                                        <option value="Reserved" {{ old('status') == 'Reserved' ? 'selected' : '' }}>Đã đặt trước</option>
                                        <option value="Occupied" {{ old('status') == 'Occupied' ? 'selected' : '' }}>Đang sử dụng</option>
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn trạng thái bàn.</div>
                                    <div class="valid-feedback">Looks good!</div>
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
@endsection
