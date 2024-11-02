@extends('admin.master')

@section('title', 'Thêm Vai Trò Mới')

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

    <div class="content-wrapper-scroll">

        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Thêm Vai Trò Mới</h5>
                            <a href="{{ route('admin.role.index') }}" class="btn btn-sm btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i> Quay lại
                            </a>
                        </div>

                        <div class="card-body">
                            <!-- Form thêm mới role -->
                            <form id="addRoleForm" method="POST" action="{{ route('admin.role.store') }}" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên Vai Trò</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên vai trò" value="{{ old('name') }}" required>
                                    <div class="invalid-feedback">Vui lòng nhập tên vai trò.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-4 mb-3">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            <div class="mt-3">
                                                <input type="checkbox" name="permission[]" value="{{ $permission->name }}" id="permission-{{ $permission->id }}" class="rounded">
                                                <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Lưu Vai Trò</button>
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
            const form = document.getElementById('addRoleForm');
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
