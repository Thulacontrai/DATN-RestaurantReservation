@extends('admin.master')

@section('title', 'Danh Mục Thực Đơn')

@section('content')
    @include('admin.layouts.messages')
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh Mục Thực Đơn</div>

                            <!-- Nút Thêm Mới và Khôi Phục -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.category.create') }}"
                                    class="btn btn-sm btn-primary d-flex align-items-center">
                                    <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                                </a>
                                <a href="{{ route('admin.category.trash') }}"
                                    class="btn btn-sm btn-secondary d-flex align-items-center">
                                    <i class="bi bi-trash3 me-2"></i> Khôi Phục
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Form Tìm Kiếm -->
                            <form method="GET" action="{{ route('admin.category.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-name" name="name"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo tên category"
                                            value="{{ request('name') }}">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                        <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-success">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>

                            <!-- Bảng Danh Sách -->
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Tên Thực Đơn</th>
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
                                                    <div class="actions d-flex gap-2">
                                                        <a href="{{ route('admin.category.edit', $category->id) }}"
                                                            class="btn btn-link p-0" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Sửa">
                                                            <i class="bi bi-pencil-square text-warning"
                                                                style="font-size: 1.2rem;"></i>
                                                        </a>
                                                        <a href="" data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Xoá">
                                                            <form
                                                                action="{{ route('admin.category.destroy', $category->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');"
                                                                style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <i class="bi bi-trash text-danger"
                                                                        style="font-size: 1.2rem;"></i>
                                                                </button>
                                                            </form>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Không có category nào được tìm thấy.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{ $categories->links() }}
                            </div>

                               {{-- <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center bg-white p-4">
                            <!-- Phần hiển thị phân trang bên trái -->
                            <div class="mb-4 flex sm:mb-0 text-center">
                                <span style="font-size: 15px">
                                    <i class="bi bi-chevron-compact-left"></i>
                                    <i class="bi bi-chevron-compact-right"></i>
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        Hiển thị <strong
                                            class="font-semibold text-secondary ">{{ $categories->firstItem() }}-{{ $categories->lastItem() }}</strong>
                                        trong tổng số <strong
                                            class="font-semibold text-secondary ">{{ $categories->total() }}</strong>
                                    </span>
                                </span>
                            </div>

                            <!-- Phần hiển thị phân trang bên phải -->
                            <div class="flex items-center space-x-3">
                                <!-- Nút Previous -->
                                @if ($categories->onFirstPage())
                                    <button class="inline-flex  p-1 pl-2 bg-success text-white  cursor-not-allowed"
                                        style="border-radius: 5px; border: 2px solid rgb(136, 243, 136);">
                                        <span style="font-size: 15px"><i class="bi bi-chevron-compact-left"></i>Trước</span>
                                    </button>
                                @else
                                    <a href="{{ $categories->previousPageUrl() }}">
                                        <button class="inline-flex  p-1 pl-2  bg-success text-white "
                                            style="border-radius: 5px;    border: 2px solid rgb(136, 243, 136);">
                                            <span style="font-size: 15px"><i class="bi bi-chevron-double-left"></i>
                                                Trước</span>
                                        </button>
                                    </a>
                                @endif

                                <!-- Nút Next -->
                                @if ($categories->hasMorePages())
                                    <a href="{{ $categories->nextPageUrl() }}">
                                        <button class="inline-flex  p-1 pl-2 bg-success text-white"
                                            style="border-radius: 5px;    border: 2px solid rgb(136, 243, 136);">
                                            <span style="font-size: 15px"> Sau <i
                                                    class="bi bi-chevron-compact-right"></i></span>
                                        </button>
                                    </a>
                                @else
                                    <button class="inline-flex  p-1 pl-2 bg-primary text-white cursor-not-allowed"
                                        style="border-radius: 5px;    border: 2px solid rgb(83, 150, 216);">
                                        <span style="font-size: 15px">
                                            Trang Cuối</i></span>
                                    </button>
                                @endif
                            </div>

                        </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
