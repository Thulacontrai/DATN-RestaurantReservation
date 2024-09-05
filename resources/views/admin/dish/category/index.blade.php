@extends('admin.master')

@section('title', 'Danh Mục Loại Món Ăn')

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
                    <div class="card-title">Danh Mục Loại Món Ăn</div>

                    <a href="{{route('category.create')}}" class="btn btn-sm btn-primary d-flex align-items-center">
                        <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                    </a>
                </div>
                <div class="card-body">


                    <form method="GET" action="" class="mb-3">
                        <div class="row g-2">
                            <div class="col-auto">
                                <input type="text" id="search-name" name="name" class="form-control form-control-sm" placeholder="Tìm kiếm theo tên danh mục">
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
                                    <th>Tên Danh Mục</th>
                                    <th>Mô Tả</th>
                                    <th>Trạng Thái</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Món Khai Vị</td>
                                    <td>Gồm các món ăn nhẹ trước bữa chính</td>
                                    <td><span class="badge shade-green min-70">Hoạt động</span></td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ route('category.edit', 101) }}" class="viewRow">
                                               <i class="bi bi-pencil-square text-warning"></i>
                                            </a>
                                            <a href="#" class="deleteRow">
                                                <i class="bi bi-trash text-red"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Món Chính</td>
                                    <td>Gồm các món ăn chính trong thực đơn</td>
                                    <td><span class="badge shade-green min-70">Hoạt động</span></td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ route('category.edit', 102) }}" class="viewRow">
                                               <i class="bi bi-pencil-square text-warning"></i>
                                            </a>
                                            <a href="#" class="deleteRow">
                                                <i class="bi bi-trash text-red"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Món Tráng Miệng</td>
                                    <td>Gồm các món tráng miệng sau bữa ăn</td>
                                    <td><span class="badge shade-green min-70">Hoạt động</span></td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ route('category.edit', 103) }}" class="viewRow">
                                               <i class="bi bi-pencil-square text-warning"></i>
                                            </a>
                                            <a href="#" class="deleteRow">
                                                <i class="bi bi-trash text-red"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                      <!-- Pagination -->
                      <div class="pagination justify-content-center mt-3">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Tiếp</a></li>
                        </ul>
                    </div>
                    <!-- Kết thúc Pagination -->

                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

@endsection
