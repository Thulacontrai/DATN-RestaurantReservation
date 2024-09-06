@extends('admin.master')

@section('title', 'Thêm Mới Danh Mục Loại Món Ăn')

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
                    <div class="card-title">Thêm Mới Danh Mục Loại Món Ăn</div>
                </div>
                <div class="card-body">

                    <!-- Form Thêm Mới -->
                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label for="category-name" class="form-label">Tên Danh Mục</label>
                            <input type="text" id="category-name" name="name" class="form-control" placeholder="Nhập tên danh mục" required>
                        </div>

                        <div class="mb-3">
                            <label for="category-description" class="form-label">Mô Tả</label>
                            <textarea id="category-description" name="description" class="form-control" placeholder="Nhập mô tả danh mục" rows="4"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="category-status" class="form-label">Trạng Thái</label>
                            <select id="category-status" name="status" class="form-select">
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Ngừng hoạt động</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Thêm Mới</button>
                    </form>
                    <!-- Kết thúc Form Thêm Mới -->

                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

@endsection
