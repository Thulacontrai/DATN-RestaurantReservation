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
<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr); /* 5 cột */
        gap: 10px; /* Khoảng cách giữa các checkbox */
    }
    .custom-checkbox {
        display: flex;
        align-items: center;
    }
    .custom-checkbox input {
        margin-right: 10px;
    }
</style>
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
                                    <label for="name" class="form-label">Tên Vai Trò</label>
                                    <input value="{{ old ('name', $role->name)}}" type="text" id="name" name="name" class="form-control" value="{{ $role->name }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="grid mb-3">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            <div class="custom-control custom-checkbox mt-3">
                                                <input {{ ($hasPermissions->contains($permission->name)) ? 'checked' : '' }} 
                                                       type="checkbox" 
                                                       name="permission[]" 
                                                       value="{{ $permission->name }}" 
                                                       id="permission-{{$permission->id}}" 
                                                       class="custom-control-input">
                                                <label class="custom-control-label" for="permission-{{$permission->id}}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    @endif
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
