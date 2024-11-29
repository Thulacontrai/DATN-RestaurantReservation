@extends('admin.master')

@section('title', 'Thùng Rác')

@section('content')



    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Thùng Rác</div>
                            <a href="{{ route('admin.table.index') }}" class="btn btn-sm btn-primary">
                                Quay lại danh sách bàn
                            </a>
                        </div>
                        <div class="card-body">
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
                                                <td><span class="badge shade-red">Đã Xóa</span></td>
                                                <td>
                                                    <div class="actions">
                                                        <!-- Restore -->
                                                        <form action="{{ route('admin.table.restore', $table->id) }}"
                                                            method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục không?');">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-link p-0"
                                                                title="Khôi phục">
                                                                <i class="bi bi-arrow-clockwise text-green"></i>
                                                            </button>
                                                        </form>
                                                        <!-- Permanently delete -->
                                                        <form action="{{ route('admin.table.forceDelete', $table->id) }}"
                                                            method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link p-0"
                                                                title="Xóa vĩnh viễn">
                                                                <i class="bi bi-trash text-red"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Không có bàn nào trong thùng rác.
                                                </td>
                                            </tr>
                                        @endforelse
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


    /* From Uiverse.io by Galahhad */
    .switch {
        /* switch */
        --switch-width: 46px;
        --switch-height: 24px;
        --switch-bg: rgb(131, 131, 131);
        --switch-checked-bg: rgb(0, 218, 80);
        --switch-offset: calc((var(--switch-height) - var(--circle-diameter)) / 2);
        --switch-transition: all .2s cubic-bezier(0.27, 0.2, 0.25, 1.51);
        /* circle */
        --circle-diameter: 18px;
        --circle-bg: #fff;
        --circle-shadow: 1px 1px 2px rgba(146, 146, 146, 0.45);
        --circle-checked-shadow: -1px 1px 2px rgba(163, 163, 163, 0.45);
        --circle-transition: var(--switch-transition);
        /* icon */
        --icon-transition: all .2s cubic-bezier(0.27, 0.2, 0.25, 1.51);
        --icon-cross-color: var(--switch-bg);
        --icon-cross-size: 6px;
        --icon-checkmark-color: var(--switch-checked-bg);
        --icon-checkmark-size: 10px;
        /* effect line */
        --effect-width: calc(var(--circle-diameter) / 2);
        --effect-height: calc(var(--effect-width) / 2 - 1px);
        --effect-bg: var(--circle-bg);
        --effect-border-radius: 1px;
        --effect-transition: all .2s ease-in-out;
    }

    .switch input {
        display: none;
    }

    .switch {
        display: inline-block;
    }

    .switch svg {
        -webkit-transition: var(--icon-transition);
        -o-transition: var(--icon-transition);
        transition: var(--icon-transition);
        position: absolute;
        height: auto;
    }

    .switch .checkmark {
        width: var(--icon-checkmark-size);
        color: var(--icon-checkmark-color);
        -webkit-transform: scale(0);
        -ms-transform: scale(0);
        transform: scale(0);
    }

    .switch .cross {
        width: var(--icon-cross-size);
        color: var(--icon-cross-color);
    }

    .slider {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        width: var(--switch-width);
        height: var(--switch-height);
        background: var(--switch-bg);
        border-radius: 999px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        position: relative;
        -webkit-transition: var(--switch-transition);
        -o-transition: var(--switch-transition);
        transition: var(--switch-transition);
        cursor: pointer;
    }

    .circle {
        width: var(--circle-diameter);
        height: var(--circle-diameter);
        background: var(--circle-bg);
        border-radius: inherit;
        -webkit-box-shadow: var(--circle-shadow);
        box-shadow: var(--circle-shadow);
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-transition: var(--circle-transition);
        -o-transition: var(--circle-transition);
        transition: var(--circle-transition);
        z-index: 1;
        position: absolute;
        left: var(--switch-offset);
    }

    .slider::before {
        content: "";
        position: absolute;
        width: var(--effect-width);
        height: var(--effect-height);
        left: calc(var(--switch-offset) + (var(--effect-width) / 2));
        background: var(--effect-bg);
        border-radius: var(--effect-border-radius);
        -webkit-transition: var(--effect-transition);
        -o-transition: var(--effect-transition);
        transition: var(--effect-transition);
    }

    /* actions */

    .switch input:checked+.slider {
        background: var(--switch-checked-bg);
    }

    .switch input:checked+.slider .checkmark {
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
    }

    .switch input:checked+.slider .cross {
        -webkit-transform: scale(0);
        -ms-transform: scale(0);
        transform: scale(0);
    }

    .switch input:checked+.slider::before {
        left: calc(100% - var(--effect-width) - (var(--effect-width) / 2) - var(--switch-offset));
    }

    .switch input:checked+.slider .circle {
        left: calc(100% - var(--circle-diameter) - var(--switch-offset));
        -webkit-box-shadow: var(--circle-checked-shadow);
        box-shadow: var(--circle-checked-shadow);
    }
</style>
