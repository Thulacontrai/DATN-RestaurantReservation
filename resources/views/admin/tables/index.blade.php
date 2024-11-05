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
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh Mục Bàn</div>

                            <div class="btn btn-outline-secondary p-0 d-flex align-items-center justify-content-center rounded-circle"
                                style="width: 35px; height: 35px; cursor: pointer;" id="filter-toggle"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Lọc">
                                <i class="bi bi-funnel-fill"></i>
                            </div>

                            <a href="{{ route('admin.table.create') }}"
                                class="btn btn-sm btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>

                        <div class="card-body">
                            <!-- Form tìm kiếm, ban đầu bị ẩn -->
                            <div id="filter-form" class="filter-form">
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
                                <table class="table v-middle table-hover m-0">
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
                                                        class="badge {{ $table->status == 'Available' ? 'bg-success' : ($table->status == 'Reserved' ? 'bg-warning' : 'bg-danger') }} min-70">
                                                        {{ $table->status == 'Available' ? 'Có sẵn' : ($table->status == 'Reserved' ? 'Đã đặt trước' : 'Đang sử dụng') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="actions" style="justify-content: center;">
                                                        <a href="{{ route('admin.table.edit', $table->id) }}"
                                                            class="text-warning" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Sửa">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="" style=" padding-bottom: 10px;">
                                                            <form action="{{ route('admin.table.destroy', $table->id) }} "
                                                                method="POST" style="display:inline-block;"
                                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-link p-0 text-danger"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Xóa">
                                                                    <svg class="delete-svgIcon" viewBox="0 0 448 512">
                                                                        <path
                                                                            d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z">
                                                                        </path>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </a>


                                                        <a href="{{ route('admin.tables.trash') }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Lưu trữ">
                                                            <svg class="delete-svgIcon1" viewBox="0 0 448 512">
                                                                <path
                                                                    d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z">
                                                                </path>
                                                            </svg></a>

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

        // Toggle filter form with fade-in effect
        document.getElementById('filter-toggle').addEventListener('click', function() {
            var filterForm = document.getElementById('filter-form');
            filterForm.classList.toggle('show');
        });

        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>

    <style>
        /* Smooth fade-in and fade-out for filter form */
        #filter-form {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        #filter-form.show {
            opacity: 1;
            visibility: visible;
        }
    </style>
@endsection
