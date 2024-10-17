@extends('pos.layouts.master')

@section('title', 'Phiếu thanh toán')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-between">
            <!-- Phần bên trái: Thông tin bàn -->
            <div class="col-md-4">
                <div class="card shadow-lg border-0 p-4 bg-white rounded">
                    <h5 class="text-muted text-center mb-4">Thông tin đặt bàn</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-chair"></i> <strong>Số bàn:</strong></span>
                            <span>{{ $table->table_number }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-crown"></i> <strong>Loại bàn:</strong></span>
                            <span>{{ $table->table_type }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-users"></i> <strong>Số lượng khách:</strong></span>
                            <span>{{ $reservation->guest_count }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-calendar-day"></i> <strong>Ngày:</strong></span>
                            <span>{{ $reservation->reservation_date }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-clock"></i> <strong>Giờ vào: </strong></span>
                            <span>{{ $reservation_table->start_time }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-clock"></i> <strong>Giờ ra:</strong></span>
                            <span id="currentTime"></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Phần bên phải: Thông tin đơn hàng và tổng tiền -->
            <div class="col-md-8">
                <div class="card shadow-lg p-4 bg-white rounded">
                    <h4 class="text-muted text-center">Thông tin món ăn</h4>
                    <table class="table mt-3 table-hover">
                        <thead class="thead-light bg-primary text-light">
                            <tr>
                                <th scope="col">Tên món ăn</th>
                                <th scope="col" class="text-center">Số lượng</th>
                                <th scope="col" class="text-end">Đơn giá</th>
                                <th scope="col" class="text-end">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_items as $index => $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">{{ $quantity[$index] }}</td>
                                    <td class="text-end">{{ $price[$index] }}</td>
                                    <td class="text-end">{{ $amount = $price[$index] * $quantity[$index] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                <td class="text-end text-success"><strong>{{ $total_amount }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Chọn phương thức thanh toán -->
        <div class="row justify-content-center ">
            <!-- Thẻ thanh toán tiền mặt -->
            <div class="col-lg-4 col-md-6">
                <div class="payment-method-card card shadow-lg border-0 text-center p-3 payment-option hover-effect"
                    id="cashPaymentBtn" data-toggle="modal" data-target="#cashPaymentSection">
                    <!-- Icon thanh toán tiền mặt -->
                    <i class="fas fa-money-bill-wave fa-3x mb-2 text-success"></i>
                    <h5 class="text-success">Thanh toán tiền mặt</h5>
                </div>
            </div>

            <!-- Thẻ chuyển khoản ngân hàng -->
            <div class="col-lg-4 col-md-6">
                <div class="payment-method-card card shadow-lg border-0 text-center p-3 payment-option hover-effect"
                    id="bankPaymentBtn" data-toggle="modal" data-target="#bankPaymentSection">
                    <!-- Icon chuyển khoản ngân hàng -->
                    <i class="fas fa-university fa-3x mb-2 text-info"></i>
                    <h5 class="text-info">Chuyển khoản ngân hàng</h5>
                </div>
            </div>
        </div>

        <!-- Nội dung khi chọn phương thức thanh toán -->
        <div class="col-lg-6 col-md-8">
            <!-- Thanh toán bằng tiền mặt -->

            <div class="modal fade" id="cashPaymentSection" tabindex="-1" aria-labelledby="cashPaymentLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="formm" action="{{ route('checkout.admin', $orderId) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="cashPaymentLabel">Thanh toán bằng tiền mặt</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Khách cần trả: <strong id="total-amount">{{ $total_amount }}</strong> VNĐ</p>
                                <input type="text" class="form-control form-control-lg mb-3" id="cashGiven"
                                    placeholder="Nhập số tiền...">
                                <div id="payment-options"></div>
                                <div class="text-muted mb-3">Tiền cọc: <strong
                                        id="deposit">{{ $reservation->deposit_amount }}</strong> VND</div>
                                <div id="cashChange" class="text-muted mb-3">Tiền thừa trả khách: <strong
                                        id="changeAmount">0
                                        VND</strong>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="end_time" value="{{ date('H:i:s') }}">
                                <input type="hidden" name="payment_method" value="cash">
                                @foreach ($order_items as $item)
                                    <input type="hidden" name="item_name[]" value="{{ $item->id }}">
                                    <input type="hidden" name="quantity[]" value="1">
                                @endforeach
                                <button type="button" class="btn btn-secondary " data-dismiss="modal">Quay
                                    lại</button>
                                <button type="submit" id="btn-formm" class="btn btn-primary">Xác nhận thanh
                                    toán</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <iframe id="printFrame" style="display:none;"></iframe>

    <!-- Chuyển khoản ngân hàng -->
    <div id="bankPaymentSection" class="modal fade" tabindex="-1" aria-labelledby="bankPaymentLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bankPaymentLabel">Thông tin chuyển khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="https://img.vietqr.io/image/MB-0964236835-compact2.png?amount={{ $total_amount }}&addInfo=Thanh Toan Don Hang {{ $orderId }}"
                        alt="">
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hiển thị ngày và giờ hiện tại
            function updateTime() {
                const now = new Date();
                const currentTime = now.toLocaleTimeString('vi-VN', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                document.getElementById('currentTime').textContent = currentTime;
            }

            setInterval(updateTime, 1000); // Cập nhật thời gian mỗi giây

            const cashGivenInput = document.getElementById('cashGiven');
            const depositElement = document.getElementById('deposit');
            const deposit = parseInt(depositElement.textContent);
            const changeAmount = document.getElementById('changeAmount');
            const totalAmount = {{ $total_amount }}; // Tổng tiền hàng
            const submitButton = document.getElementById("btn-formm");

            // Ban đầu disable nút submit
            submitButton.disabled = true;

            // Hàm kiểm tra và toggle trạng thái nút submit
            function toggleSubmitButton() {
                const cashGiven = parseInt(cashGivenInput.value.replace(/\D/g, '')) || 0; // Giá trị nhập vào
                const change = cashGiven - totalAmount; // Tiền thừa

                // Nếu nhập số tiền hợp lệ (tiền thừa >= 0) thì kích hoạt nút submit
                if (cashGiven > 0 && change >= 0) {
                    submitButton.disabled = false; // Kích hoạt nút submit
                } else {
                    submitButton.disabled = true; // Vô hiệu hóa nút submit
                }
            }

            // Sự kiện khi người dùng nhập vào ô "Nhập số tiền"
            cashGivenInput.addEventListener('input', function() {
                toggleSubmitButton();
            });

            submitButton.addEventListener('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Xác nhận thanh toán',
                    text: `Thanh toán thành công`,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    document.getElementById('formm').submit();
                });
            });

            // Tính tiền thừa khi thanh toán tiền mặt
            cashGivenInput.addEventListener('input', function() {
                let cashGiven = parseInt(cashGivenInput.value.replace(/\D/g, '')); // Chỉ nhận số
                if (!isNaN(cashGiven)) {
                    let change = cashGiven - totalAmount + deposit;
                    changeAmount.textContent = change > 0 ? change.toLocaleString('vi-VN') + ' VND' :
                        "0 VND";
                } else {
                    changeAmount.textContent = "0 VND";
                }
            });

            function roundUpToNearest100000(amount) {
                return Math.ceil(amount / 100000) * 100000;
            }

            // Hiển thị số tiền khách cần trả
            document.getElementById('total-amount').innerText = totalAmount.toLocaleString();

            // Thêm dấu phẩy khi nhập số vào ô input
            function formatInput(input) {
                let value = input.value.replace(/,/g, ''); // Loại bỏ dấu phẩy
                input.value = parseInt(value || 0).toLocaleString();
            }

            // Xử lý khi nhập vào ô "Khách thanh toán"
            cashGivenInput.addEventListener('input', function() {
                formatInput(this);
            });

            // Tạo các nút mệnh giá, bắt đầu với số tiền khách cần trả
            let paymentOptions = [totalAmount]; // Ô đầu tiên bằng số tiền khách cần trả

            // Sau đó làm tròn lên số chia hết cho 100,000 và tiếp tục tăng
            let payingAmount = roundUpToNearest100000(totalAmount); // Làm tròn để chia hết cho 100000

            for (let i = 1; i <= 5; i++) {
                paymentOptions.push(payingAmount + 100000 * (i - 1)); // Tăng dần với bước 100,000
            }

            // Thêm các nút mệnh giá vào giao diện
            let paymentOptionsContainer = document.getElementById('payment-options');
            paymentOptions.forEach(amount => {
                let button = document.createElement('a');
                button.innerText = amount.toLocaleString();
                button.classList.add('btn', 'btn-secondary', 'm-1', 'text-light');

                // Xử lý khi bấm vào nút mệnh giá
                button.onclick = function() {
                    cashGivenInput.value = amount.toLocaleString();

                    // Tính lại tiền thừa khi bấm nút
                    let cashGiven = parseInt(cashGivenInput.value.replace(/\D/g, '')); // Chỉ nhận số
                    let change = cashGiven - totalAmount + deposit;
                    changeAmount.textContent = change > 0 ? change.toLocaleString('vi-VN') + ' VND' :
                        "0 VND";

                    // Xóa trạng thái chọn ở các nút trước đó
                    document.querySelectorAll('#payment-options button').forEach(btn => btn.classList
                        .remove('selected'));
                    button.classList.add('selected');
                    toggleSubmitButton();
                };

                paymentOptionsContainer.appendChild(button);
            });


            $(document).ready(function() {
                var checkInterval = 1000;
                var delayBeforeStart = 2000;
                var desiredAmount = {{ $total_amount }};
                var desiredDescription = 'Thanh Toan Don Hang ' + {{ $orderId }};
                var transactionFound = false;
                var intervalId;

                // Hàm kiểm tra giao dịch
                function checkTransaction() {
                    $.ajax({
                        url: 'https://script.google.com/macros/s/AKfycbykL1FhIB2kEaReIq9wzGqfY1SY5cRxOvsmB7hVNc_IY3wqz_sDgVJVQCJCEWsn2CPE/exec',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var lastTransaction = data.data[data.data.length - 1];
                            if (lastTransaction['Giá trị'] == desiredAmount &&
                                lastTransaction['Mô tả'].includes(desiredDescription)) {

                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Thanh toán thành công",
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => {
                                    $.ajax({
                                        url: "{{ route('print.page', $orderId) }}",
                                        method: 'GET',
                                        data: {
                                            key1: 'value1',
                                            key2: 'value2'
                                        },
                                        success: function(response) {
                                            var printFrame = document
                                                .getElementById(
                                                    'printFrame')
                                                .contentWindow;

                                            // Chèn nội dung vào iframe và in
                                            printFrame.document.open();
                                            printFrame.document.write(
                                                response);
                                            printFrame.document.close();

                                            // Đợi quá trình in hoàn thành trước khi submit form
                                            printFrame.focus();
                                            printFrame.print();

                                            setTimeout(function() {
                                                    // Tạo form động và submit
                                                    let form = $(
                                                        '<form>', {
                                                            action: "{{ route('checkout.admin', $orderId) }}",
                                                            method: 'POST'
                                                        });

                                                    form.append($(
                                                        '<input>', {
                                                            type: 'hidden',
                                                            name: '_token',
                                                            value: '{{ csrf_token() }}'
                                                        }));

                                                    form.append($(
                                                        '<input>', {
                                                            type: 'hidden',
                                                            name: 'end_time',
                                                            value: new Date()
                                                                .toLocaleTimeString()
                                                        }));

                                                    form.append($(
                                                        '<input>', {
                                                            type: 'hidden',
                                                            name: 'payment_method',
                                                            value: 'bank'
                                                        }));

                                                    var orderItems =
                                                        @json($order_items);
                                                    $.each(orderItems,
                                                        function(
                                                            index,
                                                            item) {
                                                            if (
                                                                item
                                                            ) {
                                                                form.append(
                                                                    $('<input>', {
                                                                        type: 'hidden',
                                                                        name: 'item_name[]',
                                                                        value: item
                                                                            .id
                                                                    })
                                                                );
                                                                form.append(
                                                                    $('<input>', {
                                                                        type: 'hidden',
                                                                        name: 'quantity[]',
                                                                        value: 1
                                                                    })
                                                                );
                                                            }
                                                        });
                                                    $('body').append(
                                                        form);
                                                    form.submit();
                                                },
                                                1000
                                            ); // Đợi 1 giây cho quá trình in hoàn tất trước khi submit
                                        },
                                        error: function() {
                                            alert(
                                                'Lỗi khi tải nội dung in.'
                                            );
                                        }
                                    });
                                });

                                transactionFound = true;
                                clearInterval(intervalId); // Dừng việc kiểm tra giao dịch
                            } else {
                                $('#status').text('Chưa tìm thấy giao dịch phù hợp.');
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#status').text('Lỗi khi lấy dữ liệu: ' + error);
                        }
                    });
                }

                // Sự kiện khi bấm nút "Bắt đầu tìm kiếm"
                $('#bankPaymentBtn').click(function() {
                    setTimeout(function() {
                        intervalId = setInterval(function() {
                            if (!transactionFound) {
                                checkTransaction();
                            }
                        }, checkInterval);
                    }, delayBeforeStart);
                });
            });
        });
    </script>

    <style>
        .card {
            border-radius: 15px;
        }

        .payment-option:hover {
            transform: scale(1.02);
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .hover-effect {
            transition: all 0.3s ease;
        }

        .selected-method {
            background-color: #f8f9fa !important;
            border: 2px solid #007bff;
        }

        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        }

        .list-group-item {
            font-size: 1.1rem;
        }

        .list-group-item i {
            margin-right: 8px;
        }
    </style>
@endsection
