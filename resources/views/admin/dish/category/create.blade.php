@extends('admin.master')

@section('title', 'Thêm Mới Danh Mục Category')

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
                            <div class="card-title">Thêm Mới Danh Mục Category</div>
                        </div>
                        <div class="card-body">


                            <form method="POST" action="{{ route('admin.category.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="category-name" class="form-label">Tên Danh Mục</label>
                                    <input type="text" id="category-name" name="name" class="form-control"
                                        placeholder="Nhập tên danh mục" required>
                                </div>

                                <div class="mb-3">
                                    <label for="category-description" class="form-label">Mô Tả</label>
                                    <textarea id="category-description" name="description" class="form-control" placeholder="Nhập mô tả danh mục"
                                        rows="4"></textarea>
                                </div>


                                <button type="submit" class="btn btn-sm btn-primary">Thêm Mới</button>
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
