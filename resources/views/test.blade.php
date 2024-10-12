<form action="{{ route('Ppayment', '1') }}" method="POST">
    @csrf
    <input type="hidden" name="total_amount" value="3000">
    <input type="hidden" name="order_item[]" value="1">
    <input type="hidden" name="order_item[]" value="2">
    <input type="hidden" name="quantity[]" value="1">
    <input type="hidden" name="quantity[]" value="2">
    <input type="hidden" name="price[]" value="1000">
    <input type="hidden" name="price[]" value="1000">
    <input type="submit" value="1">
</form>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




<?php
$banksCode = '970414';
$accountNumber = '0964236835';
$total_amount = 1;
$orderId = 1;
?>
<select>
    @foreach ($banks as $bank)
        <option value="{{ $bank['bin'] }}">{{ $bank['name'] }}({{ $bank['code'] }})</option>
    @endforeach
</select>

<form action="">
    <select name="" id="">
        <option value="">Không phải là chờ hoàn cọc</option>
        <option value="" selected>Chờ hoàn cọc</option>
    </select>
    <input type="submit" id="bankPaymentBtn" data-toggle="modal" data-target="#bankPaymentSection" value="Xác nhận">
</form>
<div id="bankPaymentSection" class="modal fade" tabindex="-1" aria-labelledby="bankPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bankPaymentLabel">Thông tin chuyển khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="https://img.vietqr.io/image/{{ $banksCode }}-{{ $accountNumber }}-compact2.png?amount={{ $total_amount }}&addInfo=Thanh Toan Don Hang {{ $orderId }}"
                    alt="">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $(document).ready(function() {
            var checkInterval = 1000; // Kiểm tra mỗi giây
            var delayBeforeStart = 1; // Bắt đầu kiểm tra sau 20 giây
            var desiredAmount = -{{ $total_amount }};
            var desiredDescription = 'Hoan Coc Don Hang ' + {{ $orderId }};
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
                            });
                            transactionFound = true;
                            clearInterval(intervalId);
                            $('form').submit();
                        } else {
                            console.log(1);
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#status').text('Lỗi khi lấy dữ liệu: ' + error);
                    }
                });
            }

            // Sự kiện khi bấm nút "Xác nhận"
            $('#bankPaymentBtn').click(function(event) {
                event.preventDefault();
                // Bắt đầu tìm kiếm sau 20 giây
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
