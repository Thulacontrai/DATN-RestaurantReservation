@extends('admin.master')

@section('title', 'Thêm Combo Mới')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">

@endsection
@section('content')


    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Thêm Combo Mới</div>

                            <a href="{{ route('admin.combo.index') }}" class="btn btn-sm btn-dark">Quay lại</a>
                        </div>
                        <div class="card-body">

<<<<<<< HEAD
                            <form id="comboForm" action="{{ route('admin.combo.store') }}" method="POST"
                                enctype="multipart/form-data" novalidate>
=======
                            <form action="{{ route('admin.combo.store') }}" method="POST" enctype="multipart/form-data">
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Tên Combo</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Tên Combo" required>
<<<<<<< HEAD
                                            <div class="invalid-feedback">Vui lòng nhập tên combo.</div>
                                            <div class="valid-feedback">Looks good!</div>
=======
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Giá Combo</label>
                                            <input type="number" name="price" class="form-control"
                                                placeholder="Giá Combo" required>
<<<<<<< HEAD
                                            <div class="invalid-feedback">Vui lòng nhập giá combo.</div>
                                            <div class="valid-feedback">Looks good!</div>
=======
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <label for="dishes">Chọn Món Ăn:</label>
                                        <select name="dishes[]" id="dishes" multiple="multiple" style="width: 100%">
                                            @foreach ($dishes as $dish)
                                                <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="mb-3">
                                            <label for="editor" class="form-label">Mô tả món ăn</label>
                                            <textarea name="description" id="editor" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Ảnh Combo</label>
<<<<<<< HEAD
                                            <input type="file" name="image" class="form-control" accept="image/*"
                                                required>
                                            <div class="invalid-feedback">Vui lòng chọn ảnh combo.</div>
                                            <div class="valid-feedback">Looks good!</div>
=======
                                            <input type="file" name="image" class="form-control" accept="image/*">
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Số Lượng Món Ăn</label>
<<<<<<< HEAD
                                            <input type="number" name="quantity_dishes" id="quantity_dishes" class="form-control"
                                                placeholder="Số lượng món ăn trong combo" required readonly>
                                            <div class="invalid-feedback">Vui lòng nhập số lượng món ăn.</div>
                                            <div class="valid-feedback">Looks good!</div>
=======
                                            <input type="number" name="quantity_dishes" class="form-control"
                                                placeholder="Số lượng món ăn trong combo" required>
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">Lưu Combo</button>
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

@section('scripts')
<!-- Load jQuery first -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<!-- Load Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dishes').select2({
            placeholder: 'Chọn món ăn',
            tags: false // Cho phép người dùng thêm tag mới nếu muốn
        });
        $('#dishes').on('change', function() {
            const selectedDishesCount = $(this).val() ? $(this).val().length : 0; // Lấy số lượng món ăn được chọn
            $('input[name="quantity_dishes"]').val(selectedDishesCount); // Cập nhật giá trị vào trường số lượng món ăn
        });
    });
</script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>

  
@endsection
