@extends('admin.master')

@section('title', 'Danh Sách Quyền Hạn')

@section('content')

    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh Sách Quyền Hạn</div>
                            <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table v-middle m-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Quyền Hạn</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>{{ $permission->id }}</td>
                                                <td>{{ $permission->name }}</td>
                                                <td>{{ $permission->created_at }}</td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.permissions.edit', $permission->id) }}">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <a href="#">
                                                            <form
                                                                action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                                                method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="border-0 bg-transparent"
                                                                    onclick="deletePermission({{$permission->id}})">
                                                                    <i class="bi bi-trash text-red"></i>
                                                                </button>
                                                            </form>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif



                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $permissions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            function deletePermission(id) {
                event.preventDefault(); // Ngăn chặn hành động gửi form
                if (confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        url: '{{ route("admin.permissions.destroy", ":id") }}'.replace(':id', id), // Cập nhật ở đây
                        type: 'DELETE',
                        dataType: 'json',
                        headers: {
                            'x-csrf-token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status) {
                                window.location.href = "{{ route('admin.permissions.index') }}"; // Cập nhật đường dẫn cho đúng
                            } else {
                                alert("Error deleting permission: " + response.message);
                            }
                        },
                        error: function(xhr) {
                            alert("Error occurred: " + xhr.statusText);
                        }
                    });
                }
            }
        </script>
        
    </x-slot>
@endsection
