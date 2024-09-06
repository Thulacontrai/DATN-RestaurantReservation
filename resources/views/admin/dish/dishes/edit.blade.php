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

                    <!-- Form Chỉnh Sửa -->
                    <form method="POST" action="">
                        @csrf
                        @method('PUT') <!-- Phương thức PUT để cập nhật dữ liệu -->

                        <div class="mb-3">
                            <label for="dish-name" class="form-label">Tên Món Ăn</label>
                            <input type="text" id="dish-name" name="name" class="form-control" value=""required>
                        </div>

                        <div class="mb-3">
                            <label for="dish-category" class="form-label">Loại Món Ăn</label>
                            <select id="dish-category" name="category_id" class="form-select">
                                <option value="1">Khai Vị</option>
                                <option value="2" >Món Chính</option>
                                <option value="3" >Tráng Miệng</option>
                                <!-- Thêm các lựa chọn khác tùy theo loại món ăn của bạn -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="dish-price" class="form-label">Giá</label>
                            <input type="number" id="dish-price" name="price" class="form-control" value="" required>
                        </div>

                        <div class="mb-3">
                            <label for="dish-quantity" class="form-label">Số Lượng</label>
                            <input type="number" id="dish-quantity" name="quantity" class="form-control" value="" required>
                        </div>

                        <div class="mb-3">
                            <label for="dish-status" class="form-label">Trạng Thái</label>
                            <select id="dish-status" name="status" class="form-select">
                                <option value="available" >Có sẵn</option>
                                <option value="out_of_stock" >Hết hàng</option>
                            </select>
                        </div>

                        <div class="mb-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Cập Nhật Món ăn</button>
                            <button type="reset" class="btn btn-secondary ms-2">Hủy</button>
                        </div>
                    </form>
                    <!-- Kết thúc Form Chỉnh Sửa -->

                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

@endsection
