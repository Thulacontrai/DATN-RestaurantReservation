@extends('admin.master')

@section('title', 'Danh Sách Bàn Đặt Trước')

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
                            <div class="card-title">Danh Sách Bàn Đặt Trước</div>
                        </div>
                        <div class="card-body">

                            <form method="GET" action="#" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" name="table_id" class="form-control form-control-sm"
                                            placeholder="Tìm kiếm theo mã bàn">
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
                                            <th>Mã Bàn</th>
                                            <th>Mã Đặt Chỗ</th>
                                            <th>Thời Gian Bắt Đầu</th>
                                            <th>Thời Gian Kết Thúc</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>101</td>
                                            <td>1001</td>
                                            <td>2024-09-01 18:00:00</td>
                                            <td>2024-09-01 20:00:00</td>
                                            <td><span class="badge shade-green min-70">Đã đặt trước </span></td>
                                            <td>

                                                <div class="actions">
                                                    <a href="#"class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#viewRow">
                                                        <i class="bi bi-list text-green"></i>

                                                    </a>
                                                    <div class="actions">
                                                        <a href="#"class="viewRow" data-bs-toggle="modal" <i
                                                            class="bi bi-radioactive updateStatusBtn" data-table-id="102"
                                                            data-reservation-id="1002" data-bs-toggle="modal"
                                                            data-bs-target="#updateStatusModal"><i
                                                                class="bi bi-recycle"></i></i>
                                                        </a>
                                                        <a href="#" class="deleteRow">
                                                            <i class="bi bi-trash text-red"></i>
                                                        </a>
                                                    </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>102</td>
                                            <td>1002</td>
                                            <td>2024-09-02 19:00:00</td>
                                            <td>2024-09-02 21:00:00</td>
                                            <td><span class="badge shade-yellow min-70">Đang sử dụng</span></td>
                                            <td>

                                                <div class="actions">
                                                    <a href="#"class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#viewRow">
                                                        <i class="bi bi-list text-green"></i>

                                                    </a>
                                                    <div class="actions">
                                                        <a href="#"class="viewRow" data-bs-toggle="modal" <i
                                                            class="bi bi-radioactive updateStatusBtn" data-table-id="102"
                                                            data-reservation-id="1002" data-bs-toggle="modal"
                                                            data-bs-target="#updateStatusModal"><i
                                                                class="bi bi-recycle"></i></i>
                                                        </a>
                                                        <a href="#" class="deleteRow">
                                                            <i class="bi bi-trash text-red"></i>
                                                        </a>
                                                    </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>103</td>
                                            <td>1003</td>
                                            <td>2024-09-03 18:30:00</td>
                                            <td>2024-09-03 20:30:00</td>
                                            <td><span class="badge shade-red min-70">Hoàn thành</span></td>
                                            <td>

                                                <div class="actions">
                                                    <a href="#"class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#viewRow">
                                                        <i class="bi bi-list text-green"></i>

                                                    </a>
                                                    <div class="actions">
                                                        <a href="#"class="viewRow" data-bs-toggle="modal" <i
                                                            class="bi bi-radioactive updateStatusBtn" data-table-id="102"
                                                            data-reservation-id="1002" data-bs-toggle="modal"
                                                            data-bs-target="#updateStatusModal"><i
                                                                class="bi bi-recycle"></i></i>
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

    <!-- Modal xem chi tiết -->
    <div class="modal fade" id="viewRow" tabindex="-1" aria-labelledby="viewRowLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewRowLabel">Chi Tiết Bàn Đặt Trước</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tableIdView" class="form-label">Mã Bàn</label>
                                <input type="text" class="form-control" id="tableIdView" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="reservationIdView" class="form-label">Mã Đặt Chỗ</label>
                                <input type="text" class="form-control" id="reservationIdView" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="startTimeView" class="form-label">Thời Gian Bắt Đầu</label>
                        <input type="text" class="form-control" id="startTimeView" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="endTimeView" class="form-label">Thời Gian Kết Thúc</label>
                        <input type="text" class="form-control" id="endTimeView" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="statusView" class="form-label">Trạng Thái</label>
                        <input type="text" class="form-control" id="statusView" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal cập nhật trạng thái -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStatusLabel">Cập Nhật Trạng Thái Bàn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="Đã đặt trước">Đã đặt trước</option>
                            <option value="Đang sử dụng">Đang sử dụng</option>
                            <option value="Hoàn thành">Hoàn thành</option>
                            <option value="Hủy">Hủy</option>
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
            const updateButtons = document.querySelectorAll('.updateStatusBtn');
            const saveStatusButton = document.querySelector('.saveStatusBtn');

            const tableIdViewField = document.getElementById('tableIdView');
            const reservationIdViewField = document.getElementById('reservationIdView');
            const startTimeViewField = document.getElementById('startTimeView');
            const endTimeViewField = document.getElementById('endTimeView');
            const statusViewField = document.getElementById('statusView');

            const tableIdField = document.getElementById('tableId');
            const reservationIdField = document.getElementById('reservationId');
            const statusSelect = document.getElementById('status');

            // Xem chi tiết bàn
            viewButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const tableId = row.querySelector('td:nth-child(1)').textContent;
                    const reservationId = row.querySelector('td:nth-child(2)').textContent;
                    const startTime = row.querySelector('td:nth-child(3)').textContent;
                    const endTime = row.querySelector('td:nth-child(4)').textContent;
                    const status = row.querySelector('td:nth-child(5)').textContent.trim();

                    tableIdViewField.value = tableId;
                    reservationIdViewField.value = reservationId;
                    startTimeViewField.value = startTime;
                    endTimeViewField.value = endTime;
                    statusViewField.value = status;
                });
            });

            // Cập nhật trạng thái bàn
            updateButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const tableId = this.getAttribute('data-table-id');
                    const reservationId = this.getAttribute('data-reservation-id');
                    const row = this.closest('tr');
                    const status = row.querySelector('td:nth-child(5)').textContent.trim();

                    tableIdField.value = tableId;
                    reservationIdField.value = reservationId;
                    statusSelect.value = status;
                });
            });

            saveStatusButton.addEventListener('click', function() {
                const tableId = tableIdField.value;
                const newStatus = statusSelect.value;

                // Gọi AJAX để cập nhật trạng thái
                fetch(`/update-status/${tableId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Thêm token để bảo vệ chống CSRF
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cập nhật trạng thái trong bảng
                            const row = document.querySelector(`tr:has(td:contains(${tableId}))`);
                            row.querySelector('td:nth-child(5)').textContent = newStatus;
                            alert('Cập nhật trạng thái thành công!');
                            $('#updateStatusModal').modal('hide');
                        } else {
                            alert('Cập nhật thất bại, vui lòng thử lại.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>

@endsection
