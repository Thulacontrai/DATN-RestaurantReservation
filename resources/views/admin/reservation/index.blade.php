@extends('admin.master')

@section('title', 'Danh Sách Đặt Bàn')

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
                        <div class="card-title">Danh Sách Đặt Bàn</div>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

                        <!-- Thông báo đơn đặt bàn -->
                        @if($upcomingReservations->count() > 0)
                        <div class="alert alert-info alert-dismissible fade show reservation-alert" data-ids="{{ $upcomingReservations->pluck('id')->join(',') }}" role="alert">
                            <strong>Thông báo:</strong> Có {{ $upcomingReservations->count() }} đơn đặt bàn sắp đến hạn trong vòng 30 phút tới.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if ($waitingReservations->isNotEmpty())
                        <div class="alert alert-warning alert-dismissible fade show reservation-alert" data-ids="{{ $waitingReservations->pluck('id')->join(',') }}" role="alert">
                            <strong>Thông báo:</strong> Có {{ $waitingReservations->count() }} đơn đặt bàn đang chờ khách đến.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if($overdueReservations->count() > 0)
                        <div class="alert alert-danger alert-dismissible fade show reservation-alert" data-ids="{{ $overdueReservations->pluck('id')->join(',') }}" role="alert">
                            Thông báo: Có {{ $overdueReservations->count() }} đơn đặt bàn đã quá hạn và bị hủy!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- Search form -->
                        <form method="GET" action="{{ route('admin.reservation.index') }}" class="mb-3">
                            <div class="row g-2">
                                <div class="col-auto">
                                    <input type="text" id="search-customer" name="customer_name" class="form-control form-control-sm" placeholder="Tìm kiếm theo tên khách hàng" value="{{ request('customer_name') }}">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>

                        <!-- Table list of reservations -->
                        <div class="table-responsive">
                            <table class="table v-middle m-0">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all"></th>
                                        <th>Mã Đặt Chỗ</th>
                                        <th>Tên Khách Hàng</th>
                                        <th>Số Lượng Khách</th>
                                        <th>Thời Gian Đặt</th>
                                        <th>Bàn</th>
                                        <th>Tiền cọc</th>
                                        <th>Ghi Chú</th>
                                        <th>Trạng Thái</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reservations as $reservation)
                                    <tr id="reservation-{{ $reservation->id }}">
                                        <td><input type="checkbox" name="selected_reservations[]" value="{{ $reservation->id }}"></td>
                                        <td>{{ $reservation->id }}</td>
                                        <td>{{ $reservation->customer->name ?? 'Không rõ' }}</td>
                                        <td>{{ $reservation->guest_count ?? 'N/A' }}</td>
                                        <td>
                                            {{-- {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i:s') }} --}}
                                           {{ $reservation->reservation_date }} 
                                                <br> {{ $reservation->reservation_time }}
                                           
                                        </td>

                                        <td>@foreach ($reservation->tables as $table )
                                            {{$table->table_number}},
                                        @endforeach</td>
                                        <td>{{ number_format($reservation->deposit_amount) }}đ
                                        </td>
                                        <td>{{ $reservation->note ?? 'Không có' }}</td>
                                        <td>
                                            @if ($reservation->status === 'Confirmed')
                                            <span class="badge shade-green min-70">Đã xác nhận</span>
                                            @elseif ($reservation->status === 'Pending')
                                            <span class="badge shade-yellow min-70">Chờ xử lý</span>
                                            @elseif ($reservation->status === 'Cancelled')
                                            <span class="badge shade-red min-70">Đã hủy</span>
                                            @else
                                            <span class="badge shade-gray min-70">Không rõ</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('admin.reservation.show', $reservation->id) }}" class="editRow" data-id="{{ $reservation->id }}">
                                                    <i class="bi bi-list text-green"></i>
                                                </a>
                                                <a href="{{ route('admin.reservation.edit', $reservation->id) }}" class="editRow" data-id="{{ $reservation->id }}">
                                                    <i class="bi bi-pencil-square text-warning"></i>
                                                   
                                                </a>
                                                <a href="{{ route('admin.reservation.assignTables', $reservation->id) }}" class="editRow" data-id="{{ $reservation->id }}">
                                                    <i class="bi bi-box-arrow-in-right"></i>
                                                </a>
                                                <form action="{{ route('admin.reservation.destroy', $reservation->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" style="margin-top: 18px;" >
                                                    <button type="submit" class="btn btn-link p-0" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
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
                        <div class="pagination justify-content-center mt-3">
                            {{ $reservations->links() }}
                        </div>

                        <!-- End Pagination -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->

    </div>
</div>

<!-- Content wrapper scroll end -->

@endsection

<style>
    .highlight-row {
        border: 2px solid red;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alerts = document.querySelectorAll('.reservation-alert');

        alerts.forEach(alert => {
            alert.addEventListener('click', function () {
                const reservationIds = this.getAttribute('data-ids').split(',');

                // Bỏ highlight khỏi tất cả các hàng trước
                document.querySelectorAll('tr').forEach(row => {
                    row.classList.remove('highlight-row');
                });

                // Thêm highlight cho tất cả các hàng tương ứng
                reservationIds.forEach(reservationId => {
                    const reservationRow = document.getElementById(`reservation-${reservationId.trim()}`);
                    if (reservationRow) {
                        reservationRow.classList.add('highlight-row');

                        // Cuộn đến hàng đầu tiên
                        if (reservationId === reservationIds[0]) {
                            reservationRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }
                });
            });
        });
    });
</script>
