@extends('admin.master')

@section('title', 'Chỉnh Sửa Combo')

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
                    <div class="card-title">Chỉnh Sửa Combo</div>
                    <!-- Icon Quay lại danh sách combo -->
                    <button class="btn btn-sm btn-dark">Quay lại</button>
                </div>
                <div class="card-body">
                    <!-- Form Chỉnh Sửa Combo -->
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Tên Combo</label>
                                    <input type="text" name="name" class="form-control" value="Combo Mẫu" placeholder="Tên Combo" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Giá Combo</label>
                                    <input type="number" name="price" class="form-control" value="500000" placeholder="Giá Combo" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="editor" class="form-label">Mô tả món ăn</label>
                                    <textarea name="description" id="editor" class="form-control">Mô tả món ăn mẫu</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Danh Mục</label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="">Chọn danh mục</option>
                                        <option value="1" selected>Đồ ăn nhanh</option>
                                        <option value="2">Thức uống</option>
                                        <option value="3">Món ăn gia đình</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Ảnh Combo</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <img src="https://via.placeholder.com/100" alt="Combo Image" width="100" class="mt-2">
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Số Lượng Món Ăn</label>
                                    <input type="number" name="quantity_dishes" class="form-control" value="3" placeholder="Số lượng món ăn trong combo" required>
                                </div>
                            </div>
                        </div>
                        <!-- Nút Lưu -->
                        <div class="mb-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Cập Nhật Combo</button>
                            <button type="reset" class="btn btn-secondary ms-2">Hủy</button>
                        </div>
                    </form>
                    <!-- Kết thúc Form Chỉnh Sửa Combo -->
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

@section('scripts')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
@endsection
