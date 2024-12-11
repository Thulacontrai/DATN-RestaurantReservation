@extends('admin.master')

@section('title', 'Danh Sách Quyền Hạn')

@section('content')
    @include('admin.layouts.messages')
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


                        </div>
                     <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center bg-white p-4">
                                <!-- Phần hiển thị phân trang bên trái -->
                                <div class="mb-4 flex sm:mb-0 text-center">
                                    <span style="font-size: 15px">
                                        <i class="bi bi-chevron-compact-left"></i>

                                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            Hiển thị <strong
                                                class="font-semibold text-secondary ">{{ $permissions->firstItem() }}-{{ $permissions->lastItem() }}</strong>
                                            trong tổng số <strong
                                                class="font-semibold text-secondary ">{{ $permissions->total() }}</strong>
                                        </span> <i class="bi bi-chevron-compact-right"></i>
                                    </span>
                                </div>

                                <!-- Phần hiển thị phân trang bên phải -->
                                <div class="flex items-center space-x-3">
                                    <!-- Nút Previous -->
                                    @if ($permissions->onFirstPage())
                                        <button class="inline-flex  p-1 pl-2 bg-success text-white  cursor-not-allowed"
                                            style="border-radius: 5px; border: 2px solid rgb(136, 243, 136);">
                                            <span style="font-size: 15px"><i
                                                    class="bi bi-chevron-compact-left"></i>Trước</span>
                                        </button>
                                    @else
                                        <a href="{{ $permissions->previousPageUrl() }}">
                                            <button class="inline-flex  p-1 pl-2  bg-success text-white "
                                                style="border-radius: 5px;    border: 2px solid rgb(136, 243, 136);">
                                                <span style="font-size: 15px"><i class="bi bi-chevron-double-left"></i>
                                                    Trước</span>
                                            </button>
                                        </a>
                                    @endif

                                    <!-- Nút Next -->
                                    @if ($permissions->hasMorePages())
                                        <a href="{{ $permissions->nextPageUrl() }}">
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

                            </div></div>
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
