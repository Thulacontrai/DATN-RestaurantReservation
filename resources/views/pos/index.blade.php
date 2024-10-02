@extends('pos.layouts.master')

@section('title', 'pos Dashboard')

@section('content')
    <div class="content-page">
        <div class="container-fluid r-banner-cap">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="card card-block card-stretch card-height r-odr-block">
                        <div class="d-flex align-items-center justify-content-between p-20">
                            <div class="text-warning">
                                <i class="fas fa-utensils resto-img"></i>
                            </div>
                            <div class="iq-card-text">
                                <h2 class="mb-0 line-height">25 K</h2>
                                <p class="mb-0">Đơn hàng</p>
                            </div>
                            <div>
                                <span class="badge badge-success cust-badge">75% <i class="fas fa-angle-up ml-1"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="card card-block card-stretch card-height r-odr-block success">
                        <div class="d-flex align-items-center justify-content-between p-20">
                            <div class="text-success">
                                <i class="fas fa-users resto-img"></i>
                            </div>
                            <div class="iq-card-text">
                                <h2 class="mb-0 line-height">15 K</h2>
                                <p class="mb-0">Giao dịch</p>
                            </div>
                            <div>
                                <span class="badge badge-success cust-badge">53% <i class="fas fa-angle-up ml-1"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="card card-block card-stretch card-height r-odr-block info" style="cursor: pointer;"
                        onclick="openModal('reservationDetail')">
                        <div class="d-flex align-items-center justify-content-between p-20">
                            <div class="text-info">
                                <i class="fas fa-coins resto-img"></i>
                            </div>
                            <div class="iq-card-text">
                                <h2 class="mb-0 line-height">40 K</h2>
                                <p class="mb-0">Đặt trước</p>
                            </div>
                            <div>
                                <span class="badge badge-danger cust-badge">25% <i
                                        class="fas fa-angle-down ml-1"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reservation Detail Modal -->
                <div id="reservationDetailModal" class="modal">
                    <div class="modal-content">
                        <h3 class="text-center mb-4 modal-header">Đơn Đặt Bàn</h3>
                        <form id="reservationDetails" class="form-container">
                            <div class="d-flex justify-content-end mt-3 full-width">
                                <!-- Nút để mở form Đơn Đặt Bàn Sắp Đến -->
                                <button type="button" onclick="openModal('upcoming')" class="btn btn-primary mr-2">Sắp
                                    Đến</button>
                                <!-- Nút để mở form Đơn Đặt Bàn Quá Giờ -->
                                <button type="button" onclick="openModal('expired')" class="btn btn-secondary mr-2">Quá
                                    Giờ</button>
                                <button type="button" onclick="closeModal('reservationDetail')"
                                    class="btn btn-danger">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Đơn Đặt Bàn Sắp Đến Modal -->
                <div id="upcomingReservationModal" class="modal">
                    <h3 class="text-center mb-4">Đơn Đặt Bàn Sắp Đến</h3>
                    <form id="upcomingReservationDetails" class="form-container">
                        <div class="form-group half-width">
                            <label for="orderIdUpcoming">Mã Đơn Hàng:</label>
                            <input type="text" id="orderIdUpcoming" name="orderIdUpcoming" readonly class="form-control">
                        </div>
                        <div class="form-group half-width">
                            <label for="customerUpcoming">Khách hàng:</label>
                            <input type="text" id="customerUpcoming" name="customerUpcoming" class="form-control">
                        </div>
                        <div class="form-group half-width">
                            <label for="phoneUpcoming">Số điện thoại:</label>
                            <input type="text" id="phoneUpcoming" name="phoneUpcoming" class="form-control">
                        </div>
                        <div class="form-group half-width">
                            <label for="reservationDateUpcoming">Ngày đặt:</label>
                            <input type="date" id="reservationDateUpcoming" name="reservationDateUpcoming"
                                class="form-control">
                        </div>
                        <div class="form-group half-width">
                            <label for="tableNumberUpcoming">Bàn số:</label>
                            <input type="text" id="tableNumberUpcoming" name="tableNumberUpcoming" class="form-control">
                        </div>
                        <div class="form-group half-width">
                            <label for="statusUpcoming">Trạng thái:</label>
                            <select id="statusUpcoming" name="statusUpcoming" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group half-width">
                            <label for="guestCountUpcoming">Số người:</label>
                            <input type="number" id="guestCountUpcoming" name="guestCountUpcoming" class="form-control">
                        </div>
                        <div class="form-group half-width">
                            <label for="notesUpcoming">Ghi chú:</label>
                            <input type="text" id="notesUpcoming" name="notesUpcoming" class="form-control">
                        </div>
                        <div class="d-flex justify-content-end mt-3 full-width">
                            <button type="button" onclick="updateReservation('upcoming')"
                                class="btn btn-primary mr-2">Cập nhật</button>
                            <button type="button" onclick="printReservation('upcoming')"
                                class="btn btn-secondary mr-2">In</button>
                            <button type="button" onclick="closeModal('upcoming')" class="btn btn-danger">Đóng</button>
                        </div>
                    </form>
                </div>


                <!-- Đơn Đặt Bàn Quá Giờ Modal -->
                <div id="expiredReservationModal" class="modal">
                    <h3 class="text-center mb-4">Đơn Đặt Bàn Quá Giờ</h3>
                    <form id="expiredReservationDetails" class="form-container">
                        <div class="form-group half-width">
                            <label for="orderIdExpired">Mã Đơn Hàng:</label>
                            <input type="text" id="orderIdExpired" name="orderIdExpired" value="#48" readonly
                                class="form-control">
                        </div>
                        <div class="form-group half-width">
                            <label for="customerExpired">Khách hàng:</label>
                            <input type="text" id="customerExpired" name="customerExpired" value="Nguyen"
                                class="form-control">
                        </div>
                        <div class="form-group half-width">
                            <label for="phoneExpired">Số điện thoại:</label>
                            <input type="text" id="phoneExpired" name="phoneExpired" value="98765"
                                class="form-control">
                        </div>
                        <div class="form-group half-width">
                            <label for="reservationDateExpired">Ngày đặt:</label>
                            <input type="date" id="reservationDateExpired" name="reservationDateExpired"
                                value="2024-08" class="form-control">
                        </div>
                        <div class="form-group half-width">
                            <label for="tableNumberExpired">Bàn số:</label>
                            <input type="text" id="tableNumberExpired" name="tableNumberExpired"
                                class="form-control">
                        </div>
                        <div class="form-group half-width">
                            <label for="statusExpired">Trạng thái:</label>
                            <select id="statusExpired" name="statusExpired" class="form-control">
                                <option value="pending" selected>Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group half-width">
                            <label for="guestCountExpired">Số người:</label>
                            <input type="number" id="guestCountExpired" name="guestCountExpired" value="2"
                                class="form-control">
                        </div>
                        <div class="form-group half-width">
                            <label for="notesExpired">Ghi chú:</label>
                            <input type="text" id="notesExpired" name="notesExpired" value="late"
                                class="form-control">
                        </div>
                        <div class="d-flex justify-content-end mt-3 full-width">
                            <button type="button" onclick="updateReservation('expired')"
                                class="btn btn-primary mr-2">Cập nhật</button>
                            <button type="button" onclick="printReservation('expired')"
                                class="btn btn-secondary mr-2">In</button>
                            <button type="button" onclick="closeModal('expired')" class="btn btn-danger">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Dishes and Combos -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Món Ăn</h4>
                        <div id="trending-order-slick-arrow" class="slick-arrow-block">
                            <button class="slick-prev slick-arrow" aria-label="Previous" type="button">Previous</button>
                            <button class="slick-next slick-arrow" aria-label="Next" type="button">Next</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="trending-order slick-initialized slick-slider">
                            <div class="slick-list draggable">
                                <div class="slick-track">
                                    @foreach ($dishes as $dish)
                                        <div class="item slick-slide">
                                            <img src="{{ asset($dish->image) }}"
                                                class="img-fluid rounded-circle avatar-120 odr-img" alt="image">
                                            <div class="odr-content bg-danger-light text-center">
                                                <span class="badge badge-white text-center">
                                                    <i class="fas fa-heart text-danger"></i>
                                                </span>
                                                <h5 class="mb-1">{{ $dish->name }}</h5>
                                                <h5><strong>${{ number_format($dish->price, 2) }}</strong></h5>
                                                <p class="mb-0">Order: {{ $dish->quantity }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <nav aria-label="Page navigation" class="mt-3">
                            <ul class="pagination justify-content-center">
                                {{ $dishes->links('vendor.pagination.bootstrap-5') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Combo Section -->
            <div class="col-lg-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Combo</h4>
                        <div id="trending-order-slick-arrow" class="slick-arrow-block">
                            <button class="slick-prev slick-arrow" aria-label="Previous" type="button">Previous</button>
                            <button class="slick-next slick-arrow" aria-label="Next" type="button">Next</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="resto-blog slick-initialized slick-slider">
                            <div class="slick-list draggable">
                                <div class="slick-track">
                                    @foreach ($combos as $combo)
                                        <div class="item slick-slide" data-slick-index="{{ $loop->index }}">
                                            <img src="{{ asset($combo->image) }}" class="rounded img-fluid w-100"
                                                alt="{{ $combo->name }}">
                                            <div class="r-blog-content text-center">
                                                <h4 class="mb-1">{{ $combo->name }}</h4>
                                                <div class="d-flex justify-content-center mb-1">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <a href="#" tabindex="0">
                                                            <i
                                                                class="las la-star {{ $i < $combo->rating ? 'text-warning' : 'text-light' }}"></i>
                                                        </a>
                                                    @endfor
                                                </div>
                                                <p class="body-text font-weight-bold mb-1">
                                                    <i class="las la-map-marker-alt mr-1"></i> {{ $combo->address }}
                                                </p>
                                                <p class="mb-0">{{ Str::limit($combo->description, 50) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <nav aria-label="Page navigation" class="mt-3">
                            <ul class="pagination justify-content-center">
                                {{ $combos->links('vendor.pagination.bootstrap-5') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS for Modal Styling -->
    <style>
        .modal {
            display: none;
            background-color: white;
            width: 100%;
            max-width: 600px;
            padding: 20px;
            border-radius: 8px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            z-index: 1050;
            overflow-y: auto;
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .form-group {
            flex: 0 0 48%;
        }

        .full-width {
            flex: 0 0 70%;
            padding-bottom: 30px;
        }

        .form-control {
            width: 100%;
            border-radius: 6px;
            border: 1px solid #d1d1d1;
            padding: 10px;
        }

        button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>

    <!-- JavaScript for Modal Actions -->
    <script>
        function openModal(type) {
            if (type === 'upcoming') {
                document.getElementById('upcomingReservationModal').style.display = 'block';
            } else if (type === 'expired') {
                document.getElementById('expiredReservationModal').style.display = 'block';
            } else {
                document.getElementById('reservationDetailModal').style.display = 'block';
            }
        }

        function closeModal(type) {
            if (type === 'upcoming') {
                document.getElementById('upcomingReservationModal').style.display = 'none';
            } else if (type === 'expired') {
                document.getElementById('expiredReservationModal').style.display = 'none';
            } else {
                document.getElementById('reservationDetailModal').style.display = 'none';
            }
        }

        function updateReservation(type = '') {
            const idSuffix = type ? type.charAt(0).toUpperCase() + type.slice(1) : '';
            const orderId = document.getElementById(`orderId${idSuffix}`).value;
            const customer = document.getElementById(`customer${idSuffix}`).value;
            const phone = document.getElementById(`phone${idSuffix}`).value;
            const reservationDate = document.getElementById(`reservationDate${idSuffix}`).value;
            const tableNumber = document.getElementById(`tableNumber${idSuffix}`).value;
            const status = document.getElementById(`status${idSuffix}`).value;
            const guestCount = document.getElementById(`guestCount${idSuffix}`).value;
            const notes = document.getElementById(`notes${idSuffix}`).value;

            fetch('/api/reservation/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        orderId: orderId,
                        customer: customer,
                        phone: phone,
                        reservationDate: reservationDate,
                        tableNumber: tableNumber,
                        status: status,
                        guestCount: guestCount,
                        notes: notes
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert('Reservation updated successfully!');
                    closeModal(type || 'reservationDetail');
                })
                .catch((error) => {
                    alert('Failed to update reservation.');
                });
        }

        function printReservation(type = '') {
            window.print();
        }

        function loadUpcomingReservationDetails(reservationId) {
            fetch(`/api/reservations/${reservationId}`) // Adjust the API endpoint as needed
                .then(response => response.json())
                .then(data => {
                    document.getElementById('orderIdUpcoming').value = data.id;
                    document.getElementById('customerUpcoming').value = data.customer
                    .name; // Adjust according to your data structure
                    document.getElementById('phoneUpcoming').value = data.customer.phone;
                    document.getElementById('reservationDateUpcoming').value = data.reservation_date;
                    document.getElementById('tableNumberUpcoming').value = data.table_number;
                    document.getElementById('statusUpcoming').value = data.status;
                    document.getElementById('guestCountUpcoming').value = data.guest_count;
                    document.getElementById('notesUpcoming').value = data.notes || 'None';

                    openModal('upcoming'); // Open the modal after data is loaded
                })
                .catch(error => console.error('Error loading reservation details:', error));
        }
    </script>

@endsection
