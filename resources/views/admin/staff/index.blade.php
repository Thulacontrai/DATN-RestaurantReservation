@extends('admin.master')

@section('title', 'Danh Sách Nhân Viên')

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
                        <div class="card-title">Danh Sách Nhân Viên</div>
                        <a href="{{route('staff.create')}}" class="btn btn-sm btn-primary d-flex align-items-center">
                            <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                        </a>
                    </div>

                    <div class="card-body">

                        <!-- Form tìm kiếm -->
                        <form method="GET" action="#" class="mb-3">
                            <div class="row g-2">
                                <div class="col-auto">
                                    <input type="text" id="search-name" name="name" class="form-control form-control-sm" placeholder="Tìm kiếm theo tên nhân viên">
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
                                        <th>Mã Nhân Viên</th>
                                        <th>Tên Đầy Đủ</th>
                                        <th>Ngày Sinh</th>
                                        <th>Giới Tính</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Email</th>
                                        <th>Địa Chỉ</th>
                                        <th>Ngày Gia Nhập</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dữ liệu mẫu -->
                                    <tr>
                                        <td>001</td>
                                        <td>Nguyễn Văn A</td>
                                        <td>1990-05-15</td>
                                        <td>Nam</td>
                                        <td>0912345678</td>
                                        <td>nguyenvana@example.com</td>
                                        <td>Hà Nội</td>
                                        <td>2022-03-01</td>
                                        <td>
                                            <div class="actions">
                                                <a href="#" class="viewRow" data-id="001" data-bs-toggle="modal" data-bs-target="#viewRowModal">
                                                    <i class="bi bi-list text-green"></i>
                                                </a>
                                                <a href="{{ route('staff.edit', 001) }}" class="editRow" data-id="001">
                                                    <i class="bi bi-pencil-square text-warning"></i>
                                                </a>
                                                <a href="#" class="deleteRow">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>002</td>
                                        <td>Trần Thị B</td>
                                        <td>1992-07-21</td>
                                        <td>Nữ</td>
                                        <td>0987654321</td>
                                        <td>tranthib@example.com</td>
                                        <td>Đà Nẵng</td>
                                        <td>2021-08-15</td>
                                        <td>
                                            <div class="actions">
                                                <a href="#" class="viewRow" data-id="002" data-bs-toggle="modal" data-bs-target="#viewRowModal">
                                                    <i class="bi bi-list text-green"></i>
                                                </a>
                                                <a href="{{ route('staff.edit', 002) }}" class="editRow" data-id="002">
                                                    <i class="bi bi-pencil-square text-warning"></i>
                                                </a>
                                                <a href="#" class="deleteRow">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Thêm các hàng dữ liệu mẫu khác -->
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
    </div>
    <!-- Content wrapper end -->

</div>

<!-- Modal hiển thị chi tiết nhân viên -->
<div class="modal fade" id="viewRowModal" tabindex="-1" aria-labelledby="viewRowModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewRowModalLabel">Chi Tiết Nhân Viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="staffId" class="form-label">Mã Nhân Viên</label>
                    <input type="text" class="form-control" id="staffId" readonly>
                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Tên Đầy Đủ</label>
                    <input type="text" class="form-control" id="fullname" readonly>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Ngày Sinh</label>
                    <input type="text" class="form-control" id="dob" readonly>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Giới Tính</label>
                    <input type="text" class="form-control" id="gender" readonly>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số Điện Thoại</label>
                    <input type="text" class="form-control" id="phone" readonly>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" readonly>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa Chỉ</label>
                    <input type="text" class="form-control" id="address" readonly>
                </div>
                <div class="mb-3">
                    <label for="dateOfJoining" class="form-label">Ngày Gia Nhập</label>
                    <input type="text" class="form-control" id="dateOfJoining" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Xử lý sự kiện khi nhấp vào nút hiển thị chi tiết
    document.addEventListener('DOMContentLoaded', function() {
        const viewButtons = document.querySelectorAll('.viewRow');

        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const staffId = this.getAttribute('data-id');
                const fullname = this.closest('tr').querySelector('td:nth-child(2)').textContent;
                const dob = this.closest('tr').querySelector('td:nth-child(3)').textContent;
                const gender = this.closest('tr').querySelector('td:nth-child(4)').textContent;
                const phone = this.closest('tr').querySelector('td:nth-child(5)').textContent;
                const email = this.closest('tr').querySelector('td:nth-child(6)').textContent;
                const address = this.closest('tr').querySelector('td:nth-child(7)').textContent;
                const dateOfJoining = this.closest('tr').querySelector('td:nth-child(8)').textContent;

                // Gán giá trị vào modal
                document.getElementById('staffId').value = staffId;
                document.getElementById('fullname').value = fullname;
                document.getElementById('dob').value = dob;
                document.getElementById('gender').value = gender;
                document.getElementById('phone').value = phone;
                document.getElementById('email').value = email;
                document.getElementById('address').value = address;
                document.getElementById('dateOfJoining').value = dateOfJoining;
            });
        });
    });
</script>

@endsection
