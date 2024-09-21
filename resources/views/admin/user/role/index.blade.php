@extends('admin.master')

@section('title', 'Danh Sách Vai Trò')

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
                            <div class="card-title">Danh Sách Vai Trò</div>
                            <div class="heart-btn d-flex align-items-center" id="heartButton">
                                <a href="{{ route('admin.role.trash') }}">
                                    <i class="bi bi-trash2-fill"></i></a>
                            </div>
                            <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table v-middle m-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Vai Trò</th>
                                        <th>Mô Tả</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->role_name }}</td>
                                            <td>{{ $role->description }}</td>
                                            <td>
                                                <div class="actions">
                                                <a href="{{ route('admin.role.edit', $role->id) }}" >
                                                    <i class="bi bi-pencil-square text-warning"></i>
                                                </a>
                                                <form action="{{ route('admin.role.destroy', $role->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#">
                                                    <button type="submit" class="border-0 bg-transparent" onclick="return confirm('Bạn có muốn xóa vai trò này không?')"><i class="bi bi-trash text-red"></i></button>
                                                </a></form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- <div class="mt-3">
                                {{ $roles->links() }}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
