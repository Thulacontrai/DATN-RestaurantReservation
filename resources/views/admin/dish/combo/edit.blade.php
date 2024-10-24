@extends('admin.master')

@section('title', 'Chỉnh Sửa Combo')

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
                            <div class="card-title">Chỉnh Sửa Combo</div>

                            <a href="{{ route('admin.combo.index') }}" class="btn btn-sm btn-dark">Quay lại</a>
                        </div>
                        <div class="card-body">
                            <form id="comboForm" action="{{ route('admin.combo.update', $combo->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Tên Combo</label>
                                            <input type="text" name="name" class="form-control" value="{{ $combo->name }}" placeholder="Tên Combo" required>
                                            <div class="invalid-feedback">Vui lòng nhập tên combo.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Giá Combo</label>
                                            <input type="number" name="price" class="form-control" value="{{ $combo->price }}" placeholder="Giá Combo" required>
                                            <div class="invalid-feedback">Vui lòng nhập giá combo.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="mb-3">
                                            <label for="editor" class="form-label">Mô tả món ăn</label>
                                            <textarea name="description" id="editor" class="form-control">{{ $combo->description }}</textarea>
                                            <div class="invalid-feedback">Vui lòng nhập mô tả món ăn.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Ảnh Combo</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                            <img src="{{ asset('storage/' . $combo->image) }}" alt="{{ $combo->name }}" width="100" class="mt-2">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Số Lượng Món Ăn</label>
                                            <input type="number" name="quantity_dishes" class="form-control" value="{{ $combo->quantity_dishes }}" placeholder="Số lượng món ăn trong combo" required>
                                            <div class="invalid-feedback">Vui lòng nhập số lượng món ăn.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Cập Nhật Combo</button>
                                    <button type="reset" class="btn btn-secondary ms-2">Hủy</button>
                                </div>
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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        // Initialize CKEditor for the description field
        CKEDITOR.replace('editor');

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('comboForm');
            const inputs = form.querySelectorAll('input, textarea');

            // Kiểm tra tính hợp lệ cho mỗi input khi có sự kiện 'input'
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

            // Xử lý xác thực cho CKEditor
            CKEDITOR.instances.editor.on('change', function() {
                const descriptionField = CKEDITOR.instances.editor.getData().trim();
                const editorElement = document.getElementById('editor');

                if (descriptionField === '') {
                    editorElement.classList.add('is-invalid');
                    editorElement.classList.remove('is-valid');
                } else {
                    editorElement.classList.remove('is-invalid');
                    editorElement.classList.add('is-valid');
                }
            });

            // Kiểm tra toàn bộ form khi submit
            form.addEventListener('submit', function(event) {
                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        input.classList.add('is-invalid');
                    }
                });

                // Xác thực nội dung CKEditor
                const descriptionField = CKEDITOR.instances.editor.getData().trim();
                if (descriptionField === '') {
                    document.getElementById('editor').classList.add('is-invalid');
                    event.preventDefault(); // Ngăn chặn gửi form nếu mô tả trống
                }

                if (!form.checkValidity()) {
                    event.preventDefault(); // Ngăn chặn gửi form nếu có trường không hợp lệ
                    event.stopPropagation();
                }
            });
        });
    </script>
@endsection
