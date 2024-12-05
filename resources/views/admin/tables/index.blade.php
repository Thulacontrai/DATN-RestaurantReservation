@extends('admin.master')

@section('title', 'Danh Mục Bàn')

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
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title ">Danh Mục Bàn</div>

                            <!-- Thêm nút Thêm Mới -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.table.create') }}"
                                    class="btn btn-sm btn-primary d-flex align-items-center">
                                    <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                                </a>

                                <!-- Thêm nút Khôi Phục -->
                                <a href="{{ route('admin.tables.trash') }}"
                                    class="btn btn-sm btn-secondary d-flex align-items-center">
                                    <i class="bi bi-trash3 me-2"></i> Khôi Phục
                                </a>
                            </div>
                        </div>


                        <div class="card-body">
                            <!-- Form tìm kiếm -->
                            <div class="filter-form">
                                <form method="GET" action="{{ route('admin.table.index') }}" class="mb-3">
                                    <div class="row g-2">
                                        <div class="col-auto">
                                            <input type="text" id="search-name" name="name"
                                                class="form-control form-control-sm" placeholder="Tìm kiếm bàn"
                                                value="{{ request('name') }}">
                                        </div>
                                        {{-- <div class="col-auto">
                                            <select name="table_type" id="search-table-type"
                                                class="form-select form-select-sm">
                                                <option value="">-- Loại bàn --</option>
                                                <option value="Thường"
                                                    {{ request('table_type') == 'Thường' ? 'selected' : '' }}>Thường
                                                </option>
                                                <option value="VIP"
                                                    {{ request('table_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                                            </select>
                                        </div> --}}
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
                                            <a href="{{ route('admin.table.index') }}" class="btn btn-sm btn-success">
                                                <i class="bi bi-arrow-repeat"></i>
                                            </a>
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
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tables as $table)
                                            <tr>
                                                <td>{{ $table->area }}</td>
                                                <td>{{ $table->table_number }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $table->status == 'Available' ? 'bg-success' : ($table->status == 'Reserved' ? 'bg-warning' : 'bg-danger') }} min-70">
                                                        {{ $table->status == 'Available' ? 'Có sẵn' : ($table->status == 'Reserved' ? 'Đã đặt trước' : 'Đang sử dụng') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.table.edit', $table->id) }}"
                                                            class="text-warning" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Sửa">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="" style=" padding-bottom: 5px;padding-left: 3px;">
                                                            <form action="{{ route('admin.table.destroy', $table->id) }} "
                                                                method="POST" style="display:inline-block;"
                                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <i class="bi bi-trash text-red"></i>
                                                                </button>
                                                            </form>
                                                        </a>
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
    </script>
@endsection
