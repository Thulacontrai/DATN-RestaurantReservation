@extends('pos.layouts.master')

@section('title', 'Hóa Đơn')

@section('content')
<div class="container mt-5" id="receipt-content">
    <h1 class="text-center">Hóa Đơn</h1>
    <hr>

    <!-- Receipt Header -->
    <div class="text-center">
        <p><strong>Bàn số:</strong> {{ $table }}</p>
        <p><strong>Ngày:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </div>

    <!-- Receipt Items -->
    <div class="row">
        <div class="col-md-12">
            <h4>Danh sách sản phẩm:</h4>
            <ul class="list-group mb-3">
                @foreach($selectedItems as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $item['quantity'] }} x {{ $item['name'] }}</span>
                        <span>{{ number_format($item['quantity'] * $item['price'], 2) }} VNĐ</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Total -->
    <div class="d-flex justify-content-between">
        <strong>Tổng tiền:</strong>
        <strong>{{ number_format($totalAmount, 2) }} VNĐ</strong>
    </div>

    <!-- Footer -->
    <div class="text-center mt-4">
        <p>Cảm ơn quý khách đã sử dụng dịch vụ!</p>
    </div>

    <!-- Print Button (Hidden during print) -->
    <div class="text-center mt-4 no-print">
        <button class="btn btn-primary" onclick="window.print()">In Hóa Đơn</button>
        <a href="{{ route('pos.dashboard') }}" class="btn btn-secondary">Quay Lại</a>
    </div>
</div>

<!-- Auto-print script -->
<script>
    // Automatically trigger print when the page is loaded
    window.onload = function() {
        window.print();
    };
</script>

<!-- Hide print button during printing -->
<style>
    @media print {
        .no-print {
            display: none;
        }
    }
</style>
@endsection
