@extends('admin.master')

@section('title', 'Thêm Mới Món Ăn')

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
                            <div class="card-title">Thêm Mới Món Ăn</div>
                            <a href="{{ route('admin.dishes.index') }}" class="btn btn-sm btn-secondary">Quay lại</a>
                        </div>
                        <div class="card-body">
                            <form id="addDishForm" method="POST" action="{{ route('admin.dishes.store') }}" enctype="multipart/form-data" novalidate>
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="dish-name" class="form-label">Tên Món Ăn</label>
                                        <input type="text" id="dish-name" name="name" class="form-control" placeholder="Nhập tên món ăn" required>
                                        <div class="invalid-feedback">Vui lòng nhập tên món ăn.</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="dish-category" class="form-label">Loại:</label>
                                        <select id="dish-category" name="category_id" class="form-select" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Vui lòng chọn loại.</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="dish-price" class="form-label">Giá</label>
                                        <input type="number" id="dish-price" name="price" class="form-control" placeholder="Nhập giá món ăn" required min="0" step="0.01">
                                        <div class="invalid-feedback">Vui lòng nhập giá món ăn.</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="dish-description" class="form-label">Mô tả Món Ăn</label>
                                        <textarea id="dish-description" name="description" class="form-control" placeholder="Nhập mô tả món ăn"></textarea>
                                        <div class="invalid-feedback">Vui lòng nhập mô tả món ăn.</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="dish-status" class="form-label">Trạng Thái</label>
                                        <select id="dish-status" name="status" class="form-select" required>
                                            <option value="available">Có sẵn</option>
                                            <option value="out_of_stock">Hết hàng</option>
                                            <option value="reserved">Đã đặt trước</option>
                                            <option value="in_use">Đang sử dụng</option>
                                            <option value="completed">Hoàn thành</option>
                                            <option value="cancelled">Đã hủy</option>
                                        </select>
                                        <div class="invalid-feedback">Vui lòng chọn trạng thái món ăn.</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="dish-image" class="form-label">Hình Ảnh</label>
                                        <input type="file" id="dish-image" name="image" class="form-control" accept="image/*" required>
                                        <div class="invalid-feedback">Vui lòng chọn ảnh món ăn.</div>
                                    </div>
                                </div>

                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div class="card-title">Thêm Mới Công Thức Món Ăn</div>
                                </div>
                                <div id="ingredientsSection">
                                    <div id="ingredientsContainer">
                                        <!-- Chọn Nguyên Liệu (multiple) -->
                                        <div class="mb-4">
                                            <label for="ingredients" class="form-label fw-bold">Nguyên Liệu</label>
                                            <select id="ingredients" name="ingredient_id[]" class="form-select" multiple required>
                                                @foreach ($ingredients as $ingredient)
                                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Vui lòng chọn nguyên liệu.</div>
                                        </div>

                                        <!-- Định lượng cho từng Nguyên Liệu -->
                                        <div id="ingredient-quantities" class="mb-4"></div>

                                    </div>
                                </div>

                               
                                <button type="submit" class="btn btn-sm btn-primary">Thêm Mới</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('addDishForm');
            const inputs = form.querySelectorAll('input, select, textarea');
            const dishTypeSelect = document.getElementById('dish-category');
            const ingredientsSection = document.getElementById('ingredientsSection');
            const ingredientSelect = document.getElementById('ingredients');
            const ingredientQuantitiesDiv = document.getElementById('ingredient-quantities');

            // Ẩn phần công thức mặc định nếu chọn loại là đồ uống
            ingredientsSection.style.display = 'none';

            dishTypeSelect.addEventListener('change', function() {
                ingredientsSection.style.display = this.value == "1" ? 'block' : 'none';
            });

            ingredientSelect.addEventListener('change', () => {
                ingredientQuantitiesDiv.innerHTML = '';

                Array.from(ingredientSelect.selectedOptions).forEach(option => {
                    const ingredientId = option.value;
                    const ingredientName = option.text;

                    const quantityDiv = document.createElement('div');
                    quantityDiv.classList.add('mb-3');

                    const label = document.createElement('label');
                    label.classList.add('form-label', 'fw-bold');
                    label.textContent = `Định lượng cho ${ingredientName}`;

                    const input = document.createElement('input');
                    input.type = 'number';
                    input.name = `ingredient_quantity[${ingredientId}]`;
                    input.classList.add('form-control');
                    input.placeholder = `Nhập định lượng cho ${ingredientName}`;
                    input.required = true;
                    input.min = 0.01;
                    input.step = 0.01;

                    // Thêm sự kiện kiểm tra tính hợp lệ cho từng input
                    input.addEventListener('input', () => {
                        if (input.checkValidity()) {
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                        } else {
                            input.classList.remove('is-valid');
                            input.classList.add('is-invalid');
                        }
                    });

                    quantityDiv.append(label, input);
                    ingredientQuantitiesDiv.appendChild(quantityDiv);
                });
            });

            form.addEventListener('submit', function (event) {
                let isValid = true;

                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                        input.classList.add('is-valid');
                    }
                });

                if (!isValid) {
                    event.preventDefault(); // Ngăn biểu mẫu gửi nếu không hợp lệ
                }
            });

            const addIngredientBtn = document.getElementById('addIngredientBtn');
            const ingredientsContainer = document.getElementById('ingredientsContainer');

            addIngredientBtn.addEventListener('click', function() {
                const ingredientRow = document.createElement('div');
                ingredientRow.className = 'row mb-3 ingredient-row';
                ingredientRow.innerHTML = `
                    <div class="col-md-6">
                        <label for="ingredient-name" class="form-label">Nguyên Liệu</label>
                        <input type="text" name="ingredient_name[]" class="form-control" placeholder="Nhập Nguyên liệu">
                    </div>
                    <div class="col-md-6">
                        <label for="ingredient-quantity" class="form-label">Định Lượng</label>
                        <input type="number" name="ingredient_quantity[]" class="form-control" placeholder="Nhập định lượng" min="0" required>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-danger btn-sm remove-ingredient-btn">Xóa</button>
                    </div>
                `;
                ingredientsContainer.appendChild(ingredientRow);

                ingredientRow.querySelector('.remove-ingredient-btn').addEventListener('click', function() {
                    ingredientsContainer.removeChild(ingredientRow);
                });
            });
        });
    </script>
@endsection
