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
                    <h3 class="mb-4">Tạo giao dịch nhập kho và thêm nguyên liệu</h3>
                    <div class="col-md-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <label for="total_amount">Tổng số tiền:</label>
                                <input type="text" name="total_amount" id="total_amount" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <label for="description">Mô tả:</label>
                                <input type="text" name="description" id="description" class="form-control" placeholder="Nhập mô tả...">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <label for="supplier_id" >Nhà cung cấp</label>
                                <select class="form-select" name="supplier_id" required>
                                    <option value="">Chọn nhà cung cấp</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <label for="staff_id">Nhân viên</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                                <input type="hidden" name="staff_id" value="{{ $user->id }}">
                            </div>
                        </div>
                    </div>                         
                </div>

                <div class="row mb-3">
                    <div class="col-12 mb-2">
                        <h5>Nguyên liệu</h5>
                        <div class="card">
                            <div class="card-body" id="ingredient-container">
                                <div class="ingredient-item mb-2">
                                    <select class="form-select ingredient-select" name="ingredients[0][ingredient_id]" required>
                                        <option value="">Chọn nguyên liệu</option>
                                        @foreach($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}" data-price="{{ $ingredient->price }}">{{ $ingredient->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="ingredients[0][quantity]" placeholder="Số lượng" class="form-control mt-2 quantity-input" required min="1">
                                    <input type="number" name="ingredients[0][unit_price]" placeholder="Đơn giá" class="form-control mt-2 unit-price" required min="0" readonly>
                                    <button type="button" class="btn btn-danger remove-ingredient-btn">Xóa</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary add-ingredient-btn">Thêm nguyên liệu</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Lưu giao dịch</button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Trở về danh sách</a>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelector('.add-ingredient-btn').addEventListener('click', function() {
        const ingredientContainer = document.getElementById('ingredient-container');
        const index = ingredientContainer.children.length;

        const newIngredientItem = `
            <div class="ingredient-item mb-2">
                <select class="form-select ingredient-select" name="ingredients[${index}][ingredient_id]" required>
                    <option value="">Chọn nguyên liệu</option>
                    @foreach($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}" data-price="{{ $ingredient->price }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="ingredients[${index}][quantity]" placeholder="Số lượng" class="form-control quantity-input mt-2" required min="1">
                <input type="number" name="ingredients[${index}][unit_price]" placeholder="Đơn giá" class="form-control mt-2 unit-price" required min="0" readonly>
                <button type="button" class="btn btn-danger remove-ingredient-btn">Xóa</button>
            </div>
        `;

        ingredientContainer.insertAdjacentHTML('beforeend', newIngredientItem);
    });

    document.getElementById('ingredient-container').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-ingredient-btn')) {
            event.target.parentElement.remove();
            calculateTotalAmount();
        }
    });

    document.getElementById('ingredient-container').addEventListener('input', function(event) {
        if (event.target.classList.contains('ingredient-select') || event.target.classList.contains('quantity-input')) {
            updateUnitPrice(event.target);
            calculateTotalAmount();
        }
    });

    function updateUnitPrice(target) {
        const ingredientItem = target.closest('.ingredient-item');
        const ingredientSelect = ingredientItem.querySelector('.ingredient-select');
        const price = parseFloat(ingredientSelect.options[ingredientSelect.selectedIndex].dataset.price) || 0;
        const unitPriceInput = ingredientItem.querySelector('.unit-price');

        unitPriceInput.value = price;
    }

    function calculateTotalAmount() {
        let total = 0;
        document.querySelectorAll('.ingredient-item').forEach(item => {
            const quantity = parseFloat(item.querySelector('.quantity-input').value) || 0;
            const price = parseFloat(item.querySelector('.unit-price').value) || 0;

            total += quantity * price;
        });
        document.getElementById('total_amount').value = total.toFixed(2);
    }
</script>
@endsection
