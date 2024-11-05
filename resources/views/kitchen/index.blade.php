<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management Interface</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('layouts/css.css') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>


</head>

<body>
    <div class="container-fluid min-vh-100 d-flex wrapper">
        <div class="row flex-grow-1 w-100" style="background-color: #00408C;">
            <div class="col-md-6 d-flex flex-column" style="background-color: #00408C; padding: 0 13px 0 0;">
                <div class="header">
                    <div class=" p-2 d-flex justify-content-between align-items-center header-left" style="min-height: 60px; margin: 8px !important;">
                        <h3 class="title">Chờ chế biến</h3>
                        <div class="kv-tabs">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="priority-tab" data-bs-toggle="tab" href="#priority" role="tab" aria-controls="priority" aria-selected="true">Ưu tiên</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="by-dish-tab" data-bs-toggle="tab" href="#by-dish" role="tab" aria-controls="by-dish" aria-selected="false">Theo món</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="by-room-tab" data-bs-toggle="tab" href="#by-room" role="tab" aria-controls="by-room" aria-selected="false">Theo phòng/bàn</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Tab content -->
                <div class="tab-content flex-grow-1" id="myTabContent">
                    <div class="tab-pane fade show active" id="priority" role="tabpanel" aria-labelledby="priority-tab">
                        <div class="bg-white m-2 p-2 rounded flex-grow-1 d-flex flex-column" id="DangCheBien">
                            @foreach ($items as $item)
                                @if ($item->status == 'đang chế biến')
                                    <div class="order-card row" data-item-id="{{ $item->id }}">
                                        <div class="col-md-6">
                                            <strong>{{ $item->dish->name }}</strong>
                                            <p>{{ $item->updated_at->format('d-m-Y H:i') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Số lượng</strong>
                                                    <p>{{ $item->quantity }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Bàn</strong>
                                                    <p>{{ $item->order->table->table_number }}</p>
                                                </div>
                                                <div class="col-md-4 btn-group-custom">
                                                    <button class="btn btn-danger cook-all" title="Chế biến toàn bộ">&gt;&gt;</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="by-dish" role="tabpanel" aria-labelledby="by-dish-tab">
                        <div class="bg-white m-2 p-2 rounded flex-grow-1 d-flex flex-column" id="DangCheBien">
                            @foreach ($items as $item)
                                @if ($item->status == 'đang chế biến')
                                    <div class="order-card row" data-item-id="{{ $item->id }}">
                                        <div class="col-md-6">
                                            <strong>{{ $item->dish->name }}</strong>
                                            <p>{{ $item->updated_at->format('d-m-Y H:i') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Số lượng</strong>
                                                    <p>{{ $item->quantity }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Bàn</strong>
                                                    <p>{{ $item->order->table->table_number }}</p>
                                                </div>
                                                <div class="col-md-4 btn-group-custom">
                                                    <button class="btn btn-danger cook-all" title="Chế biến toàn bộ">&gt;&gt;</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="by-room" role="tabpanel" aria-labelledby="by-room-tab">
                        <div class="bg-white m-2 p-2 rounded flex-grow-1 d-flex flex-column" id="DangCheBien">
                            @foreach ($items as $item)
                                @if ($item->status == 'đang chế biến')
                                    <div class="order-card row" data-item-id="{{ $item->id }}">
                                        <div class="col-md-6">
                                            <strong>{{ $item->dish->name }}</strong>
                                            <p>{{ $item->updated_at->format('d-m-Y H:i') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Số lượng</strong>
                                                    <p>{{ $item->quantity }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Bàn</strong>
                                                    <p>{{ $item->order->table->table_number }}</p>
                                                </div>
                                                <div class="col-md-4 btn-group-custom">
                                                    <button class="btn btn-danger cook-all" title="Chế biến toàn bộ">&gt;&gt;</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex flex-column" style="background-color: #00408C;">
                <div class="header">
                    <div class="m-2 p-2 d-flex justify-content-between align-items-center header-right" style="min-height: 60px;">
                        <h3 class="title">Chờ chế biến</h3>

                        <ul class="d-flex align-items-center">
                            <li title="Cài đặt">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#sortingModal">
                                    <i class="fas fa-cog text-white"></i>
                                </a>
                            </li>
                            <li title="Thông báo">
                                <a href="#">
                                    <i class="fas fa-bell text-white"></i>
                                </a>
                            </li>
                            <li title="Thu ngân">
                                <a href="#">
                                    <i class="fas fa-cash-register text-white"></i>
                                </a>
                            </li>
                            <li title="Quản trị">
                                <a href="#">
                                    <i class="fas fa-user-cog text-white"></i>
                                </a>
                            </li>
                            <li title="Đăng xuất">
                                <a href="#">
                                    <i class="fas fa-sign-out-alt text-white"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content flex-grow-1" id="myTabContent">
                    <div class="tab-pane fade show active">
                        <div class="bg-white m-2 p-2 rounded flex-grow-1 d-flex flex-column" id="ChoCungUng">
                            @foreach ($items as $item)
                                @if ($item->status == 'chờ cung ứng' || $item->status == 'đã xong')
                                    <div class="order-card row" data-item-id="{{ $item->id }}">
                                        <div class="col-md-6">
                                            <strong>{{ $item->dish->name }}</strong>
                                            <p>{{ $item->updated_at->format('d-m-Y H:i') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Số lượng</strong>
                                                    <p>{{ $item->quantity }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Bàn</strong>
                                                    <p>{{ $item->order->table->table_number }}</p>
                                                </div>
                                                <div class="col-md-4 btn-group-custom">
                                                    @if ($item->status == 'chờ cung ứng')
                                                        <button class="btn btn-success done-all" title="Cung ứng toàn bộ">&gt;&gt;</button>
                                                    @else
                                                        <button class="btn btn-info" title="Xem chi tiết">Xem</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Cài Đặt-->
            <div class="modal fade" id="sortingModal" tabindex="-1" aria-labelledby="sortingModalLabel" aria-hidden="true">
                <div class="modal-dialog" id="modalDialog">
                    <div class="modal-content">
                        <div class="modal-header" id="modalHeader">
                            <h5 class="modal-title" id="sortingModalLabel">Sắp xếp danh sách chờ cung ứng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="sortingOptions">Chọn cách sắp xếp:</label>
                                <select class="form-select" id="sortingOptions">
                                    <option value="room">Phòng bàn</option>
                                    <option value="newest">Mới nhất</option>
                                    <option value="oldest">Cũ nhất</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" id="applySorting">Áp dụng</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('DangCheBien').addEventListener('click', function(event) {
                if (event.target.classList.contains('cook-all')) {
                    const itemId = event.target.closest('.order-card').dataset.itemId;
                    fetch(`/kitchen/${itemId}/cook-all`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                console.log('Trạng thái đã được cập nhật');
                            } else {
                                alert('Có lỗi xảy ra: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                            alert('Có lỗi xảy ra khi gửi yêu cầu');
                        });
                }
            });
            document.getElementById('ChoCungUng').addEventListener('click', function(event) {
                if (event.target.classList.contains('done-all')) {
                    const itemId = event.target.closest('.order-card').dataset.itemId;
                    fetch(`/kitchen/${itemId}/done-all`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                console.log('Trạng thái đã được cập nhật');
                            } else {
                                alert('Có lỗi xảy ra: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                            alert('Có lỗi xảy ra khi gửi yêu cầu');
                        });
                }
            });
        });
    </script>

<script>
    const modalDialog = document.getElementById('modalDialog');
    const modalHeader = document.getElementById('modalHeader');
    let isDragging = false;
    let offsetX, offsetY;

    modalHeader.addEventListener('mousedown', (e) => {
        isDragging = true;
        offsetX = e.clientX - modalDialog.getBoundingClientRect().left;
        offsetY = e.clientY - modalDialog.getBoundingClientRect().top;
        modalDialog.style.transition = 'none';
    });

    document.addEventListener('mousemove', (e) => {
        if (isDragging) {
            modalDialog.style.left = e.clientX - offsetX + 'px';
            modalDialog.style.top = e.clientY - offsetY + 'px';
        }
    });

    document.addEventListener('mouseup', () => {
        isDragging = false;
        modalDialog.style.transition = '';
</script>


    @vite(['resources/js/app.js', 'resources/js/kitchen.js', 'resources/css/kitchen.css'])


</body>

</html>
