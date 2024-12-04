@extends('admin.master')

@section('title', 'Thêm Mới Danh Mục Thực Đơn')

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
                            <div class="card-title">Thêm Mới Danh Mục Thực Đơn</div>
                        </div>
                        <div class="card-body">

                            <form id="addCategoryForm" method="POST" action="{{ route('admin.category.store') }}" novalidate>
                                @csrf

                                <!-- Tên Danh Mục -->
                                <div class="mb-3">
                                    <label for="category-name" class="form-label text-primary">
                                        Tên Danh Mục <span class="text-danger required">*</span>
                                    </label>

                                    <input type="text" id="category-name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Nhập tên danh mục" required value="{{ old('name') }}">

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Vui lòng nhập tên danh mục.</div>
                                        @endif
                                    </div>

                                    <!-- Mô Tả -->
                                    <div class="mb-3">
                                        <label for="category-description" class="form-label">Mô Tả</label>
                                        <textarea id="category-description" name="description" class="form-control" placeholder="Nhập mô tả danh mục"
                                            rows="4">{{ old('description') }}</textarea>
                                        <div class="invalid-feedback">Vui lòng nhập mô tả danh mục.</div>
                                    </div>

                                    <!-- Nút Thêm Mới -->
                                    <button type="submit" class="btn btn-sm btn-primary">Thêm Mới</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row end -->

            </div>
            <!-- Content wrapper end -->

        </div>
        <!-- Content wrapper scroll end -->

    @endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('addCategoryForm');
            const inputs = form.querySelectorAll('input, textarea');

            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (input.checkValidity()) {
                        input.classList.remove('is-invalid');
                        input.classList.add('is-valid');
                    } else {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                    }
                });
            });

            form.addEventListener('submit', function(event) {
                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        input.classList.add('is-invalid');
                    }
                });

                if (!form.checkValidity()) {
                    event.preventDefault(); // Ngăn biểu mẫu gửi nếu không hợp lệ
                    event.stopPropagation();
                }
            });
        });
    </script>
@endsection
