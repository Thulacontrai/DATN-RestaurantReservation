@extends('admin.master')

@section('title', 'Danh Sách Yêu Cầu Hoàn Tiền')

@section('content')
    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <style>
        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .swal2-timer-progress-bar {
            background: linear-gradient(90deg, #34eb4f, #00bcd4, #ffa726, #ffeb3b, #f44336);
            /* Gradient màu */
            background-size: 300% 300%;
            /* Kích thước gradient lớn để tạo hiệu ứng động */
            animation: gradientMove 2s ease infinite;
            /* Hiệu ứng lăn tăn */
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hiển thị thông báo lỗi
            @if ($errors->any())
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    toast: true,
                    title: "{{ $errors->first() }}",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                });
            @endif

            // Hiển thị thông báo thành công
            @if (session('success'))
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    toast: true,
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                });
            @endif
        });
    </script>



    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh sách yêu cầu hoàn tiền</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đặt chỗ</th>
                                        <th>Thông tin tài khoản</th>
                                        <th>Số tiền hoàn</th>
                                        <th>Email liên hệ</th>
                                        <th>Lý do hoàn </th>
                                        <th>Trạng thái</th>
                                        <th>Ngày xác nhận</th>
                                        <th>Người xác nhận</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($refunds as $refund)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $refund->reservation_id }}</td>

                                            <!-- Gộp Số tài khoản, Tên tài khoản và Ngân hàng vào một cột -->
                                            <td>
                                                <div class="mb-2">
                                                    <span class="text-muted">Ngân hàng:</span> {{ $refund->bank_name }}
                                                </div>
                                                <div class="mb-2">
                                                    <span class="text-muted">Tên tài khoản:</span>
                                                    {{ $refund->account_name }}
                                                </div>
                                                <div class="mb-2">
                                                    <span class="text-muted">STK:</span> {{ $refund->account_number }}
                                                </div>

                                            </td>
                                            <td>{{ number_format($refund->refund_amount, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ $refund->email }}</td>
                                            <td>{{ $refund->reason }}</td>
                                            <td>
                                                @if ($refund->status === 'Request_Refund')
                                                    <span class="badge shade-yellow">Chưa hoàn tiền</span>
                                                @elseif($refund->status === 'Refund')
                                                    <span class="badge shade-blue">Đã hoàn tiền</span>
                                                @endif
                                            </td>

                                            <td>{{ $refund->confirmed_at ? \Carbon\Carbon::parse($refund->confirmed_at)->format('d-m-Y H:i') : 'Chưa xác nhận' }}
                                            </td>

                                            <td>
                                                {{ $refund->confirmed_by_name ?? 'Chưa xác nhận' }}
                                            </td>

                                            <td class="text-center">
                                                @if ($refund->status === 'Request_Refund')
                                                    <form action="{{ route('refunds.updateStatus', $refund->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="button" class="btn btn-success btn-sm text-nowrap"
                                                            onclick="confirmRefund(event)">Xác nhận</button>
                                                    </form>
                                                @else
                                                    Đã hoàn tiền
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $refunds->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmRefund(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Xác nhận hoàn tiền?',
                    text: 'Bạn có chắc chắn muốn xác nhận hoàn tiền cho yêu cầu này?',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Hủy',
                    confirmButtonText: 'Có, xác nhận!',
                    reverseButtons: false // Đổi thành false để "Có, xác nhận!" xuất hiện trước "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.closest('form').submit();
                    }
                });
            }
        </script>
    @endsection
