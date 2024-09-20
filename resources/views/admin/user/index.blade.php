@extends('admin.master')

@section('title', 'Danh Sách Người Dùng')

@section('content')
@if (session('error'))

    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
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
                            <div class="heart-btn d-flex align-items-center" id="heartButton">
                                <a href="{{ route('admin.user.trash') }}">
                                    <i class="bi bi-trash2-fill"></i></a>
                            </div>
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
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Vai Trò</th>
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
                                                <td>{{$user->email}}</td>
                                                <td>{{ $user->phone ?? 'Chưa có số điện thoại' }}</td>

                                                <td>{{ $user->roles ? $user->roles->pluck('name')->implode(' , ') : 'Không có vai trò' }}</td>

                                                <td>
                                                    @if ($user->status == 'active')
                                                        <span class="badge shade-green">Hoạt Động</span>
                                                    @else
                                                        <span class="badge shade-red">Ngừng Hoạt Động</span>
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $user->created_at }}</td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.user.edit', $user->id) }}">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        {{-- <a href="#">
                                                            <form
                                                                action="{{ route('admin.role.destroy', $role->id) }}"
                                                                method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="border-0 bg-transparent"
                                                                    onclick="deleteRole({{$role->id}})">
                                                                    <i class="bi bi-trash text-red"></i>
                                                                </button>
                                                            </form>
                                                        </a> --}}
                                                    </div>
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
            <!-- Row end -->

        @endsection
