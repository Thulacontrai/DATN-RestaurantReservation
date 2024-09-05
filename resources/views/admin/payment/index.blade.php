@extends('admin.master')

@section('title', 'Danh Sách Thanh Toán')

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
                            <div class="card-title">Danh Sách Thanh Toán</div>
                            <a href="{{ route('payment.create') }}" class="btn btn-sm btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>

                        <div class="card-body">


                            <form method="GET" action="#" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-id" name="id"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo mã thanh toán">
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
                                            <th>Mã Thanh Toán</th>
                                            <th>Mã Đặt Bàn</th>
                                            <th>Mã Hóa Đơn</th>
                                            <th>Số Tiền</th>
                                            <th>Phương Thức Thanh Toán</th>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>001</td>
                                            <td>RES123</td>
                                            <td>BILL101</td>
                                            <td>500,000 VND</td>
                                            <td>Thẻ Tín Dụng</td>
                                            <td><span class="badge shade-green">Đã Thanh Toán</span></td>
                                            <td>2024-09-01 10:00</td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-id="001"
                                                        data-reservation-id="RES123" data-bill-id="BILL101"
                                                        data-amount="500,000 VND" data-payment-method="Thẻ Tín Dụng"
                                                        data-status="Đã Thanh Toán" data-transaction-date="2024-09-01 10:00"
                                                        data-bs-toggle="modal" data-bs-target="#viewRowModal">
                                                        <i class="bi bi-list text-green"></i>
                                                    </a>
                                                    <a href="#" class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#updateStatusModal" data-id="001"
                                                        data-status="Đã Thanh Toán">
                                                        <i class="bi bi-recycle"></i>
                                                    </a>
                                                    <a href="#" class="deleteRow">
                                                        <i class="bi bi-trash text-red"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>002</td>
                                            <td>RES124</td>
                                            <td>BILL102</td>
                                            <td>300,000 VND</td>
                                            <td>Tiền Mặt</td>
                                            <td><span class="badge shade-yellow">Chờ Xử Lý</span></td>
                                            <td>2024-09-01 11:00</td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-id="002"
                                                        data-reservation-id="RES124" data-bill-id="BILL102"
                                                        data-amount="300,000 VND" data-payment-method="Tiền Mặt"
                                                        data-status="Chờ Xử Lý" data-transaction-date="2024-09-01 11:00"
                                                        data-bs-toggle="modal" data-bs-target="#viewRowModal">
                                                        <i class="bi bi-list text-yellow"></i>
                                                    </a>
                                                    <a href="#" class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#updateStatusModal" data-id="002"
                                                        data-status="Chờ Xử Lý">
                                                        <i class="bi bi-recycle"></i>
                                                    </a>
                                                    <a href="#" class="deleteRow">
                                                        <i class="bi bi-trash text-red"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>003</td>
                                            <td>RES125</td>
                                            <td>BILL103</td>
                                            <td>1,000,000 VND</td>
                                            <td>Ví Điện Tử</td>
                                            <td><span class="badge shade-red">Đã Hủy</span></td>
                                            <td>2024-09-01 12:00</td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-id="003"
                                                        data-reservation-id="RES125" data-bill-id="BILL103"
                                                        data-amount="1,000,000 VND" data-payment-method="Ví Điện Tử"
                                                        data-status="Đã Hủy" data-transaction-date="2024-09-01 12:00"
                                                        data-bs-toggle="modal" data-bs-target="#viewRowModal">
                                                        <i class="bi bi-list text-red"></i>
                                                    </a>
                                                    <a href="#" class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#updateStatusModal" data-id="003"
                                                        data-status="Đã Hủy">
                                                        <i class="bi bi-recycle"></i>
                                                    </a>
                                                    <a href="#" class="deleteRow">
                                                        <i class="bi bi-trash text-red"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>004</td>
                                            <td>RES126</td>
                                            <td>BILL104</td>
                                            <td>700,000 VND</td>
                                            <td>Chuyển Khoản</td>
                                            <td><span class="badge shade-yellow">Chờ Xử Lý</span></td>
                                            <td>2024-09-01 13:00</td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-id="004"
                                                        data-reservation-id="RES126" data-bill-id="BILL104"
                                                        data-amount="700,000 VND" data-payment-method="Chuyển Khoản"
                                                        data-status="Chờ Xử Lý" data-transaction-date="2024-09-01 13:00"
                                                        data-bs-toggle="modal" data-bs-target="#viewRowModal">
                                                        <i class="bi bi-list text-yellow"></i>
                                                    </a>
                                                    <a href="#" class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#updateStatusModal" data-id="004"
                                                        data-status="Chờ Xử Lý">
                                                        <i class="bi bi-recycle"></i>
                                                    </a>
                                                    <a href="#" class="deleteRow">
                                                        <i class="bi bi-trash text-red"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>005</td>
                                            <td>RES127</td>
                                            <td>BILL105</td>
                                            <td>450,000 VND</td>
                                            <td>Thẻ ATM</td>
                                            <td><span class="badge shade-green">Đã Thanh Toán</span></td>
                                            <td>2024-09-01 14:00</td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-id="005"
                                                        data-reservation-id="RES127" data-bill-id="BILL105"
                                                        data-amount="450,000 VND" data-payment-method="Thẻ ATM"
                                                        data-status="Đã Thanh Toán"
                                                        data-transaction-date="2024-09-01 14:00" data-bs-toggle="modal"
                                                        data-bs-target="#viewRowModal">
                                                        <i class="bi bi-list text-green"></i>
                                                    </a>
                                                    <a href="#" class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#updateStatusModal" data-id="005"
                                                        data-status="Đã Thanh Toán">
                                                        <i class="bi bi-recycle"></i>
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

    <!-- Modal cập nhật trạng thái -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStatusLabel">Cập Nhật Trạng Thái Giao Dịch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="Thành Công">Thành Công</option>
                            <option value="Đang Xử Lý">Đang Xử Lý</option>
                            <option value="Đã Hủy">Đã Hủy</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary saveStatusBtn">Lưu Thay Đổi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal hiển thị chi tiết thanh toán -->
    <div class="modal fade" id="viewRowModal" tabindex="-1" aria-labelledby="viewRowModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewRowModalLabel">Chi Tiết Thanh Toán</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="paymentId" class="form-label">Mã Thanh Toán</label>
                        <input type="text" class="form-control" id="paymentId" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="reservationId" class="form-label">Mã Đặt Bàn</label>
                        <input type="text" class="form-control" id="reservationId" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="billId" class="form-label">Mã Hóa Đơn</label>
                        <input type="text" class="form-control" id="billId" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Số Tiền</label>
                        <input type="text" class="form-control" id="amount" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Phương Thức Thanh Toán</label>
                        <input type="text" class="form-control" id="paymentMethod" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="paymentStatus" class="form-label">Trạng Thái</label>
                        <input type="text" class="form-control" id="paymentStatus" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="paymentDate" class="form-label">Ngày Tạo</label>
                        <input type="text" class="form-control" id="paymentDate" readonly>
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
                    const paymentId = this.getAttribute('data-id');
                    const reservationId = this.getAttribute('data-reservation-id');
                    const billId = this.getAttribute('data-bill-id');
                    const amount = this.getAttribute('data-amount');
                    const paymentMethod = this.getAttribute('data-payment-method');
                    const paymentStatus = this.getAttribute('data-status');
                    const paymentDate = this.getAttribute('data-transaction-date');

                    document.getElementById('paymentId').value = paymentId;
                    document.getElementById('reservationId').value = reservationId;
                    document.getElementById('billId').value = billId;
                    document.getElementById('amount').value = amount;
                    document.getElementById('paymentMethod').value = paymentMethod;
                    document.getElementById('paymentStatus').value = paymentStatus;
                    document.getElementById('paymentDate').value = paymentDate;
                });
            });
        });
    </script>

    <!-- Modal cập nhật trạng thái -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStatusLabel">Cập Nhật Trạng Thái Thanh Toán</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="Đã Thanh Toán">Đã Thanh Toán</option>
                            <option value="Chờ Xử Lý">Chờ Xử Lý</option>
                            <option value="Đã Hủy">Đã Hủy</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary saveStatusBtn">Lưu Thay Đổi</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewButtons = document.querySelectorAll('.viewRow');
            const saveStatusButton = document.querySelector('.saveStatusBtn');
            const statusSelect = document.getElementById('status');

            let selectedPaymentId = null;

            // Khi click vào nút view, hiển thị modal với trạng thái hiện tại
            viewButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    selectedPaymentId = this.getAttribute('data-id');
                    const currentStatus = this.getAttribute('data-status');
                    statusSelect.value = currentStatus; // Set trạng thái hiện tại vào select
                });
            });

            // Lưu trạng thái mới khi click vào nút "Lưu Thay Đổi"
            saveStatusButton.addEventListener('click', function() {
                const newStatus = statusSelect.value;

                // Cập nhật trạng thái bằng AJAX hoặc theo logic cần thiết
                console.log('Cập nhật trạng thái:', selectedPaymentId, 'Thành', newStatus);

                // Giả lập việc cập nhật trạng thái thành công và ẩn modal
                alert('Cập nhật trạng thái thành công!');
                $('#updateStatusModal').modal('hide');
            });
        });
    </script>

@endsection
