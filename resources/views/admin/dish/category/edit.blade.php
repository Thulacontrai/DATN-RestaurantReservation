@extends('admin.master')

@section('title', 'Chỉnh Sửa Danh Mục Loại Món Ăn')

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
                            <div class="card-title">Chỉnh Sửa Danh Mục Loại Món Ăn</div>
                        </div>
                        <div class="card-body">


                            <form method="POST" action="{{ route('admin.category.update', $category->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="category-name" class="form-label">Tên Danh Mục</label>
                                    <input type="text" id="category-name" name="name" class="form-control"
                                        value="{{ $category->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="category-description" class="form-label">Mô Tả</label>
                                    <textarea id="category-description" name="description" class="form-control" rows="4">{{ $category->description }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary">Cập Nhật</button>
                            </form>
                            >

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
    </div>

@endsection
