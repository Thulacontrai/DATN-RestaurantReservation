@extends('admin.master')

@section('title', 'Danh Sách Phiếu Nhập Kho')

@section('content')

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <div id="toastContainer" class="toast-container position-fixed top-0 end-0 p-3">

            </div>

            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh Sách Phiếu Nhập Kho</div>
                            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Tạo phiếu nhập mới</a>
                        </div>
                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <!-- Search form -->
                            <form method="GET" action="{{ route('transactions.index') }}" class="mb-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        {{-- <input type="text" id="search-supplier" name="supplier_name" class="form-control form-control-sm" placeholder="Tìm kiếm theo nhà cung cấp" value="{{ request('supplier_name') }}"> --}}
                                    </div>
                                    <div class="col-auto">
                                        <select name="status" class="form-select form-select-sm" id="statusFilter">
                                            <option value="">Chọn trạng thái</option>
                                            <option value="chờ xử lý" {{ request('status') == 'chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                                            <option value="hoàn thành" {{ request('status') == 'hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                                            <option value="hủy" {{ request('status') == 'hủy' ? 'selected' : '' }}>Hủy</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" name="date" class="form-control form-control-sm" value="{{ request('date') }}" id="dateFilter">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>


                            <!-- Table list of transactions -->
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nhân viên</th>
                                            <th>Loại giao dịch</th>
                                            <th>Tổng số tiền</th>                                        
                                            <th>Nhà cung cấp</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td>{{ $transaction->staff_name ?? 'N/A' }}</td>
                                                <td>{{ $transaction->transaction_type }}</td>
                                                <td>{{ number_format($transaction->total_amount, 0, ',', '.') }} đ</td>                                       
                                                <td>{{ $transaction->supplier->name ?? 'N/A' }}</td>

                                                <td>
                                                    @if ($transaction->status === 'hoàn thành')
                                                        <span class="badge shade-green min-70">Hoàn thành</span>
                                                    @elseif ($transaction->status === 'chờ xử lý')
                                                        <span class="badge shade-yellow min-70">Chờ xử lý</span>
                                                    @elseif ($transaction->status === 'Hủy')
                                                        <span class="badge shade-red min-70">Hủy</span>                                                                                
                                                    @else
                                                        <span class="badge shade-gray min-70">Không rõ</span>
                                                    @endif
                                                </td>
                                               <td style="text-align: center">

                                                    {{ \Carbon\Carbon::parse($transaction->change_date . ' ' . $transaction->change_time)->format('H:i:s') }}<br>
                                                    {{ \Carbon\Carbon::parse($transaction->change_date)->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('transactions.show', $transaction->id) }}"class="btn btn-link p-1" >
                                                        <i class="bi bi-list text-green"></i>
                                                    </a>
                                                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-link p-1" >
                                                        <i class="bi bi-pencil-square text-warning"></i>

                                                    </a>
                                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-link p-1">
                                                            <i class="bi bi-trash text-red"></i>

                                                        </button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9">Không có phiếu nhập nào được tìm thấy.</td>
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

        </div>
        <!-- Row end -->
    </div>
    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa phiếu nhập này không?");
        }
    </script>


@endsection
