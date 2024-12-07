@extends('admin.master')

@section('title', 'Danh Mục Bàn')

@section('content')
@include('admin.layouts.messages')

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title ">Danh Mục Bàn</div>

                            <!-- Thêm nút Thêm Mới -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.table.create') }}"
                                    class="btn btn-sm btn-primary d-flex align-items-center">
                                    <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                                </a>

                                <!-- Thêm nút Khôi Phục -->
                                <a href="{{ route('admin.tables.trash') }}"
                                    class="btn btn-sm btn-secondary d-flex align-items-center">
                                    <i class="bi bi-trash3 me-2"></i> Khôi Phục
                                </a>
                            </div>
                        </div>


                        <div class="card-body">
                            <!-- Form tìm kiếm -->
                            <div class="filter-form">
                                <form method="GET" action="{{ route('admin.table.index') }}" class="mb-3">
                                    <div class="row g-2">
                                        <div class="col-auto">
                                            <input type="text" id="search-name" name="name"
                                                class="form-control form-control-sm" placeholder="Tìm kiếm bàn"
                                                value="{{ request('name') }}">
                                        </div>
                                        {{-- <div class="col-auto">
                                            <select name="table_type" id="search-table-type"
                                                class="form-select form-select-sm">
                                                <option value="">-- Loại bàn --</option>
                                                <option value="Thường"
                                                    {{ request('table_type') == 'Thường' ? 'selected' : '' }}>Thường
                                                </option>
                                                <option value="VIP"
                                                    {{ request('table_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                                            </select>
                                        </div> --}}
                                        <div class="col-auto">
                                            <select name="status" id="search-status" class="form-select form-select-sm">
                                                <option value="">-- Trạng thái --</option>
                                                <option value="Available"
                                                    {{ request('status') == 'Available' ? 'selected' : '' }}>Có sẵn</option>
                                                <option value="Reserved"
                                                    {{ request('status') == 'Reserved' ? 'selected' : '' }}>Đã đặt trước
                                                </option>
                                                <option value="In Use"
                                                    {{ request('status') == 'In Use' ? 'selected' : '' }}>Đang sử dụng
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                            <a href="{{ route('admin.table.index') }}" class="btn btn-sm btn-success">
                                                <i class="bi bi-arrow-repeat"></i>
                                            </a>
                                        </div>

                                    </div>
                                </form>


                            </div>

                            <div class="table-responsive">
                                <table class="table v-middle table-hover m-0">
                                    <thead>
                                        <tr>
                                            <th>Khu Vực</th>
                                            <th>Số Bàn</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tables as $table)
                                            <tr>
                                                <td>{{ $table->area }}</td>
                                                <td>{{ $table->table_number }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $table->status == 'Available' ? 'bg-success' : ($table->status == 'Reserved' ? 'bg-warning' : 'bg-danger') }} min-70">
                                                        {{ $table->status == 'Available' ? 'Có sẵn' : ($table->status == 'Reserved' ? 'Đã đặt trước' : 'Đang sử dụng') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.table.edit', $table->id) }}"
                                                            class="text-warning" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Sửa">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="" style=" padding-bottom: 5px;padding-left: 3px;">
                                                            <form action="{{ route('admin.table.destroy', $table->id) }} "
                                                                method="POST" style="display:inline-block;"
                                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <i class="bi bi-trash text-red"></i>
                                                                </button>
                                                            </form>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Không có bàn nào được tìm thấy.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                <div class="flex justify-center mt-6">
                                    <div class="inline-flex items-center space-x-2">
                                        {{-- Previous Page Link --}}
                                        @if ($tables->onFirstPage())
                                            <span
                                                class="px-4 py-2 text-gray-500 bg-gray-100 border border-gray-300 rounded-l-md cursor-not-allowed "><i
                                                    class="bi bi-chevron-compact-left "></i></span>
                                        @else
                                            <a href="{{ $tables->previousPageUrl() }}"
                                                class="px-4 py-2 text-gray-800 bg-white border border-gray-300 rounded-l-md hover:bg-indigo-500 hover:text-white transition-colors duration-200 ease-in-out"><i
                                                    class="bi bi-chevron-compact-left"></i></a>
                                        @endif

                                        {{-- Page Numbers --}}
                                        @foreach ($tables->getUrlRange(1, $tables->lastPage()) as $page => $url)
                                            @if ($page == $tables->currentPage())
                                                <span
                                                    class="px-4 py-2 text-success bg-indigo-600 border border-indigo-600 rounded-md">{{ $page }}</span>
                                            @else
                                                <a href="{{ $url }}"
                                                    class="px-4 py-2 text-gray-800 bg-white border border-gray-300 hover:bg-indigo-500 hover:text-primary transition-colors duration-200 ease-in-out">{{ $page }}</a>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($tables->hasMorePages())
                                            <a href="{{ $tables->nextPageUrl() }}"
                                                class="px-4 py-2 text-gray-800 bg-white border border-gray-300 rounded-r-md hover:bg-indigo-500 hover:text-white transition-colors duration-200 ease-in-out"><i
                                                    class="bi bi-chevron-compact-right"></i></a>
                                        @else
                                            <span
                                                class="px-4 py-2 text-gray-500 bg-gray-100 border border-gray-300 rounded-r-md cursor-not-allowed"><i
                                                    class="bi bi-chevron-compact-right"></i></span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <!-- End Pagination -->

                        </div>

                    </div>

                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Content wrapper end -->

    </div>
    <!-- Content wrapper scroll end -->

@endsection
