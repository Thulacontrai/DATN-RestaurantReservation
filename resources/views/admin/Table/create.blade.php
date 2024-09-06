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
                            <form action="#" method="POST">
                                @csrf
                             
                                <div class="mb-3">
                                    <label for="area" class="form-label">Khu Vực</label>
                                    <input type="text" class="form-control" id="area" name="area" required>
                                </div>
                                <div class="mb-3">
                                    <label for="table_number" class="form-label">Số Bàn</label>
                                    <input type="number" class="form-control" id="table_number" name="table_number" required>
                                </div>
                                <div class="mb-3">
                                    <label for="table_type" class="form-label">Loại Bàn</label>
                                    <input type="text" class="form-control" id="table_type" name="table_type" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <input type="text" class="form-control" id="status" name="status" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm Bàn</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
        </div>
    </div>

@endsection
