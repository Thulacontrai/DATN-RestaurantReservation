@extends('admin.master')

@section('title', 'Danh Sách Công Thức Món Ăn')

@section('content')
<div class="content-wrapper-scroll">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Danh Sách Công Thức Món Ăn</div>
                        <a href="{{ route('admin.recipes.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table v-middle m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Món Ăn</th>
                                    <th>Nguyên Liệu</th>

                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recipes as $recipe)
                                    <tr>
                                        <td>{{ $recipe->id }}</td>
                                        <td>{{ $recipe->dish->name }}</td>
                                        <td>
                                            @if($recipe->ingredients->isNotEmpty())
                                                @foreach($recipe->ingredients as $ingredient)
                                                    <span class="ingredient-tag">{{ $ingredient->name }}</span>
                                                @endforeach
                                            @else
                                                <div>Không có nguyên liệu</div>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            @if($recipe->ingredients->isNotEmpty())
                                                @foreach($recipe->ingredients as $ingredient)
                                                    @if(isset($ingredient->pivot) && isset($ingredient->pivot->quantity_need))
                                                        <div>{{ $ingredient->pivot->quantity_need }}</div>
                                                    @else
                                                        <div>Không có số lượng</div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <div>Không có số lượng</div>
                                            @endif
                                        </td> --}}
                                        <td>
                                            <div class="actions d-flex justify-content-center">
                                                <a href="{{ route('admin.recipes.show', $recipe->id) }}" class="viewRow me-2" data-id="{{ $recipe->id }}">
                                                    <i class="bi bi-list text-green"></i>
                                                </a>
                                                <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="me-2">
                                                    <i class="bi bi-pencil-square text-warning"></i>
                                                </a>
                                                <a href="">
                                                <form action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border-0 bg-transparent" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                        <i class="bi bi-trash text-red"></i>
                                                    </button>
                                                </form></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $recipes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ingredient-tag {
        background-color: #21b5d6; /* Màu nền xanh */
        color: #ffffff; /* Màu chữ trắng */
        padding: 3px 10px;
        border-radius: 15px; /* Bo tròn thẻ */
        display: inline-block;
        margin: 2px 4px; /* Khoảng cách giữa các thẻ */
        font-weight: bold;
    }
</style>
@endsection
