@extends('admin.master')

@section('title', 'Chỉnh Sửa Người Dùng')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center text-white">
                            <h5 class="card-title mb-3 ">Chỉnh Sửa Người Dùng</h5>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-secondary">Quay lại</a>
                        </div>
                        <div class="card-body">
                            <!-- Form Chỉnh Sửa -->
                            <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên</label>
                                    <input value="{{ old ('name', $user->name)}}" type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input value="{{ old('email', $user->email)}}" type="text" id="email" name="email" class="form-control" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input value="{{ old('phone', $user->phone) }}" type="text" id="phone" name="phone" class="form-control">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="grid grid-cols-4 mb-3  ">
                                    @if ($roles->isNotEmpty())
                                        @foreach ($roles as $role)
                                            <div class="mt-3">
                                                
                                                <input {{ ($hasRoles->contains($role->id)) ? 'checked' : '' }}  type="checkbox" name="role[]" value="{{ $role->name }}" id="role-{{$role->id}}" class="rounded">
                                                <label for="role-{{$role->id}}">{{ $role->name }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select id="status" name="status" class="form-select">
                                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Hoạt Động</option>
                                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Không Hoạt Động</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="created_at" class="form-label">Ngày tạo</label>
                                    <input value="{{ $user->created_at }}" type="text" id="created_at" name="created_at" class="form-control" disabled>
                                </div>

                                

                                <button type="submit" class="btn btn-sm btn-primary">Cập Nhật</button>

                                <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-secondary">Hủy</a>


                            </form>
                            <!-- Kết thúc Form Chỉnh Sửa -->

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
