@extends('admin.master')

@section('title', 'Danh Sách Phiếu Nhập Kho')

@section('content')

    @include('admin.layouts.messages')
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



                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center bg-white p-4">
                            <!-- Phần hiển thị phân trang bên trái -->
                            <div class="mb-4 flex sm:mb-0 text-center">
                                <span style="font-size: 15px">
                                    <i class="bi bi-chevron-compact-left"></i>

                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        Hiển thị <strong
                                            class="font-semibold text-secondary ">{{ $transactions->firstItem() }}-{{ $transactions->lastItem() }}</strong>
                                        trong tổng số <strong
                                            class="font-semibold text-secondary ">{{ $transactions->total() }}</strong>
                                    </span> <i class="bi bi-chevron-compact-right"></i>
                                </span>
                            </div>

                            <!-- Phần hiển thị phân trang bên phải -->
                            <div class="flex items-center space-x-3">
                                <!-- Nút Previous -->
                                @if ($transactions->onFirstPage())
                                    <button class="inline-flex  p-1 pl-2 bg-success text-white  cursor-not-allowed"
                                        style="border-radius: 5px; border: 2px solid rgb(136, 243, 136);">
                                        <span style="font-size: 15px"><i class="bi bi-chevron-compact-left"></i>Trước</span>
                                    </button>
                                @else
                                    <a href="{{ $transactions->previousPageUrl() }}">
                                        <button class="inline-flex  p-1 pl-2  bg-success text-white "
                                            style="border-radius: 5px;    border: 2px solid rgb(136, 243, 136);">
                                            <span style="font-size: 15px"><i class="bi bi-chevron-double-left"></i>
                                                Trước</span>
                                        </button>
                                    </a>
                                @endif

                                <!-- Nút Next -->
                                @if ($transactions->hasMorePages())
                                    <a href="{{ $transactions->nextPageUrl() }}">
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
