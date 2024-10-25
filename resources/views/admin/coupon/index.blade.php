@extends('admin.master')

@section('title', 'Danh Sách Coupons')

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
                            <div class="card-title">Danh Sách Coupons</div>


                            <a href="{{ route('admin.coupon.create') }}"
                                class="btn btn-sm btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
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
                                                            class="viewRow" data-id="{{ $coupon->id }}">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                                                            class="editRow" data-id="{{ $coupon->id }}">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <a href="#">
                                                            <form action="{{ route('admin.coupon.destroy', $coupon->id) }}"
                                                                method="POST" style="display:inline-block;padding-bottom: 7px;"
                                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <svg class="delete-svgIcon" viewBox="0 0 448 512">
                                                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                                                                      </svg>
                                                                </button>
                                                            </form>
                                                        </a>
                                                        <a href="{{ route('admin.coupon.trash') }}">
                                                            <svg class="delete-svgIcon1" viewBox="0 0 448 512">
                                                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                                                              </svg>
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
                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{-- {{ $coupon->links() }} --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        @endsection
