@extends('admin.master')

@section('title', 'Thống kê Kho')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Biểu đồ nhập kho</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xxl-2 col-lg-3 col-sm-12 col-12">
                    <div class="card-border m-0 h-100">
                        <div class="monthly-stats">
                            <h5>Theo tuần</h5>
                            <div class="avg-block">
                                <h4 class="avg-total text-blue">{{ number_format($weeklyCompleted) }}</h4>
                                <h6 class="avg-label">Hoàn thành</h6>
                            </div>
                            <div class="avg-block">
                                <h4 class="avg-total text-red">{{ number_format($weeklyCanceled) }}</h4>
                                <h6 class="avg-label">Đã Hủy</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-lg-6 col-sm-12 col-12">
                    <!-- Phần tử chứa biểu đồ -->
                    <div id="basic-area-spline-graph"></div>
                </div>
                <div class="col-xxl-2 col-lg-3 col-sm-12 col-12">
                    <div class="card-border m-0 h-100">
                        <div class="monthly-stats">
                            <h5>Theo tháng</h5>
                            <div class="avg-block">
                                <h4 class="avg-total text-blue">{{ number_format($monthlyCompleted) }}</h4>
                                <h6 class="avg-label">Hoàn thành</h6>
                            </div>
                            <div class="avg-block">
                                <h4 class="avg-total text-red">{{ number_format($monthlyCanceled) }}</h4>
                                <h6 class="avg-label">Đã Hủy</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var transactionData = @json($transactionData);

        var options = {
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    opacity: 0.1,
                    blur: 5,
                    left: -10,
                    top: 10
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            series: transactionData,
            grid: {
                borderColor: '#ffffff',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 30
                }
            },
            xaxis: {
                type: 'datetime',
                categories: transactionData[0].data.map(function(item) { return item.x; })
            },
            theme: {
                monochrome: {
                    enabled: true,
                    colors: ['#435EEF', '#59a2fb', '#8ec0fd', '#c7e0ff'],
                    shadeIntensity: 0.1
                }
            },
            markers: {
                size: 0,
                opacity: 0.2,
                colors: ['#435EEF', '#59a2fb', '#8ec0fd', '#c7e0ff'],
                strokeColor: "#fff",
                strokeWidth: 2,
                hover: {
                    size: 7
                }
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                }
            }
        };

        var chart = new ApexCharts(
            document.querySelector("#basic-area-spline-graph"),
            options
        );

        chart.render();
    </script>


      <!-- Biểu đồ Sản Phẩm nhập kho nhiều nhất-->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Biểu đồ số lượng sản phẩm nhập kho</div>
            </div>
            <div class="card-body">
                <div class="row" style="display: flex; justify-content: center;">
                    <div class="col-xxl-8 col-lg-6 col-sm-12 col-12">
                        <!-- Phần tử chứa biểu đồ -->
                        <div id="basic-pie-graph-gradient1"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var options = {
                chart: {
                    width: 400,
                    type: 'pie',
                },
                labels: @json($labels),  // Dữ liệu tên sản phẩm
                series: @json($series),  // Dữ liệu số lượng tồn kho
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                stroke: {
                    width: 0,
                },
                fill: {
                    type: 'gradient',
                },
                colors: ['#435EEF', '#2b86f5', '#63a9ff', '#95c5ff', '#c6e0ff'],
            }
            var chart = new ApexCharts(
                document.querySelector("#basic-pie-graph-gradient1"),
                options
            );
            chart.render();
        </script>

@endsection
