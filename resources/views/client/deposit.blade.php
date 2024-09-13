@extends('client.layouts.master')
@section('title', 'Đặt cọc')
@section('content')
    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-2.jpg',
        'subtitle' => 'Thanh toán',
        'title' => 'Đặt cọc',
        'currentPage' => 'Đặt cọc',
    ])
    <div id="content" class="no-bottom no-top">
        <section id="section-book-form">
            <div class="container">
                <div class="row ">
                    <div class="col-7 p-5 border-color-1 rounded">
                        <div class="">
                            <div class="row">
                                <div class="col-5">
                                    <h3 class="">Thông tin đặt chỗ</h3>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-5">
                                            <p id="info-name">Họ và tên</p>
                                            <p id="info-phone">Số điện thoại</p>
                                            <p id="info-people">Số người</p>
                                            <p id="info-datetime">Thời gian đặt</p>
                                            <p id="info-notes">Ghi chú</p>
                                        </div>
                                        <div class="col-7">
                                            <p id="info-name">Nguyễn Tôn Quý</p>
                                            <p id="info-phone">0964888888</p>
                                            <p id="info-people">6 người</p>
                                            <p id="info-datetime">Thứ tư, ngày 11/09/2024 19:30</p>
                                            <p id="info-notes">Em ăn gì cũng được...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="row">
                            <div class="col ">
                                <div class="p-4 bg-dark rounded">
                                    <h3 class="">Chi tiết cọc</h3>
                                    <div class="row pt-2">
                                        <div class="col-5">
                                            <p>Số tiền cọc/người</p>
                                            <p>Số người</p>
                                            <p>Tổng tiền cọc</p>
                                        </div>
                                        <div class="col-7">
                                            <p>X</p>
                                            <p>6</p>
                                            <p>6X</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <div class="p-4 bg-dark rounded">
                                    <h3 class="">Phương thức thanh toán</h3>

                                    <div class="pt-2">
                                        <input type="radio" name="payment" id="momo" value="momo">
                                        <label for="momo">Momo</label>
                                        <br>
                                        <input type="radio" name="payment" id="vnpay" value="vnpay">
                                        <label for="vnpay">VNPay</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-between mt-4">
                    <div class="col-3">
                        <a href="#" class="text-secondary">Quay lại trang đặt bàn</a>
                    </div>
                    <div class="col-2">
                        <a class="btn-line">Thanh toán</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection