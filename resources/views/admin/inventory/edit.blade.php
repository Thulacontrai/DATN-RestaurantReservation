@extends('admin.master')

@section('content')
<div class="container">
   

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
                <h3 class="mb-4">Chỉnh sửa phiếu nhập kho</h1>
                <div class="form-group">
                    <label for="total_amount">Tổng số tiền</label>
                    <input type="number" name="total_amount" class="form-control" value="{{ old('total_amount', $transaction->total_amount) }}" required>
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
                

                <h4 class="mt-4">Nguyên liệu</h3>
                <div id="ingredients-container">
                    @foreach($transaction->inventoryItems as $index => $item)
                        <div class="ingredient-item mb-3 p-3 border rounded">
                            <div class="form-group">
                                <label for="ingredient_id">Nguyên liệu:</label>
                                <select name="ingredients[{{ $index }}][ingredient_id]" class="form-select" required>
                                    <option value="">Chọn nguyên liệu</option>
                                    @foreach($ingredients as $ingredient)
                                        <option value="{{ $ingredient->id }}" {{ $ingredient->id == $item->ingredient_id ? 'selected' : '' }}>{{ $ingredient->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Số lượng:</label>
                                <input type="number" name="ingredients[{{ $index }}][quantity]" class="form-control" value="{{ $item->quantity }}" required>
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
@endsection
