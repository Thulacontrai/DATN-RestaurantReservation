@extends('pos.layouts.master')

@section('title', 'Trang Thanh Toán Mới')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-between">
        <!-- Phần bên trái: Thông tin bàn -->
        <div class="col-md-4 mb-5">
            <div class="card shadow-lg border-0 p-4 bg-white rounded">
                <h5 class="text-muted text-center mb-4">Thông tin bàn</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-chair"></i> <strong>Số bàn:</strong></span>
                        <span>Bàn 12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-crown"></i> <strong>Loại bàn:</strong></span>
                        <span>VIP</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-users"></i> <strong>Số lượng khách:</strong></span>
                        <span>4</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-calendar-day"></i> <strong>Ngày:</strong></span>
                        <span id="currentDate"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-clock"></i> <strong>Thời gian:</strong></span>
                        <span id="currentTime"></span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Phần bên phải: Thông tin đơn hàng và tổng tiền -->
        <div class="col-md-8 mb-5">
            <div class="card shadow-lg p-4 bg-white rounded">
                <h4 class="text-muted text-center">Thông tin đơn hàng</h4>
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
                        <tr>
                            <td>Xúc xích Đức nướng mù tạt vàng</td>
                            <td class="text-center">1</td>
                            <td class="text-end">125,000 VND</td>
                            <td class="text-end">125,000 VND</td>
                        </tr>
                        <tr>
                            <td>BLOODY MARY</td>
                            <td class="text-center">1</td>
                            <td class="text-end">30,000 VND</td>
                            <td class="text-end">30,000 VND</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                            <td class="text-end text-success"><strong>155,000 VND</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Chọn phương thức thanh toán -->
    <div class="row justify-content-center mb-4">
        <!-- Thẻ thanh toán tiền mặt -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="payment-method-card card shadow-lg border-0 text-center p-3 payment-option hover-effect" id="cashPaymentBtn">
                <!-- Icon thanh toán tiền mặt -->
                <i class="fas fa-money-bill-wave fa-3x mb-2 text-success"></i>
                <h5 class="text-success">Thanh toán tiền mặt</h5>
            </div>
        </div>

        <!-- Thẻ thanh toán bằng thẻ -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="payment-method-card card shadow-lg border-0 text-center p-3 payment-option hover-effect" id="cardPaymentBtn">
                <!-- Icon thẻ ngân hàng -->
                <i class="fas fa-credit-card fa-3x mb-2 text-primary"></i>
                <h5 class="text-primary">Thanh toán bằng thẻ</h5>
            </div>
        </div>

        <!-- Thẻ chuyển khoản ngân hàng -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="payment-method-card card shadow-lg border-0 text-center p-3 payment-option hover-effect" id="bankPaymentBtn">
                <!-- Icon chuyển khoản ngân hàng -->
                <i class="fas fa-university fa-3x mb-2 text-info"></i>
                <h5 class="text-info">Chuyển khoản ngân hàng</h5>
            </div>
        </div>
    </div>

    <!-- Nội dung khi chọn phương thức thanh toán -->
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <!-- Thanh toán bằng tiền mặt -->
            <div id="cashPaymentSection" class="payment-details card d-none p-4 shadow-lg border-0">
                <h5 class="mb-4">Nhập số tiền khách đưa</h5>
                <input type="text" class="form-control form-control-lg mb-3" id="cashGiven" placeholder="Nhập số tiền...">
                <div id="cashChange" class="text-muted mb-3">Tiền thừa: <strong id="changeAmount">0 VND</strong></div>

                <!-- Tiền cọc -->
                <h5 class="mb-4">Nhập tiền cọc (nếu có)</h5>
                <input type="text" class="form-control form-control-lg mb-3" id="depositAmount" placeholder="Nhập tiền cọc...">

                <!-- In hóa đơn -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="printReceipt">
                    <label class="form-check-label" for="printReceipt">
                        In hóa đơn
                    </label>
                </div>
            </div>

            <!-- Thanh toán bằng thẻ -->
            <div id="cardPaymentSection" class="payment-details card d-none p-4 shadow-lg border-0">
                <h5 class="mb-4">Nhập thông tin thẻ ngân hàng</h5>
                <input type="text" class="form-control form-control-lg mb-3" placeholder="Số thẻ">
                <input type="text" class="form-control form-control-lg mb-3" placeholder="Tên chủ thẻ">
            </div>

            <!-- Chuyển khoản ngân hàng -->
            <div id="bankPaymentSection" class="payment-details card d-none p-4 shadow-lg border-0">
                <h5 class="mb-4">Thông tin chuyển khoản</h5>
                <p><strong>Ngân hàng:</strong> Vietcombank</p>
                <p><strong>Số tài khoản:</strong> 123456789</p>
                <p><strong>Chủ tài khoản:</strong> Nguyễn Văn A</p>
            </div>
        </div>
    </div>

    <!-- Phần tiền thừa và xác nhận thanh toán -->
    <div class="row justify-content-center mt-4">
        <div class="col-lg-6 col-md-8 text-center">
            <button class="btn btn-primary btn-lg btn-block mt-4" id="confirmPayment">Xác nhận thanh toán</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Hiển thị ngày và giờ hiện tại
        function updateTime() {
            const now = new Date();
            const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
            const currentDate = now.toLocaleDateString('vi-VN', options);
            const currentTime = now.toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            document.getElementById('currentDate').textContent = currentDate;
            document.getElementById('currentTime').textContent = currentTime;
        }

        setInterval(updateTime, 1000); // Cập nhật thời gian mỗi giây

        // Hiệu ứng chọn phương thức thanh toán
        const cashPaymentSection = document.getElementById('cashPaymentSection');
        const cardPaymentSection = document.getElementById('cardPaymentSection');
        const bankPaymentSection = document.getElementById('bankPaymentSection');
        const cashGivenInput = document.getElementById('cashGiven');
        const changeAmount = document.getElementById('changeAmount');
        const totalAmount = 155000; // Tổng tiền hàng

        const paymentOptions = document.querySelectorAll('.payment-option');
        paymentOptions.forEach(option => {
            option.addEventListener('click', function () {
                paymentOptions.forEach(opt => opt.classList.remove('selected-method'));
                this.classList.add('selected-method');

                if (this.id === 'cashPaymentBtn') {
                    cashPaymentSection.classList.remove('d-none');
                    cardPaymentSection.classList.add('d-none');
                    bankPaymentSection.classList.add('d-none');
                } else if (this.id === 'cardPaymentBtn') {
                    cardPaymentSection.classList.remove('d-none');
                    cashPaymentSection.classList.add('d-none');
                    bankPaymentSection.classList.add('d-none');
                } else if (this.id === 'bankPaymentBtn') {
                    bankPaymentSection.classList.remove('d-none');
                    cashPaymentSection.classList.add('d-none');
                    cardPaymentSection.classList.add('d-none');
                }
            });
        });

        // Tính tiền thừa khi thanh toán tiền mặt
        cashGivenInput.addEventListener('input', function () {
            let cashGiven = parseInt(cashGivenInput.value.replace(/\D/g, '')); // Chỉ nhận số
            if (!isNaN(cashGiven)) {
                let change = cashGiven - totalAmount;
                changeAmount.textContent = change > 0 ? change.toLocaleString('vi-VN') + ' VND' : "0 VND";
            } else {
                changeAmount.textContent = "0 VND";
            }
        });

        // Xác nhận thanh toán
        document.getElementById('confirmPayment').addEventListener('click', function () {
            // Nếu checkbox in hóa đơn được tích, hiển thị hóa đơn
            if (document.getElementById('printReceipt').checked) {
                alert('In hóa đơn...');
            }
            alert('Thanh toán thành công!');
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
