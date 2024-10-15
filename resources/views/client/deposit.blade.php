@extends('client.layouts.master')
@section('title', 'Đặt cọc')
@section('content')
    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-2.jpg',
        'subtitle' => 'Thanh toán',
        'title' => 'Đặt cọc',
        'currentPage' => 'Đặt cọc',
    ])
    <div id="content" class="no-bottom no-top">
        <section id="section-book-form">
            <form id="depositForm" action="{{ route('MOMOCheckout.client') }}" method="POST">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-7 p-5 border-color-1 rounded">
                            <!-- Thông tin đặt chỗ -->
                            <div class="">
                                <div class="row">
                                    <div class="col-5">
                                        <h3 class="">Thông tin đặt chỗ</h3>
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-5">
                                                <p id="info-name">Họ và tên</p>
                                                <p id="info-phone">Số điện thoại</p>
                                                <p id="info-people">Số người</p>
                                                <p id="info-datetime">Thời gian đặt</p>
                                                <p id="info-notes">Ghi chú</p>
                                            </div>
                                            <div class="col-7">
                                                <p id="info-name">{{ $showDeposit['user_name'] }}</p>
                                                <input type="hidden" name="user_name"
                                                    value="{{ $showDeposit['user_name'] }}">
                                                <p id="info-phone">{{ $showDeposit['user_phone'] }}</p>
                                                <input type="hidden" name="user_phone"
                                                    value="{{ $showDeposit['user_phone'] }}">
                                                <p id="info-people">{{ $showDeposit['guest_count'] }} người</p>
                                                <input type="hidden" name="guest_count"
                                                    value="{{ $showDeposit['guest_count'] }}">
                                                <p id="info-datetime">{{ $showDeposit['reservation_date'] }}
                                                    {{ $showDeposit['reservation_time'] }}</p>
                                                <input type="hidden" name="reservation_date"
                                                    value="{{ $showDeposit['reservation_date'] }}">
                                                <input type="hidden" name="reservation_time"
                                                    value="{{ $showDeposit['reservation_time'] }}">
                                                <p id="info-notes">{{ $showDeposit['note'] ?? null }}</p>
                                                <input type="hidden" name="note"
                                                    value="{{ $showDeposit['note'] ?? null }}">
                                                <input type="hidden" name="orderId" value="{{ $orderId }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <!-- Chi tiết cọc -->
                            <div class="row">
                                <div class="col">
                                    <div class="p-4 bg-dark rounded">
                                        <h3 class="">Chi tiết cọc</h3>
                                        <div class="row pt-2">
                                            <div class="col-5">
                                                <p>Số tiền cọc/người</p>
                                                <p>Số người</p>
                                                <p>Tổng tiền cọc</p>
                                            </div>
                                            <div class="col-7">
                                                <p>100.000 đ</p>
                                                <p>{{ $showDeposit['guest_count'] }}</p>
                                                <p>{{ number_format($deposit) }} đ</p>
                                                <input type="hidden" name="deposit" value="{{ $deposit }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Phương thức thanh toán -->
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="p-4 bg-dark rounded">
                                        <h3 class="">Phương thức thanh toán</h3>

                                        <div class="pt-2">
                                            <input type="radio" name="payment" id="payUrl" value="payUrl" checked>
                                            <label for="payUrl">Momo</label>
                                            <br>
                                            <input type="radio" name="payment" id="vnpay" value="vnpay">
                                            <label for="vnpay">QR Code</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between mt-4">
                        <div class="col-3">
                            <a href="{{ route('customer.information', ['date' => $showDeposit['reservation_date'], 'time' => $showDeposit['reservation_time'], 'note' => $showDeposit['note'] ?? null, 'guest_count' => $showDeposit['guest_count'], 'user_phone' => $showDeposit['user_phone'], 'user_name' => $showDeposit['user_name']]) }}"
                                class="text-secondary">Quay lại trang đặt bàn</a>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn-line">Thanh toán</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const depositForm = document.getElementById('depositForm');
            const vnpayOption = document.getElementById('vnpay');
            const payUrlOption = document.getElementById('payUrl');

            depositForm.addEventListener('submit', function(event) {
                if (vnpayOption.checked) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Đang chờ thanh toán...',
                        html: 'Vui lòng thực hiện quét mã thanh toán...',
                        imageUrl: 'https://img.vietqr.io/image/MB-0964236835-compact2.png?amount={{ $deposit }}&addInfo=Thanh toan coc don dat ban {{ $orderId }}',
                        imageWidth: 400,
                        imageHeight: 450,
                        showCloseButton: true,
                        showCancelButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                            handleVnpayTask().then(() => {
                                depositForm.submit();
                            }).catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: error.message,
                                    confirmButtonText: 'OK'
                                });
                            });
                        }
                    });
                }
            });

            function handleVnpayTask() {
                return new Promise((resolve, reject) => {
                    $(document).ready(function() {
                        var checkInterval = 1000; // khoảng thời gian lặp lại (1 giây)
                        var desiredAmount = {{ $deposit }}; // số tiền cần tìm
                        var desiredDescription =
                        'Thanh toan coc don dat ban {{ $orderId }}'; // mô tả cần tìm
                        var intervalId = setInterval(checkTransaction, checkInterval);

                        function checkTransaction() {
                            $.ajax({
                                url: 'https://script.google.com/macros/s/AKfycbwsNblgurg5Wig7qUO0TNmDmwlJocExVGzMR5wCacLO1vJvRe9Zq9MW4sjrY0fdIdFv/exec',
                                type: 'GET',
                                dataType: 'json',
                                success: function(data) {
                                    var transactions = data
                                    .data; // toàn bộ các giao dịch

                                    var foundTransaction =
                                    false; // biến để xác định có tìm thấy giao dịch hợp lệ hay không

                                    // Duyệt qua tất cả các giao dịch để tìm giao dịch phù hợp
                                    transactions.forEach(function(transaction) {
                                        if (transaction['Giá trị'] ==
                                            desiredAmount &&
                                            transaction['Mô tả'].includes(
                                                desiredDescription)) {
                                            foundTransaction = true;

                                            // Hiển thị thông báo thành công nếu tìm thấy giao dịch hợp lệ
                                            Swal.fire({
                                                position: "center",
                                                icon: "success",
                                                title: "Thanh toán thành công",
                                                showConfirmButton: false,
                                                timer: 2000
                                            }).then(() => {
                                                clearInterval(
                                                    intervalId); // Dừng kiểm tra
                                                resolve
                                            (); // Hoàn thành Promise
                                            });
                                        }
                                    });

                                    // Nếu không tìm thấy giao dịch nào phù hợp, tiếp tục kiểm tra sau
                                    if (!foundTransaction) {
                                        console.log('Chưa tìm thấy giao dịch phù hợp.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    reject(new Error('Lỗi khi lấy dữ liệu: ' +
                                    error)); // Xử lý lỗi nếu có
                                }
                            });
                        }
                    });
                });
            }


        });
    </script>
    @if (session('err'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: '{{ session('err') }}',
                    timer: 2000,
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
@endsection
