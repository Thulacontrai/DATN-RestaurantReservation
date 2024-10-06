@extends('admin.master')

@section('title', 'Danh Mục Bàn')

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
                            <div class="card-title">Danh Mục Bàn</div>
                            {{-- <div class="filter-btn d-flex align-items-center ms-2 pe-2" style="cursor: pointer;">
                                <i class="bi bi-funnel-fill" id="filter-toggle"></i>
                            </div> --}}
                            <div class="heart-btn d-flex ms-2  align-items-center"
                                style="cursor: pointer;">
                                <i class="bi bi-funnel-fill" id="filter-toggle"></i>
                            </div>

                            <div class="heart-btn d-flex align-items-center" id="heartButton">
                                <a href="{{ route('admin.tables.trash') }}">
                                    <i class="bi bi-trash2-fill"></i>
                                </a>
                            </div>
                            <a href="{{ route('admin.table.create') }}"
                                class="btn btn-sm btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>

                        <div class="card-body">
                            <!-- Form tìm kiếm, ban đầu bị ẩn -->
                            <div id="filter-form" style="display: none; margin-top: 10px;">
                                <form method="GET" action="{{ route('admin.table.index') }}" class="mb-3">
                                    <div class="row g-2">
                                        <div class="col-auto">
                                            <input type="text" id="search-name" name="name"
                                                class="form-control form-control-sm" placeholder="Tìm kiếm bàn"
                                                value="{{ request('name') }}">
                                        </div>
                                        <div class="col-auto">
                                            <select name="table_type" id="search-table-type"
                                                class="form-select form-select-sm">
                                                <option value="">-- Loại bàn --</option>
                                                <option value="Thường"
                                                    {{ request('table_type') == 'Thường' ? 'selected' : '' }}>Thường
                                                </option>
                                                <option value="VIP"
                                                    {{ request('table_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                                            </select>
                                        </div>
                                        <!-- Thêm dropdown trạng thái bàn -->
                                        <div class="col-auto">
                                            <select name="status" id="search-status" class="form-select form-select-sm">
                                                <option value="">-- Trạng thái --</option>
                                                <option value="Available"
                                                    {{ request('status') == 'Available' ? 'selected' : '' }}>Có sẵn</option>
                                                <option value="Reserved"
                                                    {{ request('status') == 'Reserved' ? 'selected' : '' }}>Đã đặt trước
                                                </option>
                                                <option value="In Use"
                                                    {{ request('status') == 'In Use' ? 'selected' : '' }}>Đang sử dụng
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Khu Vực</th>
                                            <th>Số Bàn</th>
                                            <th>Loại Bàn</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tables as $table)
                                            <tr>
                                                <td>{{ $table->area }}</td>
                                                <td>{{ $table->table_number }}</td>
                                                <td>{{ $table->table_type }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $table->status == 'Available' ? 'shade-green' : ($table->status == 'Reserved' ? 'shade-yellow' : 'shade-red') }} min-70">
                                                        {{ $table->status == 'Available' ? 'Có sẵn' : ($table->status == 'Reserved' ? 'Đã đặt trước' : 'Đang sử dụng') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.table.edit', $table->id) }}"
                                                            class="viewRow">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <form action="{{ route('admin.table.destroy', $table->id) }}"
                                                            method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#" style="margin-top: 15px">
                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <i class="bi bi-trash text-red"></i>
                                                                </button></a>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Không có bàn nào được tìm thấy.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{ $tables->links() }}
                            </div>
                            <!-- End Pagination -->

                        </div>

                    </div>

                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Content wrapper end -->

    </div>
    <!-- Content wrapper scroll end -->

@endsection
<style>
    /* Căn chỉnh các trường input, select và button */
    form .form-control-sm,
    form .form-select-sm {
        height: 38px;
        /* Chiều cao đồng đều cho input và select */
    }

    form .btn-sm {
        height: 38px;
        /* Đảm bảo button có chiều cao tương đương */
        padding: 8px 16px;
        /* Điều chỉnh padding cho button */
    }

    .filter-btn i {
        font-size: 24px;
        margin-left: 10px;
    }

    /* Khoảng cách giữa các hàng trong bảng và các ô */
    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
        /* Căn giữa nội dung trong ô */
    }

    .table th {
        font-weight: bold;
        color: #343a40;
        background-color: #f8f9fa;
        /* Đặt nền tiêu đề bảng */
    }

    .table td .actions i {
        font-size: 18px;
        margin-right: 8px;
        /* Khoảng cách giữa các icon */
    }
</style>
@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        // Function to display alerts based on session messages
        function showAlert(title, icon) {
            Swal.fire({
                position: "top",
                title: title,
                icon: icon,
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 1500
            });
        }

        @if (session('success'))
            showAlert("{{ session('success') }}", "success");
        @endif

        @if (session('error'))
            showAlert("{{ session('error') }}", "error");
        @endif

        // Toggle filter form
        document.getElementById('filter-toggle').addEventListener('click', function() {
            var filterForm = document.getElementById('filter-form');
            if (filterForm.style.display === "none" || filterForm.style.display === "") {
                filterForm.style.display = "block";
            } else {
                filterForm.style.display = "none";
            }
        });
    </script>
@endsection
