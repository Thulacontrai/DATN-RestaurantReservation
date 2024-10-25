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

                            <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table v-middle m-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên vai trò</th>
                                        <th>Quyền hạn</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if ($roles->isNotEmpty())
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->permissions->pluck('name')->implode(' , ') }}</td>
                                                <td>{{ $role->created_at }}</td>
                                                <td>


                                                    <div class="actions">
                                                        @can('Sửa vai trò')
                                                        <a href="{{ route('admin.role.edit', $role->id) }}">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        @endcan

                                                        <a href="#">
                                                            <form
                                                                action="{{ route('admin.role.destroy', $role->id) }}"
                                                                method="POST" style="display: inline-block; padding-bottom: 7px;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="border-0 bg-transparent"
                                                                    onclick="deleteRole({{$role->id}})">
                                                                    <svg class="delete-svgIcon" viewBox="0 0 448 512">
                                                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                                                                      </svg>
                                                                </button>
                                                            </form>
                                                        </a>
                                                        <a href="{{ route('admin.role.trash') }}">
                                                            <svg class="delete-svgIcon1" viewBox="0 0 448 512">
                                                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                                                              </svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif




                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $roles->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
   function deleteRole(id) {
    if (confirm("Are you sure you want to delete?")) {
        $.ajax({
            url: '{{ route("admin.role.destroy", ":id") }}'.replace(':id', id), // Thay thế :id
            type: 'DELETE',
            dataType: 'json',
            headers: { 'x-csrf-token': '{{ csrf_token() }}' },
            success: function(response) {
                if (response.status) {
                    window.location.href = "{{ route('admin.role.index') }}"; // Chuyển hướng
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert('Xóa không thành công!');
            }
        });
    }
}

        </script>
    </x-slot>
@endsection
