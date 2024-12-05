@extends('admin.master')

@section('title', 'Danh Sách Phiếu Nhập Kho')

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
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh sách phiếu nhập kho</div>

                            <!-- Nút Thêm Mới và Khôi Phục -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('transactions.create') }}"
                                    class="btn btn-sm btn-primary d-flex align-items-center">
                                    <i class="bi bi-plus-circle me-2"></i> Thêm mới
                                </a>
                                {{-- <a href=""
                                    class="btn btn-sm btn-secondary d-flex align-items-center">
                                    <i class="bi bi-trash3 me-2"></i> Khôi Phục
                                </a> --}}
                            </div>
                        </div>

                        <div class="card-body">

                            <!-- Search form -->
                            <form method="GET" action="{{ route('transactions.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-id" name="id"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo mã phiếu nhập">
                                    </div>
                                    <div class="col-auto">
                                        <select name="status" class="form-select form-select-sm" id="statusFilter">
                                            <option value="">Chọn trạng thái</option>
                                            <option value="chờ xử lý"
                                                {{ request('status') == 'chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                                            <option value="hoàn thành"
                                                {{ request('status') == 'hoàn thành' ? 'selected' : '' }}>Hoàn thành
                                            </option>
                                            <option value="hủy" {{ request('status') == 'hủy' ? 'selected' : '' }}>Hủy
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" name="date" class="form-control form-control-sm"
                                            value="{{ request('date') }}" id="dateFilter">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                        <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-success">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>

                            <!-- Table list of transactions -->
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Mã Phiếu Nhập</th>
                                            <th>Nhân Viên</th>
                                            <th>Nhà Cung Cấp</th>
                                            <th>Tổng Tiền</th>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td>{{ $transaction->staff_name ?? 'Không rõ' }}</td>
                                                <td>{{ $transaction->supplier->name ?? 'Không rõ' }}</td>
                                                <td>{{ number_format($transaction->total_amount, 0, ',', '.') }} VND</td>
                                                <td>
                                                    @if ($transaction->status === 'hoàn thành')
                                                        <span class="badge bg-success">Hoàn thành</span>
                                                    @elseif ($transaction->status === 'chờ xử lý')
                                                        <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                                    @elseif ($transaction->status === 'hủy')
                                                        <span class="badge bg-danger">Đã hủy</span>
                                                    @else
                                                        <span class="badge bg-secondary">Không rõ</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($transaction->change_date . ' ' . $transaction->change_time)->format('H:i:s') }}<br>
                                                    {{ \Carbon\Carbon::parse($transaction->change_date)->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('transactions.show', $transaction->id) }}"
                                                            class="viewRow" data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Chi tiết">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="{{ route('transactions.edit', $transaction->id) }}"
                                                            class="editRow" data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Sửa">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <a href="" class="viewRow" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Xóa">
                                                            <form
                                                                action="{{ route('transactions.destroy', $transaction->id) }}"
                                                                method="POST" style="display:inline-block;"
                                                                onsubmit="return confirmDelete();">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <i class="bi bi-trash text-danger"
                                                                        style="font-size: 1.2rem;"></i>
                                                                </button>
                                                            </form>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">Không có phiếu nhập nào được tìm thấy.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{ $transactions->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
        </div>
        <!-- Content wrapper end -->

    </div>



    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa phiếu nhập này không?");
        }
    </script>

@endsection
