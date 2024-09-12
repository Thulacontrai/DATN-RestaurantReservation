<!-- resources/views/ingredientType/index.blade.php -->
@extends('admin.master')

@section('title', 'Danh Sách Loại Nguyên Liệu')

@section('content')

    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh Sách Loại Nguyên Liệu</div>
                            <a href="{{ route('admin.ingredientType.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table v-middle m-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Loại Nguyên Liệu</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ingredientTypes as $ingredientType)
                                        <tr>
                                            <td>{{ $ingredientType->id }}</td>
                                            <td>{{ $ingredientType->name }}</td>
                                            <td>
                                                <div class="actions">
                                                    <a href="{{ route('admin.ingredientType.edit', $ingredientType->id) }}">
                                                        <i class="bi bi-pencil-square text-warning"></i>
                                                    </a>
                                                    <a href="#">
                                                    <form action="{{ route('admin.ingredientType.destroy', $ingredientType->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="border-0 bg-transparent" onclick="return confirm('Bạn có chắc chắn muốn xóa loại nguyên liệu này không?')">
                                                            <i class="bi bi-trash text-red"></i>
                                                        </button>
                                                    </form></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Pagination (Nếu có) --}}
                            {{-- <div class="mt-3">
                                {{ $ingredientType->links() }}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
