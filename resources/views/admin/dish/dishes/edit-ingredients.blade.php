@extends('admin.master')

@section('title', 'Cập Nhật Nguyên Liệu')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-10">
            <!-- Card cập nhật nguyên liệu -->
            <div class="card border-0 shadow rounded-lg mb-5">
                <div class="card-header bg-gradient-primary text-white d-flex align-items-center py-3">
                    <h5 class="card-title mb-0">Cập Nhật Nguyên Liệu cho Món: <strong>{{ $dish->name }}</strong></h5>
                </div>
                <div class="card-body p-4">
                    <form id="updateIngredientsForm" method="POST" action="{{ route('admin.dishes.updateIngredients', $dish->id) }}">
                        @csrf
                        <ul class="list-group list-group-flush" id="ingredientList">
                            @foreach ($dish->recipes as $recipe)
                                <li class="list-group-item d-flex flex-wrap align-items-center justify-content-between border-0 bg-light rounded-lg mb-3">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control form-control-lg border-0 bg-white shadow-sm" name="ingredients[]" value="{{ $recipe->ingredient->name ?? 'N/A' }}" placeholder="Tên nguyên liệu" required>
                                        <input type="hidden" name="recipe_ids[]" value="{{ $recipe->id }}">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control form-control-lg border-0 bg-white shadow-sm" name="quantities[]" value="{{ $recipe->quantity_need }}" min="0" placeholder="Số lượng" required>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-end">
                                        <span class="badge bg-primary text-white px-3 py-2 shadow-sm">{{ $recipe->ingredient->unit ?? '' }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill shadow">
                                <i class="bi bi-save me-1"></i> Lưu Thay Đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card xóa nguyên liệu -->
            <div class="card border-0 shadow rounded-lg mb-5">
                <div class="card-header bg-gradient-danger text-white d-flex align-items-center py-3">
                    <h5 class="card-title mb-0">Xoá Nguyên Liệu cho Món: <strong>{{ $dish->name }}</strong></h5>
                </div>
                <div class="card-body p-4">
                    <ul class="list-group list-group-flush" id="ingredientListDelete">
                        @foreach ($dish->recipes as $recipe)
                            <li class="list-group-item d-flex flex-wrap align-items-center justify-content-between border-0 bg-light rounded-lg mb-3">
                                <div class="col-md-5">
                                    <input type="text" class="form-control-plaintext form-control-lg text-dark fw-bold" value="{{ $recipe->ingredient->name ?? 'N/A' }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control-plaintext form-control-lg text-dark fw-bold" value="{{ $recipe->quantity_need }}" readonly>
                                </div>
                                <div class="col-md-2 d-flex justify-content-end">
                                    <span class="badge bg-secondary text-white px-3 py-2 shadow-sm">{{ $recipe->ingredient->unit ?? '' }}</span>
                                    <form action="{{ route('admin.dishes.deleteIngredient', $recipe->id) }}" method="POST" class="ms-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle shadow" onclick="return confirm('Bạn có chắc chắn muốn xóa nguyên liệu này?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Card thêm nguyên liệu mới -->
            <div class="card border-0 shadow rounded-lg mb-5">
                <div class="card-header bg-gradient-success text-white d-flex align-items-center py-3">
                    <h5 class="card-title mb-0">Thêm Nguyên Liệu Mới cho Món: <strong>{{ $dish->name }}</strong></h5>
                </div>
                <div class="card-body p-4">
                    <form id="addIngredientForm" method="POST" action="{{ route('admin.dishes.addIngredient', $dish->id) }}">
                        @csrf
                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-md-5">
                                <input type="text" class="form-control form-control-lg border-0 bg-white shadow-sm" name="new_ingredient" placeholder="Tên nguyên liệu" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control form-control-lg border-0 bg-white shadow-sm" name="new_quantity" min="0" placeholder="Số lượng" required>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select form-select-lg border-0 bg-white shadow-sm" name="new_unit" required>
                                    <option value="" disabled selected>Đơn vị</option>
                                    <option value="kg">Kg</option>
                                    <option value="g">G</option>
                                    <option value="l">L</option>
                                    <option value="ml">Ml</option>
                                    <option value="cái">Cái</option>
                                    <option value="muỗng">Muỗng</option>
                                    <!-- Add more units as needed -->
                                </select>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill shadow">
                                <i class="bi bi-plus me-1"></i> Thêm Nguyên Liệu
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Nút quay lại -->
            <div class="text-center">
                <a href="{{ route('admin.dishes.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Card header gradient */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
    }

    /* Card and list group styling */
    .card {
        border-radius: 1rem;
        overflow: hidden;
    }

    .list-group-item {
        padding: 1rem;
    }

    /* Form input styling */
    .form-control-lg {
        font-size: 1.1rem;
        padding: 0.75rem 1.25rem;
    }

    .badge {
        font-size: 1rem;
        border-radius: 0.5rem;
    }

    /* Button styling */
    .btn-lg {
        font-size: 1.1rem;
        padding: 0.75rem 1.5rem;
    }

    .btn-outline-danger {
        border-width: 2px;
        transition: all 0.3s;
    }

    .btn-outline-danger:hover {
        background-color: #ff4b2b;
        color: #fff;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-header, .text-center {
            text-align: center;
        }
    }
</style>
@endsection