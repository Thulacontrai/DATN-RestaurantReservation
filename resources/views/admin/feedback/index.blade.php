@extends('admin.master')

@section('title', 'Danh Sách Phản Hồi')

@section('content')

    @include('admin.layouts.messages')


    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh sách phản hồi</div>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-auto">
                                    <!-- Input with search icon inside -->
                                    <div class="input-group">
                                        <input type="text" id="search-name" name="name"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm"
                                            value="{{ request('name') }}">
                                        <span class="input-group-text" id="search-icon">
                                            <i class="bi bi-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <!-- The search button is removed since it's no longer needed -->
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Mã Hoá Đơn</th>
                                            <th>Tên Khách Hàng</th>
                                            <th>Nội Dung</th>
                                            <th>Xếp Hạng</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($feedbacks as $feedback)
                                            <tr>
                                                <td>{{ $feedback->reservation_id }}</td>
                                                <td>{{ $feedback->customer->name ?? 'Khách hàng không tồn tại' }}</td>
                                                <td id="content_{{ $feedback->id }}">{{ $feedback->content }}</td>
                                                <td id="rating_{{ $feedback->id }}">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $feedback->rating)
                                                            <i class="fa fa-star" style="color: gold;"></i>
                                                        @else
                                                            <i class="fa fa-star-o" style="color: gold;"></i>
                                                        @endif
                                                    @endfor
                                                </td>
                                                <td>
                                                    <div class="actions d-flex">
                                                        <a href="{{ route('admin.feedback.show', $feedback->id) }}"
                                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="">
                                                            <form
                                                                action="{{ route('admin.feedback.destroy', $feedback->id) }}"
                                                                method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link p-0"
                                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                                    <i class="bi bi-trash text-red"></i>
                                                                </button>
                                                            </form>
                                                        </a>
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
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center bg-white p-4">
                            <!-- Phần hiển thị phân trang bên trái -->
                            <div class="mb-4 flex sm:mb-0 text-center">
                                <span style="font-size: 15px">
                                    <i class="bi bi-chevron-compact-left"></i>

                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        Hiển thị <strong
                                            class="font-semibold text-secondary ">{{ $feedbacks->firstItem() }}-{{ $feedbacks->lastItem() }}</strong>
                                        trong tổng số <strong
                                            class="font-semibold text-secondary ">{{ $feedbacks->total() }}</strong>
                                    </span><i class="bi bi-chevron-compact-right"></i>
                                </span>
                            </div>

                            <!-- Phần hiển thị phân trang bên phải -->
                            <div class="flex items-center space-x-3">
                                <!-- Nút Previous -->
                                @if ($feedbacks->onFirstPage())
                                    <button class="inline-flex  p-1 pl-2 bg-success text-white  cursor-not-allowed"
                                        style="border-radius: 5px; border: 2px solid rgb(136, 243, 136);">
                                        <span style="font-size: 15px"><i class="bi bi-chevron-compact-left"></i>Trước</span>
                                    </button>
                                @else
                                    <a href="{{ $feedbacks->previousPageUrl() }}">
                                        <button class="inline-flex  p-1 pl-2  bg-success text-white "
                                            style="border-radius: 5px;    border: 2px solid rgb(136, 243, 136);">
                                            <span style="font-size: 15px"><i class="bi bi-chevron-double-left"></i>
                                                Trước</span>
                                        </button>
                                    </a>
                                @endif

                                <!-- Nút Next -->
                                @if ($feedbacks->hasMorePages())
                                    <a href="{{ $feedbacks->nextPageUrl() }}">
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Chi tiết phản hồi</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="feedback-details">
                <p><strong>Mã Hóa Đơn:</strong> {{ $feedback->reservation_id }}</p>
                <p><strong>Tên Khách Hàng:</strong> {{ $feedback->customer->name ?? 'N/A' }}</p>
                <p><strong>Nội Dung:</strong> {{ $feedback->content }}</p>
                <p><strong>Xếp Hạng:</strong> {{ $feedback->rating }} ⭐</p>
            </div>
        </div>
    </div>


@endsection
