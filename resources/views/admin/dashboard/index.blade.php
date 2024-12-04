@extends('admin.master')

@section('title', 'Thống kê Dashboard')

@section('content')
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-xxl-3 col-sm-6 col-12">
                    <div class="stats-tile">
                        <div class="sale-icon shade-red">
                            <i class="bi bi-pie-chart"></i>
                        </div>
                        <div class="sale-details">
                            <h3 class="text-red">{{ $tableCount }}</h3>
                            <p><a href="{{ route('admin.table.index') }}">Bàn</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6 col-12">
                    <div class="stats-tile">
                        <div class="sale-icon shade-blue">
                            <i class="bi bi-emoji-smile"></i>
                        </div>
                        <div class="sale-details">
                            <h3 class="text-blue">{{ $userCount }}</h3>
                            <p><a href="{{ route('admin.user.index') }}">Tài Khoản</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6 col-12">
                    <div class="stats-tile">
                        <div class="sale-icon shade-yellow">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div class="sale-details">
                            <h3 class="text-yellow">{{ $categoryCount }}</h3>
                            <p><a href="{{ route('admin.category.index') }}">Thực Đơn</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6 col-12">
                    <div class="stats-tile">
                        <div class="sale-icon shade-green">
                            <i class="bi bi-handbag"></i>
                        </div>
                        <div class="sale-details">
                            <h3 class="text-green">{{ $orderCount }}</h3>
                            <p><a href="{{ route('admin.order.index') }}">Đơn Hàng</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row">
                <div class="col-xxl-9 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Bắt đầu dòng -->
                            <div class="row">
                                <!-- Tóm tắt báo cáo -->
                                <div class="col-xxl-3 col-sm-4 col-12">
                                    <div class="reports-summary">
                                        <!-- Doanh số bán hàng tổng quan -->
                                        <div class="reports-summary-block">
                                            <i class="bi bi-circle-fill text-primary me-2"></i>
                                            <div class="d-flex flex-column">
                                                <h6>Số Lượng Đặt Bàn</h6>
                                                <h5>{{ number_format($totalBookings ?? 0, 0, '.', ',') }} Bàn</h5>

                                                <!-- Hiển thị doanh thu -->
                                            </div>
                                        </div>
                                        <!-- Thu nhập tổng quan -->
                                        <div class="reports-summary-block">
                                            <i class="bi bi-circle-fill text-success me-2"></i>
                                            <div class="d-flex flex-column">
                                                <h6>Doanh Thu Từ Đặt Bàn</h6>
                                                <h5>{{ number_format($totalBookingRevenue ?? 0, 0, '.', ',') }} Triệu</h5>
                                            </div>
                                        </div>
                                        <!-- Doanh thu tổng quan -->
                                        <div class="reports-summary-block">
                                            <i class="bi bi-circle-fill text-danger me-2"></i>
                                            <div class="d-flex flex-column">
                                                <h6>Tỉ Lệ Hủy Đặt Bàn</h6>
                                                <h5>{{ number_format($cancellationRate ?? 0, 2, '.', ',') }}%</h5>
                                                <!-- Doanh thu đã sửa -->
                                            </div>
                                        </div>
                                        <!-- Khách hàng mới -->
                                        <div class="reports-summary-block">
                                            <i class="bi bi-circle-fill text-warning me-2"></i>
                                            <div class="d-flex flex-column">
                                                <h6>Số Lượng Khách</h6>
                                                <h5>{{ number_format($totalCustomers ?? 0) }} Khách</h5>
                                            </div>
                                        </div>
                                        <!-- Nút xem báo cáo -->
                                        <a href="{{ route('admin.report.index') }}" class="btn btn-info download-reports"
                                            onclick="downloadReport()">Xem Báo
                                            Cáo</a>
                                    </div>
                                </div>




                                <!-- Khu vực biểu đồ -->
                                <div class="col-xxl-9 col-sm-8 col-12">
                                    <div class="row">
                                        <!-- Chọn khoảng thời gian -->
                                        <div class="col-12">
                                            <div class="graph-day-selection mt-2" role="group">
                                                <button type="button" class="btn active" data-period="today">Hôm
                                                    Nay</button>
                                                <button type="button" class="btn" data-period="yesterday">Hôm
                                                    Qua</button>
                                                <button type="button" class="btn" data-period="7days">7 Ngày</button>
                                                <button type="button" class="btn" data-period="15days">15 Ngày</button>
                                                <button type="button" class="btn" data-period="30days">30 Ngày</button>
                                            </div>
                                        </div>
                                        <!-- Biểu đồ doanh thu -->
                                        <div class="col-12">
                                            <div id="revenueGraph" class="graph-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Kết thúc dòng -->
                        </div>
                    </div>

                </div>



                <div class="col-xxl-3  col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Sales</div>
                        </div>
                        <div class="card-body">
                            <div id="salesGraph" class="auto-align-graph"></div>
                            <div class="num-stats">
                                <h2>2100</h2>
                                <h6 class="text-truncate">12% higher than last month.</h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Row end -->

            <script>
                var options = {
                    chart: {
                        height: 317,
                        type: 'area',
                        toolbar: {
                            show: false, // Ẩn thanh công cụ
                        },
                        events: {
                            resize: function(chart) {
                                chart.updateOptions({
                                    chart: {
                                        height: 317, // Đảm bảo kích thước biểu đồ không bị thay đổi quá mức
                                    }
                                });
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false // Tắt hiển thị nhãn dữ liệu
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    series: [{
                        name: 'Số Lượng Đặt Bàn',
                        data: [{{ implode(',', $bookingData) }}], // Dữ liệu Số Lượng Đặt Bàn từ server
                        yAxisIndex: 0,
                    }, {
                        name: 'Doanh Thu Từ Đặt Bàn',
                        data: [{{ implode(',', $revenueData) }}], // Dữ liệu Doanh Thu từ server
                        yAxisIndex: 1,
                    }],
                    grid: {
                        borderColor: '#e0e6ed',
                        strokeDashArray: 5,
                        xaxis: {
                            lines: {
                                show: true // Hiển thị các đường trên trục X
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false, // Không hiển thị các đường trên trục Y
                            }
                        },
                        padding: {
                            top: 0,
                            right: 0,
                            bottom: 10,
                            left: 0
                        },
                    },
                    xaxis: {
                        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                            "Dec"
                        ], // Các tháng trong năm
                        labels: {
                            style: {
                                colors: '#9a9a9a',
                                fontSize: '12px',
                                fontWeight: 600
                            }
                        }
                    },
                    yaxis: [{
                        opposite: true, // Trục Y thứ nhất hiển thị ở phía đối diện
                    }, {
                        opposite: false, // Trục Y thứ hai hiển thị bình thường
                    }],
                    colors: ['#4267cd', '#32b2fa'], // Màu sắc cho hai chuỗi dữ liệu
                    markers: {
                        size: 0,
                        opacity: 0.1,
                        colors: ['#4267cd', '#32b2fa'],
                        strokeColor: "#ffffff",
                        strokeWidth: 2,
                        hover: {
                            size: 7, // Kích thước điểm khi hover
                        }
                    },
                    tooltip: {
                        enabled: true,
                        shared: true, // Tooltip sẽ chia sẻ thông tin giữa các chuỗi dữ liệu
                        theme: 'dark', // Chế độ giao diện tối cho tooltip
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'center',
                        markers: {
                            width: 12,
                            height: 12,
                            radius: 6
                        },
                    },
                };

                var chart = new ApexCharts(
                    document.querySelector("#revenueGraph"), // ID phần tử HTML cần vẽ biểu đồ
                    options
                );

                chart.render();

                // Xử lý sự kiện thay đổi khoảng thời gian
                document.querySelectorAll('.graph-day-selection .btn').forEach(button => {
                    button.addEventListener('click', function() {
                        // Thay đổi lớp active khi chọn khoảng thời gian
                        document.querySelectorAll('.graph-day-selection .btn').forEach(btn => btn.classList.remove(
                            'active'));
                        this.classList.add('active');

                        // Lấy khoảng thời gian được chọn
                        var period = this.getAttribute('data-period');

                        // Gửi yêu cầu tới server để lấy dữ liệu mới cho khoảng thời gian này
                        fetch('/getDataForPeriod', { // URL này sẽ cần được thay đổi sao cho phù hợp với backend của bạn
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    period: period
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Cập nhật lại biểu đồ sau khi lấy dữ liệu mới
                                chart.updateSeries([{
                                    name: 'Số Lượng Đặt Bàn',
                                    data: data.bookingData // Dữ liệu mới cho số lượng đặt bàn
                                }, {
                                    name: 'Doanh Thu Từ Đặt Bàn',
                                    data: data.revenueData // Dữ liệu mới cho doanh thu
                                }]);
                            })
                            .catch(error => console.error('Error fetching data:', error));
                    });
                });
            </script>






            <!-- Row start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Đơn Hàng</div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr>
                                            <th>Khách Hàng</th>
                                            <th>Sản Phẩm</th>
                                            <th>Mã Người Dùng</th>
                                            <th>Ngày Đặt Hàng</th>
                                            <th>Số Tiền</th>
                                            <th>Trạng Thái Thanh Toán</th>
                                            <th>Trạng Thái Đơn Hàng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="media-box">
                                                    <img src="../adminn/assets/images/user3.png" class="media-avatar"
                                                        alt="Bootstrap Gallery">
                                                    <div class="media-box-body">
                                                        <div class="text-truncate">Ellie Collins</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="media-box">
                                                    <img src="../adminn/assets/images/food/img3.jpg" class="media-avatar"
                                                        alt="Admin Themes">
                                                    <div class="media-box-body">
                                                        <div class="text-truncate">Ginger Snacks</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Arise827</td>
                                            <td>12/12/2021</td>
                                            <td>$18.00</td>
                                            <td>
                                                <span class="text-green td-status"><i class="bi bi-check-circle"></i>
                                                    Đã Thanh Toán</span>
                                            </td>
                                            <td>
                                                <span class="badge shade-green min-90">Đã Giao</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="media-box">
                                                    <img src="../adminn/assets/images/user.png" class="media-avatar"
                                                        alt="Bootstrap Gallery">
                                                    <div class="media-box-body">
                                                        <div class="text-truncate">Sophie Nguyen</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="media-box">
                                                    <img src="../adminn/assets/images/food/img6.jpg" class="media-avatar"
                                                        alt="Admin Themes">
                                                    <div class="media-box-body">
                                                        <div class="text-truncate">Guava Sorbet</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Arise253</td>
                                            <td>18/12/2021</td>
                                            <td>$32.00</td>
                                            <td>
                                                <span class="text-red td-status"><i class="bi bi-x-circle"></i>
                                                    Thất Bại</span>
                                            </td>
                                            <td>
                                                <span class="badge shade-red min-90">Đã Hủy</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="media-box">
                                                    <img src="../adminn/assets/images/user4.png" class="media-avatar"
                                                        alt="Bootstrap Gallery">
                                                    <div class="media-box-body">
                                                        <div class="text-truncate">Darcy Ryan</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="media-box">
                                                    <img src="../adminn/assets/images/food/img5.jpg" class="media-avatar"
                                                        alt="Admin Themes">
                                                    <div class="media-box-body">
                                                        <div class="text-truncate">Gooseberry Surprise</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Arise878</td>
                                            <td>22/12/2021</td>
                                            <td>$19.00</td>
                                            <td>
                                                <span class="text-blue td-status"><i class="bi bi-clock-history"></i>
                                                    Chờ Xử Lý</span>
                                            </td>
                                            <td>
                                                <span class="badge shade-blue min-90">Đang Xử Lý</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Row end -->

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Giao Dịch</div>
                        </div>
                        <div class="card-body">
                            <div class="scroll370">
                                <div class="transactions-container">
                                    <div class="transaction-block">
                                        <div class="transaction-icon shade-blue">
                                            <i class="bi bi-credit-card"></i>
                                        </div>
                                        <div class="transaction-details">
                                            <h4>Thẻ Visa</h4>
                                            <p class="text-truncate">Đặt Mua Laptop</p>
                                        </div>
                                        <div class="transaction-amount text-blue">$1590</div>
                                    </div>
                                    <div class="transaction-block">
                                        <div class="transaction-icon shade-green">
                                            <i class="bi bi-paypal"></i>
                                        </div>
                                        <div class="transaction-details">
                                            <h4>Paypal</h4>
                                            <p class="text-truncate">Nhận Thanh Toán</p>
                                        </div>
                                        <div class="transaction-amount text-green">$310</div>
                                    </div>
                                    <div class="transaction-block">
                                        <div class="transaction-icon shade-blue">
                                            <i class="bi bi-pin-map"></i>
                                        </div>
                                        <div class="transaction-details">
                                            <h4>Du Lịch</h4>
                                            <p class="text-truncate">Chuyến Đi Yosemite</p>
                                        </div>
                                        <div class="transaction-amount text-blue">$4900</div>
                                    </div>
                                    <div class="transaction-block">
                                        <div class="transaction-icon shade-blue">
                                            <i class="bi bi-bag-check"></i>
                                        </div>
                                        <div class="transaction-details">
                                            <h4>Mua Sắm</h4>
                                            <p class="text-truncate">Thanh Toán Hóa Đơn</p>
                                        </div>
                                        <div class="transaction-amount text-blue">$285</div>
                                    </div>
                                    <div class="transaction-block">
                                        <div class="transaction-icon shade-green">
                                            <i class="bi bi-boxes"></i>
                                        </div>
                                        <div class="transaction-details">
                                            <h4>Ngân Hàng</h4>
                                            <p class="text-truncate">Đầu Tư</p>
                                        </div>
                                        <div class="transaction-amount text-green">$150</div>
                                    </div>
                                    <div class="transaction-block">
                                        <div class="transaction-icon shade-green">
                                            <i class="bi bi-paypal"></i>
                                        </div>
                                        <div class="transaction-details">
                                            <h4>Paypal</h4>
                                            <p class="text-truncate">Nhận Tiền</p>
                                        </div>
                                        <div class="transaction-amount text-green">$790</div>
                                    </div>
                                    <div class="transaction-block">
                                        <div class="transaction-icon shade-blue">
                                            <i class="bi bi-credit-card-2-front"></i>
                                        </div>
                                        <div class="transaction-details">
                                            <h4>Thẻ Tín Dụng</h4>
                                            <p class="text-truncate">Mua Sắm Online</p>
                                        </div>
                                        <div class="transaction-amount text-red">$280</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Công Việc</div>
                        </div>
                        <div class="card-body">
                            <div id="taskGraph"></div>
                            <ul class="task-list-container">
                                <li class="task-list-item">
                                    <div class="task-icon shade-blue">
                                        <i class="bi bi-clipboard-plus"></i>
                                    </div>
                                    <div class="task-info">
                                        <h5 class="task-title">Mới</h5>
                                        <p class="amount-spend">12</p>
                                    </div>
                                </li>
                                <li class="task-list-item">
                                    <div class="task-icon shade-green">
                                        <i class="bi bi-clipboard-check"></i>
                                    </div>
                                    <div class="task-info">
                                        <h5 class="task-title">Hoàn Thành</h5>
                                        <p class="amount-spend">15</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Thông Báo</div>
                        </div>
                        <div class="card-body">
                            <div class="scroll370">
                                <ul class="user-messages">
                                    <li>
                                        <div class="customer shade-blue">MK</div>
                                        <div class="delivery-details">
                                            <span class="badge shade-blue">Bán Hàng</span>
                                            <h5>Marie Kieffer</h5>
                                            <p>Cảm ơn bạn đã chọn sản phẩm Apple. Nếu có thắc mắc, vui lòng liên hệ đội ngũ
                                                bán hàng.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="customer shade-blue">ES</div>
                                        <div class="delivery-details">
                                            <span class="badge shade-blue">Marketing</span>
                                            <h5>Ewelina Sikora</h5>
                                            <p>Tăng doanh số của bạn lên 50% với công cụ marketing đơn giản và hiệu quả.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="customer shade-blue">TN</div>
                                        <div class="delivery-details">
                                            <span class="badge shade-blue">Kinh Doanh</span>
                                            <h5>Teboho Ncube</h5>
                                            <p>Sử dụng mã khuyến mãi HKYMM50 để được giảm giá 50% đơn hàng đầu tiên.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="customer shade-blue">CJ</div>
                                        <div class="delivery-details">
                                            <span class="badge shade-blue">Quản Trị</span>
                                            <h5>Carla Jackson</h5>
                                            <p>Trước khi mời quản trị viên, bạn cần tạo một vai trò để gán cho họ.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="customer shade-red">JK</div>
                                        <div class="delivery-details">
                                            <span class="badge shade-red">Bảo Mật</span>
                                            <h5>Julie Kemp</h5>
                                            <p>Gói bảo mật của bạn đã hết hạn. Vui lòng gia hạn gói.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Hoạt Động</div>
                        </div>
                        <div class="card-body">
                            <div class="scroll370">
                                <div class="activity-container">
                                    <div class="activity-block">
                                        <div class="activity-user">
                                            <img src="../adminn/assets/images/user.png" alt="Người Dùng Hoạt Động">
                                        </div>
                                        <div class="activity-details">
                                            <h4>Lilly Desmet</h4>
                                            <h5>3 giờ trước</h5>
                                            <p>Gửi hóa đơn mã #23457</p>
                                            <span class="badge shade-green">Đã Gửi</span>
                                        </div>
                                    </div>
                                    <div class="activity-block">
                                        <div class="activity-user">
                                            <img src="../adminn/assets/images/user3.png" alt="Người Dùng Hoạt Động">
                                        </div>
                                        <div class="activity-details">
                                            <h4>Jennifer Wilson</h4>
                                            <h5>7 giờ trước</h5>
                                            <p>Thanh toán hóa đơn mã #23459</p>
                                            <span class="badge shade-red">Thanh Toán</span>
                                        </div>
                                    </div>
                                    <div class="activity-block">
                                        <div class="activity-user">
                                            <img src="../adminn/assets/images/user4.png" alt="Người Dùng Hoạt Động">
                                        </div>
                                        <div class="activity-details">
                                            <h4>Elliott Hermans</h4>
                                            <h5>1 ngày trước</h5>
                                            <p>Thanh toán hóa đơn mã #23473</p>
                                            <span class="badge shade-green">Đã Thanh Toán</span>
                                        </div>
                                    </div>
                                    <div class="activity-block">
                                        <div class="activity-user">
                                            <img src="../adminn/assets/images/user5.png" alt="Người Dùng Hoạt Động">
                                        </div>
                                        <div class="activity-details">
                                            <h4>Sophie Michiels</h4>
                                            <h5>3 ngày trước</h5>
                                            <p>Thanh toán hóa đơn mã #23456</p>
                                            <span class="badge shade-green">Đã Thanh Toán</span>
                                        </div>
                                    </div>
                                    <div class="activity-block">
                                        <div class="activity-user">
                                            <img src="../adminn/assets/images/user6.png" alt="Người Dùng Hoạt Động">
                                        </div>
                                        <div class="activity-details">
                                            <h4>Christopher Smith</h4>
                                            <h5>7 ngày trước</h5>
                                            <p>Gửi hóa đơn mã #23487</p>
                                            <span class="badge shade-red">Đã Gửi</span>
                                        </div>
                                    </div>
                                    <div class="activity-block">
                                        <div class="activity-user">
                                            <img src="../adminn/assets/images/user.png" alt="Người Dùng Hoạt Động">
                                        </div>
                                        <div class="activity-details">
                                            <h4>Lilly Desmet</h4>
                                            <h5>3 giờ trước</h5>
                                            <p>Gửi hóa đơn mã #23457</p>
                                            <span class="badge shade-green">Đã Gửi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row end -->

        @endsection
