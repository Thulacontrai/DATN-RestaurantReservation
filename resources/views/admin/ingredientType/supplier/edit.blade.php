@extends('admin.master')

@section('title', 'Chỉnh Sửa Nhà Cung Cấp')

@section('content')
<div class="content-wrapper-scroll">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Chỉnh Sửa Nhà Cung Cấp</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.supplier.update', $supplier->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Tên Nhà Cung Cấp</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $supplier->name) }}" placeholder="Nhập tên nhà cung cấp" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Số Điện Thoại</label>
                                <input type="number" name="phone" id="phone" class="form-control" value="{{ old('phone', $supplier->phone) }}" placeholder="Nhập số điện thoại" required>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $supplier->email) }}" placeholder="Nhập địa chỉ email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Địa Chỉ</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $supplier->address) }}" placeholder="Nhập địa chỉ nhà cung cấp">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Cập Nhật Nhà Cung Cấp</button>
                            <a href="{{ route('admin.supplier.index') }}" class="btn btn-secondary">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
