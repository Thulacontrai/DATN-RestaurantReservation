@extends('admin.master')

@section('title', 'Chỉnh Sửa Nguyên Liệu')

@section('content')
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">Chỉnh Sửa Nguyên Liệu</div>
                        <div class="card-body">
                            <form action="{{ route('admin.ingredient.update', $ingredient->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên Nguyên Liệu</label>
                                    <input type="text" name="name" class="form-control" value="{{ $ingredient->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="supplier_id" class="form-label">Nhà Cung Cấp</label>
                                    <select name="supplier_id" class="form-select" required>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ $ingredient->supplier_id == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Giá</label>
                                    <input type="number" step="0.01" name="price" class="form-control" value="{{ $ingredient->price }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="unit" class="form-label">Đơn Vị</label>
                                    <input type="text" name="unit" class="form-control" value="{{ $ingredient->unit }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="ingredient_type_id" class="form-label">Loại Nguyên Liệu</label>
                                    <select name="ingredient_type_id" class="form-select" required>
                                        @foreach($ingredientTypes as $type)
                                            <option value="{{ $type->id }}" {{ $ingredient->ingredient_type_id == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">Cập Nhật</button>
                                <a href="{{ route('admin.ingredient.index') }}" class="btn btn-sm btn-light ">Quay Lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
