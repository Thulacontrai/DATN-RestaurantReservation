<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="row d-flex justify-content-center">
        <div class="col-9 border border-3">
            <div class="receipt m-4">
                <div class="text-center">
                    <h1>STEAKS HOUSE</h1>
                    <p>Địa chỉ: Số 1 Trịnh Văn Bô, Nam Từ Liêm, Hà Nội</p>
                    <h3>HÓA ĐƠN THANH TOÁN</h3>
                    <p>Mã hóa đơn: {{ $order->id }}</p>
                </div>

                <div class="row mb-3">
                    <div class="row">
                        <div class="col-3">
                            <strong>Ngày:</strong>
                        </div>
                        <div class="col-9">
                            {{ DateTime::createFromFormat('Y-m-d', $reservation_table->reservation_date)->format('d-m-Y') }}
                            (Giờ vào: {{ $reservation_table->start_time }} -
                            Giờ ra: {{ $data }})
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <strong>Bàn:</strong>
                        </div>
                        <div class="col-9">
                            {{ $table->table_number }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <strong>Thu ngân:</strong>
                        </div>
                        <div class="col-9">
                            {{ $staff->name }}
                        </div>
                    </div>

                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên món</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>% Khuyến mãi</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item as $key => $item)
                            <tr>
                                <td>{{ $dishes[$key]->name ?? 'N/A' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price) }} VND</td>
                                <td></td>
                                <td>{{ number_format($item->total_price) }} VND</td>
                                <?php $final += $item->total_price; ?>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="d-flex justify-content-between">
                    <strong>Tổng thanh toán:</strong>
                    <strong>{{ number_format($final) }} VND</strong>
                </div>
                <div class="text-center footer-text">
                    <b>Trân trọng cảm ơn!</b>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
