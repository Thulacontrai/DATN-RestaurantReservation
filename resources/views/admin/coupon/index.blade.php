@extends('admin.master')

@section('title', 'Danh Sách Phiếu Giảm Giá')

@section('content')
    @include('admin.layouts.messages')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh sách phiếu giảm giá</div>

                            <!-- Nút Thêm Mới và Khôi Phục -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.coupon.create') }}"
                                    class="btn btn-sm btn-primary d-flex align-items-center">
                                    <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                                </a>
                                <a href="{{ route('admin.coupon.trash') }}"
                                    class="btn btn-sm btn-secondary d-flex align-items-center">
                                    <i class="bi bi-trash3 me-2"></i> Khôi Phục
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <!-- Tìm kiếm coupons -->
                            <form method="GET" action="{{ route('admin.coupon.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-code" name="code"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo mã coupon"
                                            value="{{ request('code') }}">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Bảng danh sách coupons -->
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Mã Coupon</th>
                                            <th>Mô Tả</th>
                                            <th>Số Lần Sử Dụng</th>
                                            <th>Loại Giảm Giá</th>
                                            <th>Số Tiền Giảm</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($coupons as $coupon)
                                            <tr>
                                                <td>{{ $coupon->id }}</td>
                                                <td>{{ $coupon->code }}</td>
                                                <td>{{ $coupon->description }}</td>
                                                <td>{{ $coupon->max_uses }}</td>
                                                <td>{{ $coupon->discount_type }}</td>
                                                <td>{{ number_format($coupon->discount_amount, 0, ',', '.') }} VND</td>
                                                <td>
                                                    @if ($coupon->status == 'active')
                                                        <span class="badge shade-green">Hoạt Động</span>
                                                    @elseif ($coupon->status == 'inactive')
                                                        <span class="badge shade-yellow">Ngừng Hoạt Động</span>
                                                    @else
                                                        <span class="badge shade-red">Hết Hạn</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.coupon.show', $coupon->id) }}"
                                                            class="viewRow" data-id="{{ $coupon->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Chi tiết">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                                                            class="editRow" data-id="{{ $coupon->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Xoá">
                                                            <form action="{{ route('admin.coupon.destroy', $coupon->id) }}"
                                                                method="POST" style="display:inline-block;"
                                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <i class="bi bi-trash text-danger"
                                                                        style="font-size: 1.2rem;"></i>
                                                                </button>

                                                            </form>
                                                        </a>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">Không có coupons nào được tìm thấy.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center bg-white p-4">
                            <!-- Phần hiển thị phân trang bên trái -->
                            <div class="mb-4 flex sm:mb-0 text-center">
                                <span style="font-size: 15px">
                                    <i class="bi bi-chevron-compact-left"></i>

                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        Hiển thị <strong
                                            class="font-semibold text-secondary ">{{ $coupons->firstItem() }}-{{ $coupons->lastItem() }}</strong>
                                        trong tổng số <strong
                                            class="font-semibold text-secondary ">{{ $coupons->total() }}</strong>
                                    </span> <i class="bi bi-chevron-compact-right"></i>
                                </span>
                            </div>

                            <!-- Phần hiển thị phân trang bên phải -->
                            <div class="flex items-center space-x-3">
                                <!-- Nút Previous -->
                                @if ($coupons->onFirstPage())
                                    <button class="inline-flex  p-1 pl-2 bg-success text-white  cursor-not-allowed"
                                        style="border-radius: 5px; border: 2px solid rgb(136, 243, 136);">
                                        <span style="font-size: 15px"><i class="bi bi-chevron-compact-left"></i>Trước</span>
                                    </button>
                                @else
                                    <a href="{{ $coupons->previousPageUrl() }}">
                                        <button class="inline-flex  p-1 pl-2  bg-success text-white "
                                            style="border-radius: 5px;    border: 2px solid rgb(136, 243, 136);">
                                            <span style="font-size: 15px"><i class="bi bi-chevron-double-left"></i>
                                                Trước</span>
                                        </button>
                                    </a>
                                @endif

                                <!-- Nút Next -->
                                @if ($coupons->hasMorePages())
                                    <a href="{{ $coupons->nextPageUrl() }}">
                                        <button class="inline-flex  p-1 pl-2 bg-success text-white"
                                            style="border-radius: 5px;    border: 2px solid rgb(136, 243, 136);">
                                            <span style="font-size: 15px"> Sau <i
                                                    class="bi bi-chevron-compact-right"></i></span>
                                        </button>
                                    </a>
                                @else
                                    <button class="inline-flex  p-1 pl-2 bg-success text-white cursor-not-allowed"
                                        style="border-radius: 5px;    border: 2px solid rgb(136, 243, 136);">
                                        <span style="font-size: 15px">Trang
                                            Sau<i class="bi bi-chevron-double-right"></i></span>
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->



        @endsection
