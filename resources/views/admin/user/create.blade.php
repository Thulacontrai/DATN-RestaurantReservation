@extends('admin.master')

@section('title', 'Thêm Người Dùng Mới')

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
                            <div class="card-title">Thêm Người Dùng Mới</div>
                        </div>
                        <div class="card-body">

                            <!-- Form thêm mới người dùng -->
                            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Tên</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Số Điện Thoại</label>
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="address" class="form-label">Địa Chỉ</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="role" class="form-label">Vai Trò</label>
                                        <select class="form-select" id="role" name="role">
                                            <option value="Admin">Admin</option>
                                            <option value="Người Dùng">Người Dùng</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Trạng Thái</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="Hoạt Động">Hoạt Động</option>
                                            <option value="Tạm Dừng">Tạm Dừng</option>
                                            <option value="Đã Khóa">Đã Khóa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="image" class="form-label">Hình Ảnh</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Hủy</a>
                                </div>
                            </form>
                            <!-- Kết thúc Form -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        @endsection
