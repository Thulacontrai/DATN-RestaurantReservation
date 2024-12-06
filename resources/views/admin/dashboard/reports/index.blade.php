@extends('admin.master')

@section('title', 'Báo Cáo Thống kê')

@section('content')
    <div class="content-wrapper-scroll">
        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <div class="row">



                <div class="card">
                    <div class="card-header">
                        <div class="card-title">So sánh</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xxl-2 col-lg-3 col-sm-12 col-12">
                                <div class="card-border m-0 h-100">
                                    <div class="monthly-stats">
                                        <h5>Theo tuần</h5>
                                        <div class="avg-block">
                                            <h4 class="avg-total text-blue">9,500</h4>
                                            <h6 class="avg-label">Đã nhận</h6>
                                        </div>
                                        <div class="avg-block">
                                            <h4 class="avg-total text-red">7,200$</h4>
                                            <h6 class="avg-label">Đã hết hạn</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-8 col-lg-6 col-sm-12 col-12">
                                <div id="graph4"></div>
                            </div>
                            <div class="col-xxl-2 col-lg-3 col-sm-12 col-12">
                                <div class="card-border m-0 h-100">
                                    <div class="monthly-stats">
                                        <h5>Theo tháng</h5>
                                        <div class="avg-block">
                                            <h4 class="avg-total text-blue">32,100</h4>
                                            <h6 class="avg-label">Đã nhận</h6>
                                        </div>
                                        <div class="avg-block">
                                            <h4 class="avg-total text-red">48,700$</h4>
                                            <h6 class="avg-label">Đã hết hạn</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        var options = {
                            chart: {
                                height: 320,
                                type: 'area',
                                toolbar: {
                                    show: false,
                                },
                                dropShadow: {
                                    enabled: true,
                                    opacity: 0.1,
                                    blur: 5,
                                    left: -10,
                                    top: 10
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                curve: 'smooth',
                                width: 3
                            },
                            series: [{
                                name: 'Đã nhận',
                                data: [3000, 1000, 3000, 1000]
                            }, {
                                name: 'Đã hết hạn',
                                data: [1500, 3500, 1500, 3500]
                            }],
                            grid: {
                                borderColor: '#e1e1e1',
                                strokeDashArray: 5,
                                xaxis: {
                                    lines: {
                                        show: true
                                    }
                                },
                                yaxis: {
                                    lines: {
                                        show: false,
                                    }
                                },
                                padding: {
                                    top: 0,
                                    right: 30,
                                    bottom: 0,
                                    left: 30
                                },
                            },
                            xaxis: {
                                type: 'day',
                                categories: ["Quý 1", "Quý 2", "Quý 3", "Quý 4"],
                            },
                            colors: ['#435EEF', '#59a2fb'],
                            yaxis: {
                                show: false,
                            },
                            markers: {
                                size: 0,
                                opacity: 0.2,
                                colors: ['#435EEF', '#59a2fb'],
                                strokeColor: "#fff",
                                strokeWidth: 2,
                                hover: {
                                    size: 7,
                                }
                            },
                            tooltip: {
                                x: {
                                    format: 'dd/MM/yy'
                                },
                            }
                        }

                        var chart = new ApexCharts(
                            document.querySelector("#graph4"),
                            options
                        );

                        chart.render();
                    </script>
                </div>




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
                                        height: 377,
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



        </div>
    </div>
@endsection
