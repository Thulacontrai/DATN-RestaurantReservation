@extends('admin.master')

@section('title', 'Danh Sách Người Dùng')

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
                            <div class="card-title">Danh Sách Người Dùng</div>
                            <!-- Icon Thêm Mới -->
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>
                        <div class="card-body">

                            <!-- Form tìm kiếm -->
                            <form method="GET" action="#" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-email" name="email"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo email">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Kết thúc Form tìm kiếm -->

                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Email</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Địa Chỉ</th>
                                            <th>Vai Trò</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Dữ liệu mẫu -->
                                        <tr>
                                            <td>1</td>
                                            <td>nguyenvana@example.com</td>
                                            <td>0912345678</td>
                                            <td>Hà Nội</td>
                                            <td>Admin</td>
                                            <td><span class="badge shade-green">Hoạt Động</span></td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-id="1">
                                                        <i class="bi bi-list text-green"></i>
                                                    </a>
                                                    <a href="{{ route('user.edit', 1) }}" class="editRow" data-id="1">
                                                        <i class="bi bi-pencil-square text-warning"></i>
                                                    </a>
                                                    <a href="#" class="deleteRow" data-id="1">
                                                        <i class="bi bi-trash text-red"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>tranthib@example.com</td>
                                            <td>0987654321</td>
                                            <td>Đà Nẵng</td>
                                            <td>Người Dùng</td>
                                            <td><span class="badge shade-red">Đã Khóa</span></td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-id="2">
                                                        <i class="bi bi-list text-green"></i>
                                                    </a>
                                                    <a href="{{ route('user.edit', 2) }}" class="editRow" data-id="2">
                                                        <i class="bi bi-pencil-square text-warning"></i>
                                                    </a>
                                                    <a href="#" class="deleteRow" data-id="2">
                                                        <i class="bi bi-trash text-red"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>hoangc@example.com</td>
                                            <td>0922233445</td>
                                            <td>Hồ Chí Minh</td>
                                            <td>Người Dùng</td>
                                            <td><span class="badge shade-yellow">Tạm Dừng</span></td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-id="3">
                                                        <i class="bi bi-list text-green"></i>
                                                    </a>
                                                    <a href="{{ route('user.edit', 3) }}" class="editRow" data-id="3">
                                                        <i class="bi bi-pencil-square text-warning"></i>
                                                    </a>
                                                    <a href="#" class="deleteRow" data-id="3">
                                                        <i class="bi bi-trash text-red"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Tiếp</a></li>
                                </ul>
                            </div>
                            <!-- Kết thúc Pagination -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        @endsection
