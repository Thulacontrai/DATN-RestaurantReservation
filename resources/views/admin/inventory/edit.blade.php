@extends('admin.master')

@section('title', 'Chỉnh Sửa Kho Hàng')

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
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-primary">Chỉnh Sửa Kho Hàng</h3>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.inventory.update', $inventory->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Nguyên Liệu và Số Lượng chia đều -->
                                <div class="mb-3 row">
                                    <div class="col-sm-6">
                                        <label for="ingredient_id" class="form-label">Nguyên Liệu</label>
                                        <select class="form-control @error('ingredient_id') is-invalid @enderror"
                                            id="ingredient_id" name="ingredient_id">
                                            <option value="">Chọn nguyên liệu</option>
                                            @foreach ($ingredients as $ingredient)
                                                <option value="{{ $ingredient->id }}"
                                                    {{ old('ingredient_id', $inventory->ingredient_id) == $ingredient->id ? 'selected' : '' }}>
                                                    {{ $ingredient->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('ingredient_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="quantity" class="form-label">Số Lượng</label>
                                        <input type="number"
                                            class="form-control @error('quantity_stock') is-invalid @enderror"
                                            id="quantity" name="quantity_stock"
                                            value="{{ old('quantity_stock', $inventory->quantity_stock) }}">
                                        @error('quantity_stock')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                    <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary">Quay Lại</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    input:-webkit-autofill,
    textarea:-webkit-autofill,
    select:-webkit-autofill {
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        background-color: white !important;
        -webkit-text-fill-color: black !important;
    }

    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    textarea:-webkit-autofill:hover,
    textarea:-webkit-autofill:focus,
    select:-webkit-autofill:hover,
    select:-webkit-autofill:focus {
        border: 1px solid #26ba4f;
        -webkit-text-fill-color: black !important;
        box-shadow: none !important;
    }

    input,
    textarea,
    select {
        background-color: white;
        color: black;
    }
</style>
