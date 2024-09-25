@extends('admin.master')

@section('title', 'Chỉnh Sửa Quyền Hạn')

@section('content')

    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Chỉnh Sửa Quyền Hạn</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
                                @csrf
                               
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Tên Quyền Hạn</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $permission->name) }}">

                                </div>

                               
                                <button type="submit" class="btn btn-success">Cập Nhật Quyền Hạn</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection