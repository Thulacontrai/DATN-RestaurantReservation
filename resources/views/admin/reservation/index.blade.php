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

                                            <th>
                                                <a
                                                    href="{{ route('admin.reservation.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('sort') === 'id' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                                    Mã Đặt Chỗ
                                                    <i
                                                        class="bi bi-arrow-{{ request('sort') === 'id' ? (request('direction') === 'asc' ? 'up' : 'down') : '' }}"></i>
                                                </a>
                                            </th>
                                            <th>Tên Khách Hàng</th>
                                            <th>
                                                <a
                                                    href="{{ route('admin.reservation.index', array_merge(request()->query(), ['sort' => 'guest_count', 'direction' => request('sort') === 'guest_count' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                                    Số Lượng Khách
                                                    <i
                                                        class="bi bi-arrow-{{ request('sort') === 'guest_count' ? (request('direction') === 'asc' ? 'up' : 'down') : '' }}"></i>
                                                </a>
                                            </th>
                                            <th>Thời Gian Đặt</th>
                                            <th>
                                                <a
                                                    href="{{ route('admin.reservation.index', array_merge(request()->query(), ['sort' => 'deposit_amount', 'direction' => request('sort') === 'deposit_amount' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                                    Tiền Cọc
                                                    <i
                                                        class="bi bi-arrow-{{ request('sort') === 'deposit_amount' ? (request('direction') === 'asc' ? 'up' : 'down') : '' }}"></i>
                                                </a>
                                            </th>

                                            <th>Ghi Chú</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($reservations as $reservation)
                                            <tr id="reservation-{{ $reservation->id }}">
                                                <td>{{ $reservation->id }}</td>
                                                <td>{{ $reservation->customer->name ?? 'Không rõ' }}</td>
                                                <td>{{ $reservation->guest_count ?? 'N/A' }}</td>
                                                <td style="text-align: center">
                                                    <span class="text-success">
                                                        {{ \Carbon\Carbon::parse($reservation->reservation_date . ' ' . $reservation->reservation_time)->format('H:i:s') }}</span><br>
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
                                                        <a href="{{ route('admin.reservation.assignTables', $reservation->id) }}"
                                                            class="editRow" data-id="{{ $reservation->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Chuyển Bàn">
                                                            <i class="bi bi-box-arrow-in-right"></i>
                                                        </a>
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
                                                        <form
                                                            action="{{ route('admin.reservation.destroy', $reservation->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#" style="margin-top: 18px;"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Xoá">
                                                                <button type="submit" class="btn btn-link p-0"
                                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                                    <i class="bi bi-trash text-red"></i>
                                                                </button></a>
                                                        </form>
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
</style>
