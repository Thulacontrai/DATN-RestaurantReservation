@extends('admin.master')

@section('title', 'Chỉnh Sửa Bàn')

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
                        <div class="card-title">Chỉnh Sửa Bàn</div>

                    </div>

                    <div class="card-body">

                        <!-- Form chỉnh sửa bàn -->
                        <form>
                            <div class="mb-3">
                                <label for="area" class="form-label">Khu Vực</label>
                                <select name="area" id="area" class="form-select">
                                    <option value="Trong nhà" selected>Trong nhà</option>
                                    <option value="Ngoài trời">Ngoài trời</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="number" class="form-label">Số Bàn</label>
                                <input type="text" name="number" id="number" class="form-control" value="101" required>
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Loại Bàn</label>
                                <select name="type" id="type" class="form-select">
                                    <option value="Thường" selected>Thường</option>
                                    <option value="VIP">VIP</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng Thái</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="Có sẵn" selected>Có sẵn</option>
                                    <option value="Đang sử dụng">Đang sử dụng</option>
                                    <option value="Đã đặt trước">Đã đặt trước</option>
                                </select>
                            </div>

                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Cập Nhật Bàn</button>
                                <button type="reset" class="btn btn-secondary ms-2">Hủy</button>
                            </div>
                        </form>
                        <!-- Kết thúc form -->

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
