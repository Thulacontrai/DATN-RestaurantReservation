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
                            <form action="{{ route('admin.permissions.index') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Tìm kiếm quyền hạn..." value="{{ request()->get('search') }}">
                                <button type="submit" class="btn btn-sm btn-secondary ms-2">
                                    <i class=" mb-2"></i> Tìm kiếm
                                </button>
                            </form>
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
                                                                method="POST" style="display: inline-block; padding-bottom: 7px">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="border-0 bg-transparent"
                                                                    onclick="deletePermission({{$permission->id}})">
                                                                    <svg class="delete-svgIcon" viewBox="0 0 448 512">
                                                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                                                                      </svg>
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
