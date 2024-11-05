@extends('admin.master')

@section('title', 'Thêm Mới Công Thức Món Ăn')

@section('content')
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Thêm Mới Công Thức Món Ăn</h5>
                        </div>
                        <div class="card-body">
                            <form id="addRecipeForm" method="POST" action="{{ route('admin.recipes.store') }}" novalidate>
                                @csrf

                                <!-- Chọn Món Ăn -->
                                <div class="mb-4">
                                    <label for="dish-id" class="form-label fw-bold">Món Ăn</label>
                                    <select id="dish-id" name="dish_id" class="form-select" required>
                                        <option value="">Chọn món ăn</option>
                                        @foreach ($dishes as $dish)
                                            <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn món ăn.</div>
                                </div>

                                <!-- Chọn Nguyên Liệu (multiple) -->
                                <div class="mb-4">
                                    <label for="ingredients" class="form-label fw-bold">Nguyên Liệu</label>
                                    <select id="ingredients" name="ingredient_id[]" class="form-select" multiple required>
                                        @foreach ($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn ít nhất một nguyên liệu.</div>
                                </div>

                                <!-- Định lượng cho từng Nguyên Liệu -->
                                <div id="ingredient-quantities" class="mb-4"></div>

                                <!-- Nút Thêm Mới -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold">Thêm Mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('addRecipeForm');
    const ingredientSelect = document.getElementById('ingredients');
    const ingredientQuantitiesDiv = document.getElementById('ingredient-quantities');

    // Hàm tạo input định lượng khi chọn nguyên liệu
    ingredientSelect.addEventListener('change', () => {
        ingredientQuantitiesDiv.innerHTML = ''; // Xóa nội dung trước đó

        let index = 0; // Khởi tạo biến index
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
            input.name = `ingredient_quantity[${index}]`; // Sử dụng index
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
            index++; // Tăng index sau mỗi lần thêm
        });
    });

    // Kiểm tra tính hợp lệ khi gửi biểu mẫu
    form.addEventListener('submit', function (event) {
        let isValid = true;
        const inputs = form.querySelectorAll('input, select');

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
});

    </script>
@endsection
