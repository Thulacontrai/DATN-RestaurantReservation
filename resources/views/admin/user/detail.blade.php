@extends('admin.master')

@section('title', 'Chi Tiết Người Dùng')

@section('content')
@include('admin.layouts.messages')

<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Card wrapper -->
        <div class="row justify-content-center">
            <div class="col-md-10 col-12">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-3 text-white">Chi Tiết Người Dùng</h5>
                    </div>
                    <div class="card-body bg-light p-4">
                        <!-- Thông tin người dùng -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="detail-box p-4 shadow-sm rounded bg-white">
                                    <h6 class="text-primary">Mã Người Dùng:</h6>
                                    <p class="h5">{{ $user->id }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-box p-4 shadow-sm rounded bg-white">
                                    <h6 class="text-primary">Tên Người Dùng:</h6>
                                    <p class="h5">{{ $user->name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="detail-box p-4 shadow-sm rounded bg-white">
                                    <h6 class="text-primary">Email:</h6>
                                    <p class="h5">{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-box p-4 shadow-sm rounded bg-white">
                                    <h6 class="text-primary">Số Điện Thoại:</h6>
                                    <p class="h5">{{ $user->phone }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="detail-box p-4 shadow-sm rounded bg-white">
                                    <h6 class="text-primary">Địa Chỉ:</h6>
                                    <p class="h5">{{ $user->address }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-box p-4 shadow-sm rounded bg-white">
                                    <h6 class="text-primary">Vai Trò:</h6>
                                    <p class="h5">{{ optional($user->role)->role_name ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="detail-box p-4 shadow-sm rounded bg-white">
                                    <h6 class="text-primary">Trạng Thái:</h6>
                                    <span class="badge {{ $user->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $user->status == 'active' ? 'Hoạt Động' : 'Không Hoạt Động' }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-box p-4 shadow-sm rounded bg-white">
                                    <h6 class="text-primary">Ngày Sinh:</h6>
                                    <p class="h5">{{ $user->date_of_birth }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="detail-box p-4 shadow-sm rounded bg-white">
                                    <h6 class="text-primary">Ngày Tuyển Dụng:</h6>
                                    <p class="h5">{{ $user->hire_date }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-box p-4 shadow-sm rounded bg-white">
                                    <h6 class="text-primary">Chức Vụ:</h6>
                                    <p class="h5">{{ $user->position }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Hình ảnh người dùng -->
                        <div class="row mb-4">
                            <div class="col-md-12 text-center">
                                <div class="detail-box p-4 shadow-sm rounded bg-white">
                                    <h6 class="text-primary">Hình Ảnh:</h6>
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="User Avatar" class="img-fluid shadow-lg rounded" width="250">
                                    @else
                                        <img src="https://via.placeholder.com/150" alt="No Avatar" class="img-fluid shadow-lg rounded" width="150">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square me-2"></i> Chỉnh Sửa
                            </a>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-light">
                                <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content wrapper end -->

</div>
<!-- Content wrapper scroll end -->

@endsection
