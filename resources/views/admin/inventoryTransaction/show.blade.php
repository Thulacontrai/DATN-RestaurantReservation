@extends('admin.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Chi tiết phiếu nhập kho #{{ $transaction->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Thông tin giao dịch</h5>
            <p><strong>Loại giao dịch:</strong> {{ $transaction->transaction_type }}</p>
            <p><strong>Tổng số tiền:</strong> {{ number_format($transaction->total_amount, 0, ',', '.') }} đ</p>
            <p><strong>Mô tả:</strong> {{ $transaction->description ?? 'N/A' }}</p>
            <p><strong>Nhà cung cấp:</strong> {{ $transaction->supplier->name ?? 'N/A' }}</p>
            <p><strong>Nhân viên:</strong> {{ $staff->name ?? 'N/A' }}</p>
            <p><strong>Trạng thái:</strong> {{ $transaction->status }}</p>
            <p><strong>Ngày tạo:</strong> {{ $transaction->created_at->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>

   
    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-bordered">
                <h3>Danh sách nguyên liệu</h2>
                <thead>
                    <tr>
                        <th>ID Nguyên Liệu</th>
                        <th>Tên Nguyên Liệu</th>
                        <th>Số lượng</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->inventoryItems as $item)
                    <tr>
                        <td>{{ $item->ingredient->id }}</td>
                        <td>{{ $item->ingredient->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        {{-- <td>{{ number_format($item->unit_price, 2) }}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if($transaction->status !== 'Hủy') <!-- Chỉ hiển thị nếu trạng thái không phải là "Hủy" -->
        <div class="card mb-4">
            <div class="card-body">
                <h3>Cập nhật trạng thái</h2>
                <form action="{{ route('transactions.update.status', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="chờ xử lý" {{ $transaction->status == 'chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="hoàn thành" {{ $transaction->status == 'hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="Hủy" {{ $transaction->status == 'Hủy' ? 'selected' : '' }}>Hủy</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Cập nhật trạng thái</button>
                </form>
            </div>
        </div>
    @endif

    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Trở về</a>
</div>
@endsection
