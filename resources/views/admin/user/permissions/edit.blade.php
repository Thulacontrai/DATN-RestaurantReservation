@extends('admin.master')

@section('title', 'Chỉnh Sửa Quyền Hạn')

@section('content')
 <!-- SweetAlert -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

 <style>
     @keyframes gradientMove {
         0% {
             background-position: 0% 50%;
         }

         50% {
             background-position: 100% 50%;
         }

         100% {
             background-position: 0% 50%;
         }
     }

     .swal2-timer-progress-bar {
         background: linear-gradient(90deg, #34eb4f, #00bcd4, #ffa726, #ffeb3b, #f44336);
         /* Gradient màu */
         background-size: 300% 300%;
         /* Kích thước gradient lớn để tạo hiệu ứng động */
         animation: gradientMove 2s ease infinite;
         /* Hiệu ứng lăn tăn */
     }
 </style>

 <script>
     document.addEventListener("DOMContentLoaded", function() {
         // Hiển thị thông báo lỗi
         @if ($errors->any())
             Swal.fire({
                 position: "top-end",
                 icon: "error",
                 toast: true,
                 title: "{{ $errors->first() }}",
                 showConfirmButton: false,
                 timerProgressBar: true,
                 timer: 3000
             });
         @endif

         // Hiển thị thông báo thành công
         @if (session('success'))
             Swal.fire({
                 position: "top-end",
                 icon: "success",
                 toast: true,
                 title: "{{ session('success') }}",
                 showConfirmButton: false,
                 timerProgressBar: true,
                 timer: 3000
             });
         @endif
     });
 </script>
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
