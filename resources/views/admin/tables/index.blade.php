@extends('admin.master')

@section('title', 'Danh Mục Bàn')

@section('content')

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh Mục Bàn</div>
                            <a href="{{ route('admin.table.create') }}"
                                class="btn btn-sm btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.table.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-name" name="name"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo tên bàn"
                                            value="{{ request('name') }}">
                                    </div>
                                    <div class="col-auto">
                                        <select name="table_type" id="search-table-type" class="form-select form-select-sm">
                                            <option value="">-- Loại bàn --</option>
                                            <option value="Thường"
                                                {{ request('table_type') == 'Thường' ? 'selected' : '' }}>Thường</option>
                                            <option value="VIP" {{ request('table_type') == 'VIP' ? 'selected' : '' }}>
                                                VIP</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>


                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Khu Vực</th>
                                            <th>Số Bàn</th>
                                            <th>Loại Bàn</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tables as $table)
                                            <tr>
                                                <td>{{ $table->area }}</td>
                                                <td>{{ $table->table_number }}</td>
                                                <td>{{ $table->table_type }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $table->status == 'Available' ? 'shade-green' : ($table->status == 'Reserved' ? 'shade-yellow' : 'shade-red') }} min-70">
                                                        {{ $table->status == 'Available' ? 'Có sẵn' : ($table->status == 'Reserved' ? 'Đã đặt trước' : 'Đang sử dụng') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.table.edit', $table->id) }}"
                                                            class="viewRow">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <a href="#" class="viewRow">
                                                            <form action="{{ route('admin.table.destroy', $table->id) }}"
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
                                {{ $tables->links() }}
                            </div>
                            <!-- Kết thúc Pagination -->

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
