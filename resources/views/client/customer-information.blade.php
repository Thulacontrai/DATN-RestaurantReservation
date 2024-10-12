@extends('client.layouts.master')
@section('title', 'Booking')

@section('content')
    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-2.jpg',
        'subtitle' => 'Make a',
        'title' => 'Reservation',
        'currentPage' => 'Booking',
    ])

    <div id="content" class="no-bottom no-top">
        <section id="section-book-form">
            <div class="container border">
                <div class="row text-center">
                    <div class="col bg-secondary p-2 text-uppercase">
                        <h6><a href="{{ route('booking.client') }}">Bước 1 - Chọn giờ ăn</a></h6>
                    </div>
                    <div class="col bg-warning p-2 text-uppercase">
                        <h6>Bước 2 -
                            Thông tin khách hàng</h6>
                    </div>
                </div>
                <div class="row bg-dark ">
                    <h6 class="text-center mt-4 mb-2">Mời bạn nhập thông tin để đặt bàn</h6>
                    <form action="{{ route('createReservation.client') }}" method="POST">
                        @csrf
                        <div class="row m-4 d-flex justify-content-center">
                            <div class="col">
                                <label for="user_name">Tên khách hàng*</label>
                                <input class="form-control" type="text" name="user_name" id="user_name"

                                    placeholder="Nhập tên khách hàng" value="{{old('user_name')}}">

                                @error('user_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="user_phone">Số điện thoại*</label>
                                <input class="form-control" type="text" name="user_phone" id="user_phone"

                                    placeholder="Nhập số điện thoại" value="{{old('user_phone')}}">
                                @error('user_phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="guest_count">Số người đặt bàn*</label>
                                <input class="form-control" type="text" name="guest_count" id="guest_count"

                                    placeholder="Nhập số người đặt bàn" value="{{old('guest_count')}}">

                                @error('guest_count')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row m-4 d-flex justify-content-center">
                            <div>
                                <label for="note">Ghi chú thêm</label>
                                <input class="form-control" type="text" name="note" id="note"

                                    placeholder="Nhập ghi chú" value="{{old('note')}}">

                            </div>
                        </div>
                        <input type="hidden" name="reservation_date" value="{{ $date }}">
                        <input type="hidden" name="reservation_time" value="{{ $time }}">
                        <div class="row m-4 d-flex justify-content-center">
                            <div class="col-2">
                                <a href="{{ route('booking.client') }}" class="text-secondary">Quay lại</a>
                            </div>
                            <div class="col-2">
                                <button type="button" id="confirmButton" class="btn-line">Xác nhận</button>
                            </div>
                        </div>
                    </form>

                    <!-- Modal OTP -->
                    <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="otpModalLabel">Xác thực OTP</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>                                    
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="otp_code" class="form-control" placeholder="Nhập mã OTP">
                                    <div id="otpError" class="alert alert-danger mt-2 d-none">Mã OTP không chính xác!</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Hủy</button>
                                    <button type="button" id="verifyOtpButton" class="btn btn-primary">Xác nhận OTP</button>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

@endsection

