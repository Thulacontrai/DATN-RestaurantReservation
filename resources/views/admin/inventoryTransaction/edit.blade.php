@extends('admin.master')

@section('content')
<div class="container">
    {{-- Hiển thị thông báo thành công hoặc lỗi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <div class="card-body">
                <h3 class="mb-4">Chỉnh sửa phiếu nhập kho</h3>
                <div class="form-group">
                    <label for="total_amount">Tổng số tiền</label>
                    <input type="hidden" id="total_amount" name="total_amount" value="{{ old('total_amount', $transaction->total_amount) }}" required>
                    <input type="text" id="total_amount_display" class="form-control" value="{{ number_format($transaction->total_amount, 0, ',', '.') }} đ" readonly>
                </div>
                
                <div class="form-group">
                    <label for="description">Ghi chú</label>
                    <textarea name="description" class="form-control">{{ old('description', $transaction->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="supplier_id">Nhà cung cấp</label>
                    <select name="supplier_id" class="form-control" required>
                        <option value="">Chọn nhà cung cấp</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $supplier->id == $transaction->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <h4 class="mt-4">Nguyên liệu</h4>
                <div id="ingredients-container">
                    @foreach($transaction->inventoryItems as $index => $item)
                        <div class="ingredient-item mb-3 p-3 border rounded">
                            <div class="form-group">
                                <label for="ingredient_id">Nguyên liệu:</label>
                                <select name="ingredients[{{ $index }}][ingredient_id]" class="form-select" required data-price="{{ $ingredients->firstWhere('id', $item->ingredient_id)->price ?? 0 }}">
                                    <option value="">Chọn nguyên liệu</option>
                                    @foreach($ingredients as $ingredient)
                                        <option value="{{ $ingredient->id }}" {{ $ingredient->id == $item->ingredient_id ? 'selected' : '' }}>{{ $ingredient->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Số lượng:</label>
                                <input type="number" name="ingredients[{{ $index }}][quantity]" class="form-control quantity-input" value="{{ $item->quantity }}" required>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
            </div>
        </div>
    </form>

    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Trở về</a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const totalAmountInput = document.getElementById('total_amount');
    const totalAmountDisplay = document.getElementById('total_amount_display');

    function updateTotalAmount() {
        let totalAmount = 0;
        quantityInputs.forEach(input => {
            const price = parseFloat(input.closest('.ingredient-item').querySelector('select').dataset.price || 0);
            const quantity = parseFloat(input.value || 0);
            if (!isNaN(price) && !isNaN(quantity)) {
                totalAmount += price * quantity;
            }
        });
        // Gán giá trị thực vào input ẩn
        totalAmountInput.value = totalAmount;
        // Định dạng số tiền cho người dùng thấy
        totalAmountDisplay.value = totalAmount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    }

    quantityInputs.forEach(input => {
        input.addEventListener('input', updateTotalAmount);
    });

    // Tính tổng tiền ban đầu
    updateTotalAmount();
});

</script>
@endsection
