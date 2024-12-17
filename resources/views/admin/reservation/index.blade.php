@extends('admin.master')

@section('title', 'Danh Sách Đặt Bàn')

@section('content')
    @include('admin.layouts.messages')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Toast notifications container -->
            <div id="toastContainer" class="toast-container position-fixed top-0 end-0 p-3">
                @if ($upcomingReservations->count() > 0)
                    <div class="toast reservation-alert" data-ids="{{ $upcomingReservations->pluck('id')->implode(',') }}"
                        role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                        <div class="toast-header bg-info text-white">
                            <strong class="me-auto">Thông báo</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Có {{ $upcomingReservations->count() }} đơn đặt bàn sắp đến giờ nhận bàn trong vòng 30 phút tới
                        </div>
                    </div>
                @endif

                @if ($overdueReservations->count() > 0)
                    <div class="toast reservation-alert" data-ids="{{ $overdueReservations->pluck('id')->implode(',') }}"
                        role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                        <div class="toast-header bg-danger text-white">
                            <strong class="me-auto">Cảnh báo</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Có {{ $overdueReservations->count() }} đơn đặt bàn đã quá hạn và bị hủy
                        </div>
                    </div>
                @endif

                @if ($waitingReservations->count() > 0)
                    <div class="toast reservation-alert" data-ids="{{ $waitingReservations->pluck('id')->implode(',') }}"
                        role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                        <div class="toast-header bg-warning text-white">
                            <strong class="me-auto">Chờ xử lý</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Có {{ $waitingReservations->count() }} đơn đặt bàn đang chờ khách đến.
                        </div>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh Sách Đặt Bàn</div>
                        </div>
                        <div class="card-body">

                            <!-- Search form -->
                            <form method="GET" action="{{ route('admin.reservation.index') }}" class="mb-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <input type="text" id="search-customer" name="customer_name"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo tên khách hàng"
                                            value="{{ request('customer_name') }}">
                                    </div>
                                    <div class="col-auto">
                                        <select name="status" class="form-select form-select-sm" id="statusFilter">
                                            <option value="">Chọn trạng thái</option>
                                            <option value="Confirmed"
                                                {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Đã xác nhận
                                            </option>
                                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>
                                                Chờ xử lý</option>
                                            <option value="Cancelled"
                                                {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" name="date" class="form-control form-control-sm"
                                            value="{{ request('date') }}" id="dateFilter">
                                    </div>

                                    {{-- <!-- New filter for notifications -->
                                    <div class="col-auto">
                                        <select name="notification_type" class="form-select form-select-sm"
                                            id="notificationTypeFilter">
                                            <option value="">Chọn thông báo</option>
                                            <option value="upcoming"
                                                {{ request('notification_type') == 'upcoming' ? 'selected' : '' }}>Sắp đến
                                                hạn </option>
                                            <option value="waiting"
                                                {{ request('notification_type') == 'waiting' ? 'selected' : '' }}>Chờ khách
                                                đến </option>
                                            <option value="overdue"
                                                {{ request('notification_type') == 'overdue' ? 'selected' : '' }}>Quá hạn
                                            </option>
                                        </select>
                                    </div> --}}

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                        <a href="{{ route('admin.reservation.index') }}" class="btn btn-sm btn-success">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>

                            <!-- Table list of reservations -->
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>

                                            <th>Mã Đặt Chỗ</th>
                                            <th>Tên Khách Hàng</th>
                                            <th>Số Lượng Khách</th>
                                            <th>Thời Gian Đặt</th>
                                            {{-- <th>Bàn</th> --}}
                                            <th>Tiền cọc</th>
                                            <th>Ghi Chú</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($reservations as $reservation)
                                            <tr id="reservation-{{ $reservation->id }}">
                                                <td>{{ $reservation->id }}</td>
                                                <td>{{ $reservation->user_name ?? 'Không rõ' }}</td>
                                                <td>{{ $reservation->guest_count ?? 'N/A' }}</td>
                                                <td style="text-align: center">
                                                    <span>
                                                        {{ \Carbon\Carbon::parse($reservation->reservation_date . ' ' . $reservation->reservation_time)->format('H:i:s') }}<br>
                                                        {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    {{ number_format($reservation->deposit_amount, 0, ',', '.') }}
                                                </td>

                                                <td>{{ $reservation->note ?? 'Không có' }}</td>
                                                <td>
                                                    @if ($reservation->status === 'Confirmed')
                                                        <span class="badge shade-green min-70">Đã xác nhận</span>
                                                    @elseif ($reservation->status === 'Pending')
                                                        <span class="badge shade-yellow min-70">Chờ xử lý</span>
                                                    @elseif ($reservation->status === 'Cancelled')
                                                        <span class="badge shade-red min-70">Đã hủy</span>
                                                    @elseif ($reservation->status === 'Refund')
                                                        <span class="badge bg-info">Đã hoàn cọc</span>
                                                    @elseif($reservation->status === 'Completed')
                                                        <span class="badge shade-primary min-70">Hoàn thành</span>
                                                    @elseif($reservation->status === 'Checked-in')
                                                        <span class="badge shade-bdr-light min-70">Đã nhận bàn</span>
                                                    @else
                                                        <span class="badge shade-gray min-70">Không rõ</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.reservation.show', $reservation->id) }}"
                                                            class="editRow" data-id="{{ $reservation->id }}" 
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Chi Tiết">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="{{ route('admin.reservation.edit', $reservation->id) }}"
                                                            class="editRow" data-id="{{ $reservation->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Sửa">
                                                            <i class="bi bi-pencil-square text-warning"></i>

                                                        </a>
                                                        {{-- <a href="{{ route('admin.reservation.assignTables', $reservation->id) }}"
                                                            class="editRow" data-id="{{ $reservation->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Chuyển Bàn">
                                                            <i class="bi bi-box-arrow-in-right"></i>
                                                        </a> --}}
                                                        </form>
                                                        @if ($reservation->status=='Confirmed')
                                                        <a href="#" class="editRow" title="Chuyển Bàn" >
                                                        <button class="btn btn-link p-0 openModal" id="openModal" data-reservation-id="{{$reservation->id}}" data-status-id="{{$reservation->status}}"><i class="bi bi-box-arrow-in-right"></i></button>
                                                        </a>
                                                        @endif
                                                        {{--Xác nhận đơn đặt bàn --}}
                                                        @if ($reservation->status=='Pending')
                                                        <form
                                                            action="{{ route('admin.confirmReservation', $reservation->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('POST')
                                                            <a href="#" style="margin-top: 15px"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Xác nhận">
                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <i class="bi bi-check-circle"></i>
                                                                </button></a>

                                                        </form>
                                                        @endif
                                                        {{-- Nút hủy đặt bàn --> --}}
                                                        <form
                                                            action="{{ route('admin.reservation.cancel', $reservation->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('POST')
                                                            <a href="#" style="margin-top: 15px"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Huỷ">
                                                                <button type="submit" class="btn btn-link p-0"
                                                                    onclick="return confirm('Bạn có chắc chắn muốn hủy đơn này?');">
                                                                    <i class="bi bi-x-circle text-danger"></i>
                                                                </button></a>

                                                        </form>
                                                        {{-- Hoàn cọc --}}
                                                        {{-- <form action="" method="POST"
                                                      style="display:inline-block;">
                                                      <div style="display: flex; gap: 10px; align-items: center;">
                                                          <a href="{{ route('refunds.create', ['reservation_id' => $reservation->id]) }}"
                                                              class="btn btn-link p-0 return-button"
                                                              style="margin-top: 15px; border: 1px solid #e8e7e7; padding: 10px; width: 37px; height: 35px; display: inline-flex; justify-content: center; align-items: center;">
                                                              <i class="bi bi-cash-coin"></i>
                                                          </a>
                                                      </div>
                                                  </form> --}}
                    
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">Không có đặt bàn nào được tìm thấy.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>


                            <!-- Pagination -->

                        </div>
                        <div class="d-flex justify-content-between align-items-center bg-white p-4">
                            <!-- Phần hiển thị phân trang bên trái -->
                            <div class="mb-4 flex sm:mb-0 text-center">
                                <span style="font-size: 15px">
                                    <i class="bi bi-chevron-compact-left"></i>

                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        Hiển thị <strong
                                            class="font-semibold text-secondary ">{{ $reservations->firstItem() }}-{{ $reservations->lastItem() }}</strong>
                                        trong tổng số <strong
                                            class="font-semibold text-secondary ">{{ $reservations->total() }}</strong>
                                    </span> <i class="bi bi-chevron-compact-right"></i>
                                </span>
                            </div>

                            <!-- Phần hiển thị phân trang bên phải -->
                            <div class="flex items-center space-x-3">
                                <!-- Nút Previous -->
                                @if ($reservations->onFirstPage())
                                    <button class="inline-flex  p-1 pl-2 bg-success text-white  cursor-not-allowed"
                                        style="border-radius: 5px; border: 2px solid rgb(136, 243, 136);">
                                        <span style="font-size: 15px"><i
                                                class="bi bi-chevron-compact-left"></i>Trước</span>
                                    </button>
                                @else
                                    <a href="{{ $reservations->previousPageUrl() }}">
                                        <button class="inline-flex  p-1 pl-2  bg-success text-white "
                                            style="border-radius: 5px;    border: 2px solid rgb(136, 243, 136);">
                                            <span style="font-size: 15px"><i class="bi bi-chevron-double-left"></i>
                                                Trước</span>
                                        </button>
                                    </a>
                                @endif

                                <!-- Nút Next -->
                                @if ($reservations->hasMorePages())
                                    <a href="{{ $reservations->nextPageUrl() }}">
                                        <button class="inline-flex  p-1 pl-2 bg-success text-white"
                                            style="border-radius: 5px;    border: 2px solid rgb(136, 243, 136);">
                                            <span style="font-size: 15px"> Sau <i
                                                    class="bi bi-chevron-compact-right"></i></span>
                                        </button>
                                    </a>
                                @else
                                    <button class="inline-flex  p-1 pl-2 bg-primary text-white cursor-not-allowed"
                                        style="border-radius: 5px;    border: 2px solid rgb(83, 150, 216);">
                                        <span style="font-size: 15px">
                                            Trang Cuối</i></span>
                                    </button>
                                @endif
                            </div>

                        </div>
                        <!-- End Pagination -->

                    </div>
                </div>
            </div>

            <!-- Row end -->

        </div>
        <!-- Row end -->


        <!-- Modal layout bàn-->
        <div class="modal fade mt-3" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-custom" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Danh sách bàn</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4 "><h4 id="id-reservation"></h4> </div>
                        <div class="table-container" id="table-list">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submitTables" class="btn btn-primary submitTables " data-reservation-id="">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>


    <!-- Content wrapper scroll end -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastElList = [].slice.call(document.querySelectorAll('.toast'));
            const toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl);
            });

            toastList.forEach(toast => toast.show());

            const alerts = document.querySelectorAll('.reservation-alert');
            alerts.forEach(alert => {
                alert.addEventListener('click', function() {
                    const ids = this.getAttribute('data-ids').split(',');
                    ids.forEach(id => {
                        const row = document.getElementById('reservation-' + id);
                        if (row) {
                            row.classList.add('highlight-row');
                            row.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }
                    });
                });
            });

            const statusFilter = document.getElementById('statusFilter');
            const dateFilter = document.getElementById('dateFilter');

            statusFilter.addEventListener('change', function() {
                console.log("Trạng thái đã được thay đổi: ", this.value);
            });

            dateFilter.addEventListener('change', function() {
                console.log("Ngày đã được thay đổi: ", this.value);

            });
        });
    </script>
    <script>
        const modalContent = document.getElementById('modalContent');
        const openModalBtns = document.querySelectorAll('.openModal');
        const closeModalBtns=document.querySelectorAll('.close');
        let selectedTables = [];
        const tables = document.querySelectorAll('.table-item');
        // Mở modal
        openModalBtns.forEach(btn => {

            btn.addEventListener('click', (evt) => {
                const content = btn.getAttribute('data-content');
                const reservation_id=btn.getAttribute('data-reservation-id');
                const status=btn.getAttribute('data-status-id');
                if(status!=='Cancelled'){
                     evt.preventDefault();
                // modalContent.textContent = reservation_id;
                $.ajax({
                    url: '/admin/getTable/',  // Địa chỉ URL đến controller trong Laravel
                    type: 'GET',  // Phương thức HTTP (GET hoặc POST)
                    data: { 
                        reservation_id:reservation_id  // Dữ liệu gửi đi (reservation_id)
                    },
                    success: function(response) {
                        // Xử lý kết quả trả về từ server (response)
                        // console.log('Response data:', response.reservations);
                        if(response.success) {
                            selectedTables = [];
                            RenderLayout(response.tables,response.current_reservation_id);
                            loadTables(response.tables, response.current_reservation_id);
                            // console.log(selectedTables)
                        } else {
                            Swal.fire({
                        position: "top-end",
                        icon: "error",
                        toast: true,
                        title: response.message,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2500
                    }).then(()=>{
                        $('#myModal').modal('hide');
                    });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi khi có sự cố với yêu cầu AJAX
                        console.error('Có lỗi xảy ra:', error);
                        // alert('Đã xảy ra lỗi khi lấy dữ liệu!');
                    }
                });
                $('#myModal').modal('show');
                } else{
                     evt.preventDefault();
                     Swal.fire({
                        position: "top-end",
                        icon: "error",
                        toast: true,
                        title: "Đơn đặt bàn đã hủy không được xếp bàn",
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2500
                    }).then(()=>{
                        $('#myModal').modal('hide');
                    });
                }
               
              
                
                
                
            });
        });
        
        // Hiển thị layout bàn
        function RenderLayout(tables,reservation_id){ 
            const titleIdreser = document.getElementById('id-reservation');
            titleIdreser.innerHTML = "";
            
            const $tableContainer = $('#table-list');
            $tableContainer.empty(); // Xóa nội dung cũ
            tables.forEach(table => {
            const $tableItem = $(`
            <div class=" table-item ${table.status.toLowerCase()}" 
            data-id="${table.table_id}" 
             data-reservation-id="${table.reservation_id}"
             onclick="selectTable(${table.table_id},${table.reservation_id},${reservation_id})">Bàn ${table.name}</div>
            `);
            
            $tableContainer.append($tableItem);
            });
            $('#submitTables').attr('data-reservation-id',reservation_id);
            titleIdreser.innerHTML += "Mã đơn đặt bàn :"+reservation_id ?? "";
    
        }
        //  lấy danh sách bàn đã chọn của đơn này
        function loadTables(tables, currentReservationId) {
        let hasTablesForCurrentReservation = false;
    
        tables.forEach(table => {
            // Kiểm tra nếu bàn đã được xếp cho đơn đặt bàn hiện tại
            if (table.reservation_id === parseInt(currentReservationId, 10)) {
                hasTablesForCurrentReservation = true;
                selectedTables.push(table.table_id); // Thêm bàn vào danh sách
    
                // Thay đổi giao diện
                const tableElement = document.querySelector(`[data-id="${table.table_id}"]`);
                if (tableElement) {
                    tableElement.classList.add('reserved', 'selected');
                    tableElement.classList.remove('available');
                }
            }
        });
    
        // Cập nhật chế độ tự động
    
        }
    
        // Hàm chọn bàn
        function selectTable(tableId, reservationId, currentReservationId) {
        const tableElement = document.querySelector(`[data-id="${tableId}"]`);
    
        // Kiểm tra nếu bàn đã được đặt cho đơn khác
        if (reservationId && reservationId !== currentReservationId) {
            Swal.fire({
                        position: "top-end",
                        icon: "warning",
                        toast: true,
                        title: "Bàn đã được đặt vui lòng chọn bàn khác",
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2500
                    })
                        return false;
                  
            
        }
        // Kiểm tra nếu bàn đã được chọn trong danh sách selectedTables
        const isSelected = selectedTables.includes(tableId);
        // Nếu bàn đã được chọn, xóa bàn khỏi danh sách và thay đổi lại màu
        if (isSelected) {
            selectedTables = selectedTables.filter(id => id !== tableId);
            tableElement.classList.remove('selected', 'reserved');
            tableElement.classList.add('available');
            // console.log("Đã bỏ chọn bàn:", selectedTables);
            return false; // Không gửi AJAX khi bỏ chọn
        }
    
        // Thêm bàn vào danh sách selectedTables
        selectedTables.push(tableId);
        tableElement.classList.add('selected', 'reserved');
        tableElement.classList.remove('available');
    
        return true;
        }
        let btns = document.querySelectorAll(".submitTables");  // Sử dụng class thay vì id
        let currentReservationId=null;
        btns.forEach(btn => {
        btn.addEventListener("click", function() {
             currentReservationId = btn.getAttribute('data-reservation-id');
            console.log(currentReservationId);
            
            if (selectedTables.length === 0) {
                Swal.fire({
                        position: "top-end",
                        icon: "error",
                        toast: true,
                        title: "Vui lòng chọn bàn",
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2500
                    });
                return false;
            }
            sendTableUpdates(currentReservationId);
        });
                });
    
    
        // Xử lý sự kiện khi nhấn nút Submit
        function sendTableUpdates(currentReservationId) {
        
        $.ajax({
            url: '/admin/reser-tables/update',
            method: 'POST',
            data: {
                reservation_id: currentReservationId,
                tables: selectedTables,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    console.log(response);
                    
                    Swal.fire({
                        position: "top-end",
                        icon: response.type,
                        toast: true,
                        title: response.message,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2500
                    })
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon:response.type,
                        toast: true,
                        title: response.message,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2500
                    })
                }
            },
            error: function () {
                alert("Có lỗi xảy ra khi gửi dữ liệu lên server.");
            }
        });
        }
            // Ví dụ gọi hàm khi nhân viên click vào bàn
            document.querySelectorAll('.table').forEach((table) => {
                table.addEventListener('click', function () {
                    const tableId = this.dataset.id; // ID của bàn
                    const reservationId = this.dataset.reservationId; // reservation_id của bàn
                    selectTable(tableId, parseInt(reservationId, 10)); // Truyền vào hàm kiểm tra
                });
            });
    
        // Đóng model
        closeModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                $('#myModal').modal('hide');
            });
            });
    </script>
