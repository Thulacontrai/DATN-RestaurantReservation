@extends('admin.master')

@section('title', 'Thêm Loại Nguyên Liệu Mới')

@section('content')

    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Thêm Loại Nguyên Liệu Mới</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.ingredientType.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Tên Loại Nguyên Liệu</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nhập tên loại nguyên liệu" required>
                                </div>
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
