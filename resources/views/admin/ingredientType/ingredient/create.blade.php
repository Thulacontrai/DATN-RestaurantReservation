@extends('admin.master')

@section('title', 'Thêm Nguyên Liệu Mới')

@section('content')
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">Thêm Nguyên Liệu Mới</div>
                        <div class="card-body">
                            <form action="{{ route('admin.ingredient.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên Nguyên Liệu</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nhập tên nguyên liệu" required>
                                </div>

                                <div class="mb-3">
                                    <label for="supplier_id" class="form-label">Nhà Cung Cấp</label>
                                    <select name="supplier_id" class="form-select" required>
                                        <option value="" disabled selected>Chọn nhà cung cấp</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Giá</label>
                                    <input type="number" step="0.01" name="price" class="form-control" placeholder="Nhập giá" required>
                                </div>

                                <div class="mb-3">
                                    <label for="unit" class="form-label">Đơn Vị</label>
                                    <input type="text" name="unit" class="form-control" placeholder="Nhập đơn vị" required>
                                </div>

                                <div class="mb-3">
                                    <label for="ingredient_type_id" class="form-label">Loại Nguyên Liệu</label>
                                    <select name="ingredient_type_id" class="form-select" required>
                                        <option value="" disabled selected>Chọn loại nguyên liệu</option>
                                        @foreach($ingredientTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">Lưu</button>
                                <a href="{{ route('admin.ingredient.index') }}" class="btn btn-sm btn-light ">Quay Lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
