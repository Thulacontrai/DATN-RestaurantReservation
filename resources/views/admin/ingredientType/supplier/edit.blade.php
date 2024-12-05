@extends('admin.master')

@section('title', 'Chỉnh Sửa Nhà Cung Cấp')

@section('content')
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title text-primary">Chỉnh Sửa Nhà Cung Cấp</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.supplier.update', $supplier->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên Nhà Cung Cấp</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white"><i
                                            class="bi bi-shop text-white"></i></span>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $supplier->name) }}"
                                               placeholder="Nhập tên nhà cung cấp" required>
                                    </div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số Điện Thoại</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-success text-white"><i
                                            class="bi bi-telephone text-white"></i></span>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                               value="{{ old('phone', $supplier->phone) }}" placeholder="Nhập số điện thoại"
                                               required maxlength="10">
                                    </div>
                                    <div class="invalid-feedback">Số điện thoại phải có 10 số và bắt đầu bằng số 0.</div>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-info text-white"><i class="bi bi-envelope text-white"></i></span>
                                        <input type="email" name="email" id="email" class="form-control"
                                               value="{{ old('email', $supplier->email) }}" placeholder="Nhập địa chỉ email">
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa Chỉ</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-danger"><i class="bi bi-geo-alt text-white"></i></span>
                                        <input type="text" name="address" id="address" class="form-control"
                                               value="{{ old('address', $supplier->address) }}" placeholder="Nhập địa chỉ nhà cung cấp">
                                    </div>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-success">Cập Nhật Nhà Cung Cấp</button>
                                <a href="{{ route('admin.supplier.index') }}" class="btn btn-secondary">Hủy</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('phone');

            phoneInput.addEventListener('input', function() {
                let value = phoneInput.value;

                // Kiểm tra số đầu tiên phải là 0
                if (!value.startsWith('0') && value.length > 0) {
                    value = '0' + value.replace(/^0+/, ''); // Đảm bảo luôn có số 0 đầu tiên
                }

                // Giới hạn độ dài tối đa 10 ký tự
                if (value.length > 10) {
                    value = value.slice(0, 10);
                }

                phoneInput.value = value;

                // Kiểm tra hợp lệ: bắt buộc đủ 10 số và bắt đầu bằng số 0
                if (value.length === 10 && value.startsWith('0')) {
                    phoneInput.classList.remove('is-invalid');
                    phoneInput.classList.add('is-valid');
                } else {
                    phoneInput.classList.remove('is-valid');
                    phoneInput.classList.add('is-invalid');
                }
            });

            // Kiểm tra khi submit form
            phoneInput.closest('form').addEventListener('submit', function(event) {
                const value = phoneInput.value;

                if (value.length !== 10 || !value.startsWith('0')) {
                    phoneInput.classList.add('is-invalid');
                    event.preventDefault(); // Ngăn không cho form submit
                } else {
                    phoneInput.classList.remove('is-invalid');
                }
            });
        });
    </script>
@endsection
