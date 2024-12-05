@extends('admin.master')

@section('title', 'Danh Sách Phản Hồi')

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
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh sách phản hồi</div>

                            <!-- Nút Thêm Mới và Khôi Phục -->
                            <div class="d-flex gap-2">
                                <a href="" class="btn btn-sm btn-secondary d-flex align-items-center">
                                    <i class="bi bi-trash3 me-2"></i> Khôi Phục
                                </a>
                            </div>
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
                                                        <a href="#" class="editRow me-2">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="{{ route('admin.feedback.edit', $feedback->id) }}"
                                                            class="editRow me-2">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <a href="">
                                                            <form
                                                                action="{{ route('admin.feedback.destroy', $feedback->id) }}"
                                                                method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link p-0"
                                                                    style="margin-top: 15px;"
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
    <div id="notification" class="notification d-none">
        <div class="notification-icon">
            <i class="bi"></i>
        </div>
        <div class="notification-content">
            <strong id="notification-title"></strong>
            <p id="notification-message"></p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hàm hiển thị thông báo
            function showNotification(message, type = "success") {
                const notification = document.getElementById("notification");
                const notificationIcon = notification.querySelector(".notification-icon i");
                const notificationTitle = document.getElementById("notification-title");
                const notificationMessage = document.getElementById("notification-message");

                // Cập nhật nội dung thông báo
                notificationMessage.textContent = message;

                // Đặt kiểu thông báo
                if (type === "success") {
                    notification.style.background = "linear-gradient(90deg, #58ade8, #48d1cc)";
                    notification.style.color = "#ffffff";
                    notificationIcon.className = "bi bi-check-circle-fill icon-animate";
                    notificationTitle.textContent = "Thành công!";
                } else if (type === "error") {
                    notification.style.background = "linear-gradient(90deg, #f44336, #ff6347)";
                    notification.style.color = "#ffffff";
                    notificationIcon.className = "bi bi-x-circle-fill icon-animate";
                    notificationTitle.textContent = "Lỗi!";
                }

                // Hiển thị thông báo
                notification.classList.remove("d-none");
                notification.classList.add("show");

                // Ẩn thông báo sau 3 giây
                setTimeout(() => {
                    notification.classList.remove("show");
                    notification.classList.add("hide");

                    // Reset sau khi ẩn
                    setTimeout(() => {
                        notification.classList.add("d-none");
                        notification.classList.remove("hide");
                        notificationIcon.classList.remove("icon-animate");
                    }, 300);
                }, 3000);
            }

            // Hiển thị thông báo từ session
            @if (session('success'))
                showNotification("{{ session('success') }}", "success");
            @endif

            @if (session('error'))
                showNotification("{{ session('error') }}", "error");
            @endif
        });
    </script>

@endsection

<style>
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        max-width: 300px;
        background: #ffffff;
        color: #333;
        border-radius: 8px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        opacity: 0;
        pointer-events: none;
        transform: translateY(-10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .notification.show {
        opacity: 1;
        pointer-events: all;
        transform: translateY(0);
    }

    .notification.hide {
        opacity: 0;
        pointer-events: none;
        transform: translateY(-10px);
    }

    .notification i {
        font-size: 20px;
        color: inherit;
    }
</style>
