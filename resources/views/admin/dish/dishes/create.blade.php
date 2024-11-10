@extends('admin.master')

@section('title', 'Thêm Mới Món Ăn')

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
                            <div class="card-title">Thêm Mới Món Ăn</div>
                            <a href="{{ route('admin.dishes.index') }}" class="btn btn-sm btn-secondary">Quay lại</a>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.dishes.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="dish-name" class="form-label">Tên Món Ăn</label>
                                    <input type="text" id="dish-name" name="name" class="form-control"
                                        placeholder="Nhập tên món ăn" required>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-category" class="form-label">Loại Món Ăn</label>
                                    <select id="dish-category" name="category_id" class="form-select">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-price" class="form-label">Giá</label>
                                    <input type="number" id="dish-price" name="price" class="form-control"
                                        placeholder="Nhập giá món ăn" required>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-quantity" class="form-label">Số Lượng</label>
                                    <input type="number" id="dish-quantity" name="quantity" class="form-control"
                                        placeholder="Nhập số lượng món ăn" required>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-description" class="form-label">Mô tả Món Ăn</label>
                                    <textarea id="dish-description" name="description" class="form-control" placeholder="Nhập mô tả món ăn"></textarea>
                                </div>


                                <div class="mb-3">
                                    <label for="dish-status" class="form-label">Trạng Thái</label>
                                    <select id="dish-status" name="status" class="form-select">
                                        <option value="available">Có sẵn</option>
                                        <option value="out_of_stock">Hết hàng</option>
                                        <option value="reserved">Đã đặt trước</option>
                                        <option value="in_use">Đang sử dụng</option>
                                        <option value="completed">Hoàn thành</option>
                                        <option value="cancelled">Đã hủy</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="dish-image" class="form-label">Hình Ảnh</label>
                                    <input type="file" id="dish-image" name="image" class="form-control"
                                        accept="image/*">
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary">Thêm Mới</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Content wrapper end -->

    </div>
    <!-- Content wrapper scroll end -->

@endsection
