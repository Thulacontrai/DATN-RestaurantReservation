@extends('admin.master')

@section('title', 'Chỉnh Sửa Nhân Viên')

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
                        <div class="card-title">Chỉnh Sửa Nhân Viên</div>
                    </div>

                    <div class="card-body">

                        <!-- Form chỉnh sửa nhân viên -->
                        <form method="POST">
                            <!-- Dữ liệu mẫu -->
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Tên Đầy Đủ</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="Nguyễn Văn A" required>
                            </div>

                            <div class="mb-3">
                                <label for="dateofbirth" class="form-label">Ngày Sinh</label>
                                <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" value="1990-05-15" required>
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Giới Tính</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="" disabled>Chọn giới tính</option>
                                    <option value="Nam" selected>Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="0912345678" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="nguyenvana@example.com" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Địa Chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" value="Hà Nội" required>
                            </div>

                            <div class="mb-3">
                                <label for="dateOfJoining" class="form-label">Ngày Gia Nhập</label>
                                <input type="datetime-local" class="form-control" id="dateOfJoining" name="dateOfJoining" value="2022-03-01T09:00" required>
                            </div>

                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Cập Nhật Nhân Viên</button>
                                <button type="reset" class="btn btn-secondary ms-2">Hủy</button>
                            </div>
                        </form>
                        <!-- Kết thúc form chỉnh sửa nhân viên -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->
    </div>
    <!-- Content wrapper end -->

</div>

@endsection
