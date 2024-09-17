@extends('admin.master')

@section('title', 'Thùng Rác Thanh Toán')

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
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Thùng Rác Thanh Toán</div>
                            <a href="{{ route('admin.payment.index') }}" class="btn btn-sm btn-primary">
                                Quay lại danh sách thanh toán
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Mã Thanh Toán</th>
                                            <th>Mã Đặt Chỗ</th>
                                            <th>Mã Hóa Đơn</th>
                                            <th>Số Tiền Giao Dịch</th>
                                            <th>Trạng Thái Giao Dịch</th>
                                            <th>Hình Thức Thanh Toán</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->id }}</td>
                                                <td>{{ $payment->reservation_id }}</td>
                                                <td>{{ $payment->bill_id }}</td>
                                                <td>{{ number_format($payment->transaction_amount, 2, ',', '.') }} VND</td>
                                                <td>
                                                    <span
                                                        class="badge
                                                    @if ($payment->transaction_status == 'completed') bg-success
                                                    @elseif ($payment->transaction_status == 'failed') bg-danger
                                                    @elseif ($payment->transaction_status == 'pending') bg-warning @endif">
                                                        {{ ucfirst($payment->transaction_status) }}
                                                    </span>
                                                </td>
                                                <td>{{ ucfirst($payment->payment_method) }}</td>
                                                <td>
                                                    <div class="actions">
                                                        <!-- Khôi phục -->
                                                        <form action="{{ route('admin.payment.restore', $payment->id) }}"
                                                            method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục không?');">
                                                            @csrf
                                                            @method('PATCH')
                                                            <a href="#">
                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <i class="bi bi-arrow-clockwise text-green"></i>
                                                                </button></a>
                                                        </form>

                                                        <!-- Xóa vĩnh viễn -->
                                                        <form
                                                            action="{{ route('admin.payment.forceDelete', $payment->id) }}"
                                                            method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn không?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#">
                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <i class="bi bi-trash text-red"></i>
                                                                </button></a>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Không có bản ghi thanh toán nào trong
                                                    thùng rác.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="pagination justify-content-center mt-3">
                                {{ $payments->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
