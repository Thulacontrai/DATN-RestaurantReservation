@extends('admin.master')

@section('title', 'Chỉnh Sửa Người Dùng')

@section('content')
    @include('admin.layouts.messages')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center text-white">
                            <h5 class="card-title mb-3">Chỉnh Sửa Người Dùng</h5>
                            <a href="{{ route('admin.user.employees') }}" class="btn btn-sm btn-secondary">Quay lại</a>
                        </div>
                        <div class="card-body">
                            <!-- Form Chỉnh Sửa -->
                            <form id="editUserForm" method="POST" action="{{ route('admin.user.update', $user->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên</label>
                                    <input value="{{ old('name', $user->name) }}" type="text" id="name"
                                        name="name" class="form-control" required>
                                    <div class="invalid-feedback">Vui lòng nhập tên người dùng.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input value="{{ old('email', $user->email) }}" type="email" id="email"
                                        name="email" class="form-control" required>
                                    <div class="invalid-feedback">Vui lòng nhập email hợp lệ.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input value="{{ old('phone', $user->phone) }}" type="text" id="phone"
                                        name="phone" class="form-control">
                                    <div class="invalid-feedback">Vui lòng nhập số điện thoại hợp lệ.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="grid grid-cols-4 mb-3">
                                    @if ($roles->isNotEmpty())
                                        @foreach ($roles as $role)
                                            <div class="mt-3">
                                                <input {{ $hasRoles->contains($role->id) ? 'checked' : '' }} type="checkbox"
                                                    name="role[]" value="{{ $role->name }}" id="role-{{ $role->id }}"
                                                    class="rounded">
                                                <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="invalid-feedback">Vui lòng chọn ít nhất một vai trò.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select id="status" name="status" class="form-select" required>
                                        <option value="active"
                                            {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Hoạt Động
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Không Hoạt
                                            Động</option>
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn trạng thái.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="mb-3">
                                    <label for="created_at" class="form-label">Ngày tạo</label>
                                    <input value="{{ $user->created_at }}" type="text" id="created_at" name="created_at"
                                        class="form-control" disabled>
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary">Cập Nhật</button>
                                <a href="{{ route('admin.user.employees') }}" class="btn btn-sm btn-secondary">Hủy</a>
                            </form>
                            <!-- Kết thúc Form Chỉnh Sửa -->
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
            const form = document.getElementById('editUserForm');
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
