<!DOCTYPE html>
<html>
<head>
    <title>Hóa đơn của bạn</title>
</head>
<body>
    <div class="container">
        <h1>Thông tin Hóa đơn</h1>
        {{-- <p><strong>Mã hóa đơn:</strong> {{ $invoice->id }}</p> --}}
        {{-- <p><strong>Tên khách hàng:</strong> {{ $invoice->customer_name }}</p> --}}
        {{-- <p><strong>Ngày tạo:</strong> {{ $invoice->created_at }}</p> --}}
        {{-- <p><strong>Tổng tiền:</strong> {{ number_format($invoice->total_amount, 2) }} VND</p> --}}

        <h2>Thông tin Hoàn tiền</h2>
        @if ($refund)
            <p><strong>Tên tài khoản:</strong> {{ $refund->account_name }}</p>
            <p><strong>Số tài khoản:</strong> {{ $refund->account_number }}</p>
            <p><strong>Số tiền hoàn lại:</strong> {{ number_format($refund->refund_amount, 2) }} VND</p>
            <p><strong>Ngân hàng:</strong> {{ $refund->bank_name }}</p>
            <p><strong>Email liên hệ:</strong> {{ $refund->email }}</p>
            <p><strong>Lý do hoàn lại:</strong> {{ $refund->reason }}</p>
            <p><strong>Trạng thái hoàn tiền:</strong> {{ $refund->status }}</p>
        @else
            <p class="no-refund">Không có thông tin hoàn tiền cho hóa đơn này.</p>
        @endif
    </div>
</body>
</html>
