@extends('admin.master')

@section('title', $type == 'employee' ? 'Danh Sách Nhân Viên' : 'Danh Sách Người Dùng')

@section('content')
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.user.index') }}"
                                        class="btn btn-{{ $type == 'user' ? 'primary' : 'secondary' }}">
                                        Người Dùng
                                    </a>
                                    <a href="{{ route('admin.user.employees') }}"
                                        class="btn btn-{{ $type == 'employee' ? 'primary' : 'secondary' }}">
                                        Nhân Viên
                                    </a>
                                </div>
                            </div>

                            <div>
                                <a href="{{ route('admin.user.create') }}"
                                    class="btn btn-sm btn-primary d-flex align-items-center">
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
                                            <i class=""></i> Tìm kiếm
                                        </button>
                                    </div>
                                    @if (!empty($search))
                                        <div class="col-auto">
                                            <a href="{{ $type == 'employee' ? route('admin.user.employees') : route('admin.user.index') }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="bi bi-x-circle me-1"></i> Xóa bộ lọc
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
                                            <th>Trạng Thái</th>
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
                                                    <td>
                                                        @if ($user->status == 'active')
                                                            <span class="badge shade-green">Hoạt Động</span>
                                                        @else
                                                            <span class="badge shade-red">Ngừng Hoạt Động</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.user.edit', $user->id) }}">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
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
