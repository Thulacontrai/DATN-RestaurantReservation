@extends('admin.master')

@section('title', 'Danh Sách Thanh Toán')

@section('content')


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

                        </div>

                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.payment.index') }}" class="mb-3">
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
                                            <th>Số Tiền Hoàn Lại</th>
                                            <th>Trạng Thái Giao Dịch</th>
                                            <th>Phương Thức Thanh Toán</th>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->id }}</td>
                                                <td>{{ $payment->reservation_id }}</td>
                                                <td>{{ $payment->bill_id }}</td>
                                                <td>{{ number_format($payment->transaction_amount, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($payment->refund_amount, 0, ',', '.') }} VND</td>

                                                <td>
                                                    @if ($payment->transaction_status === 'completed')
                                                        Hoàn thành
                                                    @elseif ($payment->transaction_status === 'pending')
                                                        Đang xử lý
                                                    @elseif ($payment->transaction_status === 'failed')
                                                        Thất bại
                                                    @else
                                                        Không rõ
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($payment->payment_method === 'Cash')
                                                        Tiền mặt
                                                    @elseif ($payment->payment_method === 'Credit Card')
                                                        Thẻ tín dụng
                                                    @elseif ($payment->payment_method === 'Online')
                                                        Thanh toán trực tuyến
                                                    @else
                                                        Không rõ
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($payment->status === 'Completed')
                                                        <span class="badge bg-success">Hoàn thành</span>
                                                    @elseif ($payment->status === 'Pending')
                                                        <span class="badge bg-warning text-dark">Đang xử lý</span>
                                                    @elseif ($payment->status === 'Failed')
                                                        <span class="badge bg-danger">Thất bại</span>
                                                    @else
                                                        <span class="badge bg-secondary">Không rõ</span>
                                                    @endif
                                                </td>

                                                <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.payment.show', $payment->id) }}"
                                                            class="viewRow">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="{{ route('admin.payment.edit', $payment->id) }}"
                                                            class="editRow">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <form action="{{ route('admin.payment.destroy', $payment->id) }}"
                                                            method="POST" style="display:inline-block; padding-bottom: 7px;">
                                                            @csrf
                                                            @method('DELETE') <a href="#">
                                                            <button type="submit" class="btn btn-link p-0 deleteRow">
                                                                <svg class="delete-svgIcon" viewBox="0 0 448 512">
                                                                    <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                                                                  </svg>
                                                            </button></a>
                                                            <a href="{{ route('admin.payment.trash') }}">
                                                                <svg class="delete-svgIcon1" viewBox="0 0 448 512">
                                                                    <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                                                                  </svg>
                                                            </a>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10">Không có thanh toán nào được tìm thấy.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{-- {{ $payments->links() }} --}}
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

@endsection
