@extends('admin.master')

@section('title', 'Danh Sách Món Ăn')

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
                            <div class="card-title">Danh Sách Món Ăn</div>


                            <a href="{{ route('dishes.create') }}" class="btn btn-sm btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                            </a>

                        </div>
                        <div class="card-body">


                            <form method="GET" action="" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-dish" name="dish_name"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo tên món ăn">
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
                                            <th>Số Lượng</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>101</td>
                                            <td>Salad Caesar</td>
                                            <td>Khai Vị</td>
                                            <td>120,000 VND</td>
                                            <td>50</td>
                                            <td><span class="badge shade-green min-70">Có sẵn</span></td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#viewRowModal" data-dish-id="101"
                                                        data-dish-name="Salad Caesar" data-dish-category="Khai Vị"
                                                        data-dish-price="120,000 VND" data-dish-quantity="50"
                                                        data-dish-status="Có sẵn">
                                                        <i class="bi bi-list text-green"></i>
                                                    </a>
                                                    <a href="{{ route('dishes.edit', 101) }}" class="viewRow">
                                                        <i class="bi bi-pencil-square text-warning"></i>
                                                    </a>
                                                    <a href="#" class="deleteRow">
                                                        <i class="bi bi-trash text-red"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>102</td>
                                            <td>Bít Tết</td>
                                            <td>Món Chính</td>
                                            <td>350,000 VND</td>
                                            <td>20</td>
                                            <td><span class="badge shade-yellow min-70">Sắp hết</span></td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#viewRowModal" data-dish-id="102"
                                                        data-dish-name="Bít Tết" data-dish-category="Món Chính"
                                                        data-dish-price="350,000 VND" data-dish-quantity="20"
                                                        data-dish-status="Sắp hết">
                                                        <i class="bi bi-list text-yellow"></i>
                                                    </a>
                                                    <a href="{{ route('dishes.edit', 102) }}" class="viewRow">
                                                        <i class="bi bi-pencil-square text-warning"></i>
                                                    </a>
                                                    <a href="#" class="deleteRow">
                                                        <i class="bi bi-trash text-red"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>103</td>
                                            <td>Bánh Flan</td>
                                            <td>Tráng Miệng</td>
                                            <td>80,000 VND</td>
                                            <td>0</td>
                                            <td><span class="badge shade-red min-70">Hết hàng</span></td>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" class="viewRow" data-bs-toggle="modal"
                                                        data-bs-target="#viewRowModal" data-dish-id="103"
                                                        data-dish-name="Bánh Flan" data-dish-category="Tráng Miệng"
                                                        data-dish-price="80,000 VND" data-dish-quantity="0"
                                                        data-dish-status="Hết hàng">
                                                        <i class="bi bi-list text-red"></i>
                                                    </a>
                                                    <a href="{{ route('dishes.edit', 103) }}" class="viewRow">
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


            <!-- Modal hiển thị chi tiết -->
            <div class="modal fade" id="viewRowModal" tabindex="-1" aria-labelledby="viewRowModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewRowModalLabel">Chi Tiết Món Ăn</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="dishId" class="form-label">Mã Món Ăn</label>
                                <input type="text" class="form-control" id="dishId" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="dishName" class="form-label">Tên Món Ăn</label>
                                <input type="text" class="form-control" id="dishName" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="dishCategory" class="form-label">Loại Món Ăn</label>
                                <input type="text" class="form-control" id="dishCategory" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="dishPrice" class="form-label">Giá</label>
                                <input type="text" class="form-control" id="dishPrice" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="dishQuantity" class="form-label">Số Lượng</label>
                                <input type="text" class="form-control" id="dishQuantity" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="dishStatus" class="form-label">Trạng Thái</label>
                                <input type="text" class="form-control" id="dishStatus" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- JavaScript để xử lý sự kiện nhấp vào hàng và hiển thị chi tiết trong modal -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const rows = document.querySelectorAll('.viewRow');

                    rows.forEach(function(row) {
                        row.addEventListener('click', function() {
                            const dishId = this.getAttribute('data-dish-id');
                            const dishName = this.getAttribute('data-dish-name');
                            const dishCategory = this.getAttribute('data-dish-category');
                            const dishPrice = this.getAttribute('data-dish-price');
                            const dishQuantity = this.getAttribute('data-dish-quantity');
                            const dishStatus = this.getAttribute('data-dish-status');

                            document.getElementById('dishId').value = dishId;
                            document.getElementById('dishName').value = dishName;
                            document.getElementById('dishCategory').value = dishCategory;
                            document.getElementById('dishPrice').value = dishPrice;
                            document.getElementById('dishQuantity').value = dishQuantity;
                            document.getElementById('dishStatus').value = dishStatus;
                        });
                    });
                });
            </script>

        @endsection
