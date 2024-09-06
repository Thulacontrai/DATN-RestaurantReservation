@extends('admin.master')

@section('title', 'Danh Sách Combo')

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
                        <div class="card-title">Danh Sách Combo</div>

                        <a href="{{ route('combo.create') }}" class="btn btn-sm btn-primary d-flex align-items-center">
                            <i class="bi bi-plus-circle me-2"></i> Thêm Combo Mới
                        </a>
                    </div>
                    <div class="card-body">


                        <form method="GET" action="#" class="mb-3">
                            <div class="row g-2">
                                <div class="col-auto">
                                    <input type="text" id="search-name" name="name" class="form-control form-control-sm" placeholder="Tìm kiếm theo tên combo">
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
                                        <th>Tên Combo</th>
                                        <th>Giá Combo</th>
                                        <th>Danh Mục</th>
                                        <th>Số Lượng Món Ăn</th>
                                        <th>Hình Ảnh</th>
                                        {{-- <th>Mô Tả Combo</th> --}}
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dữ liệu mẫu -->
                                    <tr>
                                        <td>Combo 1</td>
                                        <td>500,000 VND</td>
                                        <td>Thức Ăn Nhanh</td>
                                        <td>3 món</td>
                                        <td>
                                            <img src="https://via.placeholder.com/100" alt="Combo 1 Image" width="100">
                                        </td>
                                        {{-- <td>Bao gồm bánh mì kẹp thịt, khoai tây chiên và nước ngọt.</td> --}}
                                        <td>
                                            <div class="actions">
                                                <a href="#" class="viewRow" data-bs-toggle="modal" data-bs-target="#viewRowModal" data-dish-id="103">
                                                    <i class="bi bi-list text-green"></i>
                                                </a>
                                                <a href="{{ route('combo.edit', '103') }}" class="viewRow">
                                                    <i class="bi bi-pencil-square text-warning"></i>
                                                </a>
                                                <a href="#" class="deleteRow">
                                                    <i class="bi bi-trash text-red"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Combo 2</td>
                                        <td>750,000 VND</td>
                                        <td>Đồ Uống</td>
                                        <td>2 món</td>
                                        <td>
                                            <img src="https://via.placeholder.com/100" alt="Combo 2 Image" width="100">
                                        </td>
                                        {{-- <td>Gồm trà sữa và sinh tố trái cây tươi.</td> --}}
                                        <td>
                                            <div class="actions">
                                                <a href="#" class="viewRow" data-bs-toggle="modal" data-bs-target="#viewRowModal" data-dish-id="104">
                                                    <i class="bi bi-list text-green"></i>
                                                </a>
                                                <a href="{{ route('combo.edit', '104') }}" class="viewRow">
                                                    <i class="bi bi-pencil-square text-warning"></i>
                                                </a>
                                                <a href="#" class="deleteRow">
                                                    <i class="bi bi-trash text-red"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Combo 3</td>
                                        <td>1,000,000 VND</td>
                                        <td>Set Ăn Gia Đình</td>
                                        <td>5 món</td>
                                        <td>
                                            <img src="https://via.placeholder.com/100" alt="Combo 3 Image" width="100">
                                        </td>
                                        {{-- <td>Gồm lẩu hải sản, cơm chiên và trái cây tráng miệng.</td> --}}
                                        <td>
                                            <div class="actions">
                                                <a href="#" class="viewRow" data-bs-toggle="modal" data-bs-target="#viewRowModal" data-dish-id="105">
                                                    <i class="bi bi-list text-green"></i>
                                                </a>
                                                <a href="{{ route('combo.edit', '105') }}" class="viewRow">
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
                            <!-- Pagination giả lập -->
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
    </div>
    <!-- Content wrapper end -->

</div>
<!-- Content wrapper scroll end -->
@endsection
