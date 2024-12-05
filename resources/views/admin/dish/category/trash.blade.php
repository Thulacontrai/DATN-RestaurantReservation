@extends('admin.master')

@section('title', 'Thùng Rác Loại Danh Mục')

@section('content')
<!-- SweetAlert -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<style>
    @keyframes gradientMove {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .swal2-timer-progress-bar {
        background: linear-gradient(90deg, #34eb4f, #00bcd4, #ffa726, #ffeb3b, #f44336);
        /* Gradient màu */
        background-size: 300% 300%;
        /* Kích thước gradient lớn để tạo hiệu ứng động */
        animation: gradientMove 2s ease infinite;
        /* Hiệu ứng lăn tăn */
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Hiển thị thông báo lỗi
        @if ($errors->any())
            Swal.fire({
                position: "top-end",
                icon: "error",
                toast: true,
                title: "{{ $errors->first() }}",
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 3000
            });
        @endif

        // Hiển thị thông báo thành công
        @if (session('success'))
            Swal.fire({
                position: "top-end",
                icon: "success",
                toast: true,
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 3000
            });
        @endif
    });
</script>

    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Thùng Rác Danh Mục</div>
                            <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-primary">
                                Quay lại danh sách danh mục
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Tên Danh Mục</th>
                                            <th>Mô Tả</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->description }}</td>
                                                <td>
                                                    <div class="actions ">
                                                        <!-- Restore -->
                                                        <a href="">
                                                        <form action="{{ route('admin.category.restore', $category->id) }}"
                                                            method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục danh mục này không?');">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-link p-0 " >
                                                                <i class="bi bi-arrow-clockwise text-green"></i>
                                                            </button>
                                                        </form></a>
                                                        <!-- Permanently delete -->
                                                        <a href=""><form
                                                            action="{{ route('admin.category.forceDelete', $category->id) }}"
                                                            method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn danh mục này?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link p-0" >
                                                                <i class="bi bi-trash text-red"></i>
                                                            </button>
                                                        </form></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Không có danh mục nào trong thùng
                                                    rác.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="pagination justify-content-center mt-3">
                                {{ $categories->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

