<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management Interface</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <div class="container-fluid min-vh-100 d-flex">
        <div class="row flex-grow-1 w-100">
            <div class="col-md-6 bg-primary d-flex flex-column">
                <div class="m-2 p-2 rounded">
                    <h5 class="text-white">Chờ chế biến</h5>
                </div>
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
                                            <button class="btn btn-danger cook-all"
                                                title="Chế biến toàn bộ">&gt;&gt;</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-md-6 bg-primary d-flex flex-column">
                <div class="m-2 p-2 d-flex justify-content-between">
                    <h5 class="text-white">Đã xong/ Chờ cung ứng</h5>
                </div>
                <div class="bg-white m-2 p-2 rounded flex-grow-1 d-flex flex-column" id="ChoCungUng">
                    @foreach ($items as $item)
                        @if ($item->status == 'chờ cung ứng')
                            <div class="order-card row" data-item-id="{{ $item->id }}">
                                <div class="col-md-6">
                                    <strong>{{ $item->dish->name }}</strong>
                                    <p>{{ $item->updated_at->format('d-m-Y H:i') }}
                                    </p>
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
                                            <button class="btn btn-success done-all"
                                                title="Cung ứng toàn bộ">&gt;&gt;</button>
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

    @vite('resources\js\kitchen.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