@endsection

<style>
    .highlight-row {
        border: 2px solid #28a745;
        /* Màu xanh lá cây */
        transition: all 0.3s ease;
    }

    .form-control,
    .form-select {
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #007bff;
        /* Màu xanh dương khi focus */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        /* Hiệu ứng shadow */
    }

    .btn {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Màu xanh đậm hơn khi hover */
        transform: translateY(-2px);
        /* Hiệu ứng nâng lên */
    }

    .badge {
        font-weight: bold;
        padding: 0.5em 1em;
        border-radius: 0.25rem;

    }

    /* Tùy chỉnh kích thước của modal layout bàn */
    .modal-custom  {
    background-color: #ffffff;
    padding: 15px;
    border-radius: 15px;
    border: 3px solid #f0f0f0;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
    text-align: center;
    max-width: 750px !important;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    }

    .modal-body {
        max-height: 400px; /* Chiều cao tối đa của nội dung */
        overflow-y: auto; /* Thêm thanh cuộn nếu nội dung quá cao */
    }

    /* Css bàn */
    .table-container {
            display: grid;
            grid-template-columns: repeat(5, 100px);
            gap: 30px;
        }
    .table-item {
    width: 100px;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f5f5f5;
    border: 1.5px solid #ddd;
    border-radius: 8px;
    font-size: 0.9em;
    font-weight: bold;
    color: #333;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
    }   

    .table-item:hover {
    background-color: #e0e0e0;
    border-color: #ccc;
    }

    .table-item.selected {
        background-color: #ff5722 !important; /* Màu nền khi bàn được chọn */
    }

    .table-item.available {
        background-color: #ececec !important; /* Màu nền khi bàn còn trống */
        color: #000000 !important;
    }

    .table-item.occupied {
        background-color: #f2dede; /* Màu nền khi bàn đang được sử dụng */
        color: #a94442;
    }

    .table-item.reserved {
        background-color: #fcf8e3 !important; /* Màu nền khi bàn đã được đặt (reserved) */
        color: #8a6d3b !important;
    }

    .table-item.disabled {
        /* pointer-events: none; */
        /* opacity: 0.5; */
        background-color: #ff0015;
        /* border: 1px solid #f5717e; */
    }


</style>
