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
                        <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-secondary">Quay lại</a>
                    </div>
                    <div class="card-body">
                        <!-- Form Thêm Mới -->
                        <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- Tên và Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Tên</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Nhập tên" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Số Điện Thoại và Địa Chỉ -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Số Điện Thoại</label>
                                    <input type="number" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">Địa Chỉ</label>
                                    <textarea id="address" name="address" class="form-control" placeholder="Nhập địa chỉ">{{ old('address') }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Ngày Sinh và Giới Tính -->
                                <div class="col-md-6 mb-3">
                                    <label for="date_of_birth" class="form-label">Ngày Sinh</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Giới Tính</label>
                                    <select id="gender" name="gender" class="form-select">
                                        <option value="male">Nam</option>
                                        <option value="female">Nữ</option>
                                        <option value="other">Khác</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Ngày Tuyển Dụng và Chức Vụ -->
                                <div class="col-md-6 mb-3">
                                    <label for="hire_date" class="form-label">Ngày Tuyển Dụng</label>
                                    <input type="date" id="hire_date" name="hire_date" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="position" class="form-label">Chức Vụ</label>
                                    <input type="text" id="position" name="position" class="form-control" placeholder="Nhập chức vụ">
                                </div>
                            </div>

                            <div class="row">
                                <!-- Avatar và Trạng Thái -->
                                <div class="col-md-6 mb-3">
                                    <label for="avatar" class="form-label">Ảnh Đại Diện</label>
                                    <input type="file" id="avatar" name="avatar" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select id="status" name="status" class="form-select">
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt Động</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không Hoạt Động</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <!-- Vai Trò và Mật Khẩu -->
                                <div class="col-md-6 mb-3">
                                    <label for="role_id" class="form-label">Vai Trò</label>
                                    <select id="role_id" name="role_id" class="form-select" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                               <div class="form-group">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label l for="password_confirmation">Xác nhận mật khẩu</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>

                            </div>

                            <div class="text-end">
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
