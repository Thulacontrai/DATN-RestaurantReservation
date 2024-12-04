@extends('admin.master')

@section('title', 'Chỉnh Sửa Combo')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
@endsection

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

    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title text-primary">Chỉnh Sửa Combo</div>
                            <a href="{{ route('admin.combo.index') }}" class="btn btn-sm btn-dark">Quay lại</a>
                        </div>
                        <div class="card-body">
                            <form id="comboForm" action="{{ route('admin.combo.update', $combo->id) }}" method="POST"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Tên Combo </label>
                                            <input type="text" id="combo-name" name="name" class="form-control"
                                                value="{{ $combo->name }}" placeholder="Tên Combo" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Giá Combo </label>
                                            <input type="number" name="price" id="price" class="form-control"
                                                value="{{ $combo->price }}" placeholder="Giá Combo" required min="1"
                                                max="100000000">
                                            <div class="invalid-feedback">Vui lòng nhập giá combo hợp lệ (từ 1 đến
                                                10.000.000VND).</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-12">
                                        <label for="dishes">Chọn Món Ăn:</label>
                                        <select name="dishes[]" id="dishes" multiple="multiple" style="width: 100%">
                                            @foreach ($dishes as $dish)
                                                <option value="{{ $dish->id }}"
                                                    {{ in_array($dish->id, $combo->dishes->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $dish->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-12">
                                        <div class="mb-3">
                                            <label for="editor" class="form-label">Mô tả món ăn</label>
                                            <textarea name="description" id="editor" class="form-control">{{ $combo->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Ảnh Combo</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                            <img src="{{ asset('storage/' . $combo->image) }}" alt="{{ $combo->name }}"
                                                width="100" class="mt-2">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Số Lượng Món Ăn</label>
                                            <input type="number" name="quantity_dishes" class="form-control text-primary"
                                                value="{{ $combo->quantity_dishes }}"
                                                placeholder="Số lượng món ăn trong combo" required readonly>
                                            <div class="invalid-feedback">Vui lòng nhập số lượng món ăn.</div>
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
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function() {
            $('#dishes').select2({
                placeholder: 'Chọn món ăn',
                tags: false
            });

            $('#dishes').on('change', function() {
                const selectedDishesCount = $(this).val() ? $(this).val().length : 0;
                $('input[name="quantity_dishes"]').val(selectedDishesCount);
            });

            // Initialize CKEditor
            CKEDITOR.replace('editor');

            const priceInput = document.getElementById('price');
            priceInput.addEventListener('input', function() {
                const value = parseInt(priceInput.value, 10);
                if (value < 1 || value > 10000000) {
                    priceInput.classList.add('is-invalid');
                } else {
                    priceInput.classList.remove('is-invalid');
                }
            });

            const comboNameInput = document.getElementById('combo-name');
            const comboNameParent = comboNameInput.closest('.mb-3');
            const existingComboNames = window.existingComboNames || [];

            comboNameInput.addEventListener('input', function() {
                const name = comboNameInput.value.trim();
                removeErrorMessages();
                if (name.length > 50) {
                    showError('Tên combo dài quá 50 ký tự. Vui lòng rút ngắn.');
                    comboNameInput.value = name.substring(0, 50);
                    return;
                }

                if (existingComboNames.includes(name)) {
                    showError('Tên combo đã tồn tại. Vui lòng chọn tên khác.');
                }
            });

            function showError(message) {
                const errorDiv = document.createElement('div');
                errorDiv.classList.add('text-danger', 'd-block', 'mt-1');
                errorDiv.textContent = message;
                comboNameParent.appendChild(errorDiv);
            }

            function removeErrorMessages() {
                const existingErrorMessages = comboNameParent.querySelectorAll('.text-danger');
                existingErrorMessages.forEach(error => error.remove());
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceInput = document.getElementById('price');

            // Kiểm tra giá trị nhập vào (chặn số âm và giá trị vượt quá 100.000.000)
            priceInput.addEventListener('input', function() {
                // Chuyển giá trị sang số nguyên
                const value = parseInt(priceInput.value, 10);

                // Nếu giá trị không hợp lệ hoặc nhỏ hơn 1
                if (value < 1) {
                    priceInput.value = ''; // Reset giá trị nếu nhỏ hơn 1
                    priceInput.classList.add('is-invalid');
                }
                // Nếu giá trị vượt quá 10.000.000
                else if (value > 10000000) {
                    priceInput.value = 10000000; // Giới hạn giá trị tối đa
                    priceInput.classList.add('is-invalid');
                }
                // Nếu giá trị hợp lệ
                else {
                    priceInput.classList.remove('is-invalid');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const comboNameInput = document.getElementById('combo-name');
            const maxLengthWarning = 'Tên combo dài quá 50 ký tự. Vui lòng rút ngắn.';
            const nameExistsError = 'Tên combo đã tồn tại. Vui lòng chọn tên khác.';
            const comboNameParent = comboNameInput.closest('.mb-3'); // Lấy phần tử cha để thêm lỗi

            // Lấy danh sách tên combo từ server
            const existingComboNames = window.existingComboNames || []; // Danh sách tên combo có sẵn

            comboNameInput.addEventListener('input', function() {
                const name = comboNameInput.value.trim();

                // Xóa các thông báo lỗi cũ
                removeErrorMessages();

                // Kiểm tra độ dài tên combo
                if (name.length > 50) {
                    showError(maxLengthWarning);
                    comboNameInput.value = name.substring(0, 50); // Cắt chuỗi về 50 ký tự
                    return; // Dừng lại ở đây nếu dài quá 50 ký tự
                }

                // Kiểm tra tên combo có bị trùng không
                if (existingComboNames.includes(name)) {
                    showError(nameExistsError);
                }
            });

            // Hàm hiển thị lỗi
            function showError(message) {
                const errorDiv = document.createElement('div');
                errorDiv.classList.add('text-danger', 'd-block', 'mt-1');
                errorDiv.textContent = message;
                comboNameParent.appendChild(errorDiv);
            }

            // Hàm xóa các thông báo lỗi cũ
            function removeErrorMessages() {
                const existingErrorMessages = comboNameParent.querySelectorAll('.text-danger');
                existingErrorMessages.forEach(error => error.remove());
            }
        });
    </script>
@endsection
