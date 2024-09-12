@extends('admin.master')

@section('title', 'Chỉnh Sửa Loại Nguyên Liệu')

@section('content')

    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Chỉnh Sửa Loại Nguyên Liệu</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.ingredientType.update', $ingredientType->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Tên Loại Nguyên Liệu</label>
                                    <input type="text" name="name" class="form-control" value="{{ $ingredientType->name }}" required>
                                </div>
                                <button type="submit" class="btn btn-success">Cập Nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
