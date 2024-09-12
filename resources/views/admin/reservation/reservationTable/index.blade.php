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

                        <!-- Form tìm kiếm -->
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

                        <!-- Danh sách bàn -->
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
                                    @foreach($reservationTables as $table)
                                    <tr>
                                        <td>{{ $table->table_id }}</td>
                                        <td>{{ $table->reservation_id }}</td>
                                        <td>{{ $table->start_time }}</td>
                                        <td>{{ $table->end_time }}</td>
                                        <td>
                                            <span class="badge {{ $table->status == 'reserved' ? 'shade-green' : ($table->status == 'occupied' ? 'shade-yellow' : 'shade-red') }} min-70">
                                                @if($table->status == 'available')
                                                    có sẵn
                                                @elseif($table->status == 'reserved')
                                                    đã đặt
                                                @elseif($table->status == 'occupied')
                                                    đang sử dụng
                                                @elseif($table->status == 'cleaning')
                                                    đang dọn dẹp
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <!-- Xem chi tiết bàn -->
                                                <a href="#" class="viewRow" data-bs-toggle="modal"
                                                    data-bs-target="#viewRow" data-table-id="{{ $table->table_id }}"
                                                    data-reservation-id="{{ $table->reservation_id }}">
                                                    <i class="bi bi-list text-green"></i>
                                                </a>
                                                <!-- Cập nhật trạng thái bàn -->
                                                <a href="#" class="updateStatusBtn" data-bs-toggle="modal"
                                                    data-bs-target="#updateStatusModal"
                                                    data-table-id="{{ $table->table_id }}"
                                                    data-reservation-id="{{ $table->reservation_id }}">
                                                    <i class="bi bi-recycle"></i>
                                                </a>
                                                <!-- Xóa bàn -->
                                                <a href="#" class="deleteRow">
                                                    <i class="bi bi-trash text-red"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination justify-content-center mt-3">
                            {{-- {{ $reservationTables->links() }} --}}
                        </div>
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
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusLabel" aria-hidden="true">
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
                        <option value="reserved">Đã đặt</option>
                        <option value="occupied">Đang sử dụng</option>
                        <option value="available">Có sẵn</option>
                        <option value="cleaning">Đang dọn dẹp</option>
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

        const statusSelect = document.getElementById('status');

        // Xem chi tiết bàn
        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const tableId = row.querySelector('td:nth-child(1)').textContent;
                const reservationId = row.querySelector('td:nth-child(2)').textContent;
                const startTime = row.querySelector('td:nth-child(3)').textContent;
                const endTime = row.querySelector('td:nth-child(4)').textContent;
                let status = row.querySelector('td:nth-child(5)').textContent.trim();

                // Translate status to Vietnamese for display
                switch(status) {
                    case 'available':
                        status = 'Có sẵn';
                        break;
                    case 'reserved':
                        status = 'Đã đặt';
                        break;
                    case 'occupied':
                        status = 'Đang sử dụng';
                        break;
                    case 'cleaning':
                        status = 'Đang dọn dẹp';
                        break;
                }

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
                const row = this.closest('tr');
                const status = row.querySelector('td:nth-child(5)').textContent.trim();

                switch(status) {
                    case 'Có sẵn':
                        statusSelect.value = 'available';
                        break;
                    case 'Đã đặt':
                        statusSelect.value = 'reserved';
                        break;
                    case 'Đang sử dụng':
                        statusSelect.value = 'occupied';
                        break;
                    case 'Đang dọn dẹp':
                        statusSelect.value = 'cleaning';
                        break;
                }
            });
        });

        saveStatusButton.addEventListener('click', function() {
            // Logic lưu trạng thái mới
            const selectedStatus = statusSelect.value;
            console.log('Trạng thái mới:', selectedStatus);
        });
    });
</script>

@endsection
