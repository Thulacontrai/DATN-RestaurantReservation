@extends('admin.master')

@section('title', 'Danh Sách Quyền Hạn')

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
                            <div class="card-title">Danh Sách Quyền Hạn</div>
                            <form action="{{ route('admin.permissions.index') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control form-control-sm"
                                    placeholder="Tìm kiếm quyền hạn..." value="{{ request()->get('search') }}">
                                <button type="submit" class="btn btn-sm btn-secondary ms-2">
                                    <i class=" mb-2"></i> Tìm kiếm
                                </button>
                            </form>
                            <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>

                        <div class="card-body">
                            <table class="table v-middle m-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Quyền Hạn</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>{{ $permission->id }}</td>
                                                <td>{{ $permission->name }}</td>
                                                <td>

                                                    {{ \Carbon\Carbon::parse($permission->change_date . ' ' . $permission->change_time)->format('H:i:s') }}<br>
                                                    {{ \Carbon\Carbon::parse($permission->change_date)->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.permissions.edit', $permission->id) }}">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <a href="#">
                                                            <form
                                                                action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                                                method="POST"
                                                                style="display: inline-block; padding-bottom: 3px">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="border-0 bg-transparent"
                                                                    onclick="deletePermission({{ $permission->id }})">
                                                                    <i class="bi bi-trash text-danger"
                                                                        style="font-size: 1.2rem;"></i>
                                                                </button>
                                                            </form>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif



                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $permissions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            function deletePermission(id) {
                event.preventDefault(); // Ngăn chặn hành động gửi form
                if (confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        url: '{{ route('admin.permissions.destroy', ':id') }}'.replace(':id', id), // Cập nhật ở đây
                        type: 'DELETE',
                        dataType: 'json',
                        headers: {
                            'x-csrf-token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status) {
                                window.location.href =
                                "{{ route('admin.permissions.index') }}"; // Cập nhật đường dẫn cho đúng
                            } else {
                                alert("Error deleting permission: " + response.message);
                            }
                        },
                        error: function(xhr) {
                            alert("Error occurred: " + xhr.statusText);
                        }
                    });
                }
            }
        </script>

    </x-slot>
@endsection
