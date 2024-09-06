@extends('admin.master')

@section('title', 'Danh Sách Lịch Sử Đặt Chỗ')

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
                            <div class="card-title">Danh Sách Lịch Sử Đặt Chỗ</div>

                        </div>
                        <div class="card-body">


                            <form method="GET" action="" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-customer" name="customer_name"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo tên khách hàng">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>


                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Mã Lịch Sử</th>
                                            <th>Mã Đặt Chỗ</th>
                                            <th>Tên Khách Hàng</th>
                                            <th>Thời Gian Thay Đổi</th>
                                            <th>Trạng Thái Cũ</th>
                                            <th>Trạng Thái Mới</th>
                                            <th>Ghi Chú</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>1</td>
                                            <td>1001</td>
                                            <td>Nguyễn Văn A</td>
                                            <td>2024-09-01 17:00</td>
                                            <td><span class="badge shade-green min-70">Chờ xử lý</span></td>
                                            <td><span class="badge shade-green min-70">Đã xác nhận</span></td>
                                            <td>Xác nhận thanh toán</td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#viewRow">
                                                        <i class="bi bi-list text-green"></i>
                                                    </a>
                                                    <a href="#" class="deleteRow">
                                                        <i class="bi bi-trash text-red"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>1002</td>
                                            <td>Trần Thị B</td>
                                            <td>2024-09-01 18:30</td>
                                            <td><span class="badge shade-yellow min-70">Đã đặt trước</span></td>
                                            <td><span class="badge shade-yellow min-70">Đang sử dụng</span></td>
                                            <td>Khách đã đến</td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#viewRow">
                                                        <i class="bi bi-list text-green"></i>
                                                    </a>
                                                    <a href="#" class="deleteRow">
                                                        <i class="bi bi-trash text-red"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>1003</td>
                                            <td>Lê Văn C</td>
                                            <td>2024-09-01 20:15</td>
                                            <td><span class="badge shade-red min-70">Đang sử dụng</span></td>
                                            <td><span class="badge shade-red min-70">Hoàn thành</span></td>
                                            <td>Thanh toán thành công</td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#viewRow">
                                                        <i class="bi bi-list text-green"></i>
                                                    </a>
                                                    <a href="#" class="deleteRow">
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

        </div>
        <!-- Content wrapper end -->

    </div>
    <!-- Content wrapper scroll end -->

    <!-- Modal hiển thị chi tiết -->
    <div class="modal fade" id="viewRow" tabindex="-1" aria-labelledby="viewRowLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewRowLabel">Chi Tiết Lịch Sử Đặt Chỗ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="historyId" class="form-label">Mã Lịch Sử</label>
                                <input type="text" class="form-control" id="historyId" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="reservationId" class="form-label">Mã Đặt Chỗ</label>
                                <input type="text" class="form-control" id="reservationId" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Tên Khách Hàng</label>
                        <input type="text" class="form-control" id="customerName" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="changeTime" class="form-label">Thời Gian Thay Đổi</label>
                        <input type="text" class="form-control" id="changeTime" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="oldStatus" class="form-label">Trạng Thái Cũ</label>
                        <input type="text" class="form-control" id="oldStatus" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="newStatus" class="form-label">Trạng Thái Mới</label>
                        <input type="text" class="form-control" id="newStatus" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Ghi Chú</label>
                        <textarea class="form-control" id="note" rows="3" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript để xử lý sự kiện nhấp vào hàng và hiển thị chi tiết trong modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.viewRow');

            rows.forEach(function(row) {
                row.addEventListener('click', function() {
                    const historyId = this.closest('tr').querySelector('td:nth-child(1)')
                        .textContent;
                    const reservationId = this.closest('tr').querySelector('td:nth-child(2)')
                        .textContent;
                    const customerName = this.closest('tr').querySelector('td:nth-child(3)')
                        .textContent;
                    const changeTime = this.closest('tr').querySelector('td:nth-child(4)')
                        .textContent;
                    const oldStatus = this.closest('tr').querySelector('td:nth-child(5)')
                        .textContent.trim();
                    const newStatus = this.closest('tr').querySelector('td:nth-child(6)')
                        .textContent.trim();
                    const note = this.closest('tr').querySelector('td:nth-child(7)').textContent;

                    document.getElementById('historyId').value = historyId;
                    document.getElementById('reservationId').value = reservationId;
                    document.getElementById('customerName').value = customerName;
                    document.getElementById('changeTime').value = changeTime;
                    document.getElementById('oldStatus').value = oldStatus;
                    document.getElementById('newStatus').value = newStatus;
                    document.getElementById('note').value = note;
                });
            });
        });
    </script>

@endsection
