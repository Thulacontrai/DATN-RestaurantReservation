@extends('admin.master')

@section('title', 'Kiểm Tra Đơn Đặt Bàn')

@section('content')

    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card shadow-lg">
                        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                            <h4 class="card-title mb-3 text-white">Hệ Thống Kiểm Tra Đơn Đặt Bàn</h4>
                            <a href="{{ route('admin.reservation.index') }}" class="btn btn-sm btn-light mb-3">Quay Lại Danh
                                Sách</a>
                        </div>
                        <div class="card-body">
                            <!-- Thông báo đặt bàn sắp đến hạn -->
                            <!-- Danh sách đơn đặt bàn sắp đến hạn -->
                            <h5 class="text-primary">Danh Sách Đơn Đặt Bàn Sắp Đến ( 30 phút tới! )</h5>
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Mã Đặt Chỗ</th>
                                            <th>Tên Khách Hàng</th>
                                            <th>Thời Gian Đặt</th>
                                            <th>Số Khách</th>
                                            <th>Trạng Thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($upcomingReservations as $reservation)
                                            <tr>
                                                <td>{{ $reservation->id }}</td>
                                                <td>{{ $reservation->customer->name ?? 'Không rõ' }}</td>
                                                <td>{{ $reservation->reservation_time }}</td>
                                                <td>{{ $reservation->guest_count }}</td>
                                                <td><span class="badge bg-warning">Sắp đến hạn</span></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">Không có đơn đặt bàn nào sắp đến hạn.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>


                            <!-- Danh sách đơn đặt bàn đã quá hạn -->
                            <h5 class="text-primary mt-4">Danh Sách Đơn Đặt Bàn Đã Quá Hạn</h5>
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Mã Đặt Chỗ</th>
                                            <th>Tên Khách Hàng</th>
                                            <th>Thời Gian Đặt</th>
                                            <th>Số Khách</th>
                                            <th>Trạng Thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($overdueReservations as $reservation)
                                            <tr>
                                                <td>{{ $reservation->id }}</td>
                                                <td>{{ $reservation->customer->name ?? 'Không rõ' }}</td>
                                                <td>{{ $reservation->reservation_time }}</td>
                                                <td>{{ $reservation->guest_count }}</td>
                                                <td><span class="badge bg-danger">Đã quá hạn</span></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">Không có đơn đặt bàn nào đã quá hạn.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <a href="{{ route('admin.reservation.index') }}" class="btn btn-primary mt-3">Quay Lại Danh
                                Sách</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
