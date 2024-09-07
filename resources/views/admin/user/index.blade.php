@extends('admin.master')

@section('title', 'Danh Sách Người Dùng')

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
                            <div class="card-title">Danh Sách Người Dùng</div>

                            <a href="{{ route('admin.user.create') }}"
                                class="btn btn-sm btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>
                        <div class="card-body">

                            <!-- Tìm kiếm người dùng -->
                            <form method="GET" action="{{ route('admin.user.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-email" name="email"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo email"
                                            value="{{ request('email') }}">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Bảng danh sách người dùng -->
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Hình Ảnh</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Địa Chỉ</th>
                                            <th>Vai Trò</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td><img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://via.placeholder.com/50' }}"
                                                        alt="User Image" class="img-fluid rounded-circle" width="50">
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->role->name ?? 'N/A' }}</td>

                                                <td>
                                                    @if ($user->status == 'active')
                                                        <span class="badge shade-green">Hoạt Động</span>
                                                    @else
                                                        <span class="badge shade-red">Ngừng Hoạt Động</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.user.show', $user->id) }}" class="viewRow"
                                                            data-id="{{ $user->id }}">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="editRow"
                                                            data-id="{{ $user->id }}">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <form action="{{ route('admin.user.destroy', $user->id) }}"
                                                            method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link p-0">
                                                                <i class="bi bi-trash text-red"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9">Không có người dùng nào được tìm thấy.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{-- <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{ $users->links() }}
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        @endsection
