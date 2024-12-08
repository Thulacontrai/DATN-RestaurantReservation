@extends('admin.master')

@section('content')
    @include('admin.layouts.messages')
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

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center bg-white p-4">
                                <!-- Phần hiển thị phân trang bên trái -->
                                <div class="mb-4 flex sm:mb-0 text-center">
                                    <span style="font-size: 15px">
                                        <i class="bi bi-chevron-compact-left"></i>

                                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            Hiển thị <strong
                                                class="font-semibold text-secondary ">{{ $users->firstItem() }}-{{ $users->lastItem() }}</strong>
                                            trong tổng số <strong
                                                class="font-semibold text-secondary ">{{ $users->total() }}</strong>
                                        </span> <i class="bi bi-chevron-compact-right"></i>
                                    </span>
                                </div>



                             <!-- Phần hiển thị phân trang bên phải -->
                                <div class="flex items-center space-x-3">
                                    <!-- Nút Previous -->
                                    @if ($users->onFirstPage())
                                        <button class="inline-flex  p-1 pl-2 bg-success text-white  cursor-not-allowed"
                                            style="border-radius: 5px; border: 2px solid rgb(136, 243, 136);">
                                            <span style="font-size: 15px"><i
                                                    class="bi bi-chevron-compact-left"></i>Trước</span>
                                        </button>
                                    @else
                                        <a href="{{ $users->previousPageUrl() }}">
                                            <button class="inline-flex  p-1 pl-2  bg-success text-white "
                                                style="border-radius: 5px;    border: 2px solid rgb(136, 243, 136);">
                                                <span style="font-size: 15px"><i class="bi bi-chevron-double-left"></i>
                                                    Trước</span>
                                            </button>
                                        </a>
                                    @endif

                                    <!-- Nút Next -->
                                    @if ($users->hasMorePages())
                                        <a href="{{ $users->nextPageUrl() }}">
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
                                </div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
