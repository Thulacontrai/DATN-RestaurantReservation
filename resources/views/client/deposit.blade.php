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
            <form action="{{ route('MOMOCheckout.client') }}" method="POST">
                @csrf
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
                                                <p id="info-name">{{ $showDeposit['user_name'] }}</p>
                                                <input type="hidden" name="user_name"
                                                    value="{{ $showDeposit['user_name'] }}">
                                                <p id="info-phone">{{ $showDeposit['user_phone'] }}</p>
                                                <input type="hidden" name="user_phone"
                                                    value="{{ $showDeposit['user_phone'] }}">
                                                <p id="info-people">{{ $showDeposit['guest_count'] }} người</p>
                                                <input type="hidden" name="guest_count"
                                                    value="{{ $showDeposit['guest_count'] }}">
                                                <p id="info-datetime">{{ $showDeposit['reservation_date'] }}
                                                    {{ $showDeposit['reservation_time'] }}</p>
                                                <input type="hidden" name="reservation_date"
                                                    value="{{ $showDeposit['reservation_date'] }}">
                                                <input type="hidden" name="reservation_time"
                                                    value="{{ $showDeposit['reservation_time'] }}">
                                                <p id="info-notes">{{ $showDeposit['note'] ?? null }}</p>
                                                <input type="hidden" name="note"
                                                    value="{{ $showDeposit['note'] ?? null }}">
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
                                                <p>100.000 đ</p>
                                                <p>{{ $showDeposit['guest_count'] }}</p>
                                                <p>{{ number_format($deposit) }} đ</p>
                                                <input type="hidden" name="deposit" value="{{ $deposit }}">
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
                                            <input type="radio" name="payment" id="payUrl" value="payUrl" checked>
                                            <label for="payUrl">Momo</label>
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
                            <button type="submit" class="btn-line">Thanh toán</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
