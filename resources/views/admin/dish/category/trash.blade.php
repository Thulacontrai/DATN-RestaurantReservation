@extends('admin.master')

@section('title', 'Thùng Rác Loại Danh Mục')

@section('content')

    <!-- Thông báo -->
    <div id="notification" class="notification d-none">
        <div class="notification-icon">
            <i class="bi"></i>
        </div>
        <div class="notification-content">
            <strong id="notification-title"></strong>
            <p id="notification-message"></p>
        </div>
    </div>

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
                                                            <button type="submit" class="btn btn-link p-0 " style="margin-top: 15px;">
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
                                                            <button type="submit" class="btn btn-link p-0" style="margin-top: 15px;">
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


<script>
    document.addEventListener("DOMContentLoaded", function() {
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
