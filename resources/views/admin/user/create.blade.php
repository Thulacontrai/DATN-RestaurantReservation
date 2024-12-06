@extends('admin.master')

@section('title', 'Thêm Mới Người Dùng')

@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center text-white">
                        <h5 class="card-title mb-3 ">Thêm Mới Người Dùng</h5>
                        <a href="{{ route('admin.user.employees') }}" class="btn btn-sm btn-secondary">Quay lại</a>
                    </div>
                    <div class="card-body">
                        <!-- Form Thêm Mới -->
                        <form id="addUserForm" method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf

                            <div class="row">
                                <!-- Tên và Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Tên</label>
                                    <input value="{{ old('name') }}" type="text" id="name" name="name" class="form-control" placeholder="Nhập tên" required>
                                    <div class="invalid-feedback">Vui lòng nhập tên người dùng.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input value="{{ old('email') }}" type="email" id="email" name="email" class="form-control" placeholder="Nhập email" required>
                                    <div class="invalid-feedback">Vui lòng nhập email hợp lệ.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Số Điện Thoại và Địa Chỉ -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Số Điện Thoại</label>
                                    <input value="{{ old('phone') }}" type="number" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại">
                                    <div class="invalid-feedback">Vui lòng nhập số điện thoại hợp lệ.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">Địa Chỉ</label>
                                    <textarea id="address" name="address" class="form-control" placeholder="Nhập địa chỉ">{{ old('address') }}</textarea>
                                    <div class="invalid-feedback">Vui lòng nhập địa chỉ.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Ngày Sinh và Giới Tính -->
                                <div class="col-md-6 mb-3">
                                    <label for="date_of_birth" class="form-label">Ngày Sinh</label>
                                    <input value="{{ old('date_of_birth') }}" type="date" id="date_of_birth" name="date_of_birth" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Giới Tính</label>
                                    <select id="gender" name="gender" class="form-select" required>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn giới tính.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Ngày Tuyển Dụng và Chức Vụ -->
                                <div class="col-md-6 mb-3">
                                    <label for="hire_date" class="form-label">Ngày Tuyển Dụng</label>
                                    <input value="{{ old('hire_date') }}" type="date" id="hire_date" name="hire_date" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="position" class="form-label">Chức Vụ</label>
                                    <input value="{{ old('position') }}" type="text" id="position" name="position" class="form-control" placeholder="Nhập chức vụ">
                                    <div class="invalid-feedback">Vui lòng nhập chức vụ.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Avatar và Trạng Thái -->
                                <div class="col-md-6 mb-3">
                                    <label for="avatar" class="form-label">Ảnh Đại Diện</label>
                                    <input type="file" id="avatar" name="avatar" class="form-control" accept="image/*">
                                    <div class="invalid-feedback">Vui lòng chọn ảnh đại diện hợp lệ.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select id="status" name="status" class="form-select" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt Động</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không Hoạt Động</option>
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn trạng thái.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Vai Trò và Mật Khẩu -->
                                <div class="col-md-6 mb-3">
                                    <label for="role_id" class="form-label">Vai Trò</label>
                                    <div class="grid grid-cols-4 mb-3  ">
                                        @if ($roles->isNotEmpty())
                                            @foreach ($roles as $role)
                                                <div class="mt-3">
                                                    <input type="checkbox" name="role[]" value="{{ $role->name }}" id="role-{{$role->id}}" class="rounded">
                                                    <label for="role-{{$role->id}}">{{ $role->name }}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="invalid-feedback">Vui lòng chọn ít nhất một vai trò.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password">Mật khẩu</label>
                                    <input value="{{ old('password') }}" type="password" name="password" class="form-control" required>
                                    <div class="invalid-feedback">Vui lòng nhập mật khẩu.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="confirm_password">Xác nhận mật khẩu</label>
                                    <input value="{{ old('confirm_password') }}" type="password" name="confirm_password" class="form-control" required>
                                    <div class="invalid-feedback">Vui lòng xác nhận mật khẩu.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-success">Lưu Người Dùng</button>
                            </div>

                        </form>
                        <!-- Kết thúc Form Thêm Mới -->

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
            const form = document.getElementById('addUserForm');
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
