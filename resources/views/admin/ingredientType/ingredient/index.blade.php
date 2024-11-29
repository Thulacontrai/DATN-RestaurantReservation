@extends('admin.master')

@section('title', 'Danh Sách Nguyên Liệu')

@section('content')
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh Sách Nguyên Liệu</div>
                            <form id="search-form" class="d-flex">
                                <input type="text" id="search-input" name="search" class="form-control me-2"
                                    placeholder="Tìm nguyên liệu" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" id="search-button">
                                    <i class="bi bi-search me-2"></i>
                                </button>
                            </form>

                            <a href="{{ route('admin.ingredient.import') }}">
                                <button type="button" id="import-button"
                                    class="btn btn-sm btn-success d-flex align-items-center">
                                    <i class="bi bi-file-earmark-arrow-up me-2"></i> Import Excel
                                </button>
                            </a>
                            <a href="{{ route('admin.ingredient.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>

                        <div class="card-body">

                            <!-- Bảng Đồ Tươi -->
                            <h5 class="mb-3 text-success">Đồ Tươi</h5>
                            <table class="table v-middle m-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>
                                            <a
                                                href="{{ route('admin.ingredient.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                                ID
                                                <i
                                                    class="bi bi-arrow-{{ request('sort') === 'id' && request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                            </a>
                                        </th>
                                        <th>Tên Nguyên Liệu</th>
                                        <th>
                                            <a
                                                href="{{ route('admin.ingredient.index', array_merge(request()->query(), ['sort' => 'price', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                                Giá
                                                <i
                                                    class="bi bi-arrow-{{ request('sort') === 'price' && request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a
                                                href="{{ route('admin.ingredient.index', array_merge(request()->query(), ['sort' => 'unit', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                                Đơn Vị
                                                <i
                                                    class="bi bi-arrow-{{ request('sort') === 'unit' && request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                            </a>
                                        </th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($freshIngredients as $ingredient)
                                        <tr>
                                            <td>{{ $ingredient->id }}</td>
                                            <td>{{ $ingredient->name }}</td>
                                            <td>{{ number_format($ingredient->price, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ $ingredient->unit }}</td>
                                            <td>
                                                <div class="actions d-flex gap-2" style="justify-content: center;">
                                                    <a href="{{ route('admin.ingredient.show', $ingredient->id) }}"
                                                        class="text-success" title="Xem">
                                                        <i class="bi bi-list"></i>
                                                    </a>
                                                    <a href="{{ route('admin.ingredient.edit', $ingredient->id) }}"
                                                        class="text-warning" title="Chỉnh sửa">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="">
                                                        <form
                                                            action="{{ route('admin.ingredient.destroy', $ingredient->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="border-0 bg-transparent text-danger"
                                                                style="margin-top: 15px" title="Xóa"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $freshIngredients->appends(['cannedPage' => request('cannedPage')])->links() }}
                            </div>

                            <!-- Bảng Đồ Đóng Hộp -->
                            <h5 class="mt-5 mb-3 text-primary">Đồ Đóng Hộp</h5>
                            <table class="table v-middle m-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>
                                            <a
                                                href="{{ route('admin.ingredient.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                                ID
                                                <i
                                                    class="bi bi-arrow-{{ request('sort') === 'id' && request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                            </a>
                                        </th>
                                        <th>Tên Nguyên Liệu</th>
                                        <th>
                                            <a
                                                href="{{ route('admin.ingredient.index', array_merge(request()->query(), ['sort' => 'price', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                                Giá
                                                <i
                                                    class="bi bi-arrow-{{ request('sort') === 'price' && request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a
                                                href="{{ route('admin.ingredient.index', array_merge(request()->query(), ['sort' => 'unit', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                                Đơn Vị
                                                <i
                                                    class="bi bi-arrow-{{ request('sort') === 'unit' && request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                            </a>
                                        </th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cannedIngredients as $ingredient)
                                        <tr>
                                            <td>{{ $ingredient->id }}</td>
                                            <td>{{ $ingredient->name }}</td>
                                            <td>{{ number_format($ingredient->price, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ $ingredient->unit }}</td>
                                            <td>
                                                <div class="actions d-flex gap-2" style="justify-content: center;">
                                                    <a href="{{ route('admin.ingredient.show', $ingredient->id) }}"
                                                        class="text-primary" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Chi tiết">
                                                        <i class="bi bi-list"></i>
                                                    </a>
                                                    <a href="{{ route('admin.ingredient.edit', $ingredient->id) }}"
                                                        class="text-warning" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Sửa">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="">
                                                        <form
                                                            action="{{ route('admin.ingredient.destroy', $ingredient->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="border-0 bg-transparent text-danger"
                                                                style="margin-top: 15px" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Xoá"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $cannedIngredients->appends(['freshPage' => request('freshPage')])->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        document.getElementById('search-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Ngừng gửi form mặc định

            const searchTerm = document.getElementById('search-input').value;

            // Tạo URL mới với tham số tìm kiếm
            const url = new URL(window.location);
            url.searchParams.set('search', searchTerm); // Cập nhật tham số tìm kiếm

            // Chuyển hướng đến URL mới
            window.location = url;
        });
    </script>

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

    #search-input {
        width: 180px;
        /* Điều chỉnh chiều rộng ô input */
        font-size: 14px;
        /* Điều chỉnh kích thước chữ trong ô input */
    }

    #search-button {
        font-size: 14px;
        /* Điều chỉnh kích thước chữ trong nút button */
        padding: 6px 12px;
        /* Điều chỉnh padding để nút nhỏ hơn */
    }
</style>
