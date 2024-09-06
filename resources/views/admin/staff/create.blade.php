@extends('admin.master')

@section('title', 'Thêm Nhân Viên Mới')

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
                        <div class="card-title">Thêm Nhân Viên Mới</div>
                    </div>

                    <div class="card-body">

                        <!-- Form tạo mới nhân viên -->
                        <form method="POST" action="{{ route('staff.store') }}">
                            @csrf <!-- Bảo mật form với CSRF token -->

                            <div class="mb-3">
                                <label for="fullname" class="form-label">Tên Đầy Đủ</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập tên đầy đủ" required>
                            </div>

                            <div class="mb-3">
                                <label for="dateofbirth" class="form-label">Ngày Sinh</label>
                                <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" required>
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Giới Tính</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="" disabled selected>Chọn giới tính</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ email" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Địa Chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" required>
                            </div>

                            <div class="mb-3">
                                <label for="dateOfJoining" class="form-label">Ngày Gia Nhập</label>
                                <input type="datetime-local" class="form-control" id="dateOfJoining" name="dateOfJoining" required>
                            </div>

                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Lưu Nhân Viên</button>
                                <a href="{{ route('staff.index') }}" class="btn btn-secondary ms-2">Hủy</a>
                            </div>
                        </form>
                        <!-- Kết thúc form tạo mới nhân viên -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->
    </div>
    <!-- Content wrapper end -->

</div>

@endsection
