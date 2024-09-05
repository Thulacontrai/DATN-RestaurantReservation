@extends('admin.master')

@section('title', 'Thêm Nguyên Liệu')

@section('content')

<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thêm Nguyên Liệu Mới</h3>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="#">
                            <!-- Tên Nguyên Liệu -->
                            <div class="mb-3">
                                <label for="ingredientName" class="form-label">Tên Nguyên Liệu</label>
                                <input type="text" class="form-control" id="ingredientName" name="ingredientName" placeholder="Nhập tên nguyên liệu" >
                            </div>

                            <!-- Nhà Cung Cấp -->
                            <div class="mb-3">
                                <label for="supplier" class="form-label">Nhà Cung Cấp</label>
                                <select class="form-select" id="supplier" name="supplier">
                                    <option selected value="1">Công Ty ABC</option>
                                    <option value="2">Công Ty XYZ</option>
                                    <option value="3">Công Ty DEF</option>
                                </select>
                            </div>

                            <!-- Số Lượng -->
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Số Lượng</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Nhập số lượng" >
                            </div>

                            <!-- Đơn Vị -->
                            <div class="mb-3">
                                <label for="unit" class="form-label">Đơn Vị</label>
                                <input type="text" class="form-control" id="unit" name="unit" placeholder="Nhập đơn vị">
                            </div>

                            <!-- Giá Thành -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Giá Thành</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá thành">
                            </div>

                            <!-- Mô Tả -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Mô Tả</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Mô tả nguyên liệu"></textarea>
                            </div>

                            <!-- Nút Lưu -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Lưu Nguyên Liệu</button>
                                <a href="#" class="btn btn-secondary">Hủy</a>
                            </div>
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
