@extends('admin.master')

@section('title', 'Chỉnh Sửa Người Dùng')

@section('content')

<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Chỉnh Sửa Người Dùng</div>
                    </div>

                    <div class="card-body">
                        <form method="POST">
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="nguyenvana@example.com" required>
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số Điện Thoại</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="0912345678" required>
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa Chỉ</label>
                                <input type="text" name="address" class="form-control" id="address" value="Hà Nội" required>
                            </div>

                            <!-- Role -->
                            <div class="mb-3">
                                <label for="role" class="form-label">Vai Trò</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="1" selected>Admin</option>
                                    <option value="2">Người Dùng</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng Thái</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="active" selected>Hoạt Động</option>
                                    <option value="inactive">Đã Khóa</option>
                                    <option value="pending">Tạm Dừng</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Cập Nhật Người Dùng</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- Row end -->
    </div>
    <!-- Content wrapper end -->

</div>

@endsection
