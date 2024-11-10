@extends('admin.master')

@section('title', 'Danh Sách Món Ăn')

@section('content')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Danh Sách Món Ăn</h5>
                            <div class="heart-btn d-flex align-items-center" id="heartButton">
                                <a href="{{ route('admin.dishes.trash') }}">
                                    <i class="bi bi-trash2-fill"></i></a>
                            </div>
                            <a href="{{ route('admin.dishes.create') }}"
                                class="btn btn-sm btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.dishes.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-dish" name="dish_name"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo tên món ăn"
                                            value="{{ request('dish_name') }}">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Mã Món Ăn</th>
                                            <th>Tên Món Ăn</th>
                                            <th>Loại Món Ăn</th>
                                            <th>Giá</th>
                                            <th>Hình Ảnh</th>
                                            <th>Số Lượng</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dishes as $dish)
                                            <tr>
                                                <td>{{ $dish->id }}</td>
                                                <td>{{ $dish->name }}</td>
                                                <td>{{ $dish->category->name ?? 'N/A' }}</td>
                                                <td>{{ number_format($dish->price, 0, ',', '.') }} VND</td>
                                                <td class="text-center">
                                                    @if ($dish->image)
                                                        <img src="{{ asset('storage/' . $dish->image) }}"
                                                            alt="{{ $dish->name }}" width="50">
                                                    @else
                                                        <img src="https://via.placeholder.com/50" alt="No Image"
                                                            width="50">
                                                    @endif
                                                </td>
                                                <td>{{ $dish->quantity }}</td>
                                                <td>
                                                    @if ($dish->status == 'available')
                                                        <span class="badge bg-success">Có sẵn</span>
                                                    @elseif($dish->status == 'out_of_stock')
                                                        <span class="badge bg-danger">Hết hàng</span>
                                                    @elseif($dish->status == 'reserved')
                                                        <span class="badge bg-warning">Đã đặt trước</span>
                                                    @elseif($dish->status == 'in_use')
                                                        <span class="badge bg-info">Đang sử dụng</span>
                                                    @elseif($dish->status == 'completed')
                                                        <span class="badge bg-primary">Hoàn thành</span>
                                                    @elseif($dish->status == 'cancelled')
                                                        <span class="badge bg-secondary">Đã hủy</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.dishes.show', $dish->id) }}"
                                                            class="viewRow">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>

                                                        <a href="{{ route('admin.dishes.edit', $dish->id) }}"
                                                            class="">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <a href="#" class="deleteRow">
                                                            <form action="{{ route('admin.dishes.destroy', $dish->id) }}"
                                                                method="POST"method="POST" style="display:inline-block;"
                                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link p-0"><i
                                                                        class="bi bi-trash text-red"></i></button>
                                                            </form>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">Không có món ăn nào được tìm thấy.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{ $dishes->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->


        @endsection
