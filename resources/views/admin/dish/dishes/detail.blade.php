@extends('admin.master')

@section('title', 'Chi Tiết Món Ăn')

@section('content')

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-3 text-white">Chi Tiết Món Ăn</h5>
                        </div>
                        <div class="card-body bg-light p-4">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Mã Món Ăn:</h6>
                                        <p class="h5">{{ $dish->id }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Tên Món Ăn:</h6>
                                        <p class="h5">{{ $dish->name }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Loại Món Ăn:</h6>
                                        <p class="h5">{{ $dish->category->name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Giá:</h6>
                                        <p class="h5">{{ number_format($dish->price, 0, ',', '.') }} VND</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Số Lượng:</h6>
                                        <p class="h5">{{ $dish->quantity }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Trạng Thái:</h6>
                                        <span
                                            class="badge
                                            @if ($dish->status == 'available') bg-success
                                            @elseif($dish->status == 'out_of_stock') bg-danger
                                            @elseif($dish->status == 'reserved') bg-warning
                                            @elseif($dish->status == 'in_use') bg-info
                                            @elseif($dish->status == 'completed') bg-primary
                                            @elseif($dish->status == 'cancelled') bg-secondary @endif">
                                            {{ ucfirst($dish->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12 text-center">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Hình Ảnh:</h6>
                                        @if ($dish->image)
                                            <img src="{{ asset('storage/' . $dish->image) }}" alt="Hình Ảnh"
                                                class="img-fluid shadow-lg rounded" width="250">
                                        @else
                                            <img src="https://via.placeholder.com/150" alt="No Image"
                                                class="img-fluid shadow-lg rounded" width="150">
                                        @endif
                                    </div>
                                </div>
                            </div>

                             <!-- Description Field -->
                             <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Mô tả:</h6>
                                        <p class="h5">{{ $dish->description ?? 'Không có mô tả' }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('admin.dishes.edit', $dish->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square me-2"></i> Chỉnh Sửa
                            </a>
                            <a href="{{ route('admin.dishes.index') }}" class="btn btn-sm btn-light">
                                <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

@endsection
