<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var checkInterval = 1000;
        var delayBeforeStart = 20000;
        var desiredAmount = 2000;
        var desiredDescription = 'test';
        var transactionFound = false;
        var intervalId;

        // Hàm kiểm tra giao dịch
        function checkTransaction() {
            $.ajax({
                url: 'https://script.google.com/macros/s/AKfycbykL1FhIB2kEaReIq9wzGqfY1SY5cRxOvsmB7hVNc_IY3wqz_sDgVJVQCJCEWsn2CPE/exec', // Thay thế bằng URL hoặc route thực tế
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data && data.data && data.data.length > 0) {
                        var lastTransaction = data.data[data.data.length - 1];
                        if (lastTransaction['Giá trị'] == desiredAmount &&
                            lastTransaction['Mô tả'].includes(desiredDescription)) {
                            // Giao dịch khớp với điều kiện
                            $('#status').text('Thanh toán hoàn tất');
                            transactionFound = true;
                            //...
                            // Dừng việc kiểm tra
                            clearInterval(intervalId);
                        } else {
                            $('#status').text('Chưa tìm thấy giao dịch phù hợp.');
                        }
                    } else {
                        $('#status').text('Không có giao dịch nào.');
                    }
                },
                error: function(xhr, status, error) {
                    $('#status').text('Lỗi khi lấy dữ liệu: ' + error);
                }
            });
        }

        // Sự kiện khi bấm nút "Bắt đầu tìm kiếm"
        $('#bankPaymentBtn').click(function() {
            // Bắt đầu tìm kiếm sau 20 giây
            setTimeout(function() {
                // Bắt đầu kiểm tra mỗi giây
                intervalId = setInterval(function() {
                    if (!transactionFound) {
                        checkTransaction();
                    }
                }, checkInterval);
            }, delayBeforeStart);
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        // Hiển thị ngày và giờ hiện tại
        function updateTime() {
            const now = new Date();
            const options = {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            };
            const currentDate = now.toLocaleDateString('vi-VN', options);
            const currentTime = now.toLocaleTimeString('vi-VN', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            document.getElementById('currentDate').textContent = currentDate;
            document.getElementById('currentTime').textContent = currentTime;
        }

        setInterval(updateTime, 1000); // Cập nhật thời gian mỗi giây

        const cashGivenInput = document.getElementById('cashGiven');
        const changeAmount = document.getElementById('changeAmount');
        const totalAmount = 155000; // Tổng tiền hàng
        const deposit = document.getElementById('deposit');

        // Tính tiền thừa khi thanh toán tiền mặt
        cashGivenInput.addEventListener('input', function() {
            let cashGiven = parseInt(cashGivenInput.value.replace(/\D/g, '')); // Chỉ nhận số
            if (!isNaN(cashGiven)) {
                let change = cashGiven - totalAmount;
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
            let button = document.createElement('button');
            button.innerText = amount.toLocaleString();
            button.classList.add('btn', 'btn-secondary', 'm-1');

            // Xử lý khi bấm vào nút mệnh giá
            button.onclick = function() {
                cashGivenInput.value = amount.toLocaleString();

                // Tính lại tiền thừa khi bấm nút
                let cashGiven = parseInt(cashGivenInput.value.replace(/\D/g, '')); // Chỉ nhận số
                let deposit1 = parseInt(deposit.value.replace(/\D/g, '')); // Chỉ nhận số

                let change = cashGiven - totalAmount ;
                
                changeAmount.textContent = change > 0 ? change.toLocaleString('vi-VN') + ' VND' :
                    "0 VND";

                // Xóa trạng thái chọn ở các nút trước đó
                document.querySelectorAll('#payment-options button').forEach(btn => btn.classList
                    .remove('selected'));
                button.classList.add('selected');
            };

            paymentOptionsContainer.appendChild(button);
        });
    });
</script>
