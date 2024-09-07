@extends('admin.master')

@section('title', 'Chỉnh Sửa Món Ăn')

@section('content')

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Chỉnh Sửa Món Ăn</div>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.dishes.update', $dish->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="dish-name" class="form-label">Tên Món Ăn</label>
                                    <input type="text" id="dish-name" name="name" class="form-control"
                                        value="{{ $dish->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-category" class="form-label">Loại Món Ăn</label>
                                    <select id="dish-category" name="category_id" class="form-select">
                                        <option value="1" {{ $dish->category_id == 1 ? 'selected' : '' }}>Khai Vị
                                        </option>
                                        <option value="2" {{ $dish->category_id == 2 ? 'selected' : '' }}>Món Chính
                                        </option>
                                        <option value="3" {{ $dish->category_id == 3 ? 'selected' : '' }}>Tráng Miệng
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-price" class="form-label">Giá</label>
                                    <input type="number" id="dish-price" name="price" class="form-control"
                                        value="{{ $dish->price }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-quantity" class="form-label">Số Lượng</label>
                                    <input type="number" id="dish-quantity" name="quantity" class="form-control"
                                        value="{{ $dish->quantity }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-status" class="form-label">Trạng Thái</label>
                                    <select id="dish-status" name="status" class="form-select">
                                        <option value="available" {{ $dish->status == 'available' ? 'selected' : '' }}>Có
                                            sẵn</option>
                                        <option value="out_of_stock"
                                            {{ $dish->status == 'out_of_stock' ? 'selected' : '' }}>Hết hàng</option>
                                        <option value="reserved" {{ $dish->status == 'reserved' ? 'selected' : '' }}>Đã đặt
                                            trước</option>
                                        <option value="in_use" {{ $dish->status == 'in_use' ? 'selected' : '' }}>Đang sử
                                            dụng</option>
                                        <option value="completed" {{ $dish->status == 'completed' ? 'selected' : '' }}>Hoàn
                                            thành</option>
                                        <option value="cancelled" {{ $dish->status == 'cancelled' ? 'selected' : '' }}>Đã
                                            hủy</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-image" class="form-label">Hình Ảnh Món Ăn</label>
                                    <input type="file" id="dish-image" name="image" class="form-control">
                                    @if ($dish->image)
                                        <img src="{{ asset('storage/' . $dish->image) }}" alt="Hình ảnh món ăn"
                                            width="150" class="mt-3">
                                    @endif
                                </div>

                                <div class="mb-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Cập Nhật Món ăn</button>
                                    <button type="reset" class="btn btn-secondary ms-2">Hủy</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        @endsection
