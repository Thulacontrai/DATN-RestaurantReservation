@extends('admin.master')

@section('title', 'Chỉnh Sửa Vai Trò')

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
                            <div class="card-title">Chỉnh Sửa Vai Trò</div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.role.update', $role->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="role-name" class="form-label">Tên Vai Trò</label>
                                    <input type="text" id="role-name" name="role_name" class="form-control" value="{{ $role->role_name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô Tả</label>
                                    <textarea id="description" name="description" class="form-control">{{ $role->description }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary">Cập Nhật</button>
                                <a href="{{ route('admin.role.index') }}" class="btn btn-sm btn-secondary">Hủy</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
