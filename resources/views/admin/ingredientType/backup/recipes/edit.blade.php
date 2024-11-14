@extends('admin.master')

@section('title', 'Chỉnh Sửa Công Thức Món Ăn')

@section('content')
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Chỉnh Sửa Công Thức Món Ăn</h5>
                        </div>
                        <div class="card-body">
                            <form id="editRecipeForm" method="POST" action="{{ route('admin.recipes.update', $recipe->id) }}" novalidate>
                                @csrf
                                @method('PUT')

                                <!-- Chọn Món Ăn -->
                                <div class="mb-4">
                                    <label for="dish-id" class="form-label fw-bold">Món Ăn</label>
                                    <select id="dish-id" name="dish_id" class="form-select" required>
                                        <option value="">Chọn món ăn</option>
                                        @foreach ($dishes as $dish)
                                            <option value="{{ $dish->id }}" {{ $recipe->dish_id == $dish->id ? 'selected' : '' }}>
                                                {{ $dish->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn món ăn.</div>
                                </div>

                                <!-- Chọn Nguyên Liệu (multiple) -->
                                <div class="mb-4">
                                    <label for="ingredients" class="form-label fw-bold">Nguyên Liệu</label>
                                    <select id="ingredients" name="ingredient_id[]" class="form-select" multiple required>
                                        @foreach ($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}" {{ in_array($ingredient->id, $recipe->ingredients->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $ingredient->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Vui lòng chọn ít nhất một nguyên liệu.</div>
                                </div>

                                <!-- Định lượng cho từng Nguyên Liệu -->
                                <div id="ingredient-quantities" class="mb-4">
                                    @foreach ($recipe->ingredients as $ingredient)
                                        <div class="mb-3" id="quantity-{{ $ingredient->id }}">
                                            <label class="form-label fw-bold">Định lượng cho {{ $ingredient->name }}</label>
                                            <input type="number" name="ingredient_quantity[{{ $ingredient->id }}]" class="form-control" value="{{ $ingredient->pivot->quantity_need }}" required min="0.01" step="0.01">
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Nút Cập Nhật -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold">Cập Nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ingredientSelect = document.getElementById('ingredients');
        const ingredientQuantitiesDiv = document.getElementById('ingredient-quantities');
        const existingQuantities = @json($recipe->ingredients->pluck('pivot.quantity_need', 'id'));

        ingredientSelect.addEventListener('change', () => {
            // Duyệt qua từng nguyên liệu đã chọn và tạo hoặc cập nhật input số lượng
            Array.from(ingredientSelect.selectedOptions).forEach(option => {
                const ingredientId = option.value;
                const ingredientName = option.text;

                // Kiểm tra nếu input số lượng đã tồn tại
                if (!document.getElementById(`quantity-${ingredientId}`)) {
                    // Tạo thẻ div cho phần định lượng của mỗi nguyên liệu
                    const quantityDiv = document.createElement('div');
                    quantityDiv.classList.add('mb-3');
                    quantityDiv.id = `quantity-${ingredientId}`;

                    // Tạo nhãn cho mỗi input số lượng
                    const label = document.createElement('label');
                    label.classList.add('form-label', 'fw-bold');
                    label.textContent = `Định lượng cho ${ingredientName}`;

                    // Tạo input số lượng với các thuộc tính cần thiết
                    const input = document.createElement('input');
                    input.type = 'number';
                    input.name = `ingredient_quantity[${ingredientId}]`;
                    input.classList.add('form-control');
                    input.placeholder = `Nhập định lượng cho ${ingredientName}`;
                    input.required = true;
                    input.min = 0.01;
                    input.step = 0.01;

                    // Kiểm tra và gán giá trị từ dữ liệu cũ (nếu có)
                    if (existingQuantities[ingredientId]) {
                        input.value = existingQuantities[ingredientId];
                    }

                    // Thêm nhãn và input vào div
                    quantityDiv.append(label, input);
                    ingredientQuantitiesDiv.appendChild(quantityDiv);
                }
            });

            // Xóa các input định lượng nếu nguyên liệu không còn được chọn
            Array.from(ingredientQuantitiesDiv.children).forEach(child => {
                const childId = child.id.replace('quantity-', '');
                if (!Array.from(ingredientSelect.selectedOptions).map(opt => opt.value).includes(childId)) {
                    child.remove();
                }
            });
        });
    </script>
@endsection
