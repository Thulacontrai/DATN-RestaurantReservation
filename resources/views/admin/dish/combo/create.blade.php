@extends('admin.master')

@section('title', 'Thêm Combo Mới')

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
                    <div class="card-title">Thêm Combo Mới</div>
                    <!-- Icon Quay lại danh sách combo -->
                    <a href="{{ route('combo.index') }}" class="btn btn-sm btn-dark">Quay lại</a>
                </div>
                <div class="card-body">
                    <!-- Form Thêm Combo -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Tên Combo</label>
                                    <input type="text" name="name" class="form-control" placeholder="Tên Combo" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Giá Combo</label>
                                    <input type="number" name="price" class="form-control" placeholder="Giá Combo" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-12">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="editor" class="form-label">Mô tả món ăn</label>
                                        <textarea name="description" id="editor" class="form-control"></textarea>
                                    </div>
                            </div>

                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Danh Mục</label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="">Chọn danh mục</option>
                                        <!-- Lặp qua các danh mục để chọn -->
                                        {{-- @foreach()
                                            <option value=""></option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Ảnh Combo</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Số Lượng Món Ăn</label>
                                    <input type="number" name="quantity_dishes" class="form-control" placeholder="Số lượng món ăn trong combo" required>
                                </div>
                            </div>
                        </div>
                        <!-- Nút Lưu -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Lưu Combo</button>
                        </div>
                    </form>
                    <!-- Kết thúc Form Thêm Combo -->
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
