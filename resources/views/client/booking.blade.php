@extends('client.layouts.master')
@section('title', 'Booking')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                    <div class="col bg-warning p-2 text-uppercase">
                        <h5>Bước 1 - Chọn giờ ăn</h5>
                    </div>
                    <div class="col bg-secondary p-2 text-uppercase">
                        <h5><a href="">Bước 2 -
                                Thông tin khách hàng</a></h5>
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="row text-center mt-3">
                        @foreach ($days as $index => $day)
                            <a href="javascript:void(0)" class="col border m-1 p-2 day-selector"
                                data-index="{{ $index }}">
                                <div class="fw-bold {{ $index === 0 ? 'text-warning' : 'text-light' }}">
                                    {{ $index === 0 ? 'Hôm nay' : ($index === 1 ? 'Ngày mai' : 'Ngày kia') }}
                                </div>
                                <div class="fw-bold text-capitalize {{ $index === 0 ? 'text-warning' : 'text-light' }}">
                                    {{ $day->isoFormat('dddd, DD/MM/YYYY') }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                @foreach ($days as $index => $day)
                    <div class="day-section time-slots" id="day-{{ $index }}"
                        style="{{ $index === 0 ? '' : 'display: none;' }}">
                        <div class="row container mt-2 d-flex justify-content-center align-items-center">
                            @foreach ($timeSlots as $timeSlot)
                                @php
                                    $timeSlotWithDate = Carbon\Carbon::today('Asia/Ho_Chi_Minh')->setTimeFromTimeString(
                                        $timeSlot,
                                    );
                                @endphp

                                @if ($day->isToday() && $now->greaterThan($timeSlotWithDate))
                                    <div class="text-muted col-4 p-2 rounded border d-flex justify-content-center">
                                        <p class="py-2" style="font-size:30px">{{ $timeSlot }}</p>
                                    </div>
                                @else
                                    <div class="col-4 p-2 rounded border d-flex justify-content-center time-slot"
                                        style="cursor: pointer;" data-time="{{ $timeSlot }}"
                                        data-date="{{ $day->format('Y-m-d') }}">
                                        <p class="text-warning py-2" style="font-size:30px;">{{ $timeSlot }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="text-center my-4">
                    <button id="confirm-button" class="btn-line">Xác nhận</button>
                </div>
            </div>
        </section>
    </div>

@endsection
