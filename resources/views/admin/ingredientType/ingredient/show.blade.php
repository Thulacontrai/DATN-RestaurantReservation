@extends('admin.master')

@section('title', 'Chi Tiết Nguyên Liệu')

@section('content')
    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <style>
        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .swal2-timer-progress-bar {
            background: linear-gradient(90deg, #34eb4f, #00bcd4, #ffa726, #ffeb3b, #f44336);
            /* Gradient màu */
            background-size: 300% 300%;
            /* Kích thước gradient lớn để tạo hiệu ứng động */
            animation: gradientMove 2s ease infinite;
            /* Hiệu ứng lăn tăn */
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hiển thị thông báo lỗi
            @if ($errors->any())
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    toast: true,
                    title: "{{ $errors->first() }}",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                });
            @endif

            // Hiển thị thông báo thành công
            @if (session('success'))
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    toast: true,
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                });
            @endif
        });
    </script>
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card shadow-lg">
                        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                            <h4 class="card-title mb-3 text-white">Chi Tiết Nguyên Liệu</h4>
                            <a href="{{ route('admin.ingredient.index') }}" class="btn btn-sm btn-light mb-3">Quay Lại</a>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="text-primary">Thông Tin Nguyên Liệu</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Tên Nguyên Liệu:</strong>
                                            {{ $ingredient->name }}</li>
                                        {{-- <li class="list-group-item"><strong>Nhà Cung Cấp:</strong> {{ $ingredient->supplier_id }}</li>
                                        <li class="list-group-item"><strong>Loại Nguyên Liệu:</strong> {{ $ingredient->ingredient_type_id }}</li> --}}
                                    </ul>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="text-primary">Chi Tiết Giá Cả</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Giá:</strong>
                                            {{ number_format($ingredient->price, 0, ',', '.') }} VND</li>
                                        <li class="list-group-item"><strong>Đơn Vị:</strong> {{ $ingredient->unit }}</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="text-primary">Thông Tin Thời Gian</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Ngày Tạo:</strong> {{ $ingredient->created_at }}
                                        </li>
                                        <li class="list-group-item"><strong>Ngày Cập Nhật:</strong>
                                            {{ $ingredient->updated_at }}</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-footer bg-white">
                                <a href="{{ route('admin.ingredient.edit', $ingredient->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square me-2"></i> Chỉnh Sửa
                                </a>
                                <a href="{{ route('admin.ingredient.index', $ingredient->id) }}"
                                    class="btn btn-sm btn-light">
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

@endsection
