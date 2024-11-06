@extends('admin.master')

@section('title', 'Chi Tiết Công Thức Món Ăn')

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
                            <h5 class="card-title mb-3 text-white">Chi Tiết Công Thức Món Ăn</h5>
                        </div>
                        <div class="card-body bg-light p-4">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Mã Công Thức:</h6>
                                        <p class="h5">{{ $recipe->id }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Tên Món Ăn:</h6>
                                        <p class="h5">{{ $recipe->dish->name }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Danh Sách Nguyên Liệu và Định Lượng -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Nguyên Liệu và Định Lượng:</h6>
                                        <ul class="list-group list-group-flush">
                                            @foreach ($recipe->ingredients as $ingredient)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $ingredient->name }}
                                                    <span class="badge bg-primary">
                                                        {{ $ingredient->pivot->quantity_need }} | {{ $ingredient->unit }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Hướng Dẫn Chế Biến -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Hướng Dẫn Chế Biến:</h6>
                                        <p class="h5">{{ $recipe->instructions ?? 'Không có hướng dẫn' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Ngày Tạo và Ngày Cập Nhật -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Ngày Tạo:</h6>
                                        <p class="h5">{{ $recipe->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-box p-4 shadow-sm rounded bg-white">
                                        <h6 class="text-primary">Ngày Cập Nhật:</h6>
                                        <p class="h5">{{ $recipe->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square me-2"></i> Chỉnh Sửa
                            </a>
                            <a href="{{ route('admin.recipes.index') }}" class="btn btn-sm btn-light">
                                <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

@endsection
