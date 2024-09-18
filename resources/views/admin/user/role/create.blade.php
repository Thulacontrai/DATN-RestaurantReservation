@extends('admin.master')

@section('title', 'Thêm Vai Trò Mới')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <div class="content-wrapper-scroll">

        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Thêm Vai Trò Mới</h5>
                            <a href="{{ route('admin.role.index') }}" class="btn btn-sm btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i> Quay lại
                            </a>
                        </div>

                        <div class="card-body">
                            <!-- Form thêm mới role -->
                            <form method="POST" action="{{ route('admin.role.store') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="role_name" class="form-label">Tên Vai Trò</label>
                                    <input type="text" name="role_name" id="role_name" class="form-control" placeholder="Nhập tên vai trò" value="{{ old('role_name') }}" required>
                                    @error('role_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô Tả</label>
                                    <textarea name="description" id="description" class="form-control" placeholder="Nhập mô tả vai trò">{{ old('description') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Lưu Vai Trò</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
