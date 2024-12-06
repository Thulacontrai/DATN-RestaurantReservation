@extends('admin.master')

@section('title', 'Báo Cáo Thống kê')

@section('content')
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Doanh Thu Tháng -->
            <div class="row">
                <!-- Biểu đồ Doanh Thu -->
                <div class="col-xxl-6 col-sm-12 col-12">
                    <div class="card shadow-lg border-light rounded">
                        <div class="card-header text-white">
                        </div>
                        <div class="card-body">
                            <div id="salesGraph" class="auto-align-graph"></div>
                            <div class="num-stats text-center mt-3">
                                <h5 id="totalRevenue" style="color: #71ebed; font-size: 22px; font-weight: 700;">₫0.00</h5>
                                <h6>Các Tháng Trong Năm 2024</h6>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Dữ liệu được nhúng từ server
                                        const data = @json($revenues);

                                        console.log('Dữ liệu từ server:', data); // Log dữ liệu kiểm tra

                                        // Kiểm tra dữ liệu và xử lý
                                        if (Array.isArray(data) && data.length > 0) {
                                            const months = data.map(item => `${item.month < 10 ? '0' : ''}${item.month}-2024`);
                                            const revenues = data.map(item => parseFloat(item.total_revenue) || 0); // Đảm bảo giá trị là số

                                            // Cập nhật tổng doanh thu
                                            const totalRevenue = revenues.reduce((a, b) => a + b, 0);
                                            document.getElementById('totalRevenue').textContent = `₫${totalRevenue.toLocaleString()}`;

                                            // Tạo biểu đồ
                                            renderChart(months, revenues);
                                        } else {
                                            // Không có dữ liệu
                                            document.getElementById('totalRevenue').textContent = 'Chưa có dữ liệu';
                                            renderChart([], []); // Tạo biểu đồ rỗng
                                        }
                                    });

                                    // Hàm tạo biểu đồ
                                    function renderChart(months, revenues) {
                                        const options = {
                                            chart: {
                                                height: 300, // Giảm kích thước biểu đồ
                                                type: 'line', // Biểu đồ dạng đường kết hợp với thanh
                                                toolbar: {
                                                    show: false
                                                },
                                                animations: {
                                                    enabled: true,
                                                    easing: 'easeinout',
                                                    speed: 1000,
                                                    animateGradually: {
                                                        enabled: true,
                                                        delay: 300
                                                    }
                                                }
                                            },
                                            plotOptions: {
                                                bar: {
                                                    horizontal: false,
                                                    columnWidth: '50%', // Giảm chiều rộng cột
                                                    borderRadius: 8, // Bo tròn các góc thanh biểu đồ
                                                }
                                            },
                                            series: [{
                                                    name: 'Doanh Thu',
                                                    data: revenues
                                                },
                                                {
                                                    name: 'Doanh Thu - Dự báo',
                                                    data: revenues.map(rev => rev * 1.05) // Tạo dự báo doanh thu tăng 5%
                                                }
                                            ],
                                            xaxis: {
                                                categories: months,
                                                title: {
                                                    style: {
                                                        fontSize: '14px',
                                                        fontWeight: 'bold',
                                                        color: '#6c757d'
                                                    }
                                                },
                                                labels: {
                                                    rotate: -45,
                                                    style: {
                                                        fontSize: '12px',
                                                        fontWeight: '400',
                                                        colors: '#6c757d'
                                                    }
                                                }
                                            },
                                            yaxis: {
                                                title: {

                                                    style: {
                                                        fontSize: '14px',
                                                        fontWeight: 'bold',
                                                        color: '#6c757d'
                                                    }
                                                },
                                                labels: {
                                                    formatter: function(value) {
                                                        return `₫${value.toLocaleString()}`; // Hiển thị giá trị tiền tệ
                                                    }
                                                }
                                            },
                                            tooltip: {
                                                shared: true,
                                                intersect: false,
                                                y: {
                                                    formatter: function(val) {
                                                        return `₫${val.toLocaleString()}`; // Hiển thị giá trị tiền tệ
                                                    }
                                                },
                                                theme: 'dark',
                                                style: {
                                                    fontSize: '12px',
                                                    fontWeight: '600'
                                                }
                                            },
                                            fill: {
                                                type: 'gradient', // Hiệu ứng gradient cho thanh biểu đồ
                                                gradient: {
                                                    shade: 'light',
                                                    type: 'horizontal',
                                                    shadeIntensity: 0.3,
                                                    gradientToColors: ['#FFB6C1', '#FFD700'], // Gradient màu hồng và vàng
                                                    inverseColors: true,
                                                    opacityFrom: 0.8,
                                                    opacityTo: 0.5,
                                                    stops: [0, 100]
                                                }
                                            },
                                            colors: ['#00C6AE', '#FF6347'], // Thêm nhiều màu cho các chuỗi
                                            grid: {
                                                show: true,
                                                borderColor: '#e0e6ed',
                                                strokeDashArray: 5,
                                                xaxis: {
                                                    lines: {
                                                        show: true
                                                    }
                                                },
                                                yaxis: {
                                                    lines: {
                                                        show: true
                                                    }
                                                }
                                            },
                                            responsive: [{
                                                breakpoint: 1024,
                                                options: {
                                                    chart: {
                                                        height: 280
                                                    },
                                                    xaxis: {
                                                        labels: {
                                                            rotate: -30
                                                        }
                                                    }
                                                }
                                            }, {
                                                breakpoint: 768,
                                                options: {
                                                    chart: {
                                                        height: 250
                                                    },
                                                    xaxis: {
                                                        labels: {
                                                            rotate: -30
                                                        }
                                                    }
                                                }
                                            }]
                                        };

                                        // Khởi tạo ApexCharts
                                        const chart = new ApexCharts(document.querySelector("#salesGraph"), options);
                                        chart.render();
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ Food vs Drinks -->
                <div class="col-xxl-6 col-sm-12 col-12">
                    <div class="card shadow-lg border-light rounded">
                        <div class="card-header text-white">
                        </div>
                        <div class="card-body">
                            <div id="foodVsDrinksGraph"></div>
                            <script>
                                var options = {
                                    chart: {
                                        type: 'donut',
                                        height: 350,
                                    },
                                    series: [75, 25], // Giả sử 75% là món ăn, 25% là đồ uống
                                    labels: ['Món Ăn', 'Đồ Uống'],
                                    colors: ['#00cfe8', '#ff4081'],
                                    tooltip: {
                                        y: {
                                            formatter: function(value) {
                                                return value + '%';
                                            }
                                        }
                                    },
                                    legend: {
                                        position: 'bottom',
                                        horizontalAlign: 'center',
                                    }
                                };

                                var chart = new ApexCharts(document.querySelector("#foodVsDrinksGraph"), options);
                                chart.render();
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Doanh thu theo giờ đặt bàn -->
            <div class="row">
                <div class="col-xxl-6 col-sm-12 col-12">
                    <div class="card shadow-lg border-light rounded">
                        <div class="card-header text-white">
                        </div>
                        <div class="card-body">
                            <div id="hourlyReservationsGraph"></div>
                            <script>
                                var options = {
                                    chart: {
                                        type: 'bar',
                                        height: 350,
                                    },
                                    series: [{
                                        name: 'Số Lượng Đặt Bàn',
                                        data: [10, 12, 5, 8, 15, 25, 35, 40, 20, 15, 18, 12]
                                    }],
                                    xaxis: {
                                        categories: ['0h', '1h', '2h', '3h', '4h', '5h', '6h', '7h', '8h', '9h', '10h', '11h'],
                                    },
                                    yaxis: {
                                        title: {
                                            text: 'Số Lượng Đặt Bàn',
                                        },
                                    },
                                    tooltip: {
                                        y: {
                                            formatter: function(value) {
                                                return value + ' đặt bàn';
                                            }
                                        }
                                    },
                                    legend: {
                                        position: 'bottom',
                                        horizontalAlign: 'center',
                                    }
                                };

                                var chart = new ApexCharts(document.querySelector("#hourlyReservationsGraph"), options);
                                chart.render();
                            </script>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ chi tiêu theo nhóm khách -->
                <div class="col-xxl-6 col-sm-12 col-12">
                    <div class="card shadow-lg border-light rounded">
                        <div class="card-header text-white">
                        </div>
                        <div class="card-body">
                            <div id="spendingByGroupGraph"></div>
                            <script>
                                var options = {
                                    chart: {
                                        type: 'bar',
                                        height: 350,
                                    },
                                    series: [{
                                            name: 'Khách VIP',
                                            data: [5000000, 7000000, 6000000, 6500000, 7000000, 7500000, 8000000, 9500000, 8000000,
                                                10000000, 9000000, 11000000
                                            ]
                                        },
                                        {
                                            name: 'Khách Thường',
                                            data: [2000000, 2500000, 2800000, 2300000, 2200000, 2700000, 3000000, 2900000, 3100000, 3300000,
                                                3400000, 3500000
                                            ]
                                        }
                                    ],
                                    xaxis: {
                                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                    },
                                    yaxis: {
                                        title: {
                                            text: 'Tổng Chi Tiêu (VND)',
                                        },
                                    },
                                    tooltip: {
                                        y: {
                                            formatter: function(value) {
                                                return value.toLocaleString('vi-VN', {
                                                    style: 'currency',
                                                    currency: 'VND'
                                                });
                                            }
                                        }
                                    },
                                    legend: {
                                        position: 'bottom',
                                        horizontalAlign: 'center',
                                    }
                                };

                                var chart = new ApexCharts(document.querySelector("#spendingByGroupGraph"), options);
                                chart.render();
                            </script>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
