@extends('admin.master')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">

            <form action="{{ route('transactions.store') }}" method="POST" id="transaction-form">
                @csrf

                <div class="row mb-3">
                    <h3 class="mb-4">Tạo giao dịch nhập kho</h3>
                    <div class="col-md-6 mb-2">
                        <label for="total_amount">Tổng số tiền:</label>
                        <input type="text" name="total_amount" id="total_amount" class="form-control" readonly>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="description">Mô tả:</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Nhập mô tả...">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-2">
                        <label for="supplier_id">Nhà cung cấp:</label>
                        <select class="form-select" name="supplier_id" required>
                            <option value="">Chọn nhà cung cấp</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="staff_id">Nhân viên:</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                        <input type="hidden" name="staff_id" value="{{ $user->id }}">
                    </div>
                </div>

                <button type="button" class="btn btn-success mb-3 me-2" onclick="addIngredientForm()">
                    <i class="fas fa-plus"></i> Thêm nguyên liệu
                </button>

                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#importIngredientsModal">
                    <i class="fas fa-file-import"></i> Import nguyên liệu
                </button>

                <div id="ingredient-container">
                    <!-- Các form nguyên liệu sẽ được thêm vào đây -->
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Tạo phiếu nhập</button>
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Trở về danh sách</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="importIngredientsModal" tabindex="-1" aria-labelledby="importIngredientsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importIngredientsModalLabel">Import nguyên liệu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="excel_file" class="form-label">Chọn file Excel:</label>
                    <input type="file" class="form-control" id="excel_file" accept=".xlsx,.xls" required>
                </div>
                <div class="alert alert-info">
                    <small>* File Excel cần có các cột: Tên nguyên liệu, Số lượng, Đơn giá</small>
                    <br>
                    <small>* Định dạng file: .xlsx, .xls</small>
                    <br>
                    <small>* Kích thước tối đa: 5MB</small>
                </div>
                <button type="button" id="import-btn" class="btn btn-primary">Import</button>
            </div>
        </div>
    </div>
</div>

<script>
let ingredientCount = 0;
const ingredientData = @json($ingredients->map(function($ingredient) {
    return [
        'id' => $ingredient->id,
        'name' => $ingredient->name,
        'price' => $ingredient->price
    ];
}));

function addIngredientForm() {
    const container = document.getElementById('ingredient-container');
    
    const newIngredientItem = `
        <div class="ingredient-item mb-3">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-select ingredient-select" name="ingredients[${ingredientCount}][ingredient_id]" 
                            onchange="updateUnitPrice(this, ${ingredientCount})" required>
                        <option value="">Chọn nguyên liệu</option>
                        @foreach($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}" data-price="{{ $ingredient->price }}">
                                {{ $ingredient->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="ingredients[${ingredientCount}][quantity]" 
                           class="form-control quantity-input" 
                           required min="1" 
                           placeholder="Số lượng"
                           onchange="calculateRowTotal(${ingredientCount})">
                </div>
                <div class="col-md-3">
                    <input type="number" name="ingredients[${ingredientCount}][unit_price]" 
                           class="form-control unit-price" 
                           required min="0" 
                           placeholder="Đơn giá"
                           readonly>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeIngredient(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', newIngredientItem);
    ingredientCount++;
}

function updateUnitPrice(selectElement, index) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const price = selectedOption.dataset.price;
    const row = selectElement.closest('.ingredient-item');
    const unitPriceInput = row.querySelector('.unit-price');
    unitPriceInput.value = price;
    calculateRowTotal(index);
}

function calculateRowTotal(index) {
    const row = document.querySelector(`[name="ingredients[${index}][ingredient_id]"]`).closest('.ingredient-item');
    const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
    const unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
    calculateTotalAmount();
}

function calculateTotalAmount() {
    let total = 0;
    document.querySelectorAll('.ingredient-item').forEach(item => {
        const quantity = parseFloat(item.querySelector('.quantity-input').value) || 0;
        const unitPrice = parseFloat(item.querySelector('.unit-price').value) || 0;
        total += quantity * unitPrice;
    });
    document.getElementById('total_amount').value = total.toFixed(2);
}

function removeIngredient(button) {
    button.closest('.ingredient-item').remove();
    calculateTotalAmount();
}

// Xử lý import Excel
document.getElementById('import-btn').addEventListener('click', function() {
    const fileInput = document.getElementById('excel_file');
    const formData = new FormData();
    formData.append('file', fileInput.files[0]);
    formData.append('_token', '{{ csrf_token() }}');

    fetch('{{ route("transactions.import") }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            data.ingredients.forEach(ingredient => {
                addIngredientFormWithData(ingredient);
            });
            $('#importIngredientsModal').modal('hide');
            calculateTotalAmount();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi import file');
    });
});

function addIngredientFormWithData(ingredient) {
    const container = document.getElementById('ingredient-container');
    
    const newIngredientItem = `
        <div class="ingredient-item mb-3">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-select ingredient-select" name="ingredients[${ingredientCount}][ingredient_id]" required>
                        <option value="">Chọn nguyên liệu</option>
                        @foreach($ingredients as $ing)
                            <option value="{{ $ing->id }}" 
                                    ${ingredient.ingredient_id == {{ $ing->id }} ? 'selected' : ''}>
                                {{ $ing->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="ingredients[${ingredientCount}][quantity]" 
                           class="form-control quantity-input" 
                           required min="1" 
                           value="${ingredient.quantity}"
                           onchange="calculateRowTotal(${ingredientCount})">
                </div>
                <div class="col-md-3">
                    <input type="number" name="ingredients[${ingredientCount}][unit_price]" 
                           class="form-control unit-price" 
                           required min="0" 
                           value="${ingredient.unit_price}"
                           readonly>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeIngredient(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', newIngredientItem);
    ingredientCount++;
}
</script>
@endsection