@extends('admin.master')

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
                            <div class="card-title">

                            </div>
                            <div>
                                <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-primary d-flex align-i">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    {{ $type == 'employee' ? 'Thêm Nhân Viên' : 'Thêm Người Dùng' }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Tìm kiếm người dùng -->
                            <form method="GET"
                                action="{{ $type == 'employee' ? route('admin.user.employees') : route('admin.user.index') }}"
                                class="mb-3">
                                <div class="row g-2 align-items-center">
                                    <div class="col-auto">
                                        <input type="text" name="search" class="form-control form-control-sm"
                                            placeholder="Tìm kiếm">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Tìm kiếm
                                        </button>
                                    </div>
                                    @if (!empty($request->search))
                                        <div class="col-auto">
                                            <a href="{{ $type == 'employee' ? route('admin.user.employees') : route('admin.user.index') }}"
                                                class="btn btn-sm btn-secondary">
                                                Xóa bộ lọc
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </form>

                            <!-- Bảng danh sách -->
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Số Điện Thoại</th>
                                            @if ($type == 'employee')
                                                <th>Vai Trò</th>
                                            @endif
                                            <th>Ngày tạo</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($users->isNotEmpty())
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone ?? 'Chưa có số điện thoại' }}</td>
                                                    @if ($type == 'employee')
                                                        <td>
                                                            {{ $user->roles ? $user->roles->pluck('name')->implode(', ') : 'Không có vai trò' }}
                                                        </td>
                                                    @endif
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>
                                                        <div class="action text-center">
                                                            <a href="{{ route('admin.user.edit', $user->id) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Sửa">
                                                                <i class="bi bi-pencil-square text-warning"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="{{ $type == 'employee' ? 6 : 5 }}" class="text-center">
                                                    Không có dữ liệu.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="pagination justify-content-center mt-3">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
