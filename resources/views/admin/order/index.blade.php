@extends('admin.master')

@section('title', 'Danh Sách Đơn Hàng')

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
                            <div class="card-title">Danh Sách Đơn Hàng</div>
                        </div>

                        <div class="card-body">

                            <form method="GET" action="{{ route('admin.order.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-id" name="id"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo mã đơn hàng">
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
                                            <th>Mã Đơn Hàng</th>
                                            <th>Mã Đặt Chỗ</th>
                                            <th>Nhân Viên</th>
                                            <th>Bàn</th>
                                            <th>Tổng Tiền</th>
                                            <th>Số Tiền Cuối Cùng</th>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->reservation_id }}</td>
                                                <td>{{ $order->staff->name ?? 'Không rõ' }}</td>
                                                <td>{{ $order->tables['0']->id ?? 'Không rõ' }}</td>
                                                <td>{{ number_format($order->total_amount, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($order->final_amount, 0, ',', '.') }} VND</td>

                                                <td>
                                                    @if ($order->status === 'completed')
                                                        <span class="badge bg-success">Hoàn thành</span>
                                                    @elseif ($order->status === 'pending')
                                                        <span class="badge bg-warning text-dark">Đang xử lý</span>
                                                    @elseif ($order->status === 'cancelled')
                                                        <span class="badge bg-danger">Đã hủy</span>
                                                    @else
                                                        <span class="badge bg-secondary">Không rõ</span>
                                                    @endif
                                                </td>

                                                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.order.show', $order->id) }}"
                                                            class="viewRow">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="{{ route('admin.order.edit', $order->id) }}"
                                                            class="editRow">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <a href="" class="viewRow">
                                                        <form action="{{ route('admin.order.destroy', $order->id) }}"
                                                            method="POST" style="display:inline-block; padding-bottom: 7px;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link p-0 deleteRow">
                                                                <svg class="delete-svgIcon" viewBox="0 0 448 512">
                                                                    <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                                                                  </svg>
                                                            </button>
                                                        </form></a>
                                                        <a href="{{ route('admin.order.trash') }}">
                                                            <svg class="delete-svgIcon1" viewBox="0 0 448 512">
                                                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                                                              </svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10">Không có đơn hàng nào được tìm thấy.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{-- {{ $orders->links() }} --}}
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
