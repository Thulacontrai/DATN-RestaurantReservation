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
                                    <input type="text" id="search-name" name="name"
                                        class="form-control form-control-sm" placeholder="Tìm kiếm "
                                        value="{{ request('name') }}">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                </div>
                            </div>
                            <div class="table-responsive">

                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
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
                                                {{-- <td>{{ $feedback->id }}</td> --}}
                                                <td>{{ $feedback->order_id }}</td>
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
                                                        <a href="#" class="editRow me-2"
                                                            onclick="showFeedbackDetails({{ $feedback->id }})">
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

                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{ $feedbacks->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Feedback Details Modal -->
    <div class="modal fade" id="feedbackDetailsModal" tabindex="-1" role="dialog"
        aria-labelledby="feedbackDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-primary" id="feedbackDetailsModalLabel">
                        <i class="bi bi-chat-dots me-2 text-primary"></i>Chi Tiết Phản Hồi
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="border rounded p-3 bg-light">
                                <h6 class="mb-2 text-muted">ID Phản Hồi</h6>
                                <p id="feedbackId" class="mb-0 fs-5 fw-bold text-primary"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 bg-light">
                                <h6 class="mb-2 text-muted">Mã Hóa Đơn</h6>
                                <p id="feedbackOrderId" class="mb-0 fs-5 fw-bold text-primary"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="border rounded p-3 bg-light">
                                <h6 class="mb-2 text-muted">Tên Khách Hàng</h6>
                                <p id="feedbackCustomerId" class="mb-0 fs-5 fw-bold text-primary"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 bg-light">
                                <h6 class="mb-2 text-muted">Xếp Hạng</h6>
                                <div id="feedbackRating" class="fs-5 text-warning"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="border rounded p-3 bg-light">
                            <h6 class="mb-2 text-muted">Nội Dung Phản Hồi</h6>
                            <p id="feedbackContent" class="mb-0 fs-5 text-primary"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showFeedbackDetails(id) {
            // Lấy thông tin feedback từ hàng trong bảng
            const feedbackId = id;
            const orderId = document.querySelector(`#content_${id}`).parentElement.children[1].innerText.trim();
            const customerId = document.querySelector(`#content_${id}`).parentElement.children[2].innerText.trim();
            const content = document.querySelector(`#content_${id}`).innerText.trim();
            const ratingElement = document.querySelector(`#rating_${id}`);

            // Đổ dữ liệu vào modal
            document.querySelector("#feedbackId").innerText = feedbackId;
            document.querySelector("#feedbackOrderId").innerText = orderId;
            document.querySelector("#feedbackCustomerId").innerText = customerId;
            document.querySelector("#feedbackContent").innerText = content;

            // Hiển thị xếp hạng
            const stars = ratingElement.innerHTML.trim();
            document.querySelector("#feedbackRating").innerHTML = stars;

            // Hiển thị modal
            const feedbackModal = new bootstrap.Modal(document.querySelector("#feedbackDetailsModal"));
            feedbackModal.show();
        }
    </script>
  
@endsection
