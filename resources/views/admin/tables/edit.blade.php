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
                            <form action="{{ route('admin.table.update', $table->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="area" class="form-label">Khu Vực</label>
                                    <select name="area" id="area" class="form-select">
                                        <option value="Tầng 1" {{ $table->area == 'Tầng 1' ? 'selected' : '' }}>Tầng 1
                                        </option>
                                        <option value="Tầng 2" {{ $table->area == 'Tầng 2' ? 'selected' : '' }}>Tầng 2
                                        </option>
                                    </select>
                                    @error('area')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="table_number" class="form-label">Số Bàn</label>
                                    <input type="text" name="table_number" id="table_number" class="form-control"
                                        value="{{ $table->table_number }}" required>
                                    @error('table_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="table_type" class="form-label">Loại Bàn</label>
                                    <select name="table_type" id="table_type" class="form-select">
                                        <option value="Thường" {{ $table->table_type == 'Thường' ? 'selected' : '' }}>Thường
                                        </option>
                                        <option value="VIP" {{ $table->table_type == 'VIP' ? 'selected' : '' }}>VIP
                                        </option>
                                    </select>
                                    @error('table_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="Available" {{ $table->status == 'Available' ? 'selected' : '' }}>Có
                                            sẵn</option>
                                        <option value="Reserved" {{ $table->status == 'Reserved' ? 'selected' : '' }}>Đã
                                            đặt trước</option>
                                        <option value="Occupied" {{ $table->status == 'Occupied' ? 'selected' : '' }}>Đang
                                            sử dụng</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Cập Nhật Bàn</button>
                                    <a href="{{ route('admin.table.index') }}" class="btn btn-secondary ms-2">Hủy</a>
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
