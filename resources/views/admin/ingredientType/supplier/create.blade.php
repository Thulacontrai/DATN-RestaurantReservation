@extends('admin.master')

@section('title', 'Thêm Nhà Cung Cấp Mới')

@section('content')
<div class="content-wrapper-scroll">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thêm Nhà Cung Cấp Mới</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.supplier.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Tên Nhà Cung Cấp</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên nhà cung cấp" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Số Điện Thoại</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại" required>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Nhập địa chỉ email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Địa Chỉ</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Nhập địa chỉ nhà cung cấp">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Lưu Nhà Cung Cấp</button>
                            <a href="{{ route('admin.supplier.index') }}" class="btn btn-secondary">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
