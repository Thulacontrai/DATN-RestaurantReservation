@extends('admin.master')

@section('title', 'Danh Sách Feedbacks')

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
                            <div class="card-title">Danh Sách Feedbacks</div>
                            <a href="#"
                                class="btn btn-sm btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>
                        <div class="card-body">

                            <!-- Table list of feedbacks -->
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Mã Đặt Chỗ</th>
                                            <th>Mã Khách Hàng</th>
                                            <th>Nội Dung</th>
                                            <th>Xếp Hạng</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($feedbacks as $feedback)
                                            <tr>
                                                <td>{{ $feedback->id }}</td>
                                                <td>{{ $feedback->reservation_id }}</td>
                                                <td>{{ $feedback->customer_id }}</td>
                                                <td>{{ $feedback->content }}</td>
                                                <td>{{ $feedback->rating }}</td>
                                                <td>
                                                    <div class="actions d-flex">
                                                        <a href="#"
                                                            class="editRow me-2">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="{{ route('admin.feedback.edit', $feedback->id) }}"
                                                            class="editRow me-2">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <form action="{{ route('admin.feedback.destroy', $feedback->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link p-0"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                                <i class="bi bi-trash text-red"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">Không có feedback nào được tìm thấy.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{-- {{ $feedbacks->links() }} --}}
                            </div>
                            <!-- Kết thúc Pagination -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
    </div>
    <!-- Content wrapper scroll end -->

@endsection
