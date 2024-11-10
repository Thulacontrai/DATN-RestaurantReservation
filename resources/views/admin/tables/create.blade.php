@extends('admin.master')

@section('title', 'Thêm Mới Bàn')

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
                            <div class="card-title">Thêm Mới Bàn</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.table.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="area" class="form-label">Khu Vực</label>
                                    <select class="form-control" id="area" name="area" required>
                                        <option value="Tầng 1">Tầng 1</option>
                                        <option value="Tầng 2">Tầng 2</option>
                                    </select>
                                    @error('area')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="table_number" class="form-label">Số Bàn</label>
                                    <input type="number" class="form-control" id="table_number" name="table_number"
                                        required>
                                    @error('table_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="table_type" class="form-label">Loại Bàn</label>
                                    <select class="form-control" id="table_type" name="table_type" required>
                                        <option value="Thường">Thường</option>
                                        <option value="VIP">VIP</option>
                                    </select>
                                    @error('table_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Available">Có sẵn</option>
                                        <option value="Reserved">Đã đặt trước</option>
                                        <option value="Occupied">Đang sử dụng</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Thêm Bàn</button>
                                <a href="{{route('admin.table.index')}}"  class="btn btn-sm btn-secondary">Quay lại</a>
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
