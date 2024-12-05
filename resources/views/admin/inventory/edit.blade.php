@extends('admin.master')

@section('title', 'Chỉnh Sửa Kho Hàng')

@section('content')
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Chỉnh Sửa Kho Hàng</h3>
                            <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary">Quay Lại</a>
                        </div>
                        <div class="card-body">

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.inventory.update', $inventory->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Nguyên Liệu -->
                                <div class="mb-3">
                                    <label for="ingredient_id" class="form-label">Nguyên Liệu</label>
                                    <select class="form-control @error('ingredient_id') is-invalid @enderror"
                                            id="ingredient_id" name="ingredient_id">
                                        <option value="">Chọn nguyên liệu</option>
                                        @foreach($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}"
                                                {{ (old('ingredient_id', $inventory->ingredient_id) == $ingredient->id) ? 'selected' : '' }}>
                                                {{ $ingredient->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ingredient_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Số Lượng -->
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Số Lượng</label>
                                    <input type="number" class="form-control @error('quantity_stock') is-invalid @enderror"
                                           id="quantity" name="quantity_stock"
                                           value="{{ old('quantity_stock', $inventory->quantity_stock) }}">
                                    @error('quantity_stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    input:-webkit-autofill,
    textarea:-webkit-autofill,
    select:-webkit-autofill {
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        background-color: white !important; /* Đặt màu nền trắng */
        -webkit-text-fill-color: black !important; /* Đặt màu chữ đen */
    }

    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    textarea:-webkit-autofill:hover,
    textarea:-webkit-autofill:focus,
    select:-webkit-autofill:hover,
    select:-webkit-autofill:focus {
        border: 1px solid #26ba4f;/
        -webkit-text-fill-color: black !important;
        box-shadow: none !important
    }

    input,
    textarea,
    select {
        background-color: white;
        color: black;
    }
</style>

