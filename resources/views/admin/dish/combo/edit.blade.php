@extends('admin.master')

@section('title', 'Chỉnh Sửa Combo')

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
                            <div class="card-title">Chỉnh Sửa Combo</div>

                            <a href="{{ route('admin.combo.index') }}" class="btn btn-sm btn-dark">Quay lại</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.combo.update', $combo->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Tên Combo</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $combo->name }}" placeholder="Tên Combo" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Giá Combo</label>
                                            <input type="number" name="price" class="form-control"
                                                value="{{ $combo->price }}" placeholder="Giá Combo" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-12">
                                        <label for="dishes">Chọn Món Ăn:</label>
                                        <select name="dishes[]" id="dishes" multiple="multiple" style="width: 100%">
                                            @foreach ($dishes as $dish)
                                                <option value="{{ $dish->id }}" 
                                                    {{ in_array($dish->id, $combo->dishes->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $dish->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-sm-12 col-12">
                                        <div class="mb-3">
                                            <label for="editor" class="form-label">Mô tả món ăn</label>
                                            <textarea name="description" id="editor" class="form-control">{{ $combo->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Ảnh Combo</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                            <img src="{{ asset('storage/' . $combo->image) }}" alt="{{ $combo->name }}"
                                                width="100" class="mt-2">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Số Lượng Món Ăn</label>
                                            <input type="number" name="quantity_dishes" class="form-control"
                                                value="{{ $combo->quantity_dishes }}"
                                                placeholder="Số lượng món ăn trong combo" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Cập Nhật Combo</button>
                                    <button type="reset" class="btn btn-secondary ms-2">Hủy</button>
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
