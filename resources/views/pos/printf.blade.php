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
                    <h3>HÓA ĐƠN THANH TOÁN</h3>
                    <p>Mã hóa đơn: {{$order->id}}</p>
                </div>

                <div class="row mb-3">
                    <div class="row">
                        <div class="col-3">
                            <strong>Ngày:</strong>
                        </div>
                        <div class="col-9">
                            14/09/2016 (10:09 SA - 10:09 SA)
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <strong>Bàn:</strong>
                        </div>
                        <div class="col-9">
                           {{$table->table_number}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <strong>Thu ngân:</strong>
                        </div>
                        <div class="col-9">
                            {{$staff->name}}
                        </div>
                    </div>

                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên món</th>
                            <th>SL</th>
                            <th>ĐG</th>
                            <th>% KM</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lạc rang</td>
                            <td>3</td>
                            <td>20.000</td>
                            <td></td>
                            <td>60.000</td>
                        </tr>
                        <tr>
                            <td>Bia Hà Nội (Keg 2 Lít)</td>
                            <td>1</td>
                            <td>320.000</td>
                            <td>5</td>
                            <td>304.000</td>
                        </tr>
                        <tr>
                            <td>Cá bò khô nướng</td>
                            <td>2</td>
                            <td>73.000</td>
                            <td></td>
                            <td>146.000</td>
                        </tr>
                        <tr>
                            <td>Cánh gà xiên nướng</td>
                            <td>1</td>
                            <td>160.000</td>
                            <td></td>
                            <td>160.000</td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between">
                    <strong>Tổng thanh toán:</strong>
                    <strong>670.000đ</strong>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Tiền mặt:</span>
                    <span>670.000đ</span>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span>Trả lại khách:</span>
                    <span>0đ</span>
                </div>

                <div class="border-bottom-dotted mb-3"></div>

                <div class="text-center footer-text">
                    <b>Trân trọng cảm ơn!</b>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
