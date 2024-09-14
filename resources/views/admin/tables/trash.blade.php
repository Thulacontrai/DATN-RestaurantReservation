{{-- @extends('admin.master')

@section('title', 'Bàn Đã Xóa')

@section('content')
<section class="content">

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<div class="content-wrapper-scroll">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Thùng Rác - Bàn Đã Xóa</div>
                        <a href="{{ route('admin.table.index') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-arrow-left-circle me-2"></i> Trở Lại
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table v-middle m-0">
                                <thead>
                                    <tr>
                                        <th>Khu Vực</th>
                                        <th>Số Bàn</th>
                                        <th>Ngày Xóa</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tables as $table)
                                    <tr>
                                        <td>{{ $table->area }}</td>
                                        <td>{{ $table->table_number }}</td>
                                        <td>{{ $table->deleted_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <!-- Restore Button -->
                                            <form action="{{ route('admin.table.restore', $table->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Khôi Phục</button>
                                            </form>

                                            <!-- Force Delete Button -->
                                            <form action="{{ route('admin.table.forceDelete', $table->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Xóa Vĩnh Viễn</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination justify-content-center mt-3">
                            {{ $tables->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
