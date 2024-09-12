@extends('admin.master')

@section('title', 'Danh Sách Nguyên Liệu')

@section('content')

<div class="content-wrapper-scroll">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Danh Sách Nguyên Liệu</div>
                        <a href="{{ route('admin.ingredient.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table v-middle m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Nguyên Liệu</th>
                                    <th>Nhà Cung Cấp</th>
                                    <th>Giá</th>
                                    <th>Loại Nguyên Liệu</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ingredients as $ingredient)
                                    <tr>
                                        <td>{{ $ingredient->id }}</td>
                                        <td>{{ $ingredient->name }}</td>
                                        <td>{{ $ingredient->supplier->name }}</td>
                                        <td>{{ number_format($ingredient->price, 0, ',', '.') }} VNĐ</td>
                                        <td>{{ $ingredient->ingredientType->name }}</td>
                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('admin.ingredient.show', $ingredient->id)}}" class="viewRow" data-id="7">
                                                    <i class="bi bi-list text-green"></i>
                                                </a>
                                                <a href="{{ route('admin.ingredient.edit', $ingredient->id) }}">
                                                    <i class="bi bi-pencil-square text-warning"></i>
                                                </a>
                                                <a href="#">
                                                <form action="{{ route('admin.ingredient.destroy', $ingredient->id) }}" method="POST" style="display: inline-block;">
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
                            {{-- {{ $ingredients->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
