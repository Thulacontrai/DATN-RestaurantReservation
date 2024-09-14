@extends('admin.master')

@section('title', 'Chỉnh Sửa Người Dùng')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
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
                            <h5 class="card-title mb-3 ">Chỉnh Sửa Người Dùng</h5>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-secondary">Quay lại</a>
                        </div>
                        <div class="card-body">
                            <!-- Form Chỉnh Sửa -->
                            <form method="POST" action="{{ route('admin.user.update', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Sử dụng PUT method để cập nhật dữ liệu -->

                                <div class="row">
                                    <!-- Tên và Email -->
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Tên</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Số Điện Thoại và Địa Chỉ -->
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Số Điện Thoại</label>
                                        <input type="number" id="phone" name="phone" class="form-control"
                                            value="{{ old('phone', $user->phone) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="address" class="form-label">Địa Chỉ</label>
                                        <input type="text" id="address" name="address" class="form-control"
                                            value="{{ old('address', $user->address) }}" placeholder="Nhập địa chỉ">
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Ngày Sinh và Giới Tính -->
                                    <div class="col-md-6 mb-3">
                                        <label for="date_of_birth" class="form-label">Ngày Sinh</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
                                            value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="gender" class="form-label">Giới Tính</label>
                                        <select id="gender" name="gender" class="form-select">
                                            <option value="male"
                                                {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Nam</option>
                                            <option value="female"
                                                {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Nữ
                                            </option>
                                            <option value="other"
                                                {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Khác
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Ngày Tuyển Dụng và Chức Vụ -->
                                    <div class="col-md-6 mb-3">
                                        <label for="hire_date" class="form-label">Ngày Tuyển Dụng</label>
                                        <input type="date" id="hire_date" name="hire_date" class="form-control"
                                            value="{{ old('hire_date', $user->hire_date) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="position" class="form-label">Chức Vụ</label>
                                        <input type="text" id="position" name="position" class="form-control"
                                            value="{{ old('position', $user->position) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Avatar và Trạng Thái -->
                                    <div class="col-md-6 mb-3">
                                        <label for="avatar" class="form-label">Ảnh Đại Diện</label>
                                        <input type="file" id="avatar" name="avatar" class="form-control"
                                            accept="image/*">
                                        @if ($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                                class="img-thumbnail mt-2" width="100">
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Trạng Thái</label>
                                        <select id="status" name="status" class="form-select">
                                            <option value="active"
                                                {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Hoạt Động
                                            </option>
                                            <option value="inactive"
                                                {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Không
                                                Hoạt Động</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Vai Trò -->
                                    <div class="col-md-6 mb-3">
                                        <label for="role_id" class="form-label">Vai Trò</label>
                                        <select id="role_id" name="role_id" class="form-select" required>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                    {{ $role->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- <!-- Mật Khẩu và Xác nhận Mật Khẩu -->
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Mật khẩu</label>
                                        <input type="password" id="password" name="password" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control" required>
                                    </div> --}}

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">Cập Nhật Người Dùng</button>
                                    </div>
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
