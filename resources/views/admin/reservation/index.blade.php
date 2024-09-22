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
                            {{-- <!-- Thêm link đến trang kiểm tra -->
                            <a href="{{ route('admin.reservation.check') }}" class="btn btn-sm btn-primary">
                                Kiểm Tra Đơn Đặt Bàn Sắp Đến và Quá Hạn
                            </a> --}}


                        </div>
                        <div class="card-body">

                            @if ($upcomingReservations->isNotEmpty())
                            <div class="alert alert-info">
                                <strong>Thông báo:</strong> Có {{ $upcomingReservations->count() }} đơn đặt bàn sắp đến hạn trong vòng 30 phút tới!
                            </div>
                        @endif

                        @if ($waitingReservations->isNotEmpty())
                            <div class="alert alert-warning">
                                <strong>Thông báo:</strong> Có {{ $waitingReservations->count() }} đơn đặt bàn đang chờ khách thêm 15 phút.
                            </div>
                        @endif

                        @if ($overdueReservations->isNotEmpty())
                            <div class="alert alert-danger">
                                <strong>Thông báo:</strong> {{ $overdueReservations->count() }} đơn đặt bàn đã quá hạn và bị hủy.
                            </div>
                        @endif



                            <!-- Search form -->
                            <form method="GET" action="{{ route('admin.reservation.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-customer" name="customer_name"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo tên khách hàng"
                                            value="{{ request('customer_name') }}">
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
                                            <th>Ghi Chú</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($reservations as $reservation)
                                            <tr>
                                                <td><input type="checkbox" id="select-all"></td>
                                                <td>{{ $reservation->id }}</td>
                                                <td>{{ $reservation->customer->name ?? 'Không rõ' }}</td>
                                                <td>{{ $reservation->guest_count ?? 'N/A' }}</td>
                                                <td>{{ $reservation->reservation_time }}</td>
                                                {{-- <td>{{ number_format($reservation->total_amount, 0, ',', '.') }} VND</td> --}}
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
                                                        <a href="{{ route('admin.reservation.show', $reservation->id) }}"
                                                            class="editRow" data-id="{{ $reservation->id }}">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="{{ route('admin.reservation.edit', $reservation->id) }}"
                                                            class="editRow" data-id="{{ $reservation->id }}">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('admin.reservation.destroy', $reservation->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#"><button type="submit"
                                                                    class="btn btn-link p-0"
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
                            <div class="pagination justify-content-center mt-3">
                                {{-- {{ $reservations->links() }} --}}
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
